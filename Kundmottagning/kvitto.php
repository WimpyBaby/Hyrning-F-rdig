<?php

session_start();

if($_SESSION['staffLogin'] != true){
    header("location: ../login.php");
}

include "../connection.php";
$utdatum = $_POST['utdatum'];
$indatum = $_POST['indatum'];
$fuel = $_POST['fuel'];
$kundid = $_POST['kundid'];
$kundnamn = $_POST['kundnamn'];
$adress = $_POST['adress'];
$post = $_POST['post'];
$tel = $_POST['tel'];
$forsakring = $_POST['forsakring'];
$kmCost = $_POST['kmcost'];
$kcost = $_POST['kcost'];
$fuel = $_POST['fuel'];
$total = $_POST['total'];
$distance = $_POST['distance'];
$bok = $_POST['bok'];

// $hyrtyp = $_POST['hyrtyp'];
$dagar = ((strtotime($indatum)-strtotime($utdatum))/86400)+1;
$total = $kmCost + $kcost + $forsakring*$dagar;

// print_r($_POST);
$reg = $_POST['reg'];

$sql = "SELECT * FROM kund WHERE '$kundid' = KundId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM bil WHERE '$reg' = Regnr";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT * FROM gruppbet WHERE '".$row2['Gruppbet']."' = Gruppbet";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);

// $row3['korttidkm'];

// $gruppSql = "SELECT *, Forsakring, Korttiddygn, Korttidkm, Veckoslut, Veckoslutkm, Veckoslutfri FROM bil INNER JOIN gruppbet ON bil.Gruppbet = gruppbet.Gruppbet WHERE bil.Regnr = '$reg'";
// $gruppRes = mysqli_query($conn, $gruppSql);
// $gruppRow = mysqli_fetch_assoc($gruppRes);

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
    <title>Document</title>
</head>
<body>
    <div class="container5">
    <form method = post>
    <img src="../bilder/logo2.png">
            <h1>Hi, <span><?php echo $row['KundNamn'];?></span></h1>
            <h2>Thank you for ordering with Wimpy Rentals</h2>
            <div class="info">
            <div class="info2">
                <h2>Customer Info</h2>
                <p><label>Kund Id: <?php echo $kundid;?></label></p>
                <p>Name: <?php echo $kundnamn;?></p>
                <p>Adress: <?php echo $adress;?></p>
                <p>Postadress: <?php echo $post;?></p>
                <p>Telefon: <?php echo $tel;?></p>
            </div>
            <div class="info2">
                <h2>Costs</h2>
                <p><label>Insurance: <?php echo $forsakring;?> kr</label></p>
                <p>Km Cost: <?php echo $kmCost;?> kr</p>
                <p>Rent Cost: <?php echo $kcost;?> kr</p>
                <p>Fuel Cost: <?php echo $fuel?></p>
                <p>Total Cost: <?php echo $total;?></p>
            </div>
            <div class="info2">
                <h2>Rent Information</h2>
                <p><label>Registration Number: <?php echo $reg;?></label></p>
                <p>Booking Time: <?php echo $bok;?> kr</p>
                <p>Outdate: <?php echo $utdatum;?> kr</p>
                <p>Indate: <?php echo $indatum?></p>
                <p>Days: <?php echo $dagar;?></p>
                <p>Distance driven: <?php echo $distance;?></p>
            </div>
        </div>
    </div>
    </form>
</body>
</html>