<?php 
// admin\profiles\detail.php

require_once "../config.php";

//GET [ id ] 取得
$id = filter_input( INPUT_GET, "id" );

//GET [ id ] がない場合は、index.php にredirect
if( !$id){
    header("location: index.php");
    exit;
}

// 1, DBへの接続
// DSN : DBの種類やHOSTや文字エンコードなどを指定した文字列
$db = new PDO( DB_DSN,  DB_USER ,  DB_PASS );


// 2, SQLの準備と実行
$profilesTable = TB_PROFILES;
$jobsTable     = TB_JOBS;
$sql = "
    SELECT 
        {$profilesTable}.id,
        {$profilesTable}.name,
        {$profilesTable}.email,
        (
            SELECT JSON_ARRAYAGG(
                JSON_OBJECT(
                    'profile_id', {$jobsTable}.id,
                    'name',       {$jobsTable}.name
                )
            )
                FROM
                    {$jobsTable}
                WHERE
                    {$profilesTable}.id = {$jobsTable}.profile_id
        ) AS jobs,
        {$profilesTable}.about,
        {$profilesTable}.created_at,
        {$profilesTable}.updated_at
    FROM 
        {$profilesTable}
    WHERE
        {$profilesTable}.id = :id
";

//プリペアードステートメント
$stmt = $db->prepare($sql);
// $stmt -> bindParam( "id" , $id , PDO::PARAM_INT );
$stmt->execute(["id" => $id]);

// var_dump($stmt);

//3, SQLの実行結果の取り出しと整形
$profile = $stmt -> fetchObject() ;

// var_dump($profile);

// データの表示に合わせて整形
if($profile -> jobs ){
    $profile -> jobs = json_decode($profile -> jobs);
    var_dump($profile -> jobs);
}else{
    $profile -> jobs = [];
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

        <main class="p-10 flex flex-col items-center justify-center">
            <div
                class="border-solid border-[1px] border-slate-500 w-[650px] h-[200px] flex items-center m-[10px] rounded overflow-hidden shadow-md bg-white">
                <div class="px-6 py-4">
                    <div class="text-[20px] font-bold pb-[10px]">ID : <?= $profile->id ?></div>
                    <p class="text-[#333] leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">Name :</span> <?= $profile->name ?>
                    </p>
                    <p class=" leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">Email :</span> <?= $profile->email ?>
                    </p>
                    <p class=" leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">about :</span> <?= $profile->about ?>
                    </p>
                    <?php foreach(($profile-> jobs) as $job) :?>
                    <p class=" leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">jobs :</span> <?= $job -> name ?>
                    </p>
                    <?php endforeach ?>
                    <p class=" leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">Create:</span>
                        <?= $profile->created_at ?>
                    </p>
                    <p class=" leading-normal font-light">
                        <span class="text-slate-600 leading-normal font-light">Update:</span>
                        <?= $profile->updated_at ?>
                    </p>
                </div>
            </div>
            <div class="flex flex-col align-center justify-around">
                <a href="index.php"
                    class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                    HOME
                </a>
            </div>
        </main>
    </div>
</body>

</html>