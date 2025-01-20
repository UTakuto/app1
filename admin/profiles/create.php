<?php
// admin\profiles\detail.php

require_once "../config.php";


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
            <h2>プロフィール登録</h2>
            <form action="store.php" method="POST" class="max-w-sm mx-auto">
                <div class="pt-[8px]">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">NAME.</label>
                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">EMAIL.</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">PASSWORD.</label>
                    <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="repassword" class="block mb-2 text-sm font-medium text-gray-900">RE-PASSWORD.</label>
                    <input type="password" name="repassword" id="repassword" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="job1" class="block mb-2 text-sm font-medium text-gray-900">JOB1.</label>
                    <input type="text" name="job1" id="job1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="job2" class="block mb-2 text-sm font-medium text-gray-900">JOB2.</label>
                    <input type="text" name="job2" id="job2" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                </div>
                <div class="pt-[8px]">
                    <label for="about" class="block mb-2 text-sm font-medium text-gray-900">ABOUT.</label>
                    <textarea name="about" id="about" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div> 
                <div class="flex justify-center">
                    <button type="submit" class="inline-block rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        登録
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