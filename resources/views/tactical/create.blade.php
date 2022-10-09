<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>TacticalBoard作成</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!--cssの読み込み方-->
        <link rel="stylesheet" href="{{ secure_asset('css/canvas.css') }}">
    </head>
    <body>
        <h1>TacticalBoard作成</h1>
        <canvas id="canvassample" width="800" height="560"></canvas>
        <div style="padding:10px">
            <button type="button" id="changeRedBtn">RED</button>
            <button type="button" id="changeBlueBtn">BLUE</button>
            <button type="button" id="changeBlackBtn">BLACK</button>
        </div>
        <div style="padding:10px">
            <button type="button" id="resetBtn">リセット</button>
            <button type="button" id="backBtn">戻る</button>
            <button type="button" id="nextBtn">進む</button>
        </div>
        <div style="padding:10px">
            <button type="button" id="changeImgBtn" value="1">画像変換</button>
        </div>
        <h2>画像出力<h2> 
        <div id="img-box"><img id="newImg"></div>
        <a id="download">Download</a>
        
        <h2>以下はフォーム</h2>
        <form action="/tactical" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="text" name="title" placeholder="name" /><br />
            <!-- アップロードフォームの作成 -->
            <textarea name='body' placeholder='This is sample'></textarea><br />
            <input type="file" name="files[][image]" multiple><br />
            <input type="submit" value="登録">
        </form>
        <div class="back">[<a href="/tactical">back</a>]</div>
        <!--JSを読み込み-->
        <script src="{{ mix('js/tactical.js') }}"></script>
    </body>
</html>
