<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacticalBoard extends Model
{
    protected $fillable = ['title', 'body'];
    
    public function photos()
    {
        return $this->hasMany(TacticalBoardPhoto::class);
    }
}
