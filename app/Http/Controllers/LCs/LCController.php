<?php

namespace App\Http\Controllers\LCs;

use App\Event;
use App\Http\Controllers\Controller;
use App\Invoice;
use App\Mail\SendBoatConfirmation;
use App\Mail\SendFeeConfirmation;
use App\Mail\UploadProof;
use App\Payment;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadeRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;


class LCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('lc');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $bedsAreFull = Event::bedsAreFull();

        //$users = User::all()->where('section', Auth::user()->section)->where('fee', '!=', 'No');
        //If beds are full only ,show participants that have paid fee
        if ($bedsAreFull) {
            $users = User::all()->where('section', Auth::user()->section)->where('fee', '!=', 'No');
        } else {
            $users = User::all()->where('section', Auth::user()->section);
        }

        //Beds left
        $availableBeds = DB::table('event')->where('attribute', 'maxBeds')->get()->first()->value;
        $sleepingParticipants = DB::table('users')->where('fee', '140')->count() + DB::table('users')->where('fee', '150')->count();
        $beds = $availableBeds - $sleepingParticipants;

        return view('lcs.home', compact('users', 'bedsAreFull', 'beds'));
    }

    public function manage()
    {
        return redirect(route('lc.home'));
    }

    public function participant($id)
    {
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }
        return view('lcs.participant', ['id' => $id]);
    }

    public function asParticipant()
    {


        return view('lcs.asParticipant');
    }

    public function statistics()
    {
        //Get participants and money sum
        $registered = 0;
        $fee = 0;
        $boat = 0;
        $sum = 0;

        $participants = User::all()->where('section', Auth::user()->section);
        foreach ($participants as $index => $participant) {
            if ($participant->tickets != "No") {
                $sum = $sum + $participant->fee + $participant->tickets;
                $boat++;
            } elseif ($participant->fee != "No") {
                $sum = $sum + $participant->fee;
                $fee++;
            } elseif ($participant->fee == "No") {
                $registered++;
            }
        }

        //Get pending and deposited
        $pending = 0;
        $deposited = 0;
        $payments = DB::table('payments')->where('section', Auth::user()->section)->get();
        foreach ($payments as $payment) {
            if ($payment->approved === "Yes") {
                $deposited = $deposited + $payment->amount;
            }
        }
        $pending = $sum - $deposited;

        //Get payments and dates

        //$transactions = DB::table('users')->select('CAST(created_at as date) AS date, SUM(fee) AS money, count(*) AS participants')->where('section',Auth::user()->section)->where('fee','!= ','No')->groupBy('date')->get();
        $transactionsFee = DB::select('SELECT CAST(feedate AS DATE) AS date, SUM(fee) AS money, count(*) AS participants FROM users WHERE section = :section AND fee != "No" GROUP BY date', ['section' => Auth::user()->section]);
        $transactionsBoat = DB::select('SELECT CAST(ticketsdate AS DATE) AS date, SUM(tickets) AS money, count(*) AS participants FROM users WHERE section = :section AND tickets != "No" GROUP BY date', ['section' => Auth::user()->section]);

        return view('lcs.statistics', compact('registered', 'fee', 'boat', 'sum', 'pending', 'deposited', 'transactionsFee', 'transactionsBoat'));
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

    public function editParticipantEsnCard(Request $request)
    {
        $this->validate($request, [
            'esncard' => 'max:255'
        ]);
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $request['id'])->get()->first()->section) {
            return response()->json(['lol' => 'wut?'], 200);
        }


        $user = User::find($request['id']);
        $user->esncardstatus = User::esnCardStatus($request['esncard']);
        $user->esncard = $request['esncard'];
        $user->update();
        return response()->json(['new_esncard' => $user->esncard], 200);
    }

    public function bank()
    {
        return view('lcs.bank');
    }

    public function uploadProof()
    {
        return view('lcs.uploadProof');
    }

    public function doUploadProof(Request $request)
    {
        $this->validate($request, [
            'proof' => 'required|mimes:jpeg,png,jpg,pdf|max:4096',
            'amount' => 'required|integer',
            'comments' => 'max:255'
        ]);

        $path = $request->file('proof')->store('public/payments');

        $input['path'] = $path;
        $input['amount'] = $request['amount'];
        $input['comments'] = $request['comments'];
        $input['section'] = Auth::user()->section;
        Payment::create($input);

        //Send mail to treasurer, SC and IT
        Mail::to('finance@thecretetrip.org')->cc('section-c@thecretetrip.org')->bcc('it@thecretetrip.org')->send(new UploadProof());

        return redirect(route('lc.myPayments'));

    }

    public function myPayments()
    {
        $payments = DB::table('payments')->where('section', Auth::user()->section)->get();
        return view('lcs.myPayments', compact('payments'));
    }

    public function payFee($id)
    {
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }

        $user = User::find($id);

        //Check if we still have beds
        if (Event::bedsAreFull()) {

            if ($user->section != "ESN UOC - HERAKLION" && $user->section != "ESN TEI OF CRETE") {
                return redirect(route('lc.home'));
            } else {

                $user->esncardstatus = User::esnCardStatus($user->esncard);
                $user->update();

                return view('lcs.payFee', ['id' => $id]);
            }

        } else {
            $user->esncardstatus = User::esnCardStatus($user->esncard);
            $user->update();

            return view('lcs.payFee', ['id' => $id]);
        }
    }

    public function doPayFee($id)
    {
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }

        $user = User::find($id);

        if ($user->fee != 'No') {
            return redirect(route('lc.home'));
        }

        //Check if we still have beds
        if (Event::bedsAreFull()) {

            if ($user->section != "ESN UOC - HERAKLION" && $user->section != "ESN TEI OF CRETE") {
                return redirect(route('lc.home'));
            } else {  //If UOC - HER or  TEI CRETE continue paying
                //Add payment into database
                if ($user->section === 'ESN UOC - HERAKLION' || $user->section === 'ESN TEI OF CRETE') {
                    if ($user->esncardstatus === 'active') {
                        $user->fee = DB::table('event')->where('attribute', 'reducedfee')->get()->first()->value;
                        $user->feedate = Carbon::now();
                    } else {
                        $user->fee = DB::table('event')->where('attribute', 'reducedfee')->get()->first()->value + 10;
                        $user->feedate = Carbon::now();
                    }
                } else {
                    if ($user->esncardstatus === 'active') {
                        $user->fee = DB::table('event')->where('attribute', 'fee')->get()->first()->value;
                        $user->feedate = Carbon::now();
                    } else {
                        $user->fee = DB::table('event')->where('attribute', 'fee')->get()->first()->value + 10;
                        $user->feedate = Carbon::now();
                    }
                }
                $user->update();


                //Generate invoice
                $pdf = App::make('dompdf.wrapper');
                $pdf->loadHTML(view('mails.invoice', compact('user')));

                //Save invoice locally
                $invID = DB::table('sections')->where('name', $user->section)->get()->first()->reference . DB::table('invoices')->where('section', $user->section)->get()->count();
                $pdf->save('invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . '.pdf');


                //Send invoice to participant
                Mail::to($user->email)->send(new SendFeeConfirmation($user));


                //Save the whole transaction to the database
                $path = 'invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . '.pdf';

                $invoice = new Invoice();
                $invoice->user_id = $user->id;
                $invoice->path = $path;
                $invoice->section = $user->section;
                $invoice->save();


                return redirect(route('lc.home'));
            }
        } else {
            //Add payment into database
            if ($user->section === 'ESN UOC - HERAKLION' || $user->section === 'ESN TEI OF CRETE') {
                if ($user->esncardstatus === 'active') {
                    $user->fee = DB::table('event')->where('attribute', 'reducedfee')->get()->first()->value;
                    $user->feedate = Carbon::now();
                } else {
                    $user->fee = DB::table('event')->where('attribute', 'reducedfee')->get()->first()->value + 10;
                    $user->feedate = Carbon::now();
                }
            } else {
                if ($user->esncardstatus === 'active') {
                    $user->fee = DB::table('event')->where('attribute', 'fee')->get()->first()->value;
                    $user->feedate = Carbon::now();
                } else {
                    $user->fee = DB::table('event')->where('attribute', 'fee')->get()->first()->value + 10;
                    $user->feedate = Carbon::now();
                }
            }
            $user->update();


            //Generate invoice
            $pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML(view('mails.invoice', compact('user')));

            //Save invoice locally
            $invID = DB::table('sections')->where('name', $user->section)->get()->first()->reference . DB::table('invoices')->where('section', $user->section)->get()->count();
            $pdf->save('invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . '.pdf');


            //Send invoice to participant
            Mail::to($user->email)->send(new SendFeeConfirmation($user));


            //Save the whole transaction to the database
            $path = 'invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . '.pdf';

            $invoice = new Invoice();
            $invoice->user_id = $user->id;
            $invoice->path = $path;
            $invoice->section = $user->section;
            $invoice->save();


            return redirect(route('lc.home'));
        }


    }

    public function payFerry($id)
    {
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }

        $user = User::find($id);

        if ($user->fee === "No") {
            return redirect(route('login'));
        }

        //Boat Fee
        $boatFee = DB::table('event')->where('attribute', 'boat')->get()->first()->value;

        return view('lcs.payFerry', ['id' => $id, 'boatFee' => $boatFee]);

    }

    public function doPayFerry()
    {
        $id = FacadeRequest::input('userID');
        $boat = FacadeRequest::input('boat');

        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }

        $user = User::find($id);

        if ($user->fee === 'No') {
            return redirect(route('lc.home'));
        }


        //Add payment into database
        $fee = DB::table('event')->where('attribute', 'boat')->get()->first()->value;

        if ($boat === "Travel BOTH WAYS with the group") {
            $user->tickets = $fee;
            $user->boat = $boat;
            $user->ticketsdate = Carbon::now();

            $user->update();
        } elseif ($boat === "Travel WITH THE GROUP to Crete and return INDIVIDUALLY") {
            $user->tickets = $fee / 2;
            $user->boat = $boat;
            $user->ticketsdate = Carbon::now();

            $user->update();
        } elseif ($boat === "Travel INDIVIDUALLY to Crete and return WITH THE GROUP") {
            $user->tickets = $fee / 2;
            $user->boat = $boat;
            $user->ticketsdate = Carbon::now();

            $user->update();
        } else {
            return redirect(route('lc.home'));
        }

        //Generate invoice
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML(view('mails.boatInvoice', compact('user')));

        //Save invoice locally
        $invID = DB::table('sections')->where('name', $user->section)->get()->first()->reference . DB::table('invoices')->where('section', $user->section)->get()->count() . 'B';
        $pdf->save('invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . 'Boat.pdf');

        //Send invoice to participant
        Mail::to($user->email)->send(new SendBoatConfirmation($user));

        //Save the whole transaction to the database
        $path = 'invoices/' . $user->section . '/' . $invID . $user->name . $user->surname . 'Boat.pdf';

        $invoice = new Invoice();
        $invoice->user_id = $user->id;
        $invoice->path = $path;
        $invoice->section = $user->section;
        $invoice->save();


        return redirect(route('lc.home'));


    }

    public function waitingList($id)
    {
        //Simulate middleware
        if (Auth::user()->section != DB::table('users')->where('id', $id)->get()->first()->section) {
            return redirect(route('login'));
        }

        $user = User::find($id);
        $user->glcomments = "Waiting List";
        $user->feedate = Carbon::now();
        $user->update();

        return redirect(route('lc.home'));
    }

    public function boatToCrete()
    {
        $users = User::where('section', Auth::user()->section)->where('tickets', '!=', 'No')->whereIn('boat', ['Travel BOTH WAYS with the group', 'Travel WITH THE GROUP to Crete and return INDIVIDUALLY'])->get();

        return view('lcs.boatToCrete', compact('users'));
    }

    public function boatFromCrete()
    {
        $users = User::where('section', Auth::user()->section)->where('tickets', '!=', 'No')->whereIn('boat', ['Travel BOTH WAYS with the group', 'Travel INDIVIDUALLY to Crete and return WITH THE GROUP'])->get();

        return view('lcs.boatToCrete', compact('users'));
    }

    public function exportParticipants()
    {
        $section = Auth::user()->section;
        $participants = DB::table('users')->where('section', $section)->where('fee', '!=', 'No')->get();
        $participantsArray[0] = ['#', 'Name', 'Surname', 'E-mail', 'Phone', 'Facebook', 'ESNcard', 'Gender', 'Allergies', 'Fee', 'Fee Date', 'Boat', 'Boat Date'];

        //Populate array with all elements
        $counter = 1;
        foreach ($participants as $participant) {
            $participantsArray[$counter] = [$counter, $participant->name, $participant->surname, $participant->email, $participant->phone, $participant->facebook, $participant->esncard, $participant->gender, $participant->allergies, $participant->fee, $participant->feedate, $participant->tickets, $participant->ticketsdate];
            $counter++;
        }

        Excel::create(Auth::user()->section . ' TCT18 Participants', function ($excel) use ($participantsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle(Auth::user()->section . 'TCT18participants');
            $excel->setCreator('Dimitris Frangiadakis')->setCompany('The Crete Trip 2018');
            $excel->setDescription('Participants file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('Participants', function ($sheet) use ($participantsArray) {
                $sheet->fromArray($participantsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('lc.home'));
    }


}
