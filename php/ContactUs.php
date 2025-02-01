<?php 

session_start();
require_once "Database.php";

class ContactUs{
    private $db;
    private $connection;
    private $user_id;
    

    public function __construct(){
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
        $this->user_id = $_SESSION['user_id'] ?? null;
    }

    public function sendMessage($message){
        if(!$this->user_id){
            echo "<script> alert('You must be logged in to send a message'); window.location = '../register.php';</script>";
            exit;
        }

        if(empty($message)){
            echo "Message cannot be empty. ";
            exit;
        }

        $sql = "INSERT INTO contact_messages (user_id,message) VALUES (?,?)";
        $stmt=$this->connection->prepare($sql);
        $stmt->bindParam(1, $this->user_id, PDO::PARAM_INT);
        $stmt->bindParam(2,$message, PDO::PARAM_STR);

        if($stmt->execute()){
            echo "<script>alert('Message sent successfully'); window.location = '../homePage.php';</script>";
        }else{
            echo "Error: " . $stmt->errorInfo();
        }
    }
}

if(isset($_POST['contactus']) && !empty($_POST['contactus'])){
    $contactMessage = new ContactUs();
    $contactMessage->sendMessage($_POST['contactus']);
}
?>