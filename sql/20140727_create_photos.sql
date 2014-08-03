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

-- サンプルデータ作成（本番環境では実行不要）
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
