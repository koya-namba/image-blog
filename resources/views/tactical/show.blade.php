<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>TacticalBoard詳細</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>TacticalBoard詳細</h1>
        [<a href='/tactical'>TacticalBoard一覧に戻る</a>]<br />
        <a href='/'>indexに戻る</a><br />
        <div class='post'>
            <h2 class='title'>{{ $tactical_board->title }}</h2>
            <p class='body'>{{ $tactical_board->body }}</p>
            <!--複数枚の写真を1つずつ表示-->
            @foreach ($tactical_board->photos as $photo)
                <p>{{ $photo->path }}</p>
                <img class='image' width="400" height="300" src="{{ $photo->path }}">
            @endforeach
        </div>
    </body>
</html>
