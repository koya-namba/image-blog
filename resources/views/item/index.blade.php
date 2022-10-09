<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Item</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Item</h1>
        [<a href='/item/create'>create</a>]<br />
        <a href='/'>indexに戻る</a><br />
        <div class='posts'>
            @foreach ($items as $item)
                <div class='post'>
                    <h2 class='title'>{{ $item->name }}</h2>
                    <!--複数枚の写真を1つずつ表示-->
                    @foreach ($item->photos as $photo)
                        <p>{{ $photo->path }}</p>
                        <img class='image' width="200" height="200" src="{{ $photo->path }}">
                    @endforeach
                </div>
            @endforeach
        </div>
    </body>
</html>
