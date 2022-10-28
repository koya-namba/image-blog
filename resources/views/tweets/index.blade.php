<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Tweet</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Tweet</h1>
        <h3>{{ session('result') }}</h3>
        [<a href='/tweets/create'>create</a>]<br />
        <a href='/'>indexに戻る</a><br />
        <div class='posts'>
        @foreach ($tweets as $tweet)
            <div class='post'>
                <!--タイトルを表示する-->
                <p class='content'>{{ $tweet->content }}</p>
                <!--image_pathをpタグで表示-->
                <p>{{ $tweet->image_path }}</p>
                <!--画像を表示するためには，imgタグを用いる-->
                <!--imgタグのsrcにパスを設定する！-->
                <img class='image' width="300" height="200" src="{{ $tweet->image_path }}">
            </div>
        @endforeach
        </div>
    </body>
</html>
