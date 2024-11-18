<?php 
// admin\products\index.php

require "../config.php";

try{
    // DB接続
    $db = new PDO( DB_DSN, DB_USER, DB_PASS );

    $productionTable = TB_PRODUCTS;
    $sql = "SELECT * FROM {$productionTable}";

    $stmt = $db -> prepare($sql);
    $stmt -> execute();

    $products = [];
    while( $row = $stmt -> fetchObject() ){
        $products[] = $row;
    }

    var_dump($products);
}
catch(PDOException $error){

}
catch(Exception $error){

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アプリ開発演習 - 管理 - 作品</title>
    <!-- tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    
</body>
</html>