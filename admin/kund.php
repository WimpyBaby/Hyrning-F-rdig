<?php

session_start();

if($_SESSION['staffLogin'] != true || ($_SESSION['staffLogin'] == true && $_SESSION['grupp'] == 'kundmottagare')){
    header("location: ../Kundmottagning/index.php");
}

    include "../connection.php";
    if(isset($_POST['update'])){
        $kundname = $_POST['kundnamn'];
        $adress = $_POST['adress'];
        $postadress = $_POST['postadress'];
        $tel = $_POST['tel'];
        $mobil = $_POST['mobil'];
        $epost = $_POST['epost'];
        $hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // $password = $_POST['password'];
        $updateSql = "UPDATE `kund` SET `KundNamn`='$kundname',`Adress`='$adress',`Postadress`='$postadress',`Tel`='$tel', `MobilTel`='$mobil', `Epost`='$epost', `Password` = '$hash' WHERE `KundId`=".$_POST['id'];
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
    <h1>Customers</h1>
    <div class="mottFLEX">
            <?php 
            $admSql = "SELECT * FROM kund";
            $admSqlQuery = mysqli_query($conn, $admSql);
            if($admSqlQuery){
                while($row = mysqli_fetch_assoc($admSqlQuery)){
            ?>
            <div class="motUI">
            <form class="user" method="post" action="">
                <input type="hidden" name="id" value="<?php echo $row['KundId']?>">
                <br>Customer Id: <?php echo $row['KundId'];?></br>
                <p>Customer Name: <input type="text" name="kundnamn" value="<?php echo $row['KundNamn']?>"></p>
                <p>Password: <input type="password" name="password" value=""></p>
                <p>Adress: <input type="text" name="adress" value="<?php echo $row['Adress'];?>"></p>
                <p>Postadress: <input type="text" name="postadress" value="<?php echo $row['Postadress'];?>"></p>
                <p>Tel: <input type="text" name="tel" value="<?php echo $row['Tel'];?>"></p>
                <p>Mobile : <input type="text" name="mobil" value="<?php echo $row['MobilTel'];?>"></p>
                <p>Epost: <input type="text" name="epost" value="<?php echo $row['Epost'];?>"></p>
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