<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ստուգել արդյոք օգտատերը admin է
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    echo "<div style='max-width:600px; margin:50px auto; padding:30px; background:#1a1a4a; border-radius:10px; text-align:center;'>";
    echo "<h2 style='color:#F0B13B;'>🔒 Access Denied</h2>";
    echo "<p style='color:#ccc; font-size:18px;'>This page is for administrators only.</p>";
    
    if (isset($_SESSION['user_id'])) {
        echo "<p>Your account does not have admin privileges.</p>";
        echo "<p>Contact the site owner to request admin access.</p>";
    } else {
        echo "<p>Please login first.</p>";
    }
    
    echo "<div style='margin-top:30px;'>";
    echo "<a href='profile.php' style='background:#F0B13B; color:black; padding:10px 20px; margin:10px; text-decoration:none; border-radius:5px;'>Go to Profile</a>";
    echo "<a href='home.php' style='background:#444; color:white; padding:10px 20px; margin:10px; text-decoration:none; border-radius:5px;'>Go Home</a>";
    echo "</div>";
    
  
    echo "<div style='margin-top:30px; padding:15px; background:#0B0B2E; border-radius:5px; font-size:14px;'>";
    echo "<p><strong>Debug Info:</strong></p>";
    echo "<p>Session is_admin: " . (isset($_SESSION['is_admin']) ? $_SESSION['is_admin'] : 'not set') . "</p>";
    echo "<p>Session user_id: " . (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'not set') . "</p>";
    echo "<p><a href='make_me_admin.php' style='color:#F0B13B;'>Request Admin Access</a></p>";
    echo "</div>";
    
    echo "</div>";
    exit;
}

include 'data.php';
include 'user.php';

$user = new User();
$users = $user->select(); // Հիմա կդասավորվի ըստ ID-ի
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .user-management {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .user-management h1 {
            color: #F0B13B;
            text-align: center;
            margin-bottom: 30px;
        }
        
        .user-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #1a1a4a;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .user-table th {
            background-color: #F0B13B;
            color: black;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        .user-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #333;
            color: #ccc;
        }
        
        .user-table tr:nth-child(even) {
            background-color: #222;
        }
        
        .user-table tr:hover {
            background-color: #2a2a5a;
        }
        
        .admin-badge {
            background-color: #F0B13B;
            color: black;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 0.8em;
            font-weight: bold;
        }
        
        .user-actions a {
            color: #F0B13B;
            text-decoration: none;
            margin-right: 10px;
            padding: 5px 10px;
            border: 1px solid #F0B13B;
            border-radius: 3px;
            display: inline-block;
        }
        
        .user-actions a:hover {
            background-color: #F0B13B;
            color: black;
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #F0B13B;
            text-decoration: none;
        }
        
        .user-count {
            background-color: #0B0B2E;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.1em;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home" onclick="window.location.href='home.php'">HOME</button>
        <button onclick="window.location.href='profile.php'">PROFILE</button>
        <button onclick="window.location.href='logout.php'">LOGOUT</button>
    </div>
    
    <div class="user-management">
        <h1> User Management (Admin Only)</h1>
        
        <div class="user-count">
            Total Users: <strong><?php echo count($users); ?></strong>
        </div>
        
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)) { ?>
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px;">
                            No users found.
                        </td>
                    </tr>
                <?php } else { ?>
                    <?php foreach($users as $value){ ?>
                    <tr>
                        <td><?php echo $value['id']; ?></td>
                        <td><?php echo htmlspecialchars($value['firstname']); ?></td>
                        <td><?php echo htmlspecialchars($value['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($value['username']); ?></td>
                        <td><?php echo htmlspecialchars($value['email']); ?></td>
                        <td>
                            <?php if ($value['is_admin'] == 1) { ?>
                                <span class="admin-badge">ADMIN</span>
                            <?php } else { ?>
                                User
                            <?php } ?>
                        </td>
                        <td class="user-actions">
                            <a href="update.php?id=<?php echo $value['id']; ?>">Edit</a>
                            <a href="action.php?delete=<?php echo $value['id']; ?>" 
                               onclick="return confirm('Delete user: <?php echo $value['username']; ?>?')">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        
        <div style="text-align:center; margin-top:30px;">
            <a href="profile.php" class="back-link">← Back to Profile</a>
            <a href="Admin_Panel.php" class="back-link" style="margin-left:20px;">← Back to Admin Panel</a>
        </div>
    </div>

    <script>
       
        document.querySelector('.home')?.addEventListener('click', function() {
            window.location.href = 'home.php';
        });
    </script>
</body>
</html>