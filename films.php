<?php
    include_once "data.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $films_title; ?></title>
    <link rel="stylesheet" href="css.css/films.css">
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
    <div class="animefilms">
        <div class='films_1'>
        <?php
        // Եթե ուզում ես երկու բաժին, կարող ես foreach անել $films1 և $films2
        foreach ($films1 as $film) { ?>
            <div class="film-block">
                <p><?php echo $film['name']; ?></p>
                <a href="<?php echo $film['link']; ?>">
                    <img src="<?php echo $film['imgURL']; ?>" alt="">
                </a>
            </div>
        <?php }
        ?>
        </div>
        <div class='films_2'>
        <?php
        foreach ($films2 as $film) { ?>
            <div class="film-block">
                <p><?php echo $film['name']; ?></p>
                <a href="<?php echo $film['link']; ?>">
                    <img src="<?php echo $film['imgURL']; ?>" alt="">
                </a>
            </div>
       
        <?php } ?>
         </div>
    </div>
</body>
</html>