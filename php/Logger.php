<?php
include_once 'Database.php';
include_once 'User.php';
class Logger{
    private $connection;
    private $logs = [];

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }
    public function log($admin_id,$message) {
        $date = date("Y-m-d H:i:s");
        $this->logs[] = "[$date][$message]";

        $query = "INSERT INTO logs (admin_id, message, created_at) VALUES (:admin_id, :message, NOW())";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":admin_id",$admin_id);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
    }
    public function info($admin_id, $message) {
        $this->log($admin_id, $message);  
    }

    public function getLogs() {
        $query = "SELECT * FROM logs ORDER BY created_at DESC";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


  

}
