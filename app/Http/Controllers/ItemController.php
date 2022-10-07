<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\Item;
use App\ItemPhoto;

class ItemController extends Controller
{
    public function index(Item $item)
    {
        $item_photo = $item::with('photos');  // リレーション先を引っ張る
        return view('item/index')->with(['items'=>$item_photo->get()]);
    }
    
    public function create()
    {
        return view('item/create');
    }
    
    public function store(Request $request)
    {
        // itemテーブルには名前だけ保存
        $item = Item::create(['name' => $request->name]);
        
        // photoテーブルには複数のpathを保存
        foreach ($request->file('files') as $index=>$file) {
            $path = Storage::disk('s3')->putFile('myprefix', $file['image'], 'public');
            $item->photos()->create(['path' => Storage::disk('s3')->url($path)]); 
        }
        
        return redirect('/item');
    }   
}
