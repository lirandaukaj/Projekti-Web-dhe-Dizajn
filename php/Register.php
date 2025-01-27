<?php
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    if ($user->register($name, $surname, $email, $password)) {
        header("Location: Login.php"); 
        exit;
    } else {
        echo "Error registering user!";
    }
}
