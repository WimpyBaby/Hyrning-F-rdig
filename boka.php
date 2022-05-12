<?php

include("connection.php");
session_start();
$_SESSION['rent'] = true;
$regnr = $_GET['regnr'];
$fromdate = $_GET['in'];
$todate = $_GET['out'];
$total = ((strtotime($todate)-strtotime($fromdate))/86400)+1;

$carRent = "SELECT * FROM bil INNER JOIN gruppbet ON bil.gruppbet = gruppbet.Gruppbet WHERE bil.Regnr = '$regnr'";
$carRes = mysqli_query($conn, $carRent);
$carRow = mysqli_fetch_assoc($carRes);

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
    <div class="CarName">
    <h1><?php echo $carRow['Marke'];?> <?php echo $carRow['Modell'];?> <?php echo $carRow['Arsmodell'];?></h1>
    </div>
    <section class="yourCar">
        <form class="yourCar-container" action="<?php echo 'confirm.php?regnr='.$regnr.'&in='.$fromdate.'&out='.$todate?>" method="post">
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Registration Number</h1>
                </div>
                <?php echo $carRow['Regnr'];?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Brand</h1>
                </div>
                <?php echo $carRow['Marke'];?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Model</h1>
                </div>
                <?php echo $carRow['Modell'];?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Mileage</h1>
                </div>
                <?php echo $carRow['Matarstallning'];?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Days</h1>
                </div>
                <?php echo $fromdate?> to <?php echo $todate?> (<?php echo $total?> dagar) 
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Cost</h1>
                </div>
                Total Cost: <?php echo intval($carRow['Forsakring'])*$total;?> kr (<?php echo $carRow['Forsakring'];?> kr/day)
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Short-term day</h1>
                </div>
                <?php echo $carRow['Korttiddygn']?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Short-term kilometers</h1>
                </div>
                <?php echo $carRow['korttidkm']?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Weekend</h1>
                </div>
                <?php echo $carRow['Veckoslut']?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Weekend kilometers</h1>
                </div>
                <?php echo $carRow['Veckoslutkm']?>
            </div>
            <div class="yourCar-box">
                <div class="yourCar-content">
                    <h1>Weekend free</h1>
                </div>
                <?php echo $carRow['Veckoslutfri']?>
            </div>
            <select id="options" name="hyrtyp">
                <option value="korttid">short term days</option>
                <option value="veckoslut">weekend</option>
                <option value="veckoslutfri">weekend free</option>
            </select>
            <br><input type="submit" value="Rent" class="button2"/></br>
            <input type="hidden" name="insurance" value="<?php echo intval($carRow['Forsakring'])*$total;?>"/>
    </form>
    </section>
</body>
</html>