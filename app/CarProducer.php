<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarProducer extends Model
{
    protected $table = 'car_producer';

    protected $fillable = ['name'];

    public $timestamps = false;

    /**
     * Get the cars of producer.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

}
