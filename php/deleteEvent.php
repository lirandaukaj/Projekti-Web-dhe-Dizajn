
<?php
session_start(); 

require_once "Database.php";
require_once "Logger.php"; 
require_once "Events.php";  

if (!isset($_SESSION['user_id'])) {
    die("User is not logged in.");
}

$userId = $_SESSION['user_id'];

if (isset($_POST['delete_event']) && isset($_POST['event_id'])) {
    $eventId = $_POST['event_id'];
    
    $db = new Database();
    $connection = $db->getConnection();
    
    
    $events = new Events($connection);
    $logger = new Logger($connection); 

   
    $query = "SELECT titulli FROM events WHERE id = :event_id";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":event_id", $eventId);
    $stmt->execute();

    $event = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($event) {
        $eventTitle = $event['titulli'];
        $result = $events->deleteEvent($eventId, $userId);
        if ($result) {
            $logger->info($userId, "Deleted event with title: '$eventTitle'");
            header('Location: ../dashboard.php');
            exit();
        } else {
            echo "Error deleting event.";
        }
    } else {
        echo "Event not found.";
    }
} else {
    echo "Error: Event ID not provided.";
}
?>



