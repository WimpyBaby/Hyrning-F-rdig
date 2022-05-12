<?php

include("connection.php");

session_start();

error_reporting(0);
ini_set('display_errors', 0);

if(isset($_SESSION['username'])) {
$user_name = $_SESSION['username']; 
$password = $_SESSION['password'];
$epost = $_SESSION['epost']; 
$adress = $_SESSION['adress'];
$postadress = $_SESSION['postadress']; 
$tel = $_SESSION['tel'];
$mobiltel = $_SESSION['mobiltel'];
$new_username = "";
$password = "";
$new_adress ="";
$new_mobiltel = "";
$new_tel = "";
$new_postadress = "";
$new_epost = "";
}
else {
    // header("location: index.php");
    // exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $new_username = $_SESSION['username'] = $_POST['username'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $new_epost = $_SESSION['epost'] = $_POST['epost'];
    $new_adress = $_SESSION['adress'] = $_POST['adress'];
    $new_postadress= $_SESSION['postadress'] = $_POST['postadress'];
    $new_tel = $_SESSION['tel'] = $_POST['tel'];
    $new_mobiltel = $_SESSION['mobiltel'] = $_POST['mobiltel'];
    $_SESSION['pass'] = $_POST['password'];
    $_SESSION['hash'] = $new_password;

    $updateSql = "UPDATE `kund` SET `KundNamn` = '$new_username', `Adress` = '$new_adress', `Postadress` = '$new_postadress', `Tel` = '$new_tel', `Mobiltel` = '$new_mobiltel', `Epost` = '$new_epost', `Password` = '$new_password' WHERE KundId = ".$_SESSION['KundId'];
    $updateResult = mysqli_query($conn, $updateSql);
    if($updateResult)
    {
        $update = true;
    }
    
}

else
    {
        $hashedPass = $_SESSION['hash'];
        $sql = "select * from kund where KundId = ".$_SESSION['KundId'];
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            $row = mysqli_fetch_assoc($result);
            $new_username = $row['KundNamn'];
            $new_adress = $row['Adress'];
            $new_postadress = $row['Postadress'];
            $new_tel = $row['Tel'];
            $new_mobiltel = $row['MobilTel'];
            $new_epost = $row['Epost'];
            $new_password = $row['Password'];

        }
    }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
    <title>Document</title>
</head>
<body>
    <div class="box2">
    <center>
        <h1> Update Your Profile </h1>

        <form action="" method="POST">
            <input id="text" value="<?php echo $new_username;?>" class="width" name="username" placeholder="Username"/></br>
            <input id="text" value="<?php echo $new_adress;?>" class="width" name="adress" placeholder="Adress"/></br>
            <input id="text" value="<?php echo $new_postadress;?>" class="width" name="postadress" placeholder="Postadress"/></br>
            <input id="text" value="<?php echo $new_tel;?>" class="width" name="tel" placeholder="Telefon"/></br>
            <input id="text" value="<?php echo $new_mobiltel;?>" class="width" name="mobiltel" placeholder="Mobil Telefon"/></br>
            <input id="text" value="<?php echo $new_epost;?>" class="width" name="epost" placeholder="Epost"/></br>
            <input id="text" class="width" name="password" placeholder="Password" type="password"/></br>
       
            
            <input type="submit" id="button" href="" value="update"></br>
            <a href="home.php">Return</a>
        </form>
    </center>
    </div>
</body>
</html>