<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		$epost = $_POST['epost'];
		$adress = $_POST['adress'];
		$postadress = $_POST['postadress'];
		$tel = $_POST['tel'];
		$mobiltel = $_POST['mobiltel'];

		$_SESSION['username'] = $_POST['user_name'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['epost'] = $_POST['epost'];
		$_SESSION['adress'] = $_POST['adress'];
		$_SESSION['postadress'] = $_POST['postadress'];
		$_SESSION['tel'] = $_POST['tel'];
		$_SESSION['mobiltel'] = $_POST['mobiltel'];

		
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name) && !empty($epost))
		{
			//save to database
			// $user_id = random_num(20);
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$_SESSION['hash'] = $hash;
			$query = "INSERT INTO kund (KundNamn, Adress, Postadress, Tel, MobilTel, Epost, Password) values ('$user_name', '$adress', '$postadress', '$tel', '$mobiltel', '$epost', '$hash')";

			if (mysqli_query($conn, $query)){

				header("location: test.php");
			die;
			}
			else{
				echo "Successful";

				header("Location: signup.php");
				die;
			}
			
		}else
		{
			echo "Please enter some valid information!";
		}
	}

?>


<!DOCTYPE html>
<html>
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
	<title>Signup</title>
</head>
<body>
	<div class="container1">
			<form method="post" action="signup.php">
				<h2>Sign Up</h2>
				<input id="text" type="text" name="user_name" class="width" placeholder=" Username" required><br><br>
				<input id="text" type="text" name="adress" class="width" placeholder=" Adress" required><br><br>
				<input id="text" type="text" name="postadress" class="width" placeholder=" Postadress"><br><br>
				<input id="text" type="tel" name="tel" class="width" placeholder=" Telefon" required><br><br>
				<input id="text" type="tel" name="mobiltel" class="width" placeholder=" MobilTel"><br><br>
				<input id="text" type="email" name="epost" class="width" placeholder=" Epost" required><br><br>
				<input id="text" type="password" name="password" class="width" placeholder=" Password"><br><br>
				<input id="text" type="password" name="password" class="width" placeholder=" Repeat Password"><br><br>

				<input id="button" type="submit" value="Signup" href="update.php"><br><br>

				<a href="login.php">Click to Login</a><br><br>
				<a href="index.php">Click to Return</a><br><br>
			</form>
	</div>
	</div>
</body>
</html>