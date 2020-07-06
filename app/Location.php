<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // table post in database
    protected $fillable = [
        'location_name'
    ];

     // relationship with post
		 public function proceed()
     {
         return $this->hasMany(Proceed::class);
     }
}
