<?php

include("connection.php");
session_start();
$regnr = $_GET['regnr'];
$fromdate = $_GET['in'];
$todate = $_GET['out'];
$insurance = $_POST['insurance'];
// $korttid = $_POST['insurance2'];
$hyrtyp = $_POST['hyrtyp'];
$kundId = $_SESSION['KundId'];
print_r($_POST);

if(isset($_SESSION['rent']) && $_SESSION['rent']==true){
    $insertSql = "INSERT INTO `hyr` (`KundId`, `Regnr`, `Utdatum`, `Indatum`, `Hyrtyp`) VALUES ($kundId, '$regnr', '$fromdate', '$todate', '$hyrtyp')";
    $insertResult = mysqli_query($conn, $insertSql);
    $_SESSION['rent'] = false;
}

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
    <div class="panel-container">
        <div class="panel2">
            <h2>Thank You For Your Order</h2>
            <div class="undertext2">
                <p>Reg Number: <?php echo $regnr;?></span></p>
                <p>Start Day: <?php echo $fromdate;?></span></p>
                <p>End Day: <?php echo $todate;?></span></p>
                <p>Insurance: <?php echo $insurance;?> kr</span></p>
                <p>Short-Time: <?php echo $kundId;?> kr</span></p>
            </div>
            <p><a href="history.php" class="button2">See Your History</a></p>
        </div> 
    </div>
</body>
</html>