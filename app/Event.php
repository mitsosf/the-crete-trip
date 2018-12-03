<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    //
    protected function bedsAreFull()
    {
        $availableBeds = DB::table('event')->where('attribute','maxBeds')->get()->first()->value;
        $sleepingParticipants = DB::table('users')->where('fee', '140')->count() + DB::table('users')->where('fee', '150')->count() + DB::table('users')->where('fee', '0')->count(); //0 is the free ticket
        $beds = $availableBeds - $sleepingParticipants;

        if($beds<=0){
            return true;
        }else{
            return false;
        }
    }
}
