<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name'];
    
    public function photos()
    {
        // Itemはたくさんの写真を持つ
        return $this->hasMany(ItemPhoto::class);
    }
}
