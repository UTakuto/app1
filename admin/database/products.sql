# 作品情報テーブル

# products DROP
DROP TABLE IF EXISTS app1_products;

# create products table
CREATE TABLE app1_products(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,     #主キー

    title       VARCHAR(255) NOT NULL,              # タイトル
    catchcopy   VARCHAR(255),                       # キャッチコピー
    thumbnail   VARCHAR(255) NOT NULL,              # サムネイル
    description TEXT,                               # 説明
    style       TINYINT UNSIGNED DEFAULT 1,         # 制作スタイル（個人:1 / チーム:2）
    grade       TINYINT UNSIGNED DEFAULT 1,         # 作成した学年
    skill       VARCHAR(255) NOT NULL,              # 使用スキル
    demo        VARCHAR(255) NOT NULL,              # サイトリンク
    period      VARCHAR(64),                        # 制作期間

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, # 作成日時
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                ON UPDATE CURRENT_TIMESTAMP         # 更新日時
)ENGINE = INNODB;

# ダミーデータ
INSERT INTO app1_products (
    title ,
    catchcopy ,
    thumbnail ,
    style ,
    grade ,
    skill ,
    demo ,
    period
)
VALUES(
    "ダミー作品1",
    "WA!", 
    "https://click.ecc.ac.jp/ecc/tuemori/app1/",
    1, # 個人
    2, # 2年生
    "illustrator",
    "https://click.ecc.ac.jp/ecc/tuemori/php1/",
    "2024.04 - 2024.08"
);