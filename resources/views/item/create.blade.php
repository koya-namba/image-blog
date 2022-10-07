<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Item</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Item</h1>
        <form action="/item" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="name" placeholder="name" /><br />
            <!-- アップロードフォームの作成 -->
            <input type="file" name="files[][image]" multiple><br />
            <input type="submit" value="登録">
        </form>
        <div class="back">[<a href="/item">back</a>]</div>
    </body>
</html>
