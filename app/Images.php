<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';

    protected $fillable = ['car_id', 'image'];

    public $timestamps = false;

    /**
     * Get the car that owns the image.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

}
