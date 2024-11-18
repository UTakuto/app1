<?php
// header.phpをそのまま持っていくとバレるからねー


$currentFile = basename($_SERVER['PHP_SELF']);
$currentDir = basename(dirname($_SERVER['PHP_SELF']));
$displayText = '';

// ファイル名に基づいてdisplayTextを設定
switch ($currentFile) {
    case 'index.php':
        $displayText = 'INDEX';
        break;
    case 'detail.php':
        $displayText = 'DETAIL';
        break;
    default:
        $displayText = strtoupper(pathinfo($currentFile, PATHINFO_FILENAME));
        break;
}

// フォルダ名に基づいてh1タグのテキストを設定
$folderText = 'PROFILES';
if (strpos($_SERVER['PHP_SELF'], '/products/') !== false) {
    $folderText = 'PRODUCTS';
}
?>
<header class="bg-pink-200 p-5">
    <h1 class="text-[30px]">
        Admin - <?= $folderText ?> - <?= $displayText ?>
    </h1>
    <nav class="mt-1">
        <ul class="flex algin-center justify-start gap-[10px]">
            <li><a href="/ecc/tuemori/app1/admin/profiles/" class="rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">PROFILES</a></li>
            <li><a href="/ecc/tuemori/app1/admin/products/" class="rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">PRODUCTS</a></li>
        </ul>
    </nav>
</header>