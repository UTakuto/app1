<?php 
//admin\products\edit.php

require "../config.php";

//productsのIDがないと更新対象を持って来れない。
$productId = filter_input(INPUT_GET, "id");
if( !$productId ){
    header("Location: index.php");
    exit;
}

//DB接続
$db = new PDO( DB_DSN, DB_USER, DB_PASS );

//app1_products table から ID に一致するレコードを1件抽出してくる
$productsTable = TB_PRODUCTS;

$sql = "SELECT *FROM {$productsTable} WHERE id = :id";

$stmt = $db -> prepare($sql);
$stmt -> execute(["id" => $productId]);

$product = $stmt -> fetchObject();

// $product = [];
// while( $row = $stmt -> fetchObject()){
        
//     //制作スタイル
//     if($row -> style === 1){
//         $row -> style = "個人";
//     }else{
//         $row -> style = "個人";
//     }

//     $products[] = $row;
// }

var_dump($product);

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
        <main class="p-10 flex flex-col items-center justify-center">
            <h2>作品編集</h2>
            <form action="update.php" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
            <input type="hidden" name="id" value="<?= $product -> id?>">
                <!-- title -->
                <div class="pt-[8px]">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">TITLE.</label>
                    <!-- <p class="text-red-400 text-[12px] align-center">*この項目は必須です</p> -->
                    <input type="text" name="title" id="title" value="<?= $product -> title ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- catchcopy -->
                <div class="pt-[8px]">
                    <label for="catchcopy" class="block mb-2 text-sm font-medium text-gray-900">CATCHCOPY.</label>
                    <input type="text" name="catchcopy" id="catchcopy" value="<?= $product -> catchcopy ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- thumbnail -->
                <div class="pt-[8px]">
                    <label for="thumbnail" class="block mb-2 text-sm font-medium text-gray-900">THUMBNAIL.</label>
                    <input type="file" name="thumbnail" id="thumbnail" value="<?= $product -> thumbnail ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- style -->
                <div class="pt-[8px]">
                    <label for="style" class="block mb-2 text-sm font-medium text-gray-900">STYLE.</label>
                    <ul class="items-center w-full text-sm font-medium text-gray-900 border border-gray-300 rounded-lg sm:flex bg-gray-50 rounded-md">
                        <li class="w-full border-gray-300  sm:border-r">
                            <div class="flex items-center ps-3">
                                <input type="radio" value="<?=$product -> style ?>" name="style" id="style" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="style" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">個人</label>
                            </div>
                        </li>
                        <li class="w-full border-gray-200">
                            <div class="flex items-center ps-3">
                                <input type="radio" value="2" name="style" id="style" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500  focus:ring-2">
                                <label for="style" class="w-full py-3 ms-2 text-sm font-medium text-gray-900">チーム</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- grade -->
                <div class="pt-[8px]">
                    <label for="grade" class="block mb-2 text-sm font-medium text-gray-900">GRADE.</label>
                    <input type="number" name="grade" id="grade" value="<?= $product -> grade ?>" min="1" max="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- skill -->
                <div class="pt-[8px]">
                    <label for="skill" class="block mb-2 text-sm font-medium text-gray-900">SKILL.</label>
                    <input type="text" name="skill" id="skill" value="<?= $product -> skill ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
            
                <!-- demo -->
                <div class="pt-[8px]">
                    <label for="demo" class="block mb-2 text-sm font-medium text-gray-900">DEMO.</label>
                    <input type="url" name="demo" id="demo" value="<?= $product -> demo ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- period -->
                <div class="pt-[8px]">
                    <label for="period" class="block mb-2 text-sm font-medium text-gray-900">PERIOD.</label>
                    <input type="text" name="period" id="period" value="<?= $product -> period ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>

                <!-- description -->
                <div class="pt-[8px]">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">DESCRIPTION.</label>
                    <textarea name="description" id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"><?= $product -> description ?></textarea>
                </div> 
                <div class="flex justify-center">
                    <button type="submit" class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        再登録
                    </button>
                </div>
            </form>

            <a href="index.php" class="inline-block rounded-md bg-slate-800 py-2 px-3 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                HOME
            </a>
        </main>
    </div>
</body>

</html>