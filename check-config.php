#!/usr/bin/env php
<?php

/**
 * Configuration Checker untuk Fitur Baru
 * Jalankan: php check-config.php
 */

echo "==========================================\n";
echo "   Configuration Checker\n";
echo "   Graha Alfa Amertha Indonesia\n";
echo "==========================================\n\n";

// Load .env file
$envFile = __DIR__ . '/.env';
if (!file_exists($envFile)) {
    echo "❌ File .env tidak ditemukan!\n";
    exit(1);
}

$envContent = file_get_contents($envFile);

// Check configurations
$checks = [
    'Google OAuth' => [
        'GOOGLE_CLIENT_ID' => 'Google Client ID',
        'GOOGLE_CLIENT_SECRET' => 'Google Client Secret',
        'GOOGLE_REDIRECT_URI' => 'Google Redirect URI'
    ],
    'Midtrans Payment' => [
        'MIDTRANS_SERVER_KEY' => 'Midtrans Server Key',
        'MIDTRANS_CLIENT_KEY' => 'Midtrans Client Key',
        'MIDTRANS_IS_PRODUCTION' => 'Midtrans Production Mode'
    ],
    'Database' => [
        'DB_CONNECTION' => 'Database Connection',
        'DB_HOST' => 'Database Host',
        'DB_DATABASE' => 'Database Name',
        'DB_USERNAME' => 'Database Username'
    ]
];

$allPassed = true;

foreach ($checks as $category => $items) {
    echo "📋 $category\n";
    echo str_repeat('-', 40) . "\n";

    foreach ($items as $key => $label) {
        $pattern = "/$key=(.*)/";
        if (preg_match($pattern, $envContent, $matches)) {
            $value = trim($matches[1]);
            $value = str_replace('"', '', $value);
            $value = str_replace("'", '', $value);

            if (empty($value) || $value === 'your-' . strtolower(str_replace('_', '-', $key))) {
                echo "  ⚠️  $label: BELUM DIISI\n";
                $allPassed = false;
            } else {
                $displayValue = strlen($value) > 20 ? substr($value, 0, 20) . '...' : $value;
                echo "  ✅ $label: $displayValue\n";
            }
        } else {
            echo "  ❌ $label: TIDAK DITEMUKAN\n";
            $allPassed = false;
        }
    }
    echo "\n";
}

// Check migrations
echo "📋 Database Migrations\n";
echo str_repeat('-', 40) . "\n";

$migrationFiles = [
    'add_google_and_subscription_fields_to_users_table.php',
    'create_visitors_table.php',
    'create_subscriptions_table.php'
];

$migrationDir = __DIR__ . '/database/migrations';
foreach ($migrationFiles as $file) {
    $found = false;
    foreach (scandir($migrationDir) as $migrFile) {
        if (strpos($migrFile, $file) !== false) {
            echo "  ✅ $file\n";
            $found = true;
            break;
        }
    }
    if (!$found) {
        echo "  ❌ $file: TIDAK DITEMUKAN\n";
        $allPassed = false;
    }
}
echo "\n";

// Check controllers
echo "📋 Controllers\n";
echo str_repeat('-', 40) . "\n";

$controllers = [
    'app/Http/Controllers/Auth/GoogleAuthController.php',
    'app/Http/Controllers/Admin/UserManagementController.php',
    'app/Http/Controllers/Admin/AnalyticsController.php',
    'app/Http/Controllers/PaymentController.php'
];

foreach ($controllers as $controller) {
    if (file_exists(__DIR__ . '/' . $controller)) {
        echo "  ✅ " . basename($controller) . "\n";
    } else {
        echo "  ❌ " . basename($controller) . ": TIDAK DITEMUKAN\n";
        $allPassed = false;
    }
}
echo "\n";

// Check models
echo "📋 Models\n";
echo str_repeat('-', 40) . "\n";

$models = [
    'app/Models/Visitor.php',
    'app/Models/Subscription.php'
];

foreach ($models as $model) {
    if (file_exists(__DIR__ . '/' . $model)) {
        echo "  ✅ " . basename($model) . "\n";
    } else {
        echo "  ❌ " . basename($model) . ": TIDAK DITEMUKAN\n";
        $allPassed = false;
    }
}
echo "\n";

// Check views
echo "📋 Views\n";
echo str_repeat('-', 40) . "\n";

$views = [
    'resources/views/admin/users/index.blade.php',
    'resources/views/admin/users/show.blade.php',
    'resources/views/admin/analytics/index.blade.php',
    'resources/views/payment/index.blade.php',
    'resources/views/payment/finish.blade.php'
];

foreach ($views as $view) {
    if (file_exists(__DIR__ . '/' . $view)) {
        echo "  ✅ " . basename($view) . "\n";
    } else {
        echo "  ❌ " . basename($view) . ": TIDAK DITEMUKAN\n";
        $allPassed = false;
    }
}
echo "\n";

// Check middleware
echo "📋 Middleware\n";
echo str_repeat('-', 40) . "\n";

$middlewares = [
    'app/Http/Middleware/TrackVisitor.php',
    'app/Http/Middleware/IsAdmin.php'
];

foreach ($middlewares as $middleware) {
    if (file_exists(__DIR__ . '/' . $middleware)) {
        echo "  ✅ " . basename($middleware) . "\n";
    } else {
        echo "  ❌ " . basename($middleware) . ": TIDAK DITEMUKAN\n";
        $allPassed = false;
    }
}
echo "\n";

// Summary
echo "==========================================\n";
if ($allPassed) {
    echo "  ✅ SEMUA KONFIGURASI SUDAH BENAR!\n";
    echo "\n";
    echo "  Next Steps:\n";
    echo "  1. Update .env dengan credentials yang benar\n";
    echo "  2. Run: php artisan migrate\n";
    echo "  3. Run: php artisan config:clear\n";
    echo "  4. Buat admin user dengan tinker\n";
    echo "  5. Test semua fitur!\n";
} else {
    echo "  ⚠️  ADA KONFIGURASI YANG BELUM LENGKAP\n";
    echo "\n";
    echo "  Silakan cek item yang belum lengkap di atas\n";
    echo "  dan lengkapi sesuai dokumentasi.\n";
}
echo "==========================================\n\n";

echo "📚 Dokumentasi:\n";
echo "  - FITUR_BARU.md: Dokumentasi lengkap\n";
echo "  - QUICK_SETUP.md: Quick start guide\n";
echo "  - README_IMPLEMENTASI.md: Summary implementasi\n";
echo "\n";
