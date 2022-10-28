# laravel6とS3で画像を扱う

このリポジトリではlaravel6とS3で画像を保存したり，表示する方法を記録．  
S3とはファイルを保存しておける場所で，この場所へのpathをDBに保存することでファイルを扱える！  


## 概要

1. 画像を1枚ずつ保存する方法->postsを用いる．  
2. 画像を複数枚保存する方法->itemを用いる．  

おまけ 
1. 自分で画像を作成し，保存する．
2. twitterにS3画像を投稿する．


## 参考
- [S3の設定・アップロード方法](https://notepm.jp/sharing/b51bf504-3032-407b-b520-0c73e0c25f70)
    - これで基本を学びましょう！
- [Rails, Laravel(画像アップロード)向けAWS(IAM:ユーザ, S3:バケット)の設定](https://qiita.com/nobu0717/items/4425c02157bc5e88d7b6)
- [LaravelでAWS S3へ画像をアップロードする](https://qiita.com/nobu0717/items/51dfcecda90d3c5958b8)
- [Laravel 5.5で複数の画像をアップロードする方法](https://qiita.com/netfish/items/ef01cdb5f58742563e87)
- [Laravel で JavaScriptをやるときの手法](https://qiita.com/ntm718/items/fed0e1060557a4e28ef3)
- [Laravel日記2 - CSSを適用してみる-](https://qiita.com/kotsuban-teikin/items/9b00d0faa0b7eaf70796)
- [Laravelのアセットに関するTips](https://qiita.com/sakuraya/items/411dbc2e1e633928340e)
- [Twitter API Elevated(高度なアクセス)の利用申請をしてみる！](https://tensei-shinai.com/2022/04/27/twitter-api-elevated/)
- [LaravelでTwitterの投稿を実装する](https://qiita.com/tiwu_dev/items/0fdb193a44b6eeb937fa)
- [PHPでTwitterに画像を投稿する処理を書く際のハマリどころまとめ](https://qiita.com/zaramme/items/0f362d03c7961b4ef24d)
- [Amazon S3に置いた画像ファイルがTwitter, Facebook, Chatwork, Slack, Discordでどう展開されるか試してみた](https://dev.classmethod.jp/articles/s3-image-how-looking-in-services/)


## 実践


### 画像を1枚ずつ保存する方法

postsを例に使っていく．  

#### コードだけ確認したい場合，
- app/Http/Controllers/PostController  
- database/migrations/2022_10_06_1653_create_posts_table
- resouces/views/posts/index.blade.php
- resouces/views/posts/create.blade.php
- routes/web.php

#### 説明

まずはER図を確認！  
![posts-ER図](https://user-images.githubusercontent.com/82089820/194734336-c1adef6c-757a-4f7b-aadd-56b43413847d.png)  
今回は簡単のため，'title'と'image_path'の2つを登録．  
'title'はその名の通りタイトル！  
'image_path'はS3でファイルを保存していて，そこへのpathを保存しましょう！  
pathを保存するので，string扱いになります！

次にcreate.blade.phpのformの中身を確認！  
inputタグのtypeに注意をしてください！
```php
<input type="file" name="image">
```

そして，PostControllerのstoreメソッドを見ていきやしょう！  
まず，$postにタイトルを設定します！

```php
$post->title = $request['title'];
```

そしてformから画像を取り出し，S3にアップロードします．  
アップロードする時に同時にパスも取得します．  
そしてそのパスを$pathに設定します！
```php
$image = $request->file('image');
// バケットの`myprefix`フォルダへアップロード
$path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
// アップロードした画像のフルパスを取得
$post->image_path = Storage::disk('s3')->url($path);
```

そして＄postにはtitleとimage_pathが追加されたのでDBに保存します！
```php
$post->save();
```

最後にindex.blade.phpですが，簡単にimgタグのsrcにimage_pathを入れてあげましょう！
```php
<img class='image' width="300" height="200" src="{{ $post->image_path }}">
```

以上！

---

### 画像を複数枚扱う方法

itemを例にとります！

#### コードだけ確認したい場合，
- app/Item.php
- app/ItemPhoto.php
- app/Http/Controllers/ItemController.php
- database/migrations/2022_10_06_193052_create_items_table
- database/migrations/2022_10_06_193114_create_item_photos_table
- resouces/views/item/index.blade.php
- resouces/views/item/create.blade.php
- routes/web.php

#### 説明

まずはER図から確認します！  
![item-ER図](https://user-images.githubusercontent.com/82089820/194737082-a45ff6fd-d756-40d2-b968-e4bf26ab7d09.png)
複数の写真を持つには，少し工夫が入ります！  
単純にphotoカラムを持ってしまうと，1つの写真しか登録できません．  
なので写真を複数枚持つためには，新しいphotoテーブルを用意します．  
1つのitemは複数のphotoを持っており，1つのphotoは1つのitemに結びつきます．  
つまり，1対多の関係があることに注意しましょう！  

上記の内容に従って，migrationファイルとmodelを作成しましょう！

さてcreate.blade.phpを見ていきます！

```php
<input type="file" name="files[][image]" multiple><br />
```

ポイントはmultipleを設定することで，複数枚の写真を保存できます！  
さらにnameのところは配列にしましょう！  
これによって，controllerの処理ができるようになります！  

そして，ItemControllerのstoreメソッドを確認します！

```php
// itemテーブルには名前だけ保存
$item = Item::create(['name' => $request->name]);
```

ここで確認しておくべきことは，itemテーブルにはnameだけ登録すればOKです！  
そしてphotoには$pathだけ保存しましょう！

```php
// photoテーブルには複数のpathを保存
foreach ($request->file('files') as $index=>$file) {
    $path = Storage::disk('s3')->putFile('myprefix', $file['image'], 'public');
    $item->photos()->create(['path' => Storage::disk('s3')->url($path)]); 
}
```

さらに今回は複数枚のphotoが送信されてくるため，item->photoに1枚ずつ登録します！  
なので，foreachで枚数分の登録を行なってます！

そしてindex.blade.phpを確認していきたいのですが，  
その前にItemControllernのindexメソッドを確認します！

```php
$item_photo = $item::with('photos');  // リレーション先を引っ張る
return view('item/index')->with(['items'=>$item_photo->get()]);
```

itemとitem_photosを持っていきましょう!

最後にindex.blade.phpを見ます!

```php
@foreach ($item->photos as $photo)
    <p>{{ $photo->path }}</p>
    <img class='image' width="200" height="200" src="{{ $photo->path }}">
@endforeach
```

ポイントは$itemのphotosは複数枚のpathが入っています！  
なので，photosから1個ずつphotoのパスをとって画像に表示しましょう！

以上です！

---

### おまけ1 自分で画像を作成する

photoの関係やコードは重なるため，ポイントの箇所だけ説明する．

#### コードだけ確認したい場合，

- app/TacticalBoard.php
- app/TacticalBoardPhoto.php
- app/Http/Controllers/TacticalBoardController.php
- database/migrations/2022_10_08_171208_create_tactical_boards_table
- database/migrations/2022_10_08_171228_create_tactical_board_photos_table
- resouces/views/tactical/index.blade.php
- resouces/views/tactical/create.blade.php
- resouces/views/tactical/show.blade.php
- routes/web.php

JS
- resources/js/tactical.js
- webpack.mix.js

CSS
- public/css/canvas.css

#### ちょっと注意

jsを書く前に，

```bash
npm install
```

を実行します！これで，JSを書く準備OKです！  
resources/js/hoge.jsを作成して，JSを書いていきましょう！  
htmlで読み込む場合には，

```php
<script src="{{ mix('js/hoge.js') }}"></script>
```

そして，webpack.mix.jsも編集します！

```php
.js('resources/js/hoge.js', 'public/js')
```

を追加してください！  
最後にJSファイルを編集した場合には，必ず

```bash
npm run dev
```

を実行しましょう！以上！

cssは

```bash
npm install
npm run dev
```

を実行するとpublic/cssフォルダが作成されます！  
ここにcssファイルを作成しましょう！  
cssを読み込むには，

```php
<link rel="stylesheet" href="{{ secure_asset('css/hoge.css') }}">
```

としましょう！

### おまけ2 twitterにS3画像を投稿する．

twitterに画像を投稿するところメイン！

#### コードだけ確認したい場合，

- app/Tweet.php
- app/Http/Controllers/TweetController.php
- database/migrations/2022_10_28_082350_create_tweets_table.php
- resouces/views/tweets/index.blade.php
- resouces/views/tweets/create.blade.php
- config/services.php
- routes/web.php

#### 先に結論！

S3の画像のURLを記述しただけでは，twitterに画像の投稿はできないみたい！  
[Amazon S3に置いた画像ファイルがTwitter, Facebook, Chatwork, Slack, Discordでどう展開されるか試してみた](https://dev.classmethod.jp/articles/s3-image-how-looking-in-services/)  
なので，OGPを用いてhtmlをtwitterに投稿する．(この時に画像を大きくする)

#### 注意点

TweetControllerのstore_tweet関数だけが主に違います！

```php
// フォームから送信された値をそれぞれ変数に代入
$content = $request['content'];
$image = $request->file('image');
$tmp_path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
$image_path = Storage::disk('s3')->url($tmp_path);
        
// DBに登録(tweetsテーブルに値を保存)
$tweet->content = $content;
$tweet->image_path = $image_path;
```
上記の記述はcreate.blade.phpのフォームから送信された値をDBに保存しています．  
次はtwitterへの投稿のための実装．  
```php
$connection = new TwitterOAuth(
    config('services.twitter.consumer_key'),
    config('services.twitter.consumer_secret'),
    config('services.twitter.access_token'),
    config('services.twitter.access_token_secret'),
);
```
twitterと接続するための設定．  
.envから直接呼び出すより，configから呼び出した方が良い！  
.env->configとした方がパフォーマンスが上がる！  
```bash
php artisan cache:clear
php artisan config:clear
```
.env，configを変更したときは上記のコマンドを実行．

```php
$username = config('services.twitter.username');
```
OGPにTwitterのユーザ名を載せる必要があるため，configから取り出してる．  
直接htmlに記述しても問題はないはず．

```php
// twitterにs3の画像を投稿するため，htmlを作成(twittercard)
// htmlファイルを作成
$htmlfile = 'tmp.html';
// htmlファイルの中身を作成
$filecontents = 
'
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">
    <head>
        <meta name="twitter:title" content="New tweets" />
        <meta name="twitter:description" content="' . $content . '" />
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="' . $username . '" />
        <meta name="twitter:creator" content="' . $username . '">
        <meta name="twitter:image" content="' . $image_path . '" />
    </head>
    <body>
        <h1>Page Not Display</h1>
    </body>
</html>
';
// htmlファイルにhtmlの中身を記述
file_put_contents($htmlfile, $filecontents);

// 上記で作成したhtmlファイルをs3にアップロードして，pathを取得
// htmlをバケットの'myprefix'フォルダへアップロード
$html_tmp_path = Storage::disk('s3')->putFile('myprefix', $htmlfile, 'public');
// アップロードした画像のフルパスを取得
$html_path = Storage::disk('s3')->url($html_tmp_path);
// htmlファイルの中身を空にする
file_put_contents($htmlfile, '');
```
今回の実装の最大のポイント！  
OGPを投稿するためにhtmlを作成して，S3にhtmlファイルを保存．  

```php
// tweetの中身をフォーマットを作成
// statusには投稿する中身を載せる．
$tweet = [
    'status' => $content . PHP_EOL. $html_path,
];
// tweetする
$res = $connection->post('statuses/update', $tweet);
```
あとはツイートするだけ！

これで全部の説明終了です！

## メモ：インストール

初期設定
```bash
git clone git@github.com:koya-namba/image-blog.git
cd image-blog
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
```

.envを設定
```vim
DB_DATABASE={db_name}
DB_USERNAME={db_username}
DB_PASSWORD={db_password}

AWS_ACCESS_KEY_ID={access_key_id}
AWS_SECRET_ACCESS_KEY={secret_access_key}
AWS_DEFAULT_REGION=ap-northeast-1
AWS_BUCKET={backet_name}
```

実行する
```bash
php artisan migrate:fresh --seed
php artisan serve --port=8080
```

以上！
