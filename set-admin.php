<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$user = App\Models\User::where('email', 'admin@gmail.com')->first();

if ($user) {
    $user->is_admin = true;
    $user->save();
    echo "✅ Success! User {$user->email} is now admin.\n";
    echo "User ID: {$user->id}\n";
    echo "Name: {$user->name}\n";
    echo "Is Admin: " . ($user->is_admin ? 'Yes' : 'No') . "\n";
} else {
    echo "❌ User admin@gmail.com not found!\n";
}
