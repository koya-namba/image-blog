<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use App\TacticalBoard;
use App\TacticalBoardPhoto;

class TacticalBoardController extends Controller
{
    public function index(TacticalBoard $tactical_board)
    {
        $tactical_board_photo = $tactical_board::with('photos');
        return view('tactical/index')->with(['tactical_boards' => $tactical_board_photo->get()]);
    }
    
    public function show(TacticalBoard $tactical_board)
    {
        return view('tactical/show')->with(['tactical_board' => $tactical_board]);
    }
    
    public function create()
    {
        return view('tactical/create');
    }
    
    public function store(Request $request)
    {
        $tactical_board = TacticalBoard::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);
        
        foreach ($request->file('files') as $index=>$file) {
            $path = Storage::disk('s3')->putFile('myprefix', $file['image'], 'public');
            $tactical_board->photos()->create(['path' => Storage::disk('s3')->url($path)]);
        }
        
        return redirect('/tactical/'. $tactical_board->id);
    }
}
