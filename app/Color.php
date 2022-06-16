<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded=[];
    // public function variants(){
    //     return $this->hasMany(Variation::class,'created_by_color','id');
    // }
}
