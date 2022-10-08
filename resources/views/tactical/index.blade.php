<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>TacticalBoard</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>TacticalBoard一覧</h1>
        [<a href='/tactical/create'>create</a>]<br />
        <a href='/'>indexに戻る</a><br />
        <div class='posts'>
            <div class='post'>
            @foreach ($tactical_boards as $tactical_board)
                <div style="border : solid 1px #333" class='post'>
                    <h2 class='title'>
                        <a href="/tactical/{{ $tactical_board->id }}">
                            {{ $tactical_board->title }}
                        </a>
                    </h2>
                    <p>{{ $tactical_board->photos[0]->path }}</p><br />
                    <img class='image' width="400" height="300" src="{{ $tactical_board->photos[0]->path }}">
                </div>
            @endforeach
            </div>
        </div>
    </body>
</html>
