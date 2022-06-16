<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }
    public function images(){
        return $this->hasMany(Image::class, 'product_id');
    }
}

