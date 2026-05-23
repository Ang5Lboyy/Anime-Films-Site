
<?php
session_start();
include_once "data.php";

// Եթե օգտատերը արդեն մուտք է գործել, ուղղորդել profile.php
if (isset($_SESSION['user_id'])) {
    header('Location: profile.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime_title; ?> - Login</title>
    <link rel="stylesheet" href="css.css/anime.css">
    <script src="anime.js"></script>
    <style>
        .login-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .login-header {
            text-align: center;
            margin: 40px 0;
        }
        
        .login-title {
            color: #000000;
            font-size: 2.8em;
            margin-bottom: 15px;
        }
        
        .login-subtitle {
            color: #0231ff;
            font-size: 1.1em;
            max-width: 600px;
            margin: 0 auto 25px;
            line-height: 1.6;
        }
        
        .login-box {
            max-width: 500px;
            margin: 0 auto;
            background-color: #1a1a4a;
            border-radius: 10px;
            padding: 40px;
            border: 1px solid #2a2a5a;
        }
        
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        
        .form-label {
            color: #F0B13B;
            font-weight: bold;
            font-size: 1.1em;
        }
        
        .form-input {
            padding: 14px 18px;
            border-radius: 5px;
            border: 1px solid #F0B13B;
            background-color: #0B0B2E;
            color: white;
            font-size: 1em;
            transition: border-color 0.3s;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #FFA239;
            box-shadow: 0 0 0 2px rgba(240, 177, 59, 0.2);
        }
        
        .form-input::placeholder {
            color: #4400ff;
        }
        
        .login-btn {
            background-color: #F0B13B;
            color: black;
            padding: 16px 30px;
            border-radius: 5px;
            border: none;
            font-size: 1.1em;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        
        .login-btn:hover {
            background-color: #e09a2a;
        }
        
        .form-footer {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid #333;
        }
        
        .form-footer p {
            color: #ccc;
            margin-bottom: 15px;
        }
        
        .register-link {
            display: inline-block;
            background-color: #444;
            color: white;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            border: 1px solid #F0B13B;
            transition: background 0.3s;
        }
        
        .register-link:hover {
            background-color: #555;
        }
        
        .error-message {
            background-color: rgba(255, 87, 87, 0.1);
            color: #ff6b6b;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #ff6b6b;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .success-message {
            background-color: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #2ecc71;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .login-features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 30px;
            margin: 50px 0;
            text-align: center;
        }
        
        .feature-item {
            flex: 1;
            min-width: 250px;
            background-color: #1a1a4a;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #2a2a5a;
        }
        
        .feature-icon {
            font-size: 2.5em;
            color: #F0B13B;
            margin-bottom: 15px;
        }
        
        .feature-title {
            color: #F0B13B;
            font-size: 1.3em;
            margin-bottom: 10px;
        }
        
        .feature-description {
            color: #ccc;
            font-size: 0.95em;
            line-height: 1.5;
        }
        
        .demo-credentials {
            background-color: rgba(240, 177, 59, 0.1);
            padding: 20px;
            border-radius: 10px;
            margin: 30px 0;
            border: 1px solid #000000;
        }
        
        .demo-title {
            color: #000000;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        
        .demo-text {
            color: #ccc;
            font-size: 0.95em;
            line-height: 1.6;
        }
        
        .forgot-password {
            text-align: right;
            margin-top: -10px;
        }
        
        .forgot-password a {
            color: #F0B13B;
            text-decoration: none;
            font-size: 0.9em;
        }
        
        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="film-body">
    <!-- Logo -->
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <!-- Navigation Buttons -->
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
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <h1 class="login-title">Login to Anime World</h1>
            <p class="login-subtitle">
                Welcome back! Please enter your credentials to access your account and continue your anime journey.
            </p>
        </div>
        
        <!-- Error/Success Messages -->
        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid') { ?>
            <div class="error-message">
                ❌ Invalid email or password. Please try again.
            </div>
        <?php } ?>
        
        <?php if (isset($_GET['registered']) && $_GET['registered'] == 'success') { ?>
            <div class="success-message">
                ✅ Registration successful! Please login with your credentials.
            </div>
        <?php } ?>
        
        <?php if (isset($_GET['logout']) && $_GET['logout'] == 'success') { ?>
            <div class="success-message">
                ✅ You have been successfully logged out.
            </div>
        <?php } ?>
        
        <!-- Demo Credentials (if needed) -->
        <div class="demo-credentials">
            <div class="demo-title">💡 Demo Account (for testing):</div>
            <div class="demo-text" style='color: blue;'>
                <strong style='color: blue;'>Email:</strong> test@example.com<br>
                <strong>Password:</strong> password123
            </div>
        </div>
        
        <!-- Login Form -->
        <div class="login-box">
            <form class="login-form" method="POST" action="action.php">
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" 
                           placeholder="Enter your email address" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-input" 
                           placeholder="Enter your password" required>
                    
                    <div class="forgot-password">
                        <a href="forgot_password.php">Forgot password?</a>
                    </div>
                </div>
                
                <button type="submit" name="login" class="login-btn">Login to Account</button>
            </form>
            
            <div class="form-footer">
                <p>Don't have an account yet?</p>
                <a href="register.php" class="register-link">Create New Account</a>
            </div>
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
        
        // Form validation
        document.querySelector('.login-form')?.addEventListener('submit', function(e) {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            if (!email || !password) {
                e.preventDefault();
                alert('Please fill in all fields.');
                return false;
            }
            
            // Basic email validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert('Please enter a valid email address.');
                return false;
            }
            
            return true;
        });
        
        // Focus on email field when page loads
        window.onload = function() {
            document.getElementById('email')?.focus();
        };
    </script>
</body>
</html>
