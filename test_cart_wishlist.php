<?php
// Simple test script to debug cart and wishlist functionality
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test database connection
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=readora_web', 'root', '');
    echo "✅ Database connection successful\n";
    
    // Check if tables exist
    $tables = ['users', 'books', 'carts', 'cart_items', 'wishlist'];
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "✅ Table '$table' exists\n";
        } else {
            echo "❌ Table '$table' missing\n";
        }
    }
    
    // Check if there are books in database
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM books");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📚 Books in database: " . $result['count'] . "\n";
    
    // Check if there are users in database
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "👥 Users in database: " . $result['count'] . "\n";
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "\n";
}
?>
