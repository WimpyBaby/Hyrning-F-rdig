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
        $group = $_POST['group'];
        $new_forsakring = $_POST['new_forsakring'];
        $new_korttiddygn = $_POST['new_korttiddygn'];
        $new_korttidkm = $_POST['new_korttidkm'];
        $new_veckoslut = $_POST['new_veckoslut'];
        $new_veckoslutkm = $_POST['new_veckoslutkm'];
        $new_veckoslutfri = $_POST['new_veckoslutfri'];
        $updateSql = "UPDATE `gruppbet` SET `Forsakring`='$new_forsakring',`Korttiddygn`='$new_korttiddygn',`korttidkm`='$new_korttidkm',`Veckoslut`='$new_veckoslut', `Veckoslutkm`='$new_veckoslutkm', `Veckoslutfri`='$new_veckoslutfri' WHERE `Gruppbet`='$group'";
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
    <div class="allusers">
        <h2 style="margin-top:3rem;" class="heading">New <span>Car</span></h2></br>
</div>
    <section class="container7">
    <div class="motUI2">
        <form class="newUser" method="post" action="">
            <div class="box">
                <p>Group:</p> 
                <input type="text" name="group2" maxlength="1" minlength = "1" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" onkeydown="return /[A-Z]/i.test(event.key)">
            </div>
            <div class="box">
                <p>Insurance:</p>
                <input type="text" name="insurance">
            </div>
            <div class="box">
                <p>Korttiddygn:</p>
                <input type="text" name="korttiddygn">
            </div>
            <div class="box">
                <p>korttidkm:</p>
                <input type="text" name="korttidkm">
            </div>
            <div class="box">
                <p>Veckoslut:</p>
                <input type="text" name="veckoslut">
            </div>
            <div class="box">
                <p>Veckoslutkm:</p>
                <input type="text" name="veckoslutkm">
            </div>
            <div class="box">
                <p>Veckoslutfri:</p>
                <input type="text" name="veckoslutfri">
            </div>
            <input type="submit" name="create" value="Create" class="button2">
        </form>
</div>
<div class="allusers">
        <h2 style="margin-top:3rem;" class="heading">All <span>Cars</span></h2>
</div>
        <div class="mottFLEX">
            <?php 
            $admSql = "SELECT * FROM gruppbet";
            $admSqlQuery = mysqli_query($conn, $admSql);
            if($admSqlQuery){
                while($row = mysqli_fetch_assoc($admSqlQuery)){
            ?>
            <div class="motUI">
            <form class="user" method="post" action="">
                <input type="hidden" name="group" value="<?php echo $row['Gruppbet']?>">
                <p>Group: <?php echo $row['Gruppbet'];?></p>
                <p>Insurance: <input type="text" name="new_forsakring" value="<?php echo $row['Forsakring']?>"></p>
                <p>Shorttime Days: <input type="text" name="new_korttiddygn" value="<?php echo $row['Korttiddygn']?>"></p>
                <p>Shorttime Km: <input type="text" name="new_korttidkm" value="<?php echo $row['korttidkm']?>"></p>
                <p>Weekend: <input type="text" name="new_veckoslut" value="<?php echo $row['Veckoslut']?>"></p>
                <p>Weekend Km: <input type="text" name="new_veckoslutkm" value="<?php echo $row['Veckoslutkm']?>"></p>
                <p>Weekend free: <input type="text" name="new_veckoslutfri" value="<?php echo $row['Veckoslutfri'];?>" maxlength="1" minlength = "1" oninput="let p=this.selectionStart;this.value=this.value.toUpperCase();this.setSelectionRange(p, p);" onkeydown="return /[A-Z]/i.test(event.key)">
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