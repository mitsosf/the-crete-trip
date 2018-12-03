<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role->name == 'Participant') {
                return redirect(route('participants.home'));
            } elseif (Auth::user()->role->name == 'LC') {
                return redirect(route('lc.home'));
            } elseif (Auth::user()->role->name == 'OC') {
                return redirect(route('oc.home'));
            } else {
                Auth::logout();
                return redirect(route('login'));
            }
        } else {
            return redirect(route('welcome'));
        }
    }

    public function welcome(){
        return view('welcome');
    }

    public function terms(){
        return view('terms');
    }

    public function faq(){
        return view('faq');
    }
}
