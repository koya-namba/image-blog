<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Tweet</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Tweet</h1>
        <!--以下はフォームを送信する-->
        <h2>DB登録&Twitter投稿</h2>
        <form action="/tweets" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!--タイトルを入力するinputタグ-->
            <textarea type="text" name="content" placeholder='投稿内容'></textarea><br />
            <!--画像を送信するためにはinputタグを用いる-->
            <!--type='file'にすることが重要！-->
            <input type="file" name="image"><br />
            <input type="submit" value="投稿">
        </form>
        <div class="back">[<a href="/tweets">back</a>]</div>
    </body>
</html>
