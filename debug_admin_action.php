[file name]: debug_admin_action.php
[file content begin]
<?php
// Միացնել բոլոր error-ները
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "<h2>Debug Admin Action</h2>";
echo "<p>PHP version: " . phpversion() . "</p>";

// Ստուգել ֆայլերի առկայությունը
echo "<h3>Checking required files:</h3>";
$files = ['data.php', 'db.php', 'products.php', 'admin_action.php'];

foreach ($files as $file) {
    if (file_exists($file)) {
        echo "<p style='color:green;'>✅ $file exists</p>";
    } else {
        echo "<p style='color:red;'>❌ $file NOT FOUND</p>";
    }
}

// Ստուգել session
echo "<h3>Session Status:</h3>";
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

// Ստուգել POST/GET data
echo "<h3>Request Data:</h3>";
echo "<h4>GET Data:</h4>";
echo "<pre>";
print_r($_GET);
echo "</pre>";

echo "<h4>POST Data:</h4>";
echo "<pre>";
print_r($_POST);
echo "</pre>";

// Փորձել include products.php
echo "<h3>Testing products.php include:</h3>";
try {
    include 'products.php';
    echo "<p style='color:green;'>✅ products.php included successfully</p>";
    
    // Փորձել ստեղծել Products օբյեկտ
    $product = new Products();
    echo "<p style='color:green;'>✅ Products class instantiated successfully</p>";
    
} catch (Exception $e) {
    echo "<p style='color:red;'>❌ Error: " . $e->getMessage() . "</p>";
}

// Ցույց տալ PHP config
echo "<h3>PHP Configuration:</h3>";
echo "<pre>";
echo "error_reporting: " . ini_get('error_reporting') . "\n";
echo "display_errors: " . ini_get('display_errors') . "\n";
echo "max_execution_time: " . ini_get('max_execution_time') . "\n";
echo "memory_limit: " . ini_get('memory_limit') . "\n";
echo "</pre>";

echo "<hr>";
echo "<h3>Test Links:</h3>";
echo '<ul>';
echo '<li><a href="Admin_Panel.php">Go to Admin Panel</a></li>';
echo '<li><a href="admin_create.php">Create New Anime</a></li>';
echo '<li><a href="home.php">Go Home</a></li>';
echo '</ul>';
?>
[file content end]