<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    // table post in database
    protected $fillable = [
        'type_name'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
