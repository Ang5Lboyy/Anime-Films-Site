<?php
    
include_once "data.php";


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $characters_title; ?></title>
    <link rel="stylesheet" href="css.css/characters.css">
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

   <div class='characters'>  
     <?php
     
    foreach ($characters as $character) { ?>
        
        <div class="character-block">
            <p class='charactername'><?php echo $character['name']; ?></p>
            <a href="<?php echo $character['link']; ?>">
                <img src="<?php echo $character['imgURL']; ?>" alt="">
                <p class='charactertext'><?php echo $character['text']; ?></p>
            </a>
        </div>
    <?php }
?>
</div>
        
       

    

    
</body>

</html>