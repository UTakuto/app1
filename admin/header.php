<header class="bg-pink-200 p-5">
    <h1 class="text-[30px]">
        Admin - PROFILES - 
        <?php 
        $currentFile = basename($_SERVER['PHP_SELF']);
        ?>
        <?= $currentFile === 'index.php' ? 'INDEX' : ($currentFile === 'detail.php' ? 'DETAIL' : '') ?>
    </h1>
    <nav class="mt-1">
        <ul>
            <li><a href="/ecc/tuemori/app1/admin/profiles/" class="rounded-md bg-slate-800 py-2 px-4 mt-6 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">PROFILES</a></li>
        </ul>
    </nav>
</header>