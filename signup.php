<?php 
   include_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $signup_title; ?></title>
    <link rel="stylesheet" href="css.css/signup.css">
    <script src="anime.js"></script>
    
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    <div class="contacts">
        <button class="characters">CHARACTERS</button>
        <button class="films">FILMS</button>
        <button class="about">ABOUT</button>
        <button class="signup">SIGN UP</button>
        <button class="login">LOGIN</button>
        
    </div>
    <div class="animesignup">
        <div class="signupform">
            <h1>Sign Up</h1>
            <form class="form" method="POST" action="action.php">
                <input type="text" placeholder="Username" name="usname" required>
                <input type="email" placeholder="Email" name="mail" required>
                <input type="date" placeholder='B-Day' name="b-day" required>
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confpassword" required>
                <button type="submit" name='register' value='reg' class='register'>Register</button>
                <button type="submit" style='background-color: yellow; color: black' class='haveacc'>Already Have Account</button>
            </form>

        </div>
    </div>
</body>

</html>
