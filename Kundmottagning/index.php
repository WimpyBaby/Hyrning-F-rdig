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
        $sql = "SELECT * FROM users WHERE uid='$uid' and Password = '$password'";
        $result = mysqli_query($conn, $sql);
        if($result){
            $row = mysqli_fetch_assoc($result);
            $staffLogin = true;
            // session_start();
            $_SESSION['staffLogin'] = true;
            $_SESSION['uid'] = $uid;
            $_SESSION['grupp'] = $row['grupp'];
            if($row['grupp'] == 'kundmottagare'){
                header("location: uthyrdabil.php");
            }
            else if($_SESSION['grupp'] == 'admin'){
                header("location: ../admin/home.php");
            }
            else if($_SESSION['grupp'] == 'Ekonom'){
                header("location: ../ekonom/home.php");
            }
        }
        else{
            echo "hej";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style2.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <title>Document</title>
</head>
<body>
    <form method="post" action="">
        <h1 class="heading">Staff sign <span>In</span></h1></br>
        <input name="uid" type="text" placeholder="uid" class="box">
        <input name="password" type="password" placeholder="password" class="box">
        <input type="submit" class="button3" value="Sign In">
    </form>
</body>
