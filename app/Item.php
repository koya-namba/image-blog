<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name'];
    
    public function photos()
    {
        // Itemはたくさんの写真を持つ
        return $this->hasMany('App\ItemPhoto');
    }
}
