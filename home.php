<?php
include "connection.php";
session_start();
if($_SESSION['isloggedin'] == false){
    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <title>Hyrning</title>
</head>
<body>
    <div class="container1">
        <div class="logo">
            <img src="bilder/logo.png" width="200px">
        </div>
        <div class="navbar">
            <a href="#about">About</a>
            <a href="#about">About</a>
            <a href="#about">About</a>
            <a href="#about">About</a>
        </div>
        <div class="login">
            <a class="logga" href="update.php" class="login">My Account</a>
            <a class="logga" href="login.php" class="login">Logout</a>
            <a class="logga" href="history.php" class="login">History</a>
        </div>
        <div class="phrase">
          <h1>Accelerating the Future</h1>
        </div>
    </div>
    <div class="container2">
        <div class="overlay"></div>
        <h1>
            Whatever car <br>whenever</br></h1>
        </h1>
        <div class="undertext">
            <p>
                Our services outstand in giving the<br>
                cutsomer the best experience and we<br>
                look forward to having you as our<br>
                customers
            </p>
        </div>
        <div class="colorbox">
            <img src="bilder/amg.png">
        </div>
    </div>
    <div class="searchbox">
        <form name="frmSearch" method="post" action="cars.php">
        <div class="form">
            <div class="location container3">
                <label for="query">From:</label>
                <input type="date" id="post_at" 
                aria-label="Search through site content"
                name="datefrom">
            </div>
            <div class="location container3">
                <label for="query">To:</label>
                <input type="date" id="post_at_to_date" 
                aria-label="Search through site content"
                min="2021-10-05" max="2025-12-31" name="dateto">
            </div>
            <input type="submit" name="go" value="Search" class="button3">
        </div>
        </form>
    </div>
</body>
<script src="myscript.js"></script>
</html>
