<?php

class events {
    private $conn;
    private $table = 'events';

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function insertContent($titulli, $pershkrimi, $foto) {
        // Check if the event already exists in the 'events' table
        $checkQuery = "SELECT * FROM events WHERE titulli = :titulli";
        $stmt = $this->conn->prepare($checkQuery);
        $stmt->bindParam(':titulli', $titulli);
        $stmt->execute();

        // If event exists, return false
        if ($stmt->rowCount() > 0) {
            return false;
        }

        // Insert into the 'events' table
        $query = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:titulli, :pershkrimi, :foto)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulli', $titulli);
        $stmt->bindParam(':pershkrimi', $pershkrimi);
        $stmt->bindParam(':foto', $foto);
        $stmt->execute();

        // Insert into the 'eventsChanges' table (with a note of the change)
        $this->insertIntoEventsChanges($titulli, 'added', 'Event inserted into events table');

        return true;
    }

    public function insertIntoEventsChanges($titulli, $action, $description) {
        // Insert a record in 'eventsChanges' table to track changes
        $query = "INSERT INTO eventsChanges (titulli, action, description) VALUES (:titulli, :action, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':titulli', $titulli);
        $stmt->bindParam(':action', $action);
        $stmt->bindParam(':description', $description);

        return $stmt->execute();
    }

    public function getContent() {
        $query = "SELECT * FROM events";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // New method to insert from 'eventsChanges' to 'events'
    public function insertFromEventsChanges() {
        // Get all records from the 'eventsChanges' table
        $query = "SELECT * FROM eventsChanges";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $changes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Loop through each record in 'eventsChanges' and insert it into the 'events' table
        foreach ($changes as $change) {
            // Make sure the event doesn't already exist in the 'events' table
            $checkQuery = "SELECT * FROM events WHERE titulli = :titulli";
            $stmtCheck = $this->conn->prepare($checkQuery);
            $stmtCheck->bindParam(':titulli', $change['titulli']);
            $stmtCheck->execute();

            if ($stmtCheck->rowCount() == 0) {
                // Insert event into 'events' table
                $queryInsert = "INSERT INTO events (titulli, pershkrimi, foto) VALUES (:titulli, :pershkrimi, :foto)";
                $stmtInsert = $this->conn->prepare($queryInsert);
                $stmtInsert->bindParam(':titulli', $change['titulli']);
                $stmtInsert->bindParam(':pershkrimi', $change['description']);  // Assuming 'description' is used as 'pershkrimi'
                $stmtInsert->bindParam(':foto', $change['action']);  // Assuming 'action' contains 'foto' or related data

                $stmtInsert->execute();
            }
        }

        return true;
    }
}
?>