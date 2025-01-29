<?php
include_once 'Database.php';
class Logger{
    private $connection;
    private $logs = [];

    public function __construct($dbConnection) {
        $this->connection = $dbConnection;
    }
    public function log($userID,$level, $message) {
        $date = date("Y-m-d H:i:s");
        $this->logs[] = "[$date] [$level] $message";

        $query = "INSERT INTO logs (user_id,level, message, created_at) VALUES (:user_id, :level, :message, NOW())";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(":user_id",$userID);
        $stmt->bindParam(":level", $level);
        $stmt->bindParam(":message", $message);
        $stmt->execute();
    }
    public function info($userID,$message) {
        $this->log($userId,"INFO",$message);
    }
    public function warning($userId,$message) {
        $this->log($userId,"WARNING", $message);
    }
    public function error($userID,$message) {
        $this->log($userId,"ERROR", $message);
    }

    public function getLogs() {
        $query = "SELECT * FROM logs ORDER BY created_at DESC";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    


  

}
