<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // table post in database
    protected $fillable = [
        'title', 'image', 'category_id', 'type_id'
    ];

     // relationship with post
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
     // relationship with post
    public function type() {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
