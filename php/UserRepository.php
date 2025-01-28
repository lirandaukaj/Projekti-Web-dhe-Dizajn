<?php 
include_once 'Database.php';

class UserRepository{
  private $connection;

  function __construct(){
    $conn = new Database();
    $this->connection = $conn->getConnection();
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

    $sql = "SELECT * FROM users";

    $statement = $conn->query($sql);
    $users = $statement->fetchAll();

    return $users;
  }

  function getUserById($id){
    $conn = $this->connection;
    
    $sql = "SELECT * FROM users WHERE id='$id'";

    $stmt = $conn->query($sql);
    $users = $stmt->fetch();

    return $users;
  }

  function updateUser($id, $name, $surname, $email, $password) {
    $conn = $this->connection;

    $sql = "UPDATE users SET name=?, surname=?, email=?, password=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->execute([$name, $surname, $email, $password, $id]);

    echo "<script> alert('Update was successful');</script";
  }

  function deleteUser($id) {
    $conn = $this->connection;

    $sql ="DELETE FROM users WHERE id=?";

    $stmt = $conn->prepare($sql);

    $stmt->execute([$id]);

    echo "<script>aler('Delete was successful');</script>";
  }
}




?>