<?php
// admin\profiles\store.php

require "../config.php";
var_dump($_POST);

try{

    //送信データの取得
    $name  = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email" , FILTER_VALIDATE_EMAIL); 
    $password = filter_input(INPUT_POST, "password");
    $repassword = filter_input(INPUT_POST, "repassword");
    $job1  = filter_input(INPUT_POST, "job1");
    $job2  = filter_input(INPUT_POST, "job2");
    $about = filter_input(INPUT_POST, "about");

    // 未入力チェック
    if(!$name){
        throw new Exception("名前が未入力です");
    }
    if(!$email){
        throw new Exception("メールアドレスが未入力です");
    }
    if(!$password || !$repassword){
        throw new Exception("パスワードまたは、パスワード(再入力)が未入力です");
    }
    if($password !== $repassword){
        throw new Exception("パスワードが一致しません");
    }
    if(!$job1 && !$job2){
        throw new Exception("希望職種を1つ以上選択してください");
    }
    if(!$job1){
        throw new Exception("希望職種1が未入力です");
    }

    // 暗号化パスワード
    $hashPassword = password_hash($password , PASSWORD_DEFAULT , ["cost" => 12]);

    // jobの配列を作る
    $jobs = [];
    if($job1){
        $jobs[] = $job1;
    }
    if($job2){
        $jobs[] = $job2;
    }

    $db = new PDO( DB_DSN, DB_USER, DB_PASS );
    
    // トランザクション
    $db -> beginTransaction();

    $profileTable = TB_PROFILES;
    $jobsTable = "app1_jobs";

    //emailの重複チェック
    $profileSelectSql = " SELECT count(id) AS count FROM {$profileTable} WHERE email = :email ";
    $stmt = $db -> prepare($profileSelectSql);
    $stmt -> execute(["email" => $email]);
    $count = $stmt -> fetchObject();

    //重複していたらエラー
    if($count -> count > 0){
        throw new Exception("このメールアドレスは既に登録されています");
    }

    //profile insert
    $profileSql ="
        INSERT INTO {$profileTable} (name, email, password, about)
        VALUES (:name, :email, :password, :about)
    ";

    $stmt = $db -> prepare($profileSql);
    $stmt -> execute(
        [
            "name" => $name, 
            "email" => $email, 
            "password" => $hashPassword, 
            "about" => $about,
        ]
    );

    //profile id 取得
    $insertID = $db -> lastInsertId();

    //job insert
    $jobSql ="
        INSERT INTO {$jobsTable} (name , profile_id)
        VALUES (:name , :profile_id)
        ";

    $stmt = $db -> prepare($jobSql);
    foreach($jobs as $job){
        $stmt -> execute(["name" => $job, "profile_id" => $insertID]);
    }

    $db -> commit();
}
catch(PDOException $error){
    print $error->getMessage() . ">>>" . $stmt->queryString;
    //ロールバック
    $db->rollBack();
}
catch(Exception $error){
    print $error->getMessage();
     //ロールバック
    $db->rollBack();
}

