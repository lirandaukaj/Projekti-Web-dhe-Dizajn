<?php
include_once 'UserRepository.php';

if(isset($_GET['id'])) {
    $userId = $_GET['id'];

    $userRepository = new UserRepository();
    $user = $userRepository->getUserById($userId);

}else {
    echo "User id not found";
}

if(isset($_POST['editBtn'])) {
    $id = $_POST['id'];  
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userRepository->updateUser($id, $name, $surname, $email, $password);

    header("location:../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <h3 id="edit">Edit User</h3>
    <form action="" method="POST">
        <input type="text" name="id" value="<?=$user['id']?>" readonly> <br> <br>
        <input type="text" name="name" value="<?=$user['name']?>" > <br> <br>
        <input type="text" name="surname" value="<?=$user['surname']?>"> <br> <br>
        <input type="text" name="email" value="<?=$user['email']?>"> <br> <br>
        <input type="text" name="password" value="<?=$user['password']?>"> <br> <br>
        <input type="submit" name="editBtn" value="Save Changes"> <br> <br>
    </form>
</body>
</html>
