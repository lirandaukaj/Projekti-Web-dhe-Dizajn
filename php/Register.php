<?php
include_once 'Database.php';
include_once 'User.php';
include_once 'UserRepository.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $role = 'user';

    if(strpos($email,'@admin.com') !== false){
        $role = 'admin';
    }
    if ($user->userExists($email)) {
        echo "<script>alert('User with this email already exists!'); window.location = '../register.php';</script>";
        exit;
    }
   else{
    if ($user->register($name, $surname, $email, $password, $role)) {
    header("Location: ../login.php");
    exit;
    } else {
        echo "Error registering user!";
    }
}
} 
