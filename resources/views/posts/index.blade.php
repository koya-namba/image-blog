<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Post</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Post</h1>
        [<a href='/posts/create'>create</a>]<br />
        <a href='/'>indexに戻る</a><br />
        <div class='posts'>
        @foreach ($posts as $post)
            <div class='post'>
                <!--タイトルを表示する-->
                <h2 class='title'>{{ $post->title }}</h2>
                <!--image_pathをpタグで表示-->
                <p>{{ $post->image_path }}</p>
                <!--画像を表示するためには，imgタグを用いる-->
                <!--imgタグのsrcにパスを設定する！-->
                <img class='image' width="300" height="200" src="{{ $post->image_path }}">
            </div>
        @endforeach
        </div>
    </body>
</html>
