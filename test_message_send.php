<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Kernel::class);
$kernel->bootstrap();

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\DB;

// Clear previous test data
DB::table('jobs')->delete();
DB::table('failed_jobs')->delete();

// Create or get test users
$seller = User::firstOrCreate(
    ['email' => 'seller@example.com'],
    ['name' => 'John Seller', 'password' => bcrypt('password')]
);

$buyer = User::firstOrCreate(
    ['email' => 'buyer@example.com'],
    ['name' => 'Jane Buyer', 'password' => bcrypt('password')]
);

echo "Seller ID: {$seller->id}, Email: {$seller->email}\n";
echo "Buyer ID: {$buyer->id}, Email: {$buyer->email}\n";

// Create a test message from buyer to seller
$message = Message::create([
    'sender_id' => $buyer->id,
    'receiver_id' => $seller->id,
    'message' => 'Hi, I am interested in your product!',
]);

echo "\n✅ Message created with ID: {$message->id}\n";
echo "   From: {$message->sender->name} ({$message->sender->email})\n";
echo "   To: {$message->receiver->name} ({$message->receiver->email})\n";

// Dispatch the event to trigger the listener (like MessageController does)
echo "\n📡 Dispatching MessageSent event...\n";
event(new MessageSent($message));
echo "✅ Event dispatched!\n";

// Check jobs table
$jobCount = DB::table('jobs')->count();
$failedCount = DB::table('failed_jobs')->count();

echo "\n📊 Queue Status:\n";
echo "   Jobs in queue: {$jobCount}\n";
echo "   Failed jobs: {$failedCount}\n";

echo "\n✨ Test complete! Check logs for 'MessageSent event: Dispatching'\n";
