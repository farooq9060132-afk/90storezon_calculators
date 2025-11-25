<?php
// Get current page name to highlight active link
$page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-64 bg-white border-r border-gray-200 hidden md:block flex-shrink-0">
    <div class="p-6 border-b border-gray-200">
        <a href="/" class="text-xl font-bold text-gray-900 flex items-center gap-2">
            <span class="text-brand-600">90storezon</span> Admin
        </a>
    </div>
    <nav class="p-4 space-y-2">
        <a href="index.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $page == 'index.php' ? 'bg-brand-50 text-brand-600' : 'text-gray-600 hover:bg-gray-50'; ?>">
            <span>📊</span> Dashboard
        </a>
        <a href="calculators.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $page == 'calculators.php' ? 'bg-brand-50 text-brand-600' : 'text-gray-600 hover:bg-gray-50'; ?>">
            <span>🧮</span> Calculators
        </a>
        <a href="users.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $page == 'users.php' ? 'bg-brand-50 text-brand-600' : 'text-gray-600 hover:bg-gray-50'; ?>">
            <span>👥</span> Users
        </a>
        <a href="themes.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $page == 'themes.php' ? 'bg-brand-50 text-brand-600' : 'text-gray-600 hover:bg-gray-50'; ?>">
            <span>🎨</span> Themes
        </a>
        <a href="settings.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg transition-colors <?php echo $page == 'settings.php' ? 'bg-brand-50 text-brand-600' : 'text-gray-600 hover:bg-gray-50'; ?>">
            <span>⚙️</span> Settings
        </a>
        <div class="pt-4 mt-4 border-t border-gray-100">
            <a href="logout.php" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                <span>🚪</span> Logout
            </a>
        </div>
    </nav>
</aside>