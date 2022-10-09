<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPhoto extends Model
{
    protected $fillable = ['item_id', 'path'];
    
    public function item()
    {
        // ItemPhotoは一つのItemに所属
        return $this->belongsTo('App\Item');
    }
}
