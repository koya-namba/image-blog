<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Postモデルを追加
use App\Post;
// Storageを追加
use Storage;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->get()]);
    }
    
    public function create()
    {
        return view('posts/create');
    }

    public function store(Request $request, Post $post)
    {
        // storeでDBの保存処理を行う
        // storeはタイトルとimage_pathを登録する必要がある
        $post->title = $request['title'];

        //s3アップロード開始
        $image = $request->file('image');
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $post->image_path = Storage::disk('s3')->url($path);
        $post->save();

        return redirect('/posts');
    }   
}
