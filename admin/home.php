<?php

session_start();
include "../connection.php";

if($_SESSION['staffLogin'] != true || ($_SESSION['staffLogin'] == true && $_SESSION['grupp'] != 'admin')){
    header("location: ../Kundmottagning/index.php");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <title>Document</title>
</head>
<body>
    <div class="adminlog">
        <h1>Database Users</h1>
        <p><a href="users.php">Manage Users</a></p>
        <p><h1>Database Rentals</h1></p>
        <p><a href="kund.php">Customers</a></p>
        <p><a href="bilar.php">Cars</a></p>
        <p><a href="grupp.php">Price Group</a></p>
        <p><a href="rent.php">Rentals</a></p>
        <p><a href="../Kundmottagning/index.php">Log Out</a></p>
    </div>
</body>
</html>