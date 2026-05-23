[file name]: make_all_users_admin.php
[file content begin]
<?php
include 'db.php';

$connection = new Dbconnection();
$conn = $connection->connectDb();

echo "<h2>Making all current users admin...</h2>";

// 1. Ստուգել և ավելացնել is_admin սյունակը
$check_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) == 0) {
    $alter_query = "ALTER TABLE users ADD COLUMN is_admin TINYINT(1) DEFAULT 0";
    mysqli_query($conn, $alter_query);
    echo "<p>✅ Added is_admin column to users table</p>";
}

// 2. Բոլոր օգտատերերին դարձնել admin
$update_query = "UPDATE users SET is_admin = 1";
if (mysqli_query($conn, $update_query)) {
    echo "<p style='color: green; font-size: 20px;'>✅ ALL USERS ARE NOW ADMIN!</p>";
} else {
    echo "<p style='color: red;'>❌ Error: " . mysqli_error($conn) . "</p>";
}

// 3. Ցույց տալ արդյունքը
$select_query = "SELECT id, username, email, is_admin FROM users";
$result = mysqli_query($conn, $select_query);

echo "<h3>All Users Status:</h3>";
echo "<table border='1' cellpadding='10'>";
echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Admin Status</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td style='background-color: #90EE90; text-align: center; font-weight: bold;'>✅ ADMIN</td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";
echo "<h3>Instructions:</h3>";
echo "<ol>";
echo "<li><a href='logout.php'>1. Logout</a> (to clear session)</li>";
echo "<li><a href='login.php'>2. Login again</a> with your email/password</li>";
echo "<li><a href='account.php'>3. Try Admin Panel</a></li>";
echo "</ol>";

mysqli_close($conn);
?>
[file content end]