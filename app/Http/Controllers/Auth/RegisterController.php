<?php

namespace App\Http\Controllers\Auth;

use App\Mail\WelcomeMail;
use App\User;
use App\Country;
use App\Section;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/account';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $countries[''] = ""; //Providing better styling for the registration form
        $countryNames = Country::pluck('name');
        foreach ($countryNames as $countryName) {
            $countries[$countryName] = $countryName;
        }

        $sections[''] = ""; //Providing better styling for the registration form
        $sectionNames = Section::pluck('name');
        foreach ($sectionNames as $sectionName) {
            $sections[$sectionName] = $sectionName;
        }

        $registrations = DB::table('users')->count();


        return view('auth.register', compact('countries', 'sections','registrations'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|max:255|confirmed',
            'section' => 'required|string|max:255|exists:sections,name',
            'esncard' => 'max:255',
            'document' => 'required|string|max:255',
            'birthday' => 'required|string|max:255',
            'gender' => 'required|string|max:255|in:male,female',
            'phone' => 'required|string|max:255',
            'country' => 'required|string|max:255|exists:countries,name',
            'boat' => 'required|string|max:255|in:Travel BOTH WAYS with the group,Travel WITH THE GROUP to Crete and return INDIVIDUALLY,Travel INDIVIDUALLY to Crete and return WITH THE GROUP,Travel BOTH WAYS INDIVIDUALLY,I study in Crete',
            'tshirt' => 'required|string|max:255|in:XS,S,M,L,XL,XXL',
            'city' => 'required|string|max:255',
            'facebook' => 'max:255',
            'allergies' => 'max:255',
            'comments' => 'max:255',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */



    protected function create(array $data)
    {
        $esnCardStatus = User::esnCardStatus($data['esncard']);

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
            'section' => $data['section'],
            'esncard' => $data['esncard'],
            'esncardstatus' => $esnCardStatus,
            'document' => $data['document'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'boat' => $data['boat'],
            'tshirt' => $data['tshirt'],
            'city' => $data['city'],
            'facebook' => $data['facebook'],
            'allergies' => $data['allergies'],
            'comments' => $data['comments'],
        ]);



        return $user;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        Mail::to(Auth::user()->email)->send(new WelcomeMail($user));
        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }


}
