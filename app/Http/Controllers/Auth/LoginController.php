<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    protected function redirectTo(){
             if(Auth::user()->role->name == "Participant"){          //if participant
                    return route('participants.home');
                }elseif(Auth::user()->role->name == "LC"){     //if LC
                    return route('lc.home');
                }elseif(Auth::user()->role->name == "OC"){      //if OC
                    return route('oc.home');
                }else{                                  //for redundancy, if something goes wrong for some reason
                    Auth::logout();
                    return route('home');
                }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        $user = User::find(Auth::user()->id);
        $user->esncardstatus = User::esnCardStatus(Auth::user()->esncard);
        $user->update();
    }
}
