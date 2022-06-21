<?php

namespace App;
use App\Province;
use App\City;
use App\Ward;

use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    protected $table = 'fee_ships';
    protected $primaryKey='fee_id';
    protected $fillable = [
        'fee_cityid',
        'fee_provinceid',
        'fee_wardid',
        'fee_ship',
    ];
    public function city()
    {
        return $this->belongsTo(City::class, 'fee_cityid');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'fee_provinceid');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'fee_wardid');
    }
}
