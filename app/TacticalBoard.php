<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TacticalBoard extends Model
{
    protected $fillable = ['title', 'body'];
    
    public function photos()
    {
        return $this->hasMany('App\TacticalBoardPhoto');
    }
}
