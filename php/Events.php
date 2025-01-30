<?php
include_once 'Database.php';

class Events {
    private $conn;
    private $table = 'events';

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function insertContent($titulli, $pershkrimi, $foto, $user_id) {
        $checkQuery = "SELECT * FROM events WHERE titulli = :titulli";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':titulli', $titulli);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; 
        }

        $query = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:titulli, :pershkrimi, :foto)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulli', $titulli);
        $stmt->bindParam(':pershkrimi', $pershkrimi);
        $stmt->bindParam(':foto', $foto);
        $stmt->execute();

        $this->insertIntoEventsChanges($titulli, 'Event added', $user_id, $foto);

        return true;
    }

    public function insertIntoEventsChanges($title, $description, $user_id, $foto) {
        $query = "INSERT INTO eventsChanges (title, description, user_id, foto) VALUES (:title, :description, :user_id, :foto)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':foto', $foto);

        return $stmt->execute();
    }

    public function getContent() {
        $query = "SELECT * FROM events";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertFromEventsChanges() {
        $query = "SELECT * FROM eventsChanges";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $changes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($changes as $change) {
            $checkQuery = "SELECT * FROM events WHERE titulli = :titulli";
            $stmtCheck = $this->conn->prepare($checkQuery);
            $stmtCheck->bindParam(':titulli', $change['title']);
            $stmtCheck->execute();

            if ($stmtCheck->rowCount() == 0) {
                $queryInsert = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:titulli, :pershkrimi, :foto)";
                $stmtInsert = $this->conn->prepare($queryInsert);
                $stmtInsert->bindParam(':titulli', $change['title']);
                $stmtInsert->bindParam(':pershkrimi', $change['description']);
                $stmtInsert->bindParam(':foto', $change['foto']);

                $stmtInsert->execute();
            }
        }

        return true;
    }

    public function deleteEvent($eventId, $userId) {
      $this->conn->beginTransaction();
  
      try {
          // Delete from eventsChanges table
          $query = "DELETE FROM eventsChanges WHERE id = :event_id AND user_id = :user_id";
          $stmt = $this->conn->prepare($query);
          $stmt->bindParam(":event_id", $eventId);
          $stmt->bindParam(":user_id", $userId);
          $stmt->execute();
  
          // Delete from events table
          $queryEvent = "DELETE FROM events WHERE id = :event_id";
          $stmtEvent = $this->conn->prepare($queryEvent);
          $stmtEvent->bindParam(":event_id", $eventId);
          $stmtEvent->execute();
  
          $this->conn->commit();
          return "Event deleted successfully from both eventsChanges and events tables.";
      } catch (PDOException $e) {
          $this->conn->rollBack();
          return "Error: " . $e->getMessage();
      }
  }
  
  
  
  
  
}
?>

