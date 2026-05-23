<?php 
session_start();
	error_reporting(E_ALL);
    ini_set('display_errors', 1);
	include 'user.php';

	if (isset($_POST['login'])) {
    $user = new User();
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $loggedUser = $user->login($email, $password);
    
    if ($loggedUser) {
        // Պահել session-ում
        $_SESSION['user_id'] = (int)$loggedUser['id'];
        $_SESSION['username'] = $loggedUser['username'];
        
        // ԿԱՐԵՎՈՐ: Ստուգել և integer-ի փոխարկել is_admin-ը
        $_SESSION['is_admin'] = (int)$loggedUser['is_admin'];
        
        // DEBUG
        echo "<!-- DEBUG: is_admin = " . $_SESSION['is_admin'] . " (type: " . gettype($_SESSION['is_admin']) . ") -->";
        
        header('Location: profile.php');
        exit;
    } else {
        echo "<div style='padding:20px; color:red;'>Invalid email or password! <a href='login.php'>Try again</a></div>";
        exit;
    }
}
	

	if(isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])){

		$user = new User();
		$user->firstname = $_POST['firstname'];
		$user->lastname = $_POST['lastname'];
		$user->email = $_POST['email'];
		$user->password = $_POST['password'];
		$user->username = $_POST['username'];
		$user->update($_POST['id']);


	}elseif(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['username'])){
		$user = new User();
		$user->firstname = $_POST['firstname'];
		$user->lastname = $_POST['lastname'];
		$user->email = $_POST['email'];
		$user->password = $_POST['password'];
		$user->username = $_POST['username'];
		$user->create();
	}

	if(isset($_GET['delete'])){
		$user = new User();
		$user->delete($_GET['delete']);
	}






	if(isset($_POST['register'])){
		header('location:profile.php');
	}
 ?>
