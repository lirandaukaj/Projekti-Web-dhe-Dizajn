<?php
session_start();

require_once 'Database.php';
require_once 'Logger.php';

$db = new Database();
$connection = $db->getConnection();
$logger = new Logger($connection);

$userId = $_SESSION['user_id'];
$title = $_POST['title'];
$description =$_POST['description'];
// $image = $_POST['image'];

$query = "INSERT INTO eventsChanges (title,description,user_id) VALUES (:title, :description, :user_id)";
$stmt = $connection->prepare($query);
$stmt->bindParam(":title",$title);
$stmt->bindParam(":description",$description);
$stmt->bindParam(":user_id",$userId);
$stmt->execute();

$logger->info($userId, "Added a new event");

header("Location: ../dashboard.php");
exit;