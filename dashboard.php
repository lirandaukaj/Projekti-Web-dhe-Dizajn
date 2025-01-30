<?php
session_start(); 

require_once "php/Database.php";
require_once "php/UserRepository.php";
require_once "php/Logger.php";
require_once "php/Events.php";


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied!";
    exit;
}


$db = new Database();
$connection = $db->getConnection();

$userRepo = new UserRepository($connection);
$allUsers = $userRepo->getAllUsers(); 

$users = []; 

foreach ($allUsers as $u) {  
    if ($u['role'] === 'user') {  
        $users[] = $u;  
    }  
}

$logger = new Logger($connection);
$logs = $logger->getLogs();

$eventsClass = new Events($connection);
$getContent = $eventsClass->getContent();

$sql = "SELECT contact_messages.id, users.name, users.surname, users.email, contact_messages.message
        FROM contact_messages 
        JOIN users ON contact_messages.user_id = users.id";
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
          <li><a href="homePage.php"><button>Log Out</button></a></li>
          </ul>
        </nav>
      </header>
    </div>
  </section>
 

    <h2>REGISTERED USERS</h2>
    <table class="dashTable">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $u) { ?>
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
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
            <th>Password</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php foreach ($users as $user) { ?>
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

    <h2>CHANGES</h2>
    <table class="dashTable">
        <tr>
            <th>User ID</th>
            <th>Time</th>
            <th>Message</th>
        </tr>
        <?php foreach ($logs as $log) { ?>
        <tr>
            <td><?= $log['user_id']; ?></td>
            <td><?= $log['created_at']; ?></td>
            <td><?= $log['message']; ?></td>
        </tr>
        <?php } ?>
    </table><br><br>

    <h2>MANAGE EVENTS</h2>
    <form action="php/changes.php" method="POST">
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Event Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="foto">Event Image:</label>
        <input type="file" name="foto" id="foto" required><br>

        <input type="submit" name="submit" value="Add Event">
    </form>

    <h2>EVENT LIST</h2>
    <table class="dashTable">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($getContent as $event) { ?>
            <tr>
                <td><?= $event['id']; ?></td>
                <td><?= $event['titulli']; ?></td>
                <td>
                    <form action="php/deleteEvent.php" method="POST">
                        <input type="hidden" name="event_id" value="<?= $event['id']; ?>" />
                        <button type="submit" name="delete_event">Delete Event</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <h2>CONTACT MESSAGES</h2>
    <table class="dashTable">
        <tr>
            <th>Message ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Message</th>
         
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
