<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Tweetモデルを追加
use App\Models\Tweet;
// Storageを追加
use Storage;
// TwitterOAuth
use Abraham\TwitterOAuth\TwitterOAuth;

class TweetController extends Controller
{
    public function index(Tweet $tweet)
    {
        return view('tweets/index')->with(['tweets' => $tweet->get()]);
    }
    
    public function create()
    {
        return view('tweets/create');
    }

    public function store_tweet(Request $request, Tweet $tweet)
    {
        // フォームから送信された値をそれぞれ変数に代入
        $content = $request['content'];
        $image = $request->file('image');
        $tmp_path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        $image_path = Storage::disk('s3')->url($tmp_path);
        
        // DBに登録(tweetsテーブルに値を保存)
        $tweet->content = $content;
        $tweet->image_path = $image_path;
        $tweet->save();
        
        // Tweetを作成
        // twitterと接続開始
        $connection = new TwitterOAuth(
            config('services.twitter.consumer_key'),
            config('services.twitter.consumer_secret'),
            config('services.twitter.access_token'),
            config('services.twitter.access_token_secret'),
        );
        
        // 環境変数から投稿するユーザ名を取得
        $username = config('services.twitter.username');
        
        // twitterにs3の画像を投稿するため，htmlを作成(twittercard)
        // htmlファイルを作成
        $htmlfile = 'tmp.html';
        // htmlファイルの中身を作成
        $filecontents = 
        '
        <!DOCTYPE html>
        <html prefix="og: http://ogp.me/ns#">
            <head>
                <meta name="twitter:title" content="New tweets" />
                <meta name="twitter:description" content="' . $content . '" />
                <meta name="twitter:card" content="summary_large_image">
                <meta name="twitter:site" content="' . $username . '" />
                <meta name="twitter:creator" content="' . $username . '">
                <meta name="twitter:image" content="' . $image_path . '" />
            </head>
            <body>
                <h1>Page Not Display</h1>
            </body>
        </html>
        ';
        // htmlファイルにhtmlの中身を記述
        file_put_contents($htmlfile, $filecontents);
        
        // 上記で作成したhtmlファイルをs3にアップロードして，pathを取得
        // htmlをバケットの'myprefix'フォルダへアップロード
        $html_tmp_path = Storage::disk('s3')->putFile('myprefix', $htmlfile, 'public');
        // アップロードした画像のフルパスを取得
        $html_path = Storage::disk('s3')->url($html_tmp_path);
        // htmlファイルの中身を空にする
        file_put_contents($htmlfile, '');
        
        // tweetの中身をフォーマットを作成
        // statusには投稿する中身を載せる．
        $tweet = [
            'status' => $content . PHP_EOL. $html_path,
        ];
        // tweetする
        $res = $connection->post('statuses/update', $tweet);
        
        if (property_exists($res, 'errors'))
        {
            return redirect('/tweets')->with('result', 'Tweetに失敗しました！');
        }
        return redirect('/tweets')->with('result', 'Tweetしました！');
    }
}
