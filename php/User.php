<?php
class User {
    private $conn;
    private $table_name = 'users';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function userExists($email){
        $query = "SELECT * FROM users WHERE email= :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email',$email);
        $stmt->execute();

        if($stmt->rowCount()>0){
            return true;
        }
        return false;
    }

    public function register($name, $surname, $email, $password, $role = 'user') {
        $query = "INSERT INTO {$this->table_name} (name, surname, email, password, role) VALUES (:name, :surname, :email, :password, :role)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindParam(':role', $role);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT id, name, surname, email, password, role FROM {$this->table_name} WHERE email = :email";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                return true;
            }
        }
        return false;
    }
}