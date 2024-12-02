<?php
// admin\products\store.php
require "../config.php";

var_dump($_POST);
print "<hr>";
var_dump($_FILES);

// Request Method が Post かのチェック
if( $_SERVER[ "REQUEST_METHOD" ] !== "POST" ){
    header( "Location: create.php" );
    exit;
}

try{

    //作品情報を取り出し
    $title       = filter_input( INPUT_POST, "title" );                               //必須
    $catchcopy   = filter_input( INPUT_POST, "catchcopy" );
    $thumbnail   = "thumbnail_file_name.demo";                           //必須
    $description = filter_input( INPUT_POST, "description" );
    $style       = filter_input( INPUT_POST, "style" );
    $grade       = filter_input( INPUT_POST, "grade" , FILTER_VALIDATE_INT);
    $skill       = filter_input( INPUT_POST, "skill" );                               //必須
    $demo        = filter_input( INPUT_POST, "demo" , FILTER_VALIDATE_URL);   //必須
    $period      = filter_input( INPUT_POST, "period" , FILTER_VALIDATE_INT);

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

    //ファイルのアップロード処理
    if( !empty( $_FILES[ "thumbnail" ] ) ){
        $uploadedFile = $_FILES[ "thumbnail" ];
    }else{
        header( "Location: create.php?thumb" );
        exit;
    }

    if( !is_uploaded_file( $uploadedFile[ "tmp_name" ] ) ){
        new Exception( "サムネイルがアップロードできませんでした" );
    }

    //ランダムな文字列を生成する
    $randStr       = random_bytes(32);
    $base64RandStr = base64_encode($randStr);
    $base64RandStr = str_replace(["+" , "/" , "="], "" , $base64RandStr);
    $base64RandStr = substr($base64RandStr, 0, 12);

    $exe           = preg_split(" /\./ ", $uploadedFile["name"]);
    $exe           = $exe[ count($exe) - 1 ];

    $filename      = "../../storage/{$base64RandStr}.{$exe}";
    // var_dump($exe); 
    // exit;

    if( !move_uploaded_file( $uploadedFile["tmp_name"],$filename ) ){
        new Exception( "サムネイルの移動に失敗しました" );
    }

    $db = new PDO( DB_DSN, DB_USER, DB_PASS );

    //トランザクションの有効化
    $db -> beginTransaction();

    $productsTable = TB_PRODUCTS;
    //products insert
    $productsSql ="
        INSERT INTO {$productsTable} (
            title, catchcopy, thumbnail, description,
            style, grade, skill, demo, period
        )
        VALUES (
            :title, :catchcopy, :thumbnail, :description,
            :style, :grade, :skill, :demo, :period
        )
    ";

    $stmt = $db -> prepare($productsSql);
    $stmt -> execute(
        [
            "title"       => $title,
            "catchcopy"   => $catchcopy,
            "thumbnail"   => "{$base64RandStr}.{$exe}",
            "description" => $description,
            "style"       => $style,
            "grade"       => $grade,
            "skill"       => $skill,
            "demo"        => $demo,
            "period"      => $period,
        ]
    );

    $db -> commit();

}
catch( PDOException $error ){
    print $error -> getMessage();
    $db -> rollBack();
}
catch( Exception $error ){
    print $error -> getMessage();
    $db -> rollBack();
}
