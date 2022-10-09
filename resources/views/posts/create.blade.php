<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Post</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Post</h1>
        <!--以下はフォームを送信する-->
        <form action="/posts" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!--タイトルを入力するinputタグ-->
            <input type="text" name="title" placeholder="タイトル" /><br />
            <!--画像を送信するためにはinputタグを用いる-->
            <!--type='file'にすることが重要！-->
            <input type="file" name="image"><br />
            <input type="submit" value="投稿">
        </form>
        <div class="back">[<a href="/posts">back</a>]</div>
    </body>
</html>
