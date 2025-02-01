<?php
session_start();

require_once "php/Database.php";
require_once "php/UserRepository.php";
require_once "php/Logger.php";
require_once "php/Events.php";
require_once "php/Changes.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>
            alert('You should be logged in as an admin to access this page!');
            window.location.href = 'login.php'; // Redirect to the login page
          </script>";
    exit;
}

$db = new Database();
$connection = $db->getConnection();
$logger = new Logger($connection);
$userRepo = new UserRepository($connection);
$allUsers = $userRepo->getAllUsers();
$eventsClass = new Events($connection);
$getContent = $eventsClass->getContent();

$eventManager = new Changes($connection, $logger, $_SESSION['user_id']);

if (isset($_POST['submit'])) {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $file = $_FILES['foto'];
        $eventId = $eventManager->createEvent($title, $description, $file);
        echo "<script>alert('Event created successfully!');</script>";
        header("Location: dashboard.php");
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

if (isset($_POST['delete_event'])) {
    try {
        $eventId = $_POST['event_id'];
        $eventManager->deleteEvent($eventId);
        echo "<script>alert('Event deleted successfully!');</script>";
        header("Location: dashboard.php");
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}

$sql = "SELECT * FROM contact_messages cm JOIN users u ON cm.user_id = u.id";
$result = $connection->query($sql);
$result->execute();
$messages = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<section id="section1">
    <div class="container">
      <header>
        <div id="logo">
          <img src="img/logo.png" alt="Logo">
        </div>
        <div id="text-logo">
          <h1>Seray</h1>
        </div>
        
        <nav>
          <ul>
          <li><a href="homePage.php"><button>Home Page</button></a></li>
          <li><a href="php/logout.php"><button>Log Out</button></a></li>
          </ul>
        </nav>
      </header>
    </div>
</section>

<h2>REGISTERED USERS</h2>
<table class="dashTable">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>SURNAME</th>
        <th>EMAIL</th>
    </tr>

    <?php foreach ($allUsers as $u) { ?>
    <tr>
        <td><?= $u['id']; ?></td>
        <td><?= $u['name']; ?></td>
        <td><?= $u['surname']; ?></td>
        <td><?= $u['email']; ?></td>
    </tr>
    <?php } ?>
</table>

<h2>MANAGE USERS</h2>
<table class="dashTable">
    <tr>
        <th>ID</th>
        <th>NAME</th>
        <th>SURNAME</th>
        <th>EMAIL</th>
        <th>PASSWORD</th>
        <th>EDIT</th>
        <th>DELETE</th>
    </tr>
    <?php foreach ($allUsers as $user) { ?>
    <tr>
        <td><?= $user['id']; ?></td>
        <td><?= $user['name']; ?></td>
        <td><?= $user['surname']; ?></td>
        <td><?= $user['email']; ?></td>
        <td><?= $user['password']; ?></td>
        <td><a href="php/edit.php?id=<?= $user['id']; ?>">Edit</a></td>
        <td><a href="php/delete.php?id=<?= $user['id']; ?>">Delete</a></td>
    </tr>
    <?php } ?>
</table>

<h2>INSERT EVENTS</h2>
<form action="dashboard.php" method="POST" id="formAdd" enctype="multipart/form-data">
    <label for="title" class="inputa">EVENT TITLE:</label>
    <input type="text" name="title" id="title" required><br>

    <label for="description" class="inputa">EVENT DESCRIPTION:</label>
    <textarea name="description" class="inputa" required></textarea><br>

    <label for="foto" id="foto" class="inputa">EVENT IMAGE:</label>
    <input type="file" name="foto" required><br>

    <input type="submit" name="submit" value="Add Event" class="dashButon">
</form>

<h2>DELETE EVENTS</h2>
<table class="dashTable">
    <thead>
        <tr>
            <th>EVENT ID</th>
            <th>EVENT TITLE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($getContent as $event) { ?>
        <tr>
            <td><?= $event['id']; ?></td>
            <td><?= $event['titulli']; ?></td>
            <td>
                <form action="dashboard.php" method="POST">
                    <input type="hidden" name="event_id" value="<?= $event['id']; ?>" />
                    <button type="submit" name="delete_event" class="dashButon">Delete Event</button>
                </form>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<h2>CHANGES</h2>
<table class="dashTable">
    <tr>
        <th>Admin ID</th>
        <th>Time</th>
        <th>Message</th>
    </tr>
    <?php foreach ($logger->getLogs() as $log) { ?>
    <tr>
        <td><?= $log['admin_id']; ?></td>
        <td><?= $log['created_at']; ?></td>
        <td><?= $log['message']; ?></td>
    </tr>
    <?php } ?>
</table><br><br>

<h2>CONTACT MESSAGES</h2>
<table class="dashTable">
    <tr>
        <th>MESSAGE ID</th>
        <th>USER NAME</th>
        <th>EMAIL</th>
        <th>MESSAGE</th>
    </tr>
    <?php foreach ($messages as $msg) { ?>
    <tr>
        <td><?= $msg['id']; ?></td>
        <td><?= $msg['name'] . ' ' . $msg['surname']; ?></td>
        <td><?= $msg['email']; ?></td>
        <td><?= $msg['message']; ?></td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
