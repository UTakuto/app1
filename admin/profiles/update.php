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

}
catch(PDOException $error){

}
catch(Exception $error){

}

