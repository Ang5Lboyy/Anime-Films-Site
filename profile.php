<?php
session_start(); 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "data.php";
include_once "user.php";


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = new User();
$current_user = $user->selectOne($_SESSION['user_id']);

if (empty($current_user)) {
    echo "User not found!";
    exit;
}

$current_user = $current_user[0]; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .profile-container {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px;
            background-color: #1a1a4a;
            border-radius: 15px;
            color: white;
        }
        
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .profile-header h1 {
            color: #F0B13B;
            font-size: 2.5em;
        }
        
        .user-info-card {
            background-color: #0B0B2E;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 5px solid #F0B13B;
        }
        
        .user-info-card p {
            font-size: 1.1em;
            margin: 15px 0;
            padding-bottom: 10px;
            border-bottom: 1px solid #333;
        }
        
        .user-info-card strong {
            color: #F0B13B;
            min-width: 150px;
            display: inline-block;
        }
        
        .profile-actions {
            text-align: center;
            margin-top: 30px;
        }
        
        .profile-actions button, .profile-actions a {
            background-color: #F0B13B;
            color: black;
            border: none;
            padding: 12px 25px;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
        }
        
        .profile-actions button:hover, .profile-actions a:hover {
            background-color: #e09a2a;
        }
        
        .welcome-message {
            text-align: center;
            font-size: 1.2em;
            margin-top: 30px;
            color: #ccc;
            padding: 20px;
            background-color: rgba(240, 177, 59, 0.1);
            border-radius: 10px;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home" onclick="window.location.href='home.php'">HOME</button>
        <button onclick="window.location.href='logout.php'">LOGOUT</button>
    </div>

    <div class='profile-container'>
        <div class='profile-header'>
            <h1>My Profile</h1>
            <p>Welcome back, <strong><?php echo $current_user['username']; ?>!</strong></p>
        </div>
        
        <div class="user-info-card">
            <h2>Personal Information</h2>
            
            <p><strong>ID:</strong> <?php echo $current_user['id']; ?></p>
            <p><strong>First Name:</strong> <?php echo $current_user['firstname']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $current_user['lastname']; ?></p>
            <p><strong>Username:</strong> <?php echo $current_user['username']; ?></p>
            <p><strong>Email:</strong> <?php echo $current_user['email']; ?></p>
            <p><strong>Account Type:</strong> 
                <?php 
                if ($current_user['is_admin'] == 1) {
                    echo "<span style='color:#F0B13B;'>Administrator</span>";
                } else {
                    echo "Regular User";
                }
                ?>
            </p>
        </div>
        
        <div class="profile-actions">
            <a href="account.php">View All Users</a>
            <a href="update.php?id=<?php echo $current_user['id']; ?>">Edit Profile</a>
            <?php if ($current_user['is_admin'] == 1) { ?>
                <a href="Admin_Panel.php">Go to Admin Panel</a>
            <?php } ?>
        </div>
        
        <div class="welcome-message">
            <p>🎉 Thank you for being part of our Anime community!</p>
            <p>You can now explore all features of our website.</p>
        </div>
    </div>

    <script>
        
        document.querySelector('.home')?.addEventListener('click', function() {
            window.location.href = 'home.php';
        });
    </script>
</body>
</html>