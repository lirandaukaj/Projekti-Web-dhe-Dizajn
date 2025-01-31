<?php
// session_start();
// require_once "Database.php";

// if(!isset($_SESSION ['user_id'])) {
//     echo "You must be logged in to send a message";
//     exit;
// }

// $db = new Database();
// $connection = $db->getConnection();

// $user_id = $_SESSION['user_id'];
// $message = $_POST['contactus'];

// $sql = "INSERT INTO contact_messages (user_id, message) VALUES (?, ?)";
// $stmt = $connection->prepare($sql);
// $stmt->bindParam(1, $user_id, PDO::PARAM_INT); 
// $stmt->bindParam(2, $message, PDO::PARAM_STR);

// if($stmt->execute()) {
//     echo "<script> alert('Message sent successfully'); window.location = '../dashboard.php';</script>";
// } else{
//     echo "Error:" .$stmt->error;
// }
?>
<?php
session_start();
require_once "Database.php";

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to send a message";
    exit;
}

$db = new Database();
$connection = $db->getConnection();

$user_id = $_SESSION['user_id'];

// Check if contactus is set and not empty
if (isset($_POST['contactus']) && !empty($_POST['contactus'])) {
    $message = $_POST['contactus'];
} else {
    echo "Error: Message cannot be empty.";
    exit;
}

$sql = "INSERT INTO contact_messages (user_id, message) VALUES (?, ?)";
$stmt = $connection->prepare($sql);
$stmt->bindParam(1, $user_id, PDO::PARAM_INT);
$stmt->bindParam(2, $message, PDO::PARAM_STR);

if ($stmt->execute()) {
    echo "<script> alert('Message sent successfully'); window.location = '../dashboard.php';</script>";
} else {
    echo "Error: " . $stmt->errorInfo();
}
?>
