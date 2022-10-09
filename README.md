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

### おまけ 自分で画像を作成する
