<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Dashboard</title>
</head>
<body>

 
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
</body>
</html>
