# 作品情報テーブル

# products DROP
DROP TABLE IF EXISTS app1_products;

# create products table
CREATE TABLE app1_products(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,     #主キー
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, # 作成日時
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                ON UPDATE CURRENT_TIMESTAMP         # 更新日時
)ENGINE = INNODB;