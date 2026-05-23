
<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once "data.php";

$latest_animes = [];
if (file_exists('products.php')) {
    include_once "products.php";
    try {
        $product = new Products();
        $latest_animes = $product->select();
        $latest_animes = array_slice($latest_animes, 0, 8); 
    } catch (Exception $e) {
        $latest_animes = [];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .home-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .home-header {
            text-align: center;
            margin: 40px 0;
        }
        
        .home-title {
            color: #000000;
            font-size: 3em;
            margin-bottom: 15px;
        }
        
        .home-subtitle {
            color: #ccc;
            font-size: 1.2em;
            max-width: 700px;
            margin: 0 auto 30px;
            line-height: 1.6;
        }
        
        .quick-links {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin: 30px 0;
        }
        
        .btn-primary {
            background-color: #F0B13B;
            color: black;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-primary:hover {
            background-color: #e09a2a;
        }
        
        .btn-secondary {
            background-color: #444;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #F0B13B;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .btn-secondary:hover {
            background-color: #555;
        }
        
        .section-title {
            color: #F0B13B;
            font-size: 2em;
            margin: 40px 0 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #F0B13B;
        }
        
        .anime-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }
        
        .anime-card {
            background-color: #1a1a4a;
            border-radius: 10px;
            overflow: hidden;
            transition: transform 0.3s;
            border: 1px solid #2a2a5a;
        }
        
        .anime-card:hover {
            transform: translateY(-5px);
        }
        
        .anime-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        
        .anime-card-content {
            padding: 15px;
        }
        
        .anime-card-title {
            color: #F0B13B;
            font-size: 1.2em;
            margin: 0 0 10px 0;
            height: 50px;
            overflow: hidden;
        }
        
        .anime-card-category {
            display: inline-block;
            background-color: #0B0B2E;
            color: #F0B13B;
            padding: 3px 10px;
            border-radius: 15px;
            font-size: 0.85em;
            margin-bottom: 10px;
        }
        
        .anime-card-description {
            color: #ccc;
            font-size: 0.9em;
            line-height: 1.4;
            margin-bottom: 15px;
            height: 60px;
            overflow: hidden;
        }
        
        .view-btn {
            display: inline-block;
            background-color: #F0B13B;
            color: black;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .categories-section {
            background-color: #1a1a4a;
            padding: 30px;
            border-radius: 10px;
            margin: 40px 0;
        }
        
        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }
        
        .category-item {
            background-color: #0B0B2E;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #F0B13B;
            transition: background 0.3s;
        }
        
        .category-item:hover {
            background-color: #F0B13B;
        }
        
        .category-item a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            display: block;
        }
        
        .category-item:hover a {
            color: black;
        }
        
        .no-animes {
            text-align: center;
            padding: 50px;
            color: #ccc;
            font-size: 1.2em;
            background-color: #1a1a4a;
            border-radius: 10px;
        }
        
        .no-animes a {
            color: #000000;
            text-decoration: none;
            font-weight: bold;
        }
        
        .welcome-message {
            text-align: center;
            padding: 30px;
            background-color: rgba(240, 177, 59, 0.1);
            border-radius: 10px;
            margin: 30px 0;
        }
    </style>
</head>

<body class="film-body">
    <!-- Logo -->
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <!-- Navigation Buttons (like in your other pages) -->
    <div class="contacts">
        <button class="home" onclick="window.location.href='home.php'">HOME</button>
        <button class="characters" onclick="window.location.href='characters.php'">CHARACTERS</button>
        <button class="films" onclick="window.location.href='films.php'">FILMS</button>
        <button class="about" onclick="window.location.href='about.php'">ABOUT</button>
        
        <?php if (isset($_SESSION['user_id'])) { ?>
            <button class="account" onclick="window.location.href='profile.php'">ACCOUNT</button>
            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == true) { ?>
                <button class="Admin_Panel" onclick="window.location.href='Admin_Panel.php'">Admin Panel</button>
            <?php } ?>
            <button onclick="window.location.href='logout.php'">Logout</button>
        <?php } else { ?>
            <button class="register" onclick="window.location.href='register.php'">REGISTER</button>
            <button onclick="window.location.href='login.php'">LOGIN</button>
        <?php } ?>
    </div>

    <!-- Main Content -->
    <div class="home-container">
        <div class="home-header">
            <h1 class="home-title">Welcome to Anime World!</h1>
            <p class="home-subtitle">
                Explore the ultimate collection of anime series, movies, and characters. 
                Join our community of anime enthusiasts and discover new worlds.
            </p>
            
            <div class="quick-links">
                <a href="films.php" class="btn-primary">Browse All Animes</a>
                <a href="characters.php" class="btn-secondary">View Characters</a>
                <a href="category.php" class="btn-primary">Categories</a>
                <a href="about.php" class="btn-secondary">About Us</a>
            </div>
        </div>
        
        <?php if (isset($_SESSION['user_id'])) { ?>
            <div class="welcome-message">
                <h2 style="color: #000000;">Welcome back, <?php echo $_SESSION['username']; ?>! 👋</h2>
                <p>Ready to continue your anime adventure? Check out the latest releases below.</p>
            </div>
        <?php } ?>
        
      
      
        <div style="background-color: #1a1a4a; padding: 30px; border-radius: 10px; text-align: center; margin: 40px 0;">
            <h2 style="color: #F0B13B; margin-bottom: 20px;">Looking for something specific?</h2>
            <p style="color: #ccc; margin-bottom: 25px; max-width: 600px; margin-left: auto; margin-right: auto;">
                Use our search feature to find your favorite anime by title, description, or category.
            </p>
            
            <form action="search.php" method="GET" style="max-width: 600px; margin: 0 auto;">
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="query" 
                           placeholder="Search anime..." 
                           style="flex: 1; padding: 12px 20px; border-radius: 5px; border: 1px solid #F0B13B; background-color: #0B0B2E; color: white;">
                    <button type="submit" class="btn-primary" style="padding: 12px 30px;">Search</button>
                </div>
            </form>
        </div>
      
        <?php if (!isset($_SESSION['user_id'])) { ?>
            <div style="text-align: center; padding: 50px 20px; background-color: rgba(240, 177, 59, 0.1); border-radius: 10px; margin: 50px 0;">
                <h2 style="color: #F0B13B; margin-bottom: 20px;">Join Our Community</h2>
                <p style="color: #ccc; margin-bottom: 30px; max-width: 700px; margin-left: auto; margin-right: auto;">
                    Create a free account to save your favorite animes, create watchlists, and get personalized recommendations.
                </p>
                <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;">
                    <a href="register.php" class="btn-primary" style="padding: 15px 40px; font-size: 1.1em;">Sign Up Free</a>
                    <a href="login.php" class="btn-secondary" style="padding: 15px 40px; font-size: 1.1em;">Already have an account? Login</a>
                </div>
            </div>
        <?php } ?>
    </div>

    <script>
        // Navigation buttons functionality
        document.addEventListener('DOMContentLoaded', function() {
            // HOME
            document.querySelector('.home')?.addEventListener('click', function() {
                window.location.href = 'home.php';
            });
            
            // CHARACTERS
            document.querySelector('.characters')?.addEventListener('click', function() {
                window.location.href = 'characters.php';
            });
            
            // FILMS
            document.querySelector('.films')?.addEventListener('click', function() {
                window.location.href = 'films.php';
            });
            
            // ABOUT
            document.querySelector('.about')?.addEventListener('click', function() {
                window.location.href = 'about.php';
            });
            
            // REGISTER
            document.querySelector('.register')?.addEventListener('click', function() {
                window.location.href = 'register.php';
            });
            
            // LOGIN
            document.querySelector('button[onclick*="login.php"]')?.addEventListener('click', function() {
                window.location.href = 'login.php';
            });
            
            // ACCOUNT
            document.querySelector('.account')?.addEventListener('click', function() {
                window.location.href = 'profile.php';
            });
            
            // ADMIN PANEL
            document.querySelector('.Admin_Panel')?.addEventListener('click', function() {
                window.location.href = 'Admin_Panel.php';
            });
            
            // LOGOUT
            document.querySelector('button[onclick*="logout.php"]')?.addEventListener('click', function() {
                window.location.href = 'logout.php';
            });
        });
    </script>
</body>
</html>
