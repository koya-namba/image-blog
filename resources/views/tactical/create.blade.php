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
        <!-- canvasを用意 -->
        <canvas id="canvassample" width="1014" height="650"></canvas>
        <!-- モードを選択 -->
        <div style="padding:10px">
            <p>現在は<span id="tool">ペン</span>モードです</p>
            <button type="button" id="changeToolBtn">スタンプに変更</button>
        </div>
        <!-- 色を選択 -->
        <div style="padding:10px">
            <p>現在のカラーは<span id="color">黒</span>色です</p>
            <button type="button" id="changeRedBtn">RED</button>
            <button type="button" id="changeBlueBtn">BLUE</button>
            <button type="button" id="changeBlackBtn">BLACK</button>
        </div>
        <!-- リセット，戻る，進むボタンを設置 -->
        <div style="padding:10px">
            <button type="button" id="resetBtn">リセット</button>
            <button type="button" id="backBtn">戻る</button>
            <button type="button" id="nextBtn">進む</button>
        </div>
        <!-- canvasを画像に変換 -->
        <div style="padding:10px">
            <button type="button" id="changeImgBtn" value="1">画像変換</button>
        </div>
        <h2>画像出力<h2> 
        <!-- 画像を表示するimgタグ -->
        <div id="img-box">
            <img id="newImg">
        </div>
        <!-- ダウンロードをするためのaタグ -->
        <a id="download">Download</a>
        <!--以下はフォーム-->
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
