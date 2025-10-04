<?php
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
    
    $username = $_POST['usname'];
    $email = $_POST['mail'];
    $birthday = $_POST['b-day'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confpassword'];

    if($password != $confirmpassword){
        echo "Password and Confirm Password do not match.";
    }

    if($_POST['register']){
        header("location:myaccount.php");
    }

?>