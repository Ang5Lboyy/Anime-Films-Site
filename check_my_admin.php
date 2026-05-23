<?php
session_start();
include 'db.php';

$connection = new Dbconnection();
$conn = $connection->connectDb();

// Քո email-ը
$your_email = "angelbarseghyan12@gmail.com";

echo "<h2>Checking your admin status...</h2>";

// 1. Գտնել քո օգտատիրոջը
$query = "SELECT id, username, email, is_admin FROM users WHERE email = '$your_email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    echo "<p><strong>Found user:</strong> " . $user['username'] . " (ID: " . $user['id'] . ")</p>";
    echo "<p><strong>Email:</strong> " . $user['email'] . "</p>";
    echo "<p><strong>is_admin value:</strong> " . $user['is_admin'] . "</p>";
    
    if ($user['is_admin'] == 1) {
        echo "<p style='color:green; font-size:20px;'>✅ You ARE an admin!</p>";
    } else {
        echo "<p style='color:red; font-size:20px;'>❌ You are NOT an admin (is_admin = 0)</p>";
    }
} else {
    echo "<p style='color:red;'>User not found with email: $your_email</p>";
}

// 2. Ցույց տալ բոլոր admin օգտատերերին
echo "<h3>All Admin Users:</h3>";
$query = "SELECT id, username, email FROM users WHERE is_admin = 1";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row['username'] . " (" . $row['email'] . ") - ID: " . $row['id'] . "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>No admin users found!</p>";
}

echo '<br><a href="make_me_admin.php" style="background:#F0B13B; color:black; padding:10px; text-decoration:none;">👉 Make Me Admin</a>';
?>