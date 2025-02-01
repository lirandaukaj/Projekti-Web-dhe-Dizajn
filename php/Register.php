<?php
include_once 'Database.php';
include_once 'User.php';

class Register {
    private $userRepository;
    private $user;

    public function __construct( User $user) {
        $this->user = $user;
    }

    public function registerUser($name, $surname, $email, $password) {
        $role = strpos($email, '@admin.com') !== false ? 'admin' : 'user';

        if ($this->user->userExists($email)) {
            echo "<script>alert('User with this email already exists!'); window.location = '../register.php';</script>";
            exit;
        }

        if ($this->user->register($name, $surname, $email, $password, $role)) {
            header("Location: ../login.php");
            exit;
        }

        echo "Error registering user!";
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);
    $register = new Register($user);

    $register->registerUser($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['password']);
}

