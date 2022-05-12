<?php

session_start();

if($_SESSION['staffLogin'] != true || ($_SESSION['staffLogin'] == true && $_SESSION['grupp'] == 'kundmottagare')){
    header("location: ../Kundmottagning/index.php");
}

    include "../connection.php";
    if(isset($_POST['create'])){
        $group2 = $_POST['group2'];
        $insurance = $_POST['insurance'];
        $korttiddygn = $_POST['korttiddygn'];
        $korttidkm = $_POST['korttidkm'];
        $veckoslut = $_POST['veckoslut'];
        $veckoslutkm = $_POST['veckoslutkm'];
        $veckoslutfri = $_POST['veckoslutfri'];
        $insertSql = "INSERT INTO `gruppbet`(`Gruppbet`, `Forsakring`, `Korttiddygn`, `korttidkm`, `Veckoslut`, `Veckoslutkm`, `Veckoslutfri`) VALUES ('$group2','$insurance','$korttiddygn','$korttidkm', '$veckoslut', '$veckoslutkm', '$veckoslutfri')";
        $insertRes = mysqli_query($conn, $insertSql);
    }
    if(isset($_POST['update'])){
        $kundid = $_POST['kundid'];
        $reg = $_POST['reg'];
        $datum = $_POST['datum'];
        $in = $_POST['in'];
        $ut = $_POST['ut'];
        $hyrtyp = $_POST['hyrtyp'];
        $distance = $_POST['distance'];
        $cost = $_POST['cost'];
        $fuel = $_POST['fuel'];

        $updateSql = "UPDATE `hyr` SET `Utdatum`='$in',`Indatum`='$ut',`Hyrtyp`='$hyrtyp',`AntalKm`='$distance', `Kostnad`='$cost', `Bensinkostnad`='$fuel' WHERE `KundId`='$kundid'";
        echo $updateSql;
        $updateRes = mysqli_query($conn, $updateSql);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
</head>
<body>
    <a href="home.php">Return</a>
    <a href="index.php">Logout</a>
    <a href="../ekonom/home.php">Ekonom Return</a>
    <a href="../kundmottagning/uthyrdabil.php">Rented Cars</a>
    <div class="allusers">
<div class="allusers">
        <h2 style="margin-top:3rem;" class="heading">Returned <span> Cars</span></h2>
</div>
        <div class="mottFLEX">
            <?php 
            $admSql = "SELECT * FROM hyr";
            $admSqlQuery = mysqli_query($conn, $admSql);
            if($admSqlQuery){
                while($row = mysqli_fetch_assoc($admSqlQuery)){
            ?>
            <div class="motUI">
            <form class="user" method="post" action="">
                <input type="hidden" name="kundid" value="<?php echo $row['KundId']?>">
                <p>Customer ID: <?php echo $row['KundId'];?></p>
                <input type="hidden" name="reg" value="<?php echo $row['Regnr']?>">
                <p>Reg Number: <?php echo $row['Regnr'];?>
                <input type="hidden" name="datum" value="<?php echo $row['Bokningsdatum']?>">
                <p>Booking Date: <?php echo $row['Bokningsdatum'];?> 
                <p>Out Date: <input type="text" name="in" value="<?php echo $row['Utdatum']?>"></p>
                <p>In Date: <input type="text" name="ut" value="<?php echo $row['Indatum']?>"></p>
                <p>Distance: <input type="text" name="distance" value="<?php echo $row['AntalKm'];?>">
                <p>Cost: <input type="text" name="cost" value="<?php echo $row['Kostnad'];?>">
                <p>Fuel: <input type="text" name="fuel" value="<?php echo $row['Bensinkostnad'];?>">
                <p><label>Rent Type:</label>
                <select name="hyrtyp">
                    <option value="Veckoslut">Weekend</option>
                    <option value="Korttid">Short-time</option>
                    <option value="Veckoslutfri">Weekend free</option>
                </select>


                <input type="submit" value="Update" class="button2" name="update">
            </form>
                </div>
            <?php
                }
            }
            ?>
        </div>
    </section>
</body>
</html>