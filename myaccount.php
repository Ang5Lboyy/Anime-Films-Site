[file name]: myaccount.php
[file content begin]
<?php
session_start();
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
    <title>My Account - <?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <style>
        .account-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
        }
        
        .account-header {
            text-align: center;
            margin-bottom: 40px;
        }
        
        .account-header h1 {
            color: #F0B13B;
            font-size: 2.5em;
        }
        
        .account-sections {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }
        
        .sidebar {
            background-color: #1a1a4a;
            border-radius: 10px;
            padding: 20px;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
        }
        
        .sidebar-menu li {
            margin-bottom: 10px;
        }
        
        .sidebar-menu a {
            display: block;
            padding: 12px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: #F0B13B;
            color: black;
        }
        
        .account-content {
            background-color: #1a1a4a;
            border-radius: 10px;
            padding: 30px;
        }
        
        .info-card {
            background-color: #0B0B2E;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 25px;
            border-left: 4px solid #F0B13B;
        }
        
        .info-row {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
        }
        
        .info-label {
            flex: 1;
            color: #F0B13B;
            font-weight: bold;
        }
        
        .info-value {
            flex: 2;
            color: #ccc;
        }
        
        .edit-btn {
            background-color: #F0B13B;
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .anime-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }
        
        .anime-item {
            background-color: #0B0B2E;
            border-radius: 8px;
            overflow: hidden;
            text-align: center;
        }
        
        .anime-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }
        
        .anime-item h4 {
            padding: 10px;
            margin: 0;
            color: #F0B13B;
            font-size: 0.9em;
        }
        
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #ccc;
            font-size: 1.1em;
        }
    </style>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home">HOME</button>
        <button onclick="window.location.href='cart.php'">CART</button>
        <button onclick="window.location.href='logout.php'">LOGOUT</button>
    </div>

    <div class="account-container">
        <div class="account-header">
            <h1>My Account</h1>
            <p style="color: #ccc;">Welcome back, <?php echo $current_user['username']; ?>!</p>
        </div>
        
        <div class="account-sections">
            <div class="sidebar">
                <ul class="sidebar-menu">
                    <li><a href="#profile" class="active">👤 Profile</a></li>
                    <li><a href="#favorites">❤ Favorites</a></li>
                    <li><a href="#purchases">💰 Purchases</a></li>
                    <li><a href="#watchlist">📺 Watchlist</a></li>
                    <li><a href="#settings">⚙ Settings</a></li>
                    <?php if ($current_user['is_admin'] == 1) { ?>
                        <li><a href="account.php">👑 Manage Users</a></li>
                        <li><a href="Admin_Panel.php">📊 Admin Panel</a></li>
                    <?php } ?>
                </ul>
            </div>
            
            <div class="account-content">
                <!-- Profile Section -->
                <div id="profile" class="account-section">
                    <h2 style="color: #F0B13B; margin-bottom: 20px;">Personal Information</h2>
                    
                    <div class="info-card">
                        <div class="info-row">
                            <div class="info-label">Username:</div>
                            <div class="info-value"><?php echo $current_user['username']; ?></div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">Full Name:</div>
                            <div class="info-value"><?php echo $current_user['firstname'] . ' ' . $current_user['lastname']; ?></div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">Email:</div>
                            <div class="info-value"><?php echo $current_user['email']; ?></div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">Account Type:</div>
                            <div class="info-value">
                                <?php 
                                if ($current_user['is_admin'] == 1) {
                                    echo '<span style="color:#F0B13B;">Administrator</span>';
                                } else {
                                    echo 'Regular User';
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div class="info-row">
                            <div class="info-label">Member Since:</div>
                            <div class="info-value">2024 (estimated)</div>
                        </div>
                        
                        <a href="update.php?id=<?php echo $current_user['id']; ?>" class="edit-btn">Edit Profile</a>
                    </div>
                </div>
                
                <!-- Favorites Section -->
                <div id="favorites" class="account-section" style="display: none;">
                    <h2 style="color: #F0B13B; margin-bottom: 20px;">My Favorite Animes</h2>
                    
                    <div class="empty-message">
                        <p>You haven't added any animes to favorites yet.</p>
                        <p><a href="films.php" style="color: #F0B13B;">Browse Animes</a> and add some favorites!</p>
                    </div>
                    
                    <!-- Այստեղ կարող եք ավելացնել PHP կոդ, որ բեռնի օգտատիրոջ favorite-ները տվյալների բազայից -->
                </div>
                
                <!-- Purchases Section -->
                <div id="purchases" class="account-section" style="display: none;">
                    <h2 style="color: #F0B13B; margin-bottom: 20px;">My Purchases</h2>
                    
                    <div class="empty-message">
                        <p>You haven't made any purchases yet.</p>
                        <p><a href="films.php" style="color: #F0B13B;">Browse our collection</a> to get started!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab navigation
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all
                document.querySelectorAll('.sidebar-menu a').forEach(a => {
                    a.classList.remove('active');
                });
                
                // Add active to clicked
                this.classList.add('active');
                
                // Hide all sections
                document.querySelectorAll('.account-section').forEach(section => {
                    section.style.display = 'none';
                });
                
                // Show target section
                const targetId = this.getAttribute('href').substring(1);
                document.getElementById(targetId).style.display = 'block';
            });
        });
        
        // Show profile by default
        document.getElementById('profile').style.display = 'block';
    </script>
</body>
</html>
[file content end]