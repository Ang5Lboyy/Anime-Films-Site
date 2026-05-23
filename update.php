
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $anime_title; ?></title>
    <link rel="stylesheet" href="css.css/anime.css">
    
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
<?php
  include 'user.php';
  $users = new User();
  $user = $users->selectOne($_GET['id']);
?>
  <main class="container my-5">
    <form action="action.php" method="POST">

      <?php foreach($user as $value){ ?>

      <div class="mb-3">
        <input type="text" value = "<?php echo $value['id']; ?>" class="form-control" name="id" required placeholder="Id" hidden>
      </div>

      <div class="mb-3">
        <input type="text" value = "<?php echo $value['firstname']; ?>" class="form-control" name="firstname" required placeholder="Firstname">
      </div>

      <div class="mb-3">
        <input type="text" value = "<?php echo $value['lastname']; ?>" class="form-control" name="lastname" required placeholder="Lastname">
      </div>
      <div class="mb-3">
        <input type="text" value = "<?php echo $value['email']; ?>" class="form-control" name="email" required placeholder="Email">
      </div>
      <div class="mb-3">
        <input type="text" value = "<?php echo $value['password']; ?>" class="form-control" name="password" required placeholder="Password">
      </div>
      <div class="mb-3">
        <input type="text" value = "<?php echo $value['username']; ?>" class="form-control" name="username" required placeholder="Username">
      </div>
    <?php } ?>
      <button type="submit" class="btn btn-primary" name="register" style="background: black; color: #FFA239; border: none;">Update</button>
    </form>

    <p class="text-center mt-5">Already have an account? <a href="login.php">Login</a></p>
  </main>
