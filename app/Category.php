<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   // table post in database
    protected $fillable = [
        'category_name'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
