<?php
session_start();

$email = filter_var(htmlspecialchars(trim($_REQUEST['email'])), FILTER_SANITIZE_EMAIL);
$password = htmlspecialchars(trim($_REQUEST['password']));

$errors = [];

if(empty($email) || empty($password)){
    $errors['empty'] = 'Please fill in All Fields!';
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = 'Please enter a Valid Email!';
}

if(empty($errors)){
    require_once 'classes.php';
    $hashedPassword = md5($password);
    $result = User::login($email, $hashedPassword);

    if($result){
        $_SESSION['user'] = serialize($result);
        if($result->role == 'admin'){
            header('Location: dashboard.php');
        } else {
            header('Location: Home.php');
        }
    } else {
        header('Location: Login.php?msg=login_failed');
    }
}
else{
    $_SESSION['errors'] = $errors;
    header('Location: Login.php');
}
