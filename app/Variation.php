<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softdeletes;

class Variation extends Model
{
    protected $guarded=[];

    // public function color(){
    //     return $this->belongsTo(Color::class,'created_by_color','id');
    // }
}

