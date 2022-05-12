<?php
include("connection.php");

// if ($_SESSION['isLoggedin'] = false){
//     header("location: start.php");
// }
session_start();
$error = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fromdate = $_POST["datefrom"];
    $todate = $_POST["dateto"];
    $check = strtotime($fromdate) <= strtotime($todate);
    $today = strtotime(date("Y/m/d"));
    if($today <= strtotime($fromdate) && $check==true){
        $error = false;
    }
    else{
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
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
<a href="home.php">Return</a>

<?php
            if($error){

                echo '
                <h1>Invalid Date</h1>';

            
            }else{
            $sql = "SELECT *, Forsakring, Korttiddygn, korttidkm, Veckoslut, Veckoslutkm, Veckoslutfri FROM `bil` INNER JOIN `gruppbet` ON bil.Gruppbet = gruppbet.Gruppbet WHERE `Regnr` not in ( SELECT `Regnr` FROM `hyr` WHERE `Indatum` and `Utdatum` BETWEEN '$fromdate' and '$todate' UNION SELECT `Regnr` FROM `hyr` WHERE `Utdatum` < '$fromdate' and  `Indatum` > '$todate')";
            $result = mysqli_query($conn, $sql);
echo '
<div class="table">
<h1>Available Cars</h1>
    <table class="car-data" style="margin-top: 5rem;">
    <thead>
    <tr>
    <th>Registration Number</th>
    <th>Brand</th>
    <th>Modell</th>
    <th>Årsmodell</th>
    <th>Mätarinställning</th>
    <th>Antal Dygn</th>
    <th>Försäkring</th>
    <th>Korttiddygn</th>
    <th>korttidkm</th>
    <th>Veckoslut</th>
    <th>Veckoslutkm</th>
    <th>Veckoslutfri</th>
    <th>Boka</th>
    </tr>
</thead>
<tbody>
';
while($row = mysqli_fetch_assoc($result))
{
                    echo "<tr>
                    <td>". $row['Regnr']. "</td>
                    <td>". $row['Marke']. "</td>
                    <td>". $row['Modell']. "</td>
                    <td>". $row['Arsmodell']. "</td>
                    <td>". $row['Matarstallning']. "</td>
                    <td>". $row['Antaldygn']. "</td>
                    <td>". $row['Forsakring']. "</td>
                    <td>". $row['Korttiddygn']. "</td>
                    <td>". $row['korttidkm']. "</td>
                    <td>". $row['Veckoslut']. "</td>
                    <td>". $row['Veckoslutkm']. "</td>
                    <td>". $row['Veckoslutfri']. "</td>
                    <td><a href='boka.php?regnr=".$row['Regnr']. "&in=".$fromdate."&out=".$todate."'>Rent</a></td>
                    </tr>
                    ";
                }
            }
            echo '
            </tbody>
    </table>
    </div>
            ';
            ?>
</body>
</html>