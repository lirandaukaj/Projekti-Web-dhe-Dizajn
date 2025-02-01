<?php 
class Changes{
    private $connection;
    private $logger;
    private $userId;

    public function __construct($dbConnection,$logger,$userId){
        $this->connection=$dbConnection;
        $this->logger = $logger;
        $this->userId=$userId;
    }

    private function handleFileUpload($file){
        if($file['error']!=0){
            throw new Exception("File upload failed.Please try again !");
        }

        $targetDir = "img/"; 
        $fileName = basename($file['name']);
        $uplFile = $targetDir . $fileName;

        if(!move_uploaded_file($file['tmp_name'], "../" . $uplFile)){
            throw new Exception("Error uploading the file.");
        }
        return $uplFile;
    }

    public function createEvent($title,$description,$file){
        if(empty($title) || empty($description) || $file['error']!=0){
            throw new Exception("Title,Description, and a valid file are required.");
        }
        $filePath = $this->handleFileUpload($file);
        $queryEvent = "INSERT INTO events (titulli,pershkrimi,foto) VALUES (:title, :description, :foto)";
        $stmtEvent = $this->connection->prepare($queryEvent);
        $stmtEvent->bindParam(":title",$title);
        $stmtEvent->bindParam(":description",$description);
        $stmtEvent->bindParam(":foto",$filePath);

        try{
            $stmtEvent->execute();
            $eventId=$this->connection->lastInsertId();

            $this->logEventChange($eventId,$title,$description,$filePath);
            $this->logger->info($this->userId, "Added a new event with title: '$title'");

            return $eventId;
        }catch(PDOException $e){
            throw new Exception("Error creating event: " . $e->getMessage());
        }
    }

    private function logEventChange($eventId,$title,$description,$filePath){
        $queryChange = "INSERT INTO eventsChanges (event_id, title, description, user_id,foto) VALUES (:event_id,:title,:description,:user_id,:foto)";
        $stmtChange = $this->connection->prepare($queryChange);
        $stmtChange->bindParam(":event_id",$eventId);
        $stmtChange->bindParam(":title",$title);
        $stmtChange->bindParam(":description",$description);
        $stmtChange->bindParam(":user_id",$this->userId);
        $stmtChange->bindParam(":foto",$filePath);

        $stmtChange->execute();
    }

    public function deleteEvent($eventId){
        $queryGetTitle = "SELECT titulli FROM events WHERE id=:event_id";
        $stmtGetTitle=$this->connection->prepare($queryGetTitle);
        $stmtGetTitle->bindParam(":event_id", $eventId);


        $stmtGetTitle->execute();
        $event = $stmtGetTitle->fetch(PDO::FETCH_ASSOC);
        if(!$event){
            throw new Exception("Event with ID '$eventId' not found.");
        }

        $title = $event['titulli'];
        $queryDelete = "DELETE FROM events WHERE id = :event_id";
        $stmtDelete = $this->connection->prepare($queryDelete);
        $stmtDelete->bindParam(":event_id",$eventId);


        try{
            $stmtDelete->execute();
            $this->logger->info($this->userId, "Deleted event with title: '$title'");
        }catch(PDOException $e){
            throw new Exception("Error deleting event: " . $e->getMessage());
        }
    }
}




?>



