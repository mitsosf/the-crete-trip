<?php

namespace App\Http\Controllers\Participants;

use App\Http\Controllers\Controller;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadeRequest;

class ParticipantController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('participant');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //My Account

        $rooming = DB::table('event')->where('attribute', 'rooming')->first()->value;

        return view('participants.home', compact('rooming'));
    }

    public function editEsnCard(Request $request)
    {
        $this->validate($request, [
            'esncard' => 'max:255'
        ]);

        $user = User::find(Auth::user()->id);
        $user->esncardstatus = User::esnCardStatus($request['esncard']);
        $user->esncard = $request['esncard'];
        $user->update();
        return response()->json(['new_esncard' => $user->esncard], 200);
    }

    public function pay()
    {
        //Simulate middleware
        if (Auth::user()->section != "International Guests (ESNers)") {
            return redirect(route('login'));
        }

        return view('participants.pay');
    }

    public function faq()
    {
        return view('participants.faq');
    }

    public function terms()
    {
        return view('participants.terms');
    }

    public function rooming()  //The good part
    {
        $user = Auth::user();
        $roomID = $user->rooming;

        $room = DB::table('rooms')->where('id', $roomID);
        $roomIsFinal = false;

        //If participant is not in a room
        if ($room->count() == 0) {
            return view('participants.rooming', compact('roomIsFinal'));
        } else {

            $room = $room->first();


            if ($room->final == 1) {
                $roomIsFinal = true;
            }


            $roomCode = $room->code;

            $roomActual = $room->actual;

            if (Auth::user()->rooming == "No") {
                $roommates[0] = User::find($user->id);
            } else {
                $roommates = DB::table('users')->where('rooming', $roomID)->get();
            }


            return view('participants.rooming', compact('roomIsFinal', 'roomID', 'roomCode', 'roommates','roomActual'));

        }
    }

    public function createRoom()
    {
        $user = Auth::user();


        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        $section = $user->section;
        $hotelId = DB::table('sections')->where('name', $section)->first()->hotel_id;

        $bedTypes = DB::table('hotels')->where('id', $hotelId)->first();

        //Figure out the maximum amount of beds of each type for this hotel
        $maxBeds['2'] = $bedTypes->twobeds;
        $maxBeds['3'] = $bedTypes->threebeds;
        $maxBeds['4'] = $bedTypes->fourbeds;
        $maxBeds['5'] = $bedTypes->fivebeds;
        $maxBeds['6'] = $bedTypes->sixbeds;


        //Figure out the taken rooms of each type for this hotel
        $takenBeds['2'] = 0;
        $takenBeds['3'] = 0;
        $takenBeds['4'] = 0;
        $takenBeds['5'] = 0;
        $takenBeds['6'] = 0;

        //Get all taken rooms for this hotel
        $rows = DB::table('rooms')->where('hotel', $hotelId)->where('final', '!=', '0')->get();

        //Get exact number of taken rooms of each kind for this hotel
        foreach ($rows as $row) {
            $takenBeds[$row->beds]++;
        }

        //Get number of available beds of each kind
        $availableBeds['2'] = $maxBeds['2'] - $takenBeds['2'];
        $availableBeds['3'] = $maxBeds['3'] - $takenBeds['3'];
        $availableBeds['4'] = $maxBeds['4'] - $takenBeds['4'];
        $availableBeds['5'] = $maxBeds['5'] - $takenBeds['5'];
        $availableBeds['6'] = $maxBeds['6'] - $takenBeds['6'];

        //Build list for view
        if ($availableBeds['2'] > 0) {
            $beds['2'] = '2';
        }

        if ($availableBeds['3'] > 0) {
            $beds['3'] = '3';
        }

        if ($availableBeds['4'] > 0) {
            $beds['4'] = '4';
        }

        if ($availableBeds['5'] > 0) {
            $beds['5'] = '5';
        }

        if ($availableBeds['6'] > 0) {
            $beds['6'] = '6';
        }

        return view('participants.createRoom', compact('beds', 'availableBeds'));
    }

    function random_str($length, $keyspace = '0123456789')
    {
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces [] = $keyspace[random_int(0, $max)];
        }
        $code = implode('', $pieces);

        $count = DB::table('rooms')->where('code', $code)->count();
        if ($count === 0) {
            return $code;
        } else {
            $this->random_str();
        }

        return $code;
    }

    public
    function doCreateRoom()
    {
        $user = Auth::user();

        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        $code = $this->random_str(6);
        $hotel = DB::table('sections')->where('name', Auth::user()->section)->first()->hotel_id;

        $room = new Room();
        $room->code = $code;
        $room->hotel = $hotel;
        $room->beds = FacadeRequest::input('roomType'); //TODO PROGIATONE check input
        $room->comments = FacadeRequest::input('comments');

        $room->save();

        $roomId = DB::table('rooms')->where('code', $code)->first()->id;

        $user->rooming = $roomId;
        $user->update();


        return redirect(route('participants.rooming'));
    }

    public
    function joinRoom()
    {
        $user = Auth::user();

        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        return view('participants.joinRoom');
    }

    public
    function doJoinRoom()
    {
        $user = Auth::user();

        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        $id = FacadeRequest::input('id');
        $code = FacadeRequest::input('code');


        //Check if id and code are correct
        $check = DB::table('rooms')->where('id', $id)->where('code', $code)->count();
        if ($check === 0) {
            echo '<script language="javascript">';
            echo 'alert("Room ID and Room Code don\'t match")';
            echo '</script>';
            return redirect(route('participants.joinRoom'));
        } else {
            $room = Room::where('id', $id)->where('code', $code)->first();

            //Check if room is full
            $fullRoom = $room->final;
            if ($fullRoom == 1) {
                echo '<script language="javascript">';
                echo 'alert("Room is full")';
                echo '</script>';
                return redirect(route('participants.joinRoom'));
            }

            //Check if user can check in to this particular hotel
            $participantHotel = DB::table('sections')->where('name', Auth::user()->section)->first()->hotel_id;
            if ($participantHotel != $room->hotel) {
                echo '<script language="javascript">';
                echo 'alert("This room belongs to a different hotel. For more info please contact your Group Leader")';
                echo '</script>';
                return redirect(route('participants.joinRoom'));
            }

            $currentGuests = DB::table('users')->where('rooming', $room->id)->count();
            $availableBeds = $room->beds - $currentGuests;

            if ($availableBeds === 1) { //If last room guest
                //Finalise room
                $room->final = 1;
                $room->update();

                //Get last guest in
                $user->rooming = $room->id;
                $user->update();

                //Send email to all guests

                //Check if it's the final room of this type in this hotel, if yes, delete all open rooms of this type, in this hotel and reset users' rooming status
                $bedtype = '';
                //Build list for view
                if ($room->beds == 2) {
                    $bedtype = 'twobeds';
                }

                if ($room->beds == 3) {
                    $bedtype = 'threebeds';
                }

                if ($room->beds == 4) {
                    $bedtype = 'fourbeds';
                }

                if ($room->beds == 5) {
                    $bedtype = 'fivebeds';
                }

                if ($room->beds == 6) {
                    $bedtype = 'sixbeds';
                }

                $totalBedsOfCertainType = DB::table('hotels')->where('id', $room->hotel)->pluck($bedtype);

                        $finalisedBedsOfCertainType = Room::where('hotel', $participantHotel)->where('beds', $room->beds)->where('final', '1')->count();
                        if ($totalBedsOfCertainType[0] - $finalisedBedsOfCertainType == 0) {
                            //Drop all unfinished rooms and users
                            $openRoomsToBeDeleted = Room::where('hotel', $participantHotel)->where('beds', $room->beds)->where('final', '0')->get();
                            foreach ($openRoomsToBeDeleted as $openRoomToBeDeleted) {
                                $roomOccupants = User::where('rooming', $openRoomToBeDeleted->id)->get();
                                foreach ($roomOccupants as $roomOccupant) {
                                    $roomOccupant->rooming = 'No';
                                    $roomOccupant->update();
                                }
                                $openRoomToBeDeleted->delete();
                    }

                }


            } else { //If not last guest
                $user->rooming = $room->id;
                $user->update();
            }

            return redirect(route('participants.rooming'));
        }
    }

    public
    function randomRoom()
    {

        $user = Auth::user();

        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        return view('participants.randomRoom');
    }

    public
    function doRandomRoom()
    {

        $user = Auth::user();

        //Simulate middleware for already roomed user
        if ($user->rooming != 'No' && false) { //TODO rooming closed, change
            return redirect(route('participants.rooming'));
        }

        $comments = FacadeRequest::input('comments');

        $user->rooming = 'random';
        $user->roomingcomments = '' . $comments;
        $user->update();

        return redirect(route('participants.rooming'));
    }

    public function viewRoommateDetails($id){

        $user = Auth::user();
        $roommate = User::find($id);

        //Check if they are roommates
        if ($user->rooming == $roommate->rooming){
            return view('participants.viewRoommateDetails', compact('roommate'));
        }else{
            return redirect(route('participants.rooming'));
        }

    }

    public
    function logout()
    {
        Auth::logout();
        return redirect(route('participants.home'));
    }
}
