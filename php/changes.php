<?php

session_start();

require_once 'Database.php';
require_once 'Logger.php';
$db = new Database();
$connection = $db->getConnection();
$logger = new Logger($connection);

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$userId = $_SESSION['user_id'];

if (isset($_POST['title']) && isset($_POST['description']) && isset($_POST['foto'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $foto = $_POST['foto'];

    if (empty($title) || empty($description) || empty($foto)) {
        die("Title and Description are required.");
    }

  
    $queryEvent = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:title, :description, :foto)";
    $stmtEvent = $connection->prepare($queryEvent);
    $stmtEvent->bindParam(":title", $title);
    $stmtEvent->bindParam(":description", $description);
    $stmtEvent->bindParam(":foto", $foto);

    try {
        $stmtEvent->execute(); 
        
      
        $eventId = $connection->lastInsertId();
        $queryChange = "INSERT INTO eventsChanges (event_id, title, description, user_id, foto) 
                        VALUES (:event_id, :title, :description, :user_id, :foto)";
        $stmtChange = $connection->prepare($queryChange);
        $stmtChange->bindParam(":event_id", $eventId);
        $stmtChange->bindParam(":title", $title);
        $stmtChange->bindParam(":description", $description);
        $stmtChange->bindParam(":user_id", $userId);
        $stmtChange->bindParam(":foto", $foto);

        $stmtChange->execute();

        $logger->info($userId, "Added a new event with title: '$title'");

        header("Location: ../dashboard.php");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Error: Title and Description are required.");
}
?>
