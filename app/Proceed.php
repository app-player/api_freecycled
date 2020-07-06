<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proceed extends Model
{
    // table post in database
    protected $fillable = [
        'phone_number', 'location_id', 'link_facebook', 'user_id'
    ];

		public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
		// relationship with post
		public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }
}
