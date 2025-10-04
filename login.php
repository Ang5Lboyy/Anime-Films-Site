<?php
   include_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $login_title; ?></title>
    <link rel="stylesheet" href="css.css/login.css">
    
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
            <h1>Login</h1>
            <form action="" class="form">
                <input type="text" placeholder="Username" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <button type="submit" style='background-color: yellow; color: black' class='dhaveacc'>You don't have an account.</button>
            </form>

        </div>
    </div>
    <script src="anime.js"></script>
</body>

</html>