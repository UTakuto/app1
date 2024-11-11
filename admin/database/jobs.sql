# 希望職種のテーブル

# jobs drop
DROP TABLE IF EXISTS app1_jobs;

# JOBS create table
CREATE TABLE app1_jobs(
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,     #主キー
    name VARCHAR(255) NOT NULL,                     # 職種名
    profile_id INT UNSIGNED NOT NULL,               # プロフィールID
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, # 作成日時
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                ON UPDATE CURRENT_TIMESTAMP         # 更新日時
)ENGINE = INNODB;

#table を結合して抽出（JSON形式を利用した方法）
SELECT
	app1_profiles.id,
    app1_profiles.name,
    (
        SELECT JSON_ARRAYAGG(
            JSON_OBJECT(
                app1_jobs.profile_id,
                app1_jobs.name
            )
        )
        FROM
        	app1_jobs
        WHERE
        	app1_profiles.id = app1_jobs.profile_id
    ) AS jobs
FROM
	app1_profiles
WHERE
	app1_profiles.id = 1