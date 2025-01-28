<?php 
include_once 'Database.php';

class UserRepository{
  private $connection;

  function __construct(){
    $conn = new Database();
    $this->connection = $conn->startConnection();
  }

  function insertUser($users){
    $conn = $this->connection;

    $id=$users->getId();
    $name = $users->getName();
    $surname = $users->getSurname();
    $email = $users->getEmail();
    $password = $users->getPassword();

    $sql = "INSERT INTO users (id,name,surname,email,password) VALUES (?,?,?,?,?)";

    $statement = $conn->prepare($sql);

    $statement ->execute([$id,$name,$surname,$email,$password]);

    echo "<script> alert('User has been inserted successfully!'); </script>";
  }

  function getAllUsers(){
    $conn = $this->connection;

    $sql = "SELECT - FROM users";

    $statement = $conn->query($sql);
    $users = $statement->fetchAll();

    return $users;
  }
}




?>