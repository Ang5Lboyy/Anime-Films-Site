<?php
echo "Testing MySQL connection...<br><br>";

$host = '127.0.0.1';
$user = 'root';
$pass = 'root';
$db = 'ang5lboyy';
$port = 3306;  // կամ 8889

echo "Connecting to MySQL...<br>";
echo "Host: $host<br>";
echo "Port: $port<br>";
echo "User: $user<br><br>";

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    echo "<span style='color:red;'>❌ Connection failed: " . mysqli_connect_error() . "</span>";
} else {
    echo "<span style='color:green;'>✅ Connection successful!</span><br><br>";
    
    $result = mysqli_query($conn, "SELECT * FROM users");
    echo "<strong>Users in database:</strong><br>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "ID: " . $row['id'] . " - " . $row['username'] . " (Admin: " . $row['is_admin'] . ")<br>";
    }
    
    mysqli_close($conn);
}
?>