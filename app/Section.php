<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property  registered
 * @property  paidFee
 * @property  paidBoat
 * @property  name
 * @property float rate
 * @property int allCash
 * @property int depositedCash
 * @property mixed pendingCash
 */
class Section extends Model
{
    //
    protected $fillable = [
        'name', 'reference', 'registered', 'paidFee'. 'paidBoat'
    ];

    private $registered;
    private $paidFee;
    private $paidBoat;
    private $name;
    private $rate;

    public function users(){
        return $this->belongsToMany('App\User');
    }
}
