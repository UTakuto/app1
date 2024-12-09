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

    $productionTable = TB_PRODUCTS;

    $sql = "
        UPDATE {$productionTable}
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
            "title" => $title,
            "catchcopy" => $catchcopy,
            "thumbnail" => $thumbnail,
            "description" => $description,
            "style" => $style,
            "grade" => $grade,
            "skill" => $skill,
            "demo" => $demo,
            "period" => $period,
            "id" => $id
        ]
    );

    $db -> commit();

}catch(PDOException $error){
    $db -> rollBack();
}
catch(Exception $error){
    $db -> rollBack();
}