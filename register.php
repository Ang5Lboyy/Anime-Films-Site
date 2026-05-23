<?php 
include_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $register_title; ?></title>
    <link rel="stylesheet" href="css.css/register.css">
    <script src="anime.js"></script>
</head>

<body class="film-body">
    <div class="logo">
        <img src="https://i.pinimg.com/736x/86/80/bb/8680bbd7552d6513168dd92543cb8608.jpg" alt="Anime Logo">
    </div>
    
    <div class="contacts">
        <button class="home">HOME</button>
        <button class="characters">CHARACTERS</button>
        <button class="films">FILMS</button>
        <button class="about">ABOUT</button>
        <button class="register">REGISTER</button>
        <button class="account">ACCOUNT</button>
        <button class="Admin_Panel">Admin_Panel</button>
    </div>
    
    <div class="animeregister">
        <div class="registerform">
            <h1>Register</h1>
            
            <form class="form" method="POST" action="action.php">
                <input type="text" placeholder="First Name" name="firstname" required>
                <input type="text" placeholder="Last Name" name="lastname" required>
                <input type="text" placeholder="Username" name="username" required>
                <input type="email" placeholder="Email" name="email" required>
                <input type="date" placeholder="Birth Date" name="b-day">
                <input type="password" placeholder="Password" name="password" required>
                <input type="password" placeholder="Confirm Password" name="confirmpassword" required>
                <button type="submit" name="register" value="reg" class="register">Register</button>
            </form>
             
            
           
        </div>
    </div>
</body>
</html>