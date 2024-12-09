<?php
//admin\profiles\update.php

require "../config.php";

try{
    //送信データの取得
    $id          = filter_input(INPUT_POST, "id");
    $title       = filter_input(INPUT_POST, "title");
    $catchcopy   = filter_input(INPUT_POST, "catchcopy");
    $thumbnail   = "thumbnail_file_name.demo";
    $description = filter_input(INPUT_POST, "description");
    $style       = filter_input(INPUT_POST, "style");
    $grade       = filter_input(INPUT_POST, "grade", FILTER_VALIDATE_INT);
    $skill       = filter_input(INPUT_POST, "skill");
    $demo        = filter_input(INPUT_POST, "demo", FILTER_VALIDATE_URL);
    $period      = filter_input(INPUT_POST, "period", FILTER_VALIDATE_INT);


    // デバッグ情報を表示
    var_dump([
        "id" => $id,
        "title" => $title,
        "catchcopy" => $catchcopy,
        "thumbnail" => $thumbnail,
        "description" => $description,
        "style" => $style,
        "grade" => $grade,
        "skill" => $skill,
        "demo" => $demo,
        "period" => $period,
    ]);

    //未入力チェック
    if(!$title){
        header("Location: create.php?title");
        exit;
    }
    if(!$skill){
        header("Location: create.php?skill");
        exit;
    }
    if(!$demo){
        header("Location: create.php?demo");
        exit;
    }

    $db = new PDO( DB_DSN, DB_USER, DB_PASS );
    $db -> beginTransaction();

    $productsTable = TB_PRODUCTS;

    $sql = "
        UPDATE {$productsTable}
        SET 
            title = :title, 
            catchcopy = :catchcopy, 
            thumbnail = :thumbnail, 
            description = :description, 
            style = :style, 
            grade = :grade, 
            skill = :skill, 
            demo = :demo, 
            period = :period
        WHERE id = :id
    ";

    $stmt = $db -> prepare($sql);
    $stmt -> execute(
        [
            "id" => $id,
            "title" => $title,
            "catchcopy" => $catchcopy,
            "thumbnail" => $thumbnail,
            "description" => $description,
            "style" => $style,
            "grade" => $grade,
            "skill" => $skill,
            "demo" => $demo,
            "period" => $period,
        ]
    );

    $db -> commit();

}catch(PDOException $error){
    $db -> rollBack();
    print $error -> getMessage();
}
catch(Exception $error){
    print $error -> getMessage();
}