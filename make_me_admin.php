<?php
include 'db.php';

$connection = new Dbconnection();
$conn = $connection->connectDb();

// Քո email-ը
$your_email = "angelbarseghyan12@gmail.com";

echo "<h2>Making you an admin...</h2>";

// 1. Գտնել քո օգտատիրոջ ID-ն
$query = "SELECT id, username FROM users WHERE email = '$your_email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if ($user) {
    $user_id = $user['id'];
    $username = $user['username'];
    
    echo "<p>Found user: <strong>$username</strong> (ID: $user_id)</p>";
    
    // 2. Դարձնել admin
    $update_query = "UPDATE users SET is_admin = 1 WHERE id = $user_id";
    
    if (mysqli_query($conn, $update_query)) {
        echo "<p style='color:green; font-size:24px;'>✅ SUCCESS! You are now an ADMIN!</p>";
        echo "<p>User <strong>$username</strong> (ID: $user_id) has been granted admin privileges.</p>";
        
        // 3. Ստուգել, որ աշխատել է
        $check_query = "SELECT is_admin FROM users WHERE id = $user_id";
        $check_result = mysqli_query($conn, $check_query);
        $check_row = mysqli_fetch_assoc($check_result);
        
        echo "<p><strong>Verified:</strong> is_admin = " . $check_row['is_admin'] . "</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
} else {
    echo "<p style='color:red;'>User not found with email: $your_email</p>";
    echo "<p>Please register first or use correct email.</p>";
}

echo '<hr>';
echo '<h3>Next Steps:</h3>';
echo '<ol>';
echo '<li><a href="logout.php">1. Logout</a> (to clear old session)</li>';
echo '<li><a href="login.php">2. Login again</a> (with your email/password)</li>';
echo '<li><a href="account.php">3. Try account.php</a> (should work now)</li>';
echo '<li><a href="Admin_Panel.php">4. Try Admin Panel</a></li>';
echo '</ol>';

echo '<br><a href="login.php" style="background:#F0B13B; color:black; padding:10px 20px; text-decoration:none; border-radius:5px;">➡️ Go to Login</a>';
?>