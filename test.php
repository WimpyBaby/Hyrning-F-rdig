<?php
session_start();
// print_r($_SESSION);
include("connection.php");
$user_name = $_SESSION['username'];
$password = $_SESSION['password'];
$epost = $_SESSION['epost'];
$adress = $_SESSION['adress'];
$postadress = $_SESSION['postadress'];
$tel = $_SESSION['tel'];
$mobiltel = $_SESSION['mobiltel'];
$hash = $_SESSION['hash'];


$sql = "SELECT * FROM kund WHERE '$user_name' = KundNamn and '$hash' = Password and '$adress' = Adress and '$epost' = Epost and '$tel' = Tel and '$mobiltel' = MobilTel";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
  <title>Document</title>
</head>
<body>
<form>
  <div class="id">
      <p>Your Id is: <h2><span><?php echo $row['KundId'];?></span></h2></p>
      <a href="login.php"></a>
      <br><a href="login.php">Return to login</a></br>
  </div>
</form>
<?php }?>
</body>
</html>