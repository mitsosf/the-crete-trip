<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * @property  int id
 * @property  string name
 * @property  string twobeds
 * @property  string threebeds
 * @property  string fourbeds
 * @property  string fivebeds
 * @property  string sixbeds
 */

class Hotel extends Model
{
    protected $fillable = [
        'id', 'name', 'twobeds', 'threebeds', 'fourbeds', 'fivebeds', 'sixbeds'
    ];
}
