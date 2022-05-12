<?php

include("connection.php");
session_start();
// print_r($_SESSION);

$kundid = $_SESSION['KundId'];

?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <title>Document</title>
</head>
<body>
<h1>History</h1>
<a href="home.php">Home</a>
<div class="table1">
    <table>
        <thead>
            <tr>
            <th>Registration Number</th>
            <th>Booking Date</th>
            <th>Out Date</th>
            <th>In Date</th>
            <th>Renttype</th>
            </tr>
    </thead>
    <?php
    $sql = "SELECT * FROM hyr WHERE '$kundid' = KundId";
    $result = mysqli_query($conn, $sql);
    if ($result){
        while($row = mysqli_fetch_assoc($result)){
        ?>
    <tr>
        <td><?php echo $row['Regnr'];?></td>
        <td><?php echo $row['Bokningsdatum'];?></td>
        <td><?php echo $row['Utdatum'];?></td>
        <td><?php echo $row['Indatum'];?></td>
        <td><?php echo $row['Hyrtyp'];?></td>
    <?php
        }
    }
    ?>
</table>
    </div>
</body>
</html>