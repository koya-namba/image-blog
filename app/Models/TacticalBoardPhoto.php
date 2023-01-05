<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TacticalBoardPhoto extends Model
{
    protected $fillable = ['tactical_board_id', 'path'];
    
    public function tactical_board()
    {
        return $this->belongsTo(TacticalBoard::class);
    }
}
