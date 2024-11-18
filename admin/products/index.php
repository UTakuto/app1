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
    <div class="w-full m-auto">
        <?php require __DIR__ . "/../header.php"; ?>
        <main class="p-10 flex flex-row flex-wrap items-center justify-center">
        <?php foreach($products as $product) : ?>
            <div class="border-solid border-[1px] border-slate-500 w-[500px] h-[300px] flex items-center m-[10px] rounded overflow-hidden shadow-md bg-white">
                <div class="px-6 py-4">
                    <div class="text-[20px] font-bold"><?= $product -> title ?></div>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> catchcopy ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> thumbnail ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> style ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> grade ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> skill ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> demo ?>
                    </p>
                    <p class="text-slate-600 leading-normal font-light">
                        <?= $product -> period ?>
                    </p>
                    <!-- <a href="./detail.php?id=<?= $product -> id ?>" class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        DETAIL
                    </a> -->
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