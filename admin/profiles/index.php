<?php 
// admin\profiles\index.php

// PDO( PHP Database Object )
// メリット : DBの種類が変わってもコードを再利用できる

require_once "../config.php";

// 1, DBへの接続
// DSN : DBの種類やHOSTや文字エンコードなどを指定した文字列
$db = new PDO( DB_DSN,  DB_USER ,  DB_PASS );

// var_dump(value: $db);

// 2, SQLの準備と実行
$table = TB_PROFILES;
$sql = "SELECT * FROM $table";

//プリペアードステートメント
$stmt = $db->prepare($sql);
$stmt->execute();

// var_dump($stmt);

//3, SQLの実行結果の取り出しと整形
while( $row = $stmt -> fetchObject() ){
    // echo "<p> $row->id $row->name  $row->email </p>";
    $profiles[] = $row;

}




?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>アプリ開発演習 - 管理 - プロフィール</title>
    <!-- tailwindcss -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="w-full m-auto">
        <?php require __DIR__ . "/../header.php"; ?>
        <main class="p-10 flex flex-row flex-wrap items-center justify-center">
        <?php foreach($profiles as $profile) : ?>
            <div class="border-solid border-[1px] border-slate-500 w-[500px] h-[200px] flex items-center m-[10px] rounded overflow-hidden shadow-md bg-white">
                <div class="px-6 py-4">
                    <div class="text-[20px] font-bold"><?= $profile -> name ?></div>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $profile -> email ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $profile -> about ?>
                    </p>
                    <a href="./detail.php?id=<?= $profile -> id ?>" class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        DETAIL
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </main>
    <div class="flex justify-center align-center">
        <a href="create.php" class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
            CREATE
        </a>
    </div>

    </div>
</body>

</html>