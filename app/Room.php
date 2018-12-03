<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string code
 * @property  string hotel
 * @property  string beds
 * @property  string comments
 */
class Room extends Model
{
    protected $fillable = [
        'code', 'hotel', 'beds', 'final', 'comments'
    ];
}
