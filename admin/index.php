<?php
session_start();
session_destroy();
session_start();

    $staffLogin = false;
    $showError = false;
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include "../connection.php";
        $uid = $_POST['uid'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE uid='$uid'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $staffLogin = true;
            session_start();
            $_SESSION['staffLogin'] = true;
            $_SESSION['uid'] = $uid;
            header("location: home.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" rel="stylesheet">
</head>
<body>
    <form method="post" action="index.php">
        <h1 class="heading">Admin sign <span>In</span></h1>
        <input name="uid" type="text" placeholder="uid" class="box">
        <input name="password" type="password" placeholder="password" class="box">
        <input type="submit" class="btn" value="Sign In">
    </form>
</body>
