[file name]: add_is_admin_column.php
[file content begin]
<?php
include 'db.php';

$connection = new Dbconnection();
$conn = $connection->connectDb();

echo "<h2>Adding is_admin column to users table...</h2>";

// 1. Ստուգել, արդյոք սյունակը արդեն կա
$check_query = "SHOW COLUMNS FROM users LIKE 'is_admin'";
$result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($result) > 0) {
    echo "<p style='color: orange;'>⚠️ is_admin column already exists!</p>";
} else {
    // 2. Ավելացնել is_admin սյունակը
    $alter_query = "ALTER TABLE users ADD COLUMN is_admin TINYINT(1) DEFAULT 0";
    
    if (mysqli_query($conn, $alter_query)) {
        echo "<p style='color: green;'>✅ is_admin column added successfully!</p>";
    } else {
        echo "<p style='color: red;'>❌ Error adding column: " . mysqli_error($conn) . "</p>";
    }
}

// 3. Ստուգել առաջին օգտատիրոջը դարձնել admin
echo "<h3>Checking first user...</h3>";
$check_users_query = "SELECT COUNT(*) as count FROM users";
$result = mysqli_query($conn, $check_users_query);
$row = mysqli_fetch_assoc($result);

if ($row['count'] == 0) {
    echo "<p>No users in database yet.</p>";
} else {
    // Ստուգել, արդյոք առաջին օգտատերը admin է
    $first_user_query = "SELECT id, username, is_admin FROM users ORDER BY id LIMIT 1";
    $result = mysqli_query($conn, $first_user_query);
    $user = mysqli_fetch_assoc($result);
    
    echo "<p>First user: " . $user['username'] . " (ID: " . $user['id'] . ")</p>";
    echo "<p>Current is_admin value: " . $user['is_admin'] . "</p>";
    
    // Եթե առաջին օգտատերը admin չէ, դարձնել admin
    if ($user['is_admin'] == 0) {
        $update_query = "UPDATE users SET is_admin = 1 WHERE id = " . $user['id'];
        if (mysqli_query($conn, $update_query)) {
            echo "<p style='color: green;'>✅ First user is now admin!</p>";
        } else {
            echo "<p style='color: red;'>❌ Error updating user: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p style='color: green;'>✅ First user is already admin!</p>";
    }
}

// 4. Ցույց տալ բոլոր օգտատերերին
echo "<h3>All Users:</h3>";
$all_users_query = "SELECT id, username, email, is_admin FROM users";
$result = mysqli_query($conn, $all_users_query);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>is_admin</th></tr>";
    
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td style='text-align: center; background-color: " . ($row['is_admin'] == 1 ? '#90EE90' : '#FFB6C1') . ";'>" . $row['is_admin'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}

echo "<hr>";
echo "<h3>Next Steps:</h3>";
echo "<ol>";
echo "<li><a href='register.php'>1. Register a new user</a> (if no users exist)</li>";
echo "<li><a href='login.php'>2. Login</a></li>";
echo "<li><a href='home.php'>3. Go to Home</a></li>";
echo "</ol>";

// Փակել կապը
mysqli_close($conn);
?>
[file content end]