# プロフィールテーブル

# profiles drop
DROP TABLE IF EXISTS app1_profiles;

# profiles create
CREATE TABLE app1_profiles( 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY ,    # 主キー
    name VARCHAR(255) NOT NULL ,                    # 作者名
    email VARCHAR(255) NOT NULL ,                   # メールアドレス
    about TEXT ,                                    # 自己紹介
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, # 作成日時
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                ON UPDATE CURRENT_TIMESTAMP         # 更新日時
 ) ENGINE = INNODB;



























 

# Test Data (seed)
INSERT INTO app1_profiles (name, email) VALUES('Fin', 'fin@gmail.com');
INSERT INTO app1_profiles (name, email) VALUES('Yuki', 'yuki@gmail.com');
INSERT INTO app1_profiles (name, email) VALUES('HONDA', 'hon@icloud.com');