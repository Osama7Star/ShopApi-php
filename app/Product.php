<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [ 'name'];

    public $timestamps = false;

    /**
     * Get the type that owns the car.
     */

    /*
    public function type()
    {
        return $this->belongsTo(CarType::class);
    }

    /**
     * Get the images of car.
     */
    /*
    public function images()
    {
        return $this->hasMany(Images::class);
    }
*/
}
