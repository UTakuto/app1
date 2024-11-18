<?php 
// admin\profiles\update.php

require "../config.php";

try{

    // 送信データの取得
    $id    = filter_input(INPUT_POST, "id");
    $name  = filter_input(INPUT_POST, "name");
    $email = filter_input(INPUT_POST, "email" , FILTER_VALIDATE_EMAIL);
    $about = filter_input(INPUT_POST, "about");
    
    $job1  = filter_input(INPUT_POST, "job1");
    $job2  = filter_input(INPUT_POST, "job2");

    // 未入力チェック
    if(!$id){
        throw new Exception("プロフィールIDがありません");
    }    
    if(!$name){
        throw new Exception("名前が未入力です");
    }
    if(!$email){
        throw new Exception("メールアドレスが未入力です");
    }
    if(!$job1 && !$job2){
        throw new Exception("希望職種を1つ以上選択してください");
    }
    if(!$job1){
        throw new Exception("希望職種1が未入力です");
    }

    // jobの配列を作る
    $jobs = [];
    if($job1){
        $jobs[] = $job1;
    }
    if($job2){
        $jobs[] = $job2;
    }

    //app1_profiles table と　app1_jobs table にデータを更新する
    $db = new PDO( DB_DSN, DB_USER, DB_PASS );
    $db -> beginTransaction();

    $profilesTable = TB_PROFILES;
    $jobsTable = TB_JOBS;

    // トランザクションの有効化
    $db -> beginTransaction();

    // app1_profiles Update SQL
    $sql = "
        UPDATE {$profilesTable}
        SET 
            name = :name, email = :email, about = :about
        WHERE id = :id
    ";
    $stmt = $db -> prepare($sql);
    $stmt -> execute([
        "id"    => $id,
        "name"  => $name,
        "email" => $email,
        "about" => $about,
    ]);

    foreach($jobs as $job){
        if($job["id"]){
            $sql = "UPDATE {$jobsTable} SET name = :name WHERE id = :id";
            $params = ["id" => $job["id"], "name" => $job["name"]];
        }
        else{
            $sql = "INSERT INTO {$jobsTable} (profile_id , name) VALUES (:profile_id , :name)";
            $params = ["name" => $job["name"], "profile_id" => $id];
        }

        $stmt = $db -> prepare($sql);
        $stmt -> execute($params);
    }



    // 更新処理の適用
    $db -> commit();

}
catch(PDOException $error){
    //更新処理のロールバック
    $db -> rollback();

}
catch(Exception $error){

}

