<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ixudra\Curl\Facades\Curl;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'role', 'password', 'section', 'esncard', 'esncardstatus', 'document', 'birthday', 'gender', 'phone', 'country', 'boat', 'tshirt', 'city', 'facebook', 'allergies', 'comments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function country()
    {
        return $this->belongsTo('App\Country');
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function isParticipant()
    {
        $role = $this->role->name;
        if(isset($role)){
            return $role;   //Get role name for middleware :)
        }else{
            return false;
        }

    }

    protected function esnCardStatus($card){

        $response = Curl::to('https://esncard.org/services/1.0/card.json')
            ->withData( array( 'code' => $card ) )
            ->get();


        if(strpos($response,'active')){
            return 'active';
        }elseif (strpos($response,'expired')){
            return 'expired';
        }elseif (strpos($response,'available')){
            return 'available';
        }else{
            return 'invalid';
        }
    }

}
