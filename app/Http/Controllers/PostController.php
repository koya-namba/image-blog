<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Postモデルを追加
use App\Post;
// Storageを追加
use Storage;
// TwitterOAuth
use Abraham\TwitterOAuth\TwitterOAuth;

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
    
    public function create_tweet(Request $request)
    {
        # Twitterと接続開始
        $connection = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret'),
        );
        
        // フォームからタイトルを取得
        $title = $request['title'];
        // フォームから内容を取得
        $body = $request['body'];
        // フォームから画像を取得
        $image = $request->file('image');
        // バケットの`myprefix`フォルダへアップロード
        $image_up_path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        // アップロードした画像のフルパスを取得
        $image_path = Storage::disk('s3')->url($image_up_path);
        
        // htmlファイルを作成
        $htmlfile = 'tmp.html';
        // Twitterのユーザ名を設定
        $user_name = config('services.twitter.username');
        // htmlファイルの中身を作成
        $filecontents = 
        '
        <!DOCTYPE html>
        <html prefix="og: http://ogp.me/ns#">
            <head>
                <meta name="twitter:title" content="' . $title . '" />
                <meta name="twitter:description" content="' . $body . '" />
                <meta name="twitter:card" content="summary_large_image">
                <meta name="twitter:site" content="' . $user_name . '" />
                <meta name="twitter:creator" content="' . $user_name . '">
                <meta name="twitter:image" content="' . $image_path . '" />
            </head>
            <body>
                <h1>Page Not Display</h1>
            </body>
        </html>
        ';
        
        // htmlファイルにhtmlの中身を記述
        file_put_contents($htmlfile, $filecontents);
        
        // htmlをバケットの'myprefix'フォルダへアップロード
        $html_up_path = Storage::disk('s3')->putFile('myprefix', $htmlfile, 'public');
        // アップロードした画像のフルパスを取得
        $html_path = Storage::disk('s3')->url($html_up_path);
        // ツイートの中身にS3に保存したhtmlファイルのパスを記述
        
        // htmlファイルの中身を空にする
        file_put_contents($htmlfile, '');
        
        $tweet = [
            'status' => $html_path,
        ];
        
        $res = $connection->post('statuses/update', $tweet);
        if (property_exists($res, 'errors'))
        {
            foreach($res->errors as $error){
                dd($error->message);
            }
        }
        return redirect('/posts')->with('result', 'Tweetしました！');
    }
}
