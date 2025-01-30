<?php
/*session_start();

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

    $query = "INSERT INTO eventsChanges (title, description, user_id,foto) VALUES (:title, :description, :user_id, :foto)";
    $stmt = $connection->prepare($query);
    $stmt->bindParam(":title", $title);
    $stmt->bindParam(":description", $description);
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":foto", $foto);

    try {
        $stmt->execute();
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
*/

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

    // Step 1: Insert event into the events table
    $queryEvent = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:title, :description, :foto)";
    $stmtEvent = $connection->prepare($queryEvent);
    $stmtEvent->bindParam(":title", $title);
    $stmtEvent->bindParam(":description", $description);
    $stmtEvent->bindParam(":foto", $foto);

    try {
        $stmtEvent->execute(); // Insert the event into the events table
        
        // Step 2: Get the event_id of the newly inserted event
        $eventId = $connection->lastInsertId();

        // Step 3: Insert the event change into the eventsChanges table
        $queryChange = "INSERT INTO eventsChanges (event_id, title, description, user_id, foto) 
                        VALUES (:event_id, :title, :description, :user_id, :foto)";
        $stmtChange = $connection->prepare($queryChange);
        $stmtChange->bindParam(":event_id", $eventId);
        $stmtChange->bindParam(":title", $title);
        $stmtChange->bindParam(":description", $description);
        $stmtChange->bindParam(":user_id", $userId);
        $stmtChange->bindParam(":foto", $foto);

        // Execute the change insertion
        $stmtChange->execute();

        // Log the action
        $logger->info($userId, "Added a new event with title: '$title'");

        // Redirect to the dashboard
        header("Location: ../dashboard.php");
        exit;
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else {
    die("Error: Title and Description are required.");
}
?>
