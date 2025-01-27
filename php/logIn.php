<?php
session_start();
include_once 'Database.php';
include_once 'User.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')  {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $email = $_POST['email'];
    $password = $_POST['password'];

    if($user->login($email, $password)) {
        header("Location: homePage.php");
        exit;
    } else {
        echo "Invalid email or password";
    }
}

