<?php

namespace App\Http\Controllers\OC;

use App\Hotel;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Payment;
use App\Room;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class OCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('oc');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //OC Panel

        //Participants
        $registered = DB::table('users')->count();
        $paid = DB::table('users')->where('fee', '!=', 'No')->count();

        //Beds left
        $availableBeds = DB::table('event')->where('attribute', 'maxBeds')->get()->first()->value;
        $sleepingParticipants = DB::table('users')->where('fee', '140')->count() + DB::table('users')->where('fee', '150')->count();
        $beds = $availableBeds - $sleepingParticipants;

        //Boats
        $bothWays = DB::table('users')->where('tickets', '!=', 'No')->where('boat', 'Travel BOTH WAYS with the group')->count();
        $toCrete = DB::table('users')->where('tickets', '!=', 'No')->where('boat', 'Travel WITH THE GROUP to Crete and return INDIVIDUALLY')->count();
        $fromCrete = DB::table('users')->where('tickets', '!=', 'No')->where('boat', 'Travel INDIVIDUALLY to Crete and return WITH THE GROUP')->count();

        //Map
        $users = DB::table('users')->where('fee', '!=', 'No')->get();

        $elements = DB::table('countries')->get();

        foreach ($elements as $element) {
            $countries[$element->code] = 0;
        }

        foreach ($users as $user) {
            $countryCode = DB::table('countries')->where('name', $user->country)->first()->code;
            $countries[$countryCode]++;
        }

        return view("oc.home", compact('registered', 'paid', 'bothWays', 'toCrete', 'fromCrete', 'beds', 'countries'));
    }

    public function registrations()
    {
        $users = User::all();
        return view('oc.registrations', compact('users'));
    }

    public function sections()
    {
        $entries = Section::all();
        $section = new Section();
        $sections = array();

        foreach ($entries as $entry) {
            $registered = DB::table('users')->where('section', $entry->name)->count();
            $paidFee = DB::table('users')->where('section', $entry->name)->where('fee', '!=', 'No')->count();
            $paidBoat = DB::table('users')->where('section', $entry->name)->where('tickets', '!=', 'No')->count();
            $rate = round(($paidFee / $registered) * 100, 2);
            $section->registered = $registered;
            $section->paidFee = $paidFee;
            $section->paidBoat = $paidBoat;
            $section->name = $entry->name;
            $section->rate = $rate;
            $sections[$entry->name] = $section;
            $section = new Section();
        }

        return view('oc.sections', compact('sections'));
    }

    public function proofs()
    {
        $sections = DB::table('payments')->where('individual', 'No')->where('approved', 'No')->get();
        $individuals = DB::table('payments')->where('individual', 'Yes')->where('approved', 'No')->get();

        $approvedSections = DB::table('payments')->where('individual', 'No')->where('approved', 'Yes')->get();


        return view('oc.proofs', compact('sections', 'individuals', 'approvedSections'));
    }

    public function doApprovePayment($id)
    {
        $payment = Payment::find($id);
        $payment->approved = "Yes";
        $payment->update();

        return redirect(route('oc.proofs'));
    }

    public function cashflow()
    {

        $entries = Section::all();
        $section = new Section();
        $sections = array();

        foreach ($entries as $entry) {
            $section->id = $entry->id;
            $section->name = $entry->name;

            //Get how much money a section has received from all its participants in total
            //Get the ones from fees first
            $payments = DB::table('users')->where('section', $entry->name)->where('fee', '!=', 'No')->get();
            $sum = 0;
            foreach ($payments as $payment) {
                $sum = $sum + $payment->fee;
            }

            //Now boats
            $payments = DB::table('users')->where('section', $entry->name)->where('tickets', '!=', 'No')->get();

            foreach ($payments as $payment) {
                $sum = $sum + $payment->tickets;
            }
            $section->allCash = $sum;     //We have all the cash from fees and boats the section ever had

            //Get how much money section has deposited
            //Fees and boats are the same, as we only check deposits here
            $payments = DB::table('payments')->where('section', $entry->name)->where('approved', 'Yes')->get();
            $sum = 0;
            foreach ($payments as $payment) {
                $sum = $sum + $payment->amount;
            }
            $section->depositedCash = $sum;
            $section->pendingCash = $section->allCash - $section->depositedCash; //Easy peasy lemon squeezy
            $sections[$entry->name] = $section;
            $section = new Section();
        }

        //Now get the total of aaaaall the money we have
        $total = 0;
        foreach ($sections as $section) {
            $total = $total + $section->allCash;
        }

        //Let's also get the sum of all deposits
        $deposited = 0;
        foreach ($sections as $section) {
            $deposited = $deposited + $section->depositedCash;
        }

        $pending = $total - $deposited; // I'm not gonna even...

        return view('oc.cashflow', compact('sections', 'total', 'deposited', 'pending'));
    }

    public function asSection($sectionName)
    {
        $users = User::all()->where('section', $sectionName);
        return view('oc.asSection', compact('users', 'sectionName'));
    }

    public function asParticipant($id)
    {
        return view('oc.asParticipant', ['id' => $id]);
    }

    public function marilena()
    {

        $users = User::where('fee', '!=', 'No')->get();

        $elements = DB::table('sections')->get();

        foreach ($elements as $element) {
            $sections[$element->name] = $element->hotel_id;
        }

        $residents[0] = new User();
        $index = 0;
        foreach ($users as $user) {
            if ($sections[$user->section] === 1) {
                $residents[$index] = $user;
                $index++;
            }

        }
        $residentCount = $index;


        //Get number of checked in peeps
        $sections = Section::all();
        foreach ($sections as $section) {
            $sectionTypes[$section->name] = $section->hotel_id;
        }

        $checkedIn = 0;

        foreach ($residents as $resident) {
            if ($sectionTypes[$resident->section] === 1 && $resident->checkin != "No") {
                $checkedIn++;
            }
        }

        return view('oc.marilena', compact('residents', 'residentCount', 'checkedIn'));
    }

    public function marirena()
    {

        $users = User::where('fee', '!=', 'No')->get();

        $elements = DB::table('sections')->get();

        foreach ($elements as $element) {
            $sections[$element->name] = $element->hotel_id;
        }

        $residents[0] = new User();
        $index = 0;
        foreach ($users as $user) {
            if ($sections[$user->section] === 2) {
                $residents[$index] = $user;
                $index++;
            }
        }

        $residentCount = $index;


        //Get number of checked in peeps
        $sections = Section::all();
        foreach ($sections as $section) {
            $sectionTypes[$section->name] = $section->hotel_id;
        }

        $checkedIn = 0;

        foreach ($residents as $resident) {
            if ($sectionTypes[$resident->section] === 2 && $resident->checkin != "No") {
                $checkedIn++;
            }
        }

        return view('oc.marirena', compact('residents', 'residentCount', 'checkedIn'));
    }

    public function heraklion()
    {
        $users = User::where('fee', '!=', 'No')->get();

        $elements = DB::table('sections')->get();

        foreach ($elements as $element) {
            $sections[$element->name] = $element->hotel_id;
        }

        $residents[0] = new User();
        $index = 0;
        foreach ($users as $user) {
            if ($sections[$user->section] === 3) {
                $residents[$index] = $user;
                $index++;
            }
        }

        $residentCount = $index;


        //Get number of checked in peeps
        $sections = Section::all();
        foreach ($sections as $section) {
            $sectionTypes[$section->name] = $section->hotel_id;
        }

        $checkedIn = 0;

        foreach ($residents as $resident) {
            if ($sectionTypes[$resident->section] === 3 && $resident->checkin != "No") {
                $checkedIn++;
            }
        }

        return view('oc.heraklion', compact('residents', 'residentCount', 'checkedIn'));
    }

    public function rooming()
    {
        $hotels = DB::table('hotels')->get();

        $finalRooms = DB::table('rooms')->where('final', '1')->get();

        //Initialise taken rooms array
        foreach ($hotels as $hotel) {
            $takenRooms[$hotel->id] = new Hotel();
            $takenRooms[$hotel->id]->id = $hotel->id;
            $takenRooms[$hotel->id]->name = $hotel->name;
            $takenRooms[$hotel->id]->twobeds = 0;
            $takenRooms[$hotel->id]->threebeds = 0;
            $takenRooms[$hotel->id]->fourbeds = 0;
            $takenRooms[$hotel->id]->fivebeds = 0;
            $takenRooms[$hotel->id]->sixbeds = 0;
        }

        foreach ($finalRooms as $finalRoom) {
            if ($finalRoom->beds == 2) {
                $takenRooms[$finalRoom->hotel]->twobeds++;

            }
            if ($finalRoom->beds == 3) {
                $takenRooms[$finalRoom->hotel]->threebeds++;
            }
            if ($finalRoom->beds == 4) {
                $takenRooms[$finalRoom->hotel]->fourbeds++;
            }
            if ($finalRoom->beds == 5) {
                $takenRooms[$finalRoom->hotel]->fivebeds++;
            }
            if ($finalRoom->beds == 6) {
                $takenRooms[$finalRoom->hotel]->sixbeds++;
            }
        }

        foreach ($hotels as $hotel) {
            $availableBeds[$hotel->id] = $hotel;

            $twobeds[$hotel->id] = $hotel->twobeds;
            $threebeds[$hotel->id] = $hotel->threebeds;
            $fourbeds[$hotel->id] = $hotel->fourbeds;
            $fivebeds[$hotel->id] = $hotel->fivebeds;
            $sixbeds[$hotel->id] = $hotel->sixbeds;
            $availableBeds[$hotel->id]->id = $hotel->id;
            $availableBeds[$hotel->id]->twobeds = $twobeds[$hotel->id] - $takenRooms[$hotel->id]->twobeds;
            $availableBeds[$hotel->id]->threebeds = $threebeds[$hotel->id] - $takenRooms[$hotel->id]->threebeds;
            $availableBeds[$hotel->id]->fourbeds = $fourbeds[$hotel->id] - $takenRooms[$hotel->id]->fourbeds;
            $availableBeds[$hotel->id]->fivebeds = $fivebeds[$hotel->id] - $takenRooms[$hotel->id]->fivebeds;
            $availableBeds[$hotel->id]->sixbeds = $sixbeds[$hotel->id] - $takenRooms[$hotel->id]->sixbeds;
        }

        $hotels = DB::table('hotels')->get();
        $rooms = DB::table('rooms')->get();

        /*//Test for excess rooms Marilena
        $rooms = DB::table('rooms')->where('hotel',1)->where('final',1)->get();
        $index=0;
        $test[0]= "marilena";
        foreach ($rooms as $room){
            $users = User::where('rooming',$room->id)->count();
            $index++;
            if ($users!=$room->beds){
                $test[$index] = $room->id;
            }
        }

        //TEst
        //Test for excess rooms Marilena
        $rooms = DB::table('rooms')->where('hotel',2)->where('final',1)->get();
        $index++;
        $test[$index]= "mariRena";
        foreach ($rooms as $room){
            $users = User::where('rooming',$room->id)->count();
            $index++;
            if ($users!=$room->beds){
                $test[$index] = $room->id;
            }
        }

        //TEst*/

        return view('oc.rooming', compact('availableBeds', 'hotels', 'rooms'/*,'test'*/));
    }

    public function checkin($id)
    {
        $user = User::find($id);

        //Get user hotel id to return to correct rooming page
        $hotel = DB::table('sections')->where('name', $user->section)->first()->hotel_id;


        if ($hotel === 1) {
            //return to Marilena
            $back = "oc.marilena";
        } elseif ($hotel === 2) {
            //return to Marirena
            $back = "oc.marirena";
        } elseif ($hotel === 3) {
            $back = "oc.heraklion";
        } else {
            //return to Rooming
            return redirect(route('oc.rooming'));
        }

        $potentialRoom = DB::table('rooms')->where('id', $user->rooming)->count();
        if ($potentialRoom == 0) {
            $room = Room::find(1);
            return view('oc.checkin', compact('user', 'back', 'room'));
        } else {
            $room = DB::table('rooms')->where('id', $user->rooming)->first();
            return view('oc.checkin', compact('user', 'back', 'room'));
        }
    }

    public function doCheckin($id)
    {
        $user = User::find($id);
        $user->checkin = 1;
        $user->update();

        $room = Room::where('id', $user->rooming)->first();
        if ($room->first_id == "No") {
            $room->first_id = $user->id;
            $room->update();
        }


        //Get user hotel id to return to correct rooming page
        $hotel = DB::table('sections')->where('name', $user->section)->first()->hotel_id;

        if ($hotel === 1) {
            //return to Marilena
            return redirect(route('oc.marilena'));
        } elseif ($hotel === 2) {
            //return to Marirena
            return redirect(route('oc.marirena'));
        } elseif ($hotel === 3) {
            return redirect(route('oc.heraklion'));
        } else {
            //return to Rooming
            return redirect(route('oc.rooming'));
        }

    }

    public function uncheckin($id)
    {
        $user = User::find($id);

        //Get user hotel id to return to correct rooming page
        $hotel = DB::table('sections')->where('name', $user->section)->first()->hotel_id;


        if ($hotel === 1) {
            //return to Marilena
            $back = "oc.marilena";
        } elseif ($hotel === 2) {
            //return to Marirena
            $back = "oc.marirena";
        } elseif ($hotel === 3) {
            $back = "oc.heraklion";
        } else {
            //return to Rooming
            return redirect(route('oc.rooming'));
        }

        $potentialRoom = DB::table('rooms')->where('id', $user->rooming)->count();
        if ($potentialRoom == 0) {
            $room = Room::find(1);
            return view('oc.uncheckin', compact('user', 'back', 'room'));
        } else {
            $room = DB::table('rooms')->where('id', $user->rooming)->first();
            return view('oc.uncheckin', compact('user', 'back', 'room'));
        }
    }

    public function doUncheckin($id)
    {
        $user = User::find($id);
        $user->checkin = 'No';
        $user->update();

        //Get user hotel id to return to correct rooming page
        $hotel = DB::table('sections')->where('name', $user->section)->first()->hotel_id;

        if ($hotel === 1) {
            //return to Marilena
            return redirect(route('oc.marilena'));
        } elseif ($hotel === 2) {
            //return to Marirena
            return redirect(route('oc.marirena'));
        } else {
            //return to Rooming
            return redirect(route('oc.rooming'));
        }

    }

    public function welcomeBags()
    {
        $users = User::where('fee', '!=', 'No')->get();

        $elements = DB::table('sections')->get();

        foreach ($elements as $element) {
            $sections[$element->name] = $element->hotel_id;
        }

        $adminSectionCode = DB::table('sections')->where('name', Auth::user()->section)->first()->hotel_id;
        $residents[0] = new User();
        $index = 0;
        foreach ($users as $user) {
            if ($sections[$user->section] == $adminSectionCode) {
                if ($user->checkin == 1) {
                    $residents[$index] = $user;
                    $index++;
                }
            }
        }

        $residentCount = $index;


        //Get number of checked in peeps
        $sections = Section::all();
        foreach ($sections as $section) {
            $sectionTypes[$section->name] = $section->hotel_id;
        }

        $checkedIn = 0;
        if ($index == 0) { //If no one standing by for welcome bag
            $residents[0] = new User();
            return view('oc.welcomeBags', compact('residents', 'residentCount', 'checkedIn'));
        } else {
            foreach ($residents as $resident) {
                if ($sectionTypes[$resident->section] === $adminSectionCode && $resident->checkin == 2) {
                    $checkedIn++;
                }
            }

            return view('oc.welcomeBags', compact('residents', 'residentCount', 'checkedIn'));
        }
    }

    public function giveWelcomeBag($id)
    {
        $user = User::find($id);

        return view('oc.confirmWelcomeBag', compact('user'));
    }

    public function doGiveWelcomeBag($id)
    {
        $user = User::find($id);
        $user->checkin = '2';
        $user->update();

        return redirect(route('oc.welcomeBags'));

    }

    public function viewRoomOccupants($id)
    {
        $occupants = User::where('rooming', $id)->get();

        return view('oc.viewRoomOccupants', compact('occupants'));
    }

    public function viewParticipant($id)
    {
        $user = User::find($id);

        return view('oc.viewParticipant', compact('user'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('oc.home'));
    }
}
