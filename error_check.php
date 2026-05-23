<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

echo "PHP Error Reporting is ON<br>";
echo "Checking included files...<br>";

if (file_exists('data.php')) {
    echo "✅ data.php exists<br>";
} else {
    echo "❌ data.php NOT FOUND<br>";
}


if (file_exists('db.php')) {
    echo "✅ db.php exists<br>";
} else {
    echo "❌ db.php NOT FOUND<br>";
}

if (file_exists('user.php')) {
    echo "✅ user.php exists<br>";
} else {
    echo "❌ user.php NOT FOUND<br>";
}

echo "<br>If you see this message, PHP is working.";
?>