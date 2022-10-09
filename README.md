# laravel6とS3で画像を扱う

このリポジトリではlaravel6とS3で画像を保存したり，表示する方法を記録．  
S3とはファイルを保存しておける場所で，この場所へのpathをDBに保存することでファイルを扱える！  


## 概要

1. 画像を1枚ずつ保存する方法->postsを用いる．  
2. 画像を複数枚保存する方法->itemを用いる．  

おまけ 自分で画像を作成し，保存する．


## 実践


### 画像を1枚ずつ保存する方法

postsを例に使っていく．  

#### コードだけ確認したい場合，
- app/Http/Controllers/PostController  
- database/migrations/2022_10_06_1653_create_posts_table
- resouces/views/index.blade.php
- resouces/views/posts/create.blade.php

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


### 画像を複数枚扱う方法
