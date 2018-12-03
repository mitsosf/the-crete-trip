<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Role extends Model
{

    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany('App\User');
    }


}
