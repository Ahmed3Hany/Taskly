<?php
session_start();

$fname = htmlspecialchars(trim($_REQUEST['fname']));
$lname = htmlspecialchars(trim($_REQUEST['lname']));
$email = filter_var(htmlspecialchars(trim($_REQUEST['email'])), FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars(trim($_REQUEST['newpassword']));

$errors = [];

if(empty($fname) || empty($lname) || empty($email) || empty($password)){
    $errors['empty'] = 'Please fill in All Fields!';
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Please enter a Valid Email!';
}

if(empty($errors)){
    require_once 'classes.php';
    $hashedPassword = md5($password);
    $result = User::register($fname, $lname, $email, $hashedPassword);

    if($result){
        header('Location: Login.php?msg=SR');
    } else {
        header('Location: Login.php?msg=AR');
    }
}
else{
    $_SESSION['errors'] = $errors;
    header('Location: Login.php');
}
