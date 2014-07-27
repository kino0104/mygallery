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

左にできた `mygallery` データベースを選択し、 SQL を押し、下記クエリを実行する。

```sql
CREATE TABLE photos (
  id VARCHAR(100) PRIMARY KEY,
  high_image_url VARCHAR(256) NOT NULL,
  high_image_width INTEGER NOT NULL,
  high_image_height INTEGER NOT NULL,
  low_image_url VARCHAR(256) NOT NULL,
  low_image_width INTEGER NOT NULL,
  low_image_height INTEGER NOT NULL,
  sort INTEGER,
  created_at DATETIME NOT NULL,
  updated_at TIMESTAMP NOT NULL,
  INDEX idx_sort(sort)
);
INSERT INTO photos (
  id,
  high_image_url, high_image_width, high_image_height,
  low_image_url, low_image_width, low_image_height,
  sort, created_at
) VALUES
(
  '730037546194686809_222717163',
  'http://scontent-a.cdninstagram.com/hphotos-xap1/t51.2885-15/10424493_412665722206682_898489326_n.jpg', 640, 640,
  'http://scontent-a.cdninstagram.com/hphotos-xap1/t51.2885-15/10424493_412665722206682_898489326_a.jpg', 306, 306,
  1, CURRENT_TIMESTAMP
),
(
  '714820211599070030_222717163',
  'http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10299696_462869223856887_1450111075_n.jpg', 640, 640,
  'http://scontent-a.cdninstagram.com/hphotos-xaf1/t51.2885-15/10299696_462869223856887_1450111075_a.jpg', 306, 306,
  2, CURRENT_TIMESTAMP
),
(
  '697744872909689299_222717163',
  'http://scontent-a.cdninstagram.com/hphotos-xfa1/t51.2885-15/914305_497904653666317_1866275385_n.jpg', 640, 640,
  'http://scontent-a.cdninstagram.com/hphotos-xfa1/t51.2885-15/914305_497904653666317_1866275385_a.jpg', 306, 306,
  3, CURRENT_TIMESTAMP
),
(
  '693299813644619793_222717163',
  'http://scontent-b.cdninstagram.com/hphotos-xap1/t51.2885-15/1596981_624027450998721_1583769907_n.jpg', 640, 640,
  'http://scontent-b.cdninstagram.com/hphotos-xap1/t51.2885-15/1596981_624027450998721_1583769907_a.jpg', 306, 306,
  4, CURRENT_TIMESTAMP
),
(
  '692690296816915142_222717163',
  'http://scontent-a.cdninstagram.com/hphotos-xpa1/t51.2885-15/10011287_262808207223875_883625916_n.jpg', 640, 640,
  'http://scontent-a.cdninstagram.com/hphotos-xpa1/t51.2885-15/10011287_262808207223875_883625916_a.jpg', 306, 306,
  5, CURRENT_TIMESTAMP
);
```
