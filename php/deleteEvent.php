<?php
session_start();
require_once 'Database.php';
require_once 'Events.php';

$db = new Database();
$conn = $db->getConnection();
$events = new Events($conn);
if (isset($_POST['delete_event']) && isset($_POST['event_id'])) {
  $eventId = $_POST['event_id']; 
  $userId = $_SESSION['user_id'];

  echo "Event ID: " . $eventId;
  echo "User ID: " . $userId;

  $result = $events->deleteEvent($eventId, $userId);

  echo $result; 

  header('Location: ../dashboard.php');
  exit();
} else {
  echo "Error: Event ID not provided.";
}


?>

