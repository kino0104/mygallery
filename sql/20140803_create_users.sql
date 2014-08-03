CREATE TABLE users (
  id VARCHAR(100) PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(32) NOT NULL,
  salt VARCHAR(32) NOT NULL,
  sid VARCHAR(32) NOT NULL UNIQUE,
  session_expires_at DATETIME NOT NULL,
  created_at DATETIME NOT NULL,
  updated_at TIMESTAMP NOT NULL
);

ALTER TABLE photos ADD COLUMN user_id VARCHAR(100) NOT NULL REFERENCES user(id) AFTER id;

-- サンプルデータ作成（本番環境では実行不要）
INSERT INTO users (id, username, password, salt, sid, session_expires_at, created_at)
VALUES ('222717163', 'kino_0104', 'PASSWORD', 'SALT', 'SID', '2015-01-01 00:00:00', CURRENT_TIMESTAMP);

UPDATE photos SET user_id = '222717163';
