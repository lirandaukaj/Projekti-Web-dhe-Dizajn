<?php 
include_once 'Database.php';

class UserRepository{
  private $connection;

  function __construct(){
    $conn = new Database();
    $this->connection = $conn->startConnection();
  }

  function insertUser($user){
    $conn = $this->connection;

    
  }
}




?>