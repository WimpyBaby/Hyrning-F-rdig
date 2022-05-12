<?php

session_start();

// print_r($_SESSION);

include "../connection.php";
$utdatum = $_POST['utdatum'];
$indatum = $_POST['indatum'];
$fuel = $_POST['fuel'];
$id = $_POST['kundid'];

$hyrtyp = $_POST['hyrtyp'];
$dagar = ((strtotime($indatum)-strtotime($utdatum))/86400)+1;

$reg = $_GET['regnr'];

$sql = "SELECT * FROM kund WHERE '$id' = KundId";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$sql2 = "SELECT * FROM bil WHERE '$reg' = Regnr";
$result2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_assoc($result2);

$sql3 = "SELECT * FROM gruppbet WHERE '".$row2['Gruppbet']."' = Gruppbet";
$result3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_assoc($result3);


$sql4 = "SELECT * FROM hyr WHERE `KundId` = '$id'";
$result4 = mysqli_query($conn, $sql4);
$row4 = mysqli_fetch_assoc($result4);

// $row3['korttidkm'];
$distance = $_POST['matar'] - $row2['Matarstallning'];

$gruppSql = "SELECT *, Forsakring, Korttiddygn, Korttidkm, Veckoslut, Veckoslutkm, Veckoslutfri FROM bil INNER JOIN gruppbet ON bil.Gruppbet = gruppbet.Gruppbet WHERE bil.Regnr = '$reg'";
$gruppRes = mysqli_query($conn, $gruppSql);
$gruppRow = mysqli_fetch_assoc($gruppRes);

// echo $gruppRow['korttidkm'];

switch ($hyrtyp){
    case 'korttid':
        $kmCost = intval($gruppRow['korttidkm']*$distance);
        // $rentType = 'Korttiddygn';
        $kCost = intval($gruppRow['Korttiddygn']*$dagar);

        break;
    case 'veckoslut':
        $kmCost = intval($gruppRow['Veckoslutkm']*$distance);
        $rentType = 'Veckoslut';
        $kCost = intval($gruppRow['Veckoslut']*$dagar);
        break;
    case 'veckoslutfri';
        $kmCost = (intval($gruppRow['Veckoslutfri']));
        $rentType = 'Veckoslutfri';
        $kCost = intval($gruppRow['Veckoslutfri']*$dagar);
    break;  
}

$total = $kmCost + $kCost + $row3['Forsakring']*$dagar;

$hyrSql = "UPDATE hyr SET `AntalKm`='$distance', `Kostnad`='$total', `Bensinkostnad`='$fuel' WHERE `KundId`= '$id' AND `Regnr`='$reg' AND `Utdatum`='$utdatum' AND `Indatum` = '$indatum'";
$hyrresult = mysqli_query($conn, $hyrSql);

// echo $hyrSql;

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
    <h1>Payments</h1>
    <a href="../home.php">Home Page</a>
    <a href="index.php">Logout</a>
    <a href="uthyrdabil.php">Return</a>
    <div class="container5">
    <form action="kvitto.php" method="post" target="_blank">
    <img src="../bilder/logo2.png">
            <h1>Hi, <span><?php echo $row['KundNamn'];?></span></h1>
            <h2>Thank you for ordering with Wimpy Rentals</h2>
            <div class="info">
            <div class="info2">
                <h2>Customer Info</h2>
                <p><label>Kund Id: <?php echo $id ;?></label></p>
                <input type="hidden" name="kundid" value="<?php echo $id;?>">
                <p>Name: <?php echo $row['KundNamn'];?></p>
                <input type="hidden" name="kundnamn" value="<?php echo $row['KundNamn'];?>">
                <p>Adress: <?php echo $row['Adress'];?></p>
                <input type="hidden" name="adress" value="<?php echo $row['Adress'];?>">
                <p>Postadress: <?php echo $row['Postadress'];?></p>
                <input type="hidden" name="post" value="<?php echo $row['Postadress'];?>">
                <p>Telefon: <?php echo $row['Tel'];?></p>
                <input type="hidden" name="tel" value="<?php echo $row['Tel'];?>">
                <input type="hidden" name="utdatum" value="<?php echo $utdatum;?>">
                <input type="hidden" name="indatum" value="<?php echo $indatum;?>">
            </div>
            <div class="info2">
                <h2>Costs</h2>
                <p><label>Insurance: <?php echo $row3['Forsakring'] * $dagar;?> kr</label></p>
                <input type="hidden" name="forsakring" value="<?php echo $row3['Forsakring'] * $dagar;?>">
                <p>Km Cost: <?php echo $kmCost;?> kr</p>
                <input type="hidden" name="kmcost" value="<?php echo $kmCost;?>">
                <p>Rent Cost: <?php echo $kCost;?> kr</p>
                <input type="hidden" name="kcost" value="<?php echo $kCost;?>">
                <p>Fuel Cost: <?php echo $fuel?></p>
                <input type="hidden" name="fuel" value="<?php echo $fuel;?>">
                <p>Total Cost: <?php echo $kmCost + $kCost + $row3['Forsakring']*$dagar;?></p>
                <input type="hidden" name="total" value="<?php echo $kmCost + $kCost + $row3['Forsakring']*$dagar;?>">
            </div>
            <div class="info2">
                <h2>Rent Information</h2>
                <p><label>Registration Number: <?php echo $reg;?></label></p>
                <input type="hidden" name="reg" value="<?php echo $reg;?>">
                <p>Booking time: <?php echo $row4['Bokningsdatum'];?> kr</p>
                <input type="hidden" name="bok" value="<?php echo $row4['Bokningsdatum'];?>">
                <p>Outdate: <?php echo $utdatum;?> kr</p>
                <p>Indate: <?php echo $indatum?></p>
                <p>Rent Type: <?php echo $hyrtyp;?></p>
                <p>Days: <?php echo $dagar;?></p>
                <p>Distance driven: <?php echo $distance;?></p>
                <input type="hidden" name="distance" value="<?php echo $distance;?>">
            </div>
        </div>
        <!-- <a href="kvitto.php" target="blank" class="reciept">Reciept</a> -->
        <input type="submit" value="View reciept" class="button2">
        <p>(Registrer the costs and print out a reciept)</p>
    </form>
    </div>
</body>
</html>