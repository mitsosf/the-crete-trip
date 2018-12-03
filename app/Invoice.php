<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed user_id
 * @property string path
 * @property string section
 */
class Invoice extends Model
{
    protected $fillable = [
        'path', 'user_id' , 'section'
    ];
}
