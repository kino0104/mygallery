mygallery
=========
change

## サーバーサイド環境構築

### Mac

XAMPP をインストールする。下記のようにセキュリティの設定を行う。

```bash
$ sudo /Applications/XAMPP/xamppfiles/xampp security
```

PHP から MySQL に接続できるように設定する。

```bash
$ cp api/connection.php.example api/connection.php
$ vi api/connection.php
```

下記のように `httpd.conf` を開き、 `DocumentRoot` を `mygallery` の場所に向け、アクセスできるよう設定を追加。

```bash
$ vi /Applications/XAMPP/etc/httpd.conf
-> DocumentRoot "/Users/youcune/develop/mygallery"
-> <Directory /></Directory> 内の
-> Require all denied
-> を下記のように変更
-> Require all granted
```

管理画面から Apache と MySQL を起動する。

http://localhost/phpmyadmin/ にアクセスし、さっき作った root のパスワードでログインし、データベース名は `mygallery` 、照合順序は `utf8_general_ci` でデータベース作成。

左にできた `mygallery` データベースを選択し、 SQL を押し、 sql/ ディレクトリの中にある SQL ファイルを日付順に実行する。

## API 仕様

### 写真一覧取得

```
GET /api/photos.php
```

* user_id: どのユーザの写真一覧を取りたいか

#### 例

```bash
$ curl 'http://localhost/api/photos.php?user_id=222717163' | jq .
{
  "results": [
    {
      "low_image": {
        "height": "306",
        "width": "306",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xfa1/t51.2885-15/914305_497904653666317_1866275385_a.jpg"
      },
      "high_image": {
        "height": "640",
        "width": "640",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xfa1/t51.2885-15/914305_497904653666317_1866275385_n.jpg"
      },
      "id": "697744872909689299_222717163"
    },
    {
      "low_image": {
        "height": "306",
        "width": "306",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xap1/t51.2885-15/10424493_412665722206682_898489326_a.jpg"
      },
      "high_image": {
        "height": "640",
        "width": "640",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xap1/t51.2885-15/10424493_412665722206682_898489326_n.jpg"
      },
      "id": "730037546194686809_222717163"
    },
    {
      "low_image": {
        "height": "306",
        "width": "306",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xpa1/t51.2885-15/10011287_262808207223875_883625916_a.jpg"
      },
      "high_image": {
        "height": "640",
        "width": "640",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xpa1/t51.2885-15/10011287_262808207223875_883625916_n.jpg"
      },
      "id": "692690296816915142_222717163"
    },
    {
      "low_image": {
        "height": "306",
        "width": "306",
        "url": "http://scontent-b.cdninstagram.com/hphotos-xap1/t51.2885-15/1596981_624027450998721_1583769907_a.jpg"
      },
      "high_image": {
        "height": "640",
        "width": "640",
        "url": "http://scontent-b.cdninstagram.com/hphotos-xap1/t51.2885-15/1596981_624027450998721_1583769907_n.jpg"
      },
      "id": "693299813644619793_222717163"
    },
    {
      "low_image": {
        "height": "306",
        "width": "306",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10299696_462869223856887_1450111075_a.jpg"
      },
      "high_image": {
        "height": "640",
        "width": "640",
        "url": "http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10299696_462869223856887_1450111075_n.jpg"
      },
      "id": "714820211599070030_222717163"
    }
  ],
  "status": "OK"
}
```

### 順序更新

```
POST /api/sort.php
```

* sid: 更新したいユーザの users テーブルの sid の値を指定。指定したユーザ以外のデータは更新できない
* photos: photos テーブルの id の順序を , 区切りで指定。次から photos.php が指定した順序で返すようになる。

#### 例

```bash
$ curl -d 'sid=SID' -d 'photos=697744872909689299_222717163,730037546194686809_222717163' http://localhost/api/sort.php | jq .
{
  "status": "OK"
}
```
