<?php
include 'db.php';

$connection = new Dbconnection();
$conn = $connection->connectDb();

// 1. Տեսնել բոլոր օգտատերերին
echo "<h2>All Users</h2>";
$query = "SELECT id, username, email, is_admin FROM users";
$result = mysqli_query($conn, $query);

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>is_admin</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['is_admin'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// 2. Դարձնել քո օգտատիրոջը admin
$user_id = 8; // Քո ID-ն
$query = "UPDATE users SET is_admin = 1 WHERE id = $user_id";

if (mysqli_query($conn, $query)) {
    echo "<p style='color: green;'>✅ User ID $user_id is now ADMIN!</p>";
} else {
    echo "<p style='color: red;'>❌ Error: " . mysqli_error($conn) . "</p>";
}

// 3. Ստուգել, որ աշխատել է
$query = "SELECT is_admin FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

echo "<p>User ID $user_id - is_admin value: " . $row['is_admin'] . "</p>";

echo "<br><a href='login.php'>Go to Login</a>";
?>