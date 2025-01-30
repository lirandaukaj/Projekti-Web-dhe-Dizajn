<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
   
    <a href="homePage.php"><button>Log Out</button></a>
    <?php
    require_once 'php/Database.php';
    require_once 'php/Logger.php';
    require_once 'php/Events.php';
    $db = new Database();
    $connection = $db->getConnection();
    $logger = new Logger($connection);

    $logs = $logger->getLogs();


    $eventsClass = new Events($connection); 
    $getContent = $eventsClass->getContent(); 
    ?>
    <h2>Changes</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Time</th>
            <!-- <th>Level</th> -->
            <th>Message</th>
        </tr>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log['user_id']; ?></td>
                <td><?= $log['created_at']; ?></td>
                <!-- <td><?= $log['level']; ?></td> -->
                <td><?= $log['message']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table><br><br>

    <h2>Manage Events</h2>
    <form action="php/changes.php" method="POST" >
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required><br>

        <label for="description">Event Description:</label>
        <textarea name="description" id="description" required></textarea><br>

        <label for="foto">Event Image:</label>
        <input type="file" name="foto" id="foto" required><br>

        <input type="submit" name="submit" value="Add Event">
    </form>

    <h2>Manage Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>SURNAME</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

        <?php 
        include_once 'php/UserRepository.php';

        $userRepository = new UserRepository();
        $users = $userRepository->getAllUsers(); 

        foreach($users as $user){
            echo "
            <tr>
                <td>{$user['id']}</td>
                <td>{$user['name']}</td>
                <td>{$user['surname']}</td>
                <td>{$user['email']}</td>
                <td>{$user['password']}</td>
                <td><a href='php/edit.php?id={$user['id']}'>Edit</a></td>
                <td><a href='php/delete.php?id={$user['id']}'>Delete</a></td>
            </tr>";
        }
        ?>
    </table>

    <h2>Event List</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Event ID</th>
                <th>Event Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($getContent as $event) {
            ?>
                <tr>
                    <td><?php echo $event['id']; ?></td>
                    <td><?php echo $event['titulli']; ?></td>
                    <td>
                        <form action="php/deleteEvent.php" method="POST">
                            <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>" />
                            <button type="submit" name="delete_event">Delete Event</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <?php 
    require_once "php/Database.php";
    require_once "php/UserRepository.php";

    $db = new Database();
    $connection = $db->getConnection();

    $user = new UserRepository($connection);
    $users = $user->getAllUsers();
    ?>
    <h2>Registered Users</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Email</th>
        </tr>
        <?php foreach($users as $u) {?>
         <tr>
            <td><?= $u['id']; ?></td>
            <td><?= $u['name']; ?></td>
            <td><?= $u['surname']?></td>
            <td><?= $u['email']; ?></td>
         </tr>
        <?php } ?>
    </table>

</body>
</html>
