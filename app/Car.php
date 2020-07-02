<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'car';

    protected $fillable = ['model', 'type', 'colour', 'car_status', 'sell_price', 'capacity', 'location'];

    public $timestamps = false;

    /**
     * Get the type that owns the car.
     */
    public function type()
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * Get the images of car.
     */
    public function images()
    {
        return $this->hasMany(Images::class);
    }

}
