<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'location';

    protected $fillable = ['latitude', 'longitude', 'zoom',  'distrect'];

    public $timestamps = false;

    /**
     * Get the cars of location.
     */
    public function cars()
    {
        return $this->hasMany(Car::class);
    }

}
