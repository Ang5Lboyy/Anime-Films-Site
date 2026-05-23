<?php
session_start();
echo "<h2>Session Information</h2>";
echo "<pre>";
print_r($_SESSION);
echo "</pre>";

echo "<h2>Current User from DB</h2>";
if (isset($_SESSION['user_id'])) {
    include 'user.php';
    $user = new User();
    $user_data = $user->selectOne($_SESSION['user_id']);
    
    if (!empty($user_data)) {
        print_r($user_data[0]);
    } else {
        echo "User not found in database!";
    }
} else {
    echo "No user logged in.";
}
?>