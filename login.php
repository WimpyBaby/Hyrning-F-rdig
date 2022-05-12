<?php
// session_start();
// session_destroy();
session_start();

	include("connection.php");
	//include("functions.php");
	
	$_SESSION['isLoggedin'] = false;

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$id = $_POST['id'];
		$password = $_POST['password'];
		$hash = password_hash($password, PASSWORD_DEFAULT);
		$epost = $_POST['epost'];
		$sql = "SELECT * FROM kund WHERE KundId = '$id' AND Password = '$hash' AND Epost = '$epost'";
		$sqlresult = mysqli_query($conn, $sql);
		if(!$sqlresult){
			return;
		}

		if(!empty($id) && !empty($password) && !empty($epost))
		{
			//read from database
			$query = "select * from kund where KundId = '$id'";
			$result = mysqli_query($conn, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					// if($user_data['Password'] === $password && $user_data['Epost'] == $epost)
					if(password_verify($password, $hash))
					{
						

						// $_SESSION['username'] = $user_data['KundId'];
						// $id = $_SESSION['username'];
						// $epost = $_SESSION['epost']; 
						// $adress = $_SESSION['adress'];
						// $postadress = $_SESSION['postadress']; 
						// $tel = $_SESSION['tel'];
						// $mobiltel = $_SESSION['mobiltel'];
						$_SESSION['isloggedin'] = true;
						$_SESSION['KundId'] = $id;
						$_SESSION['password'] = $_POST['password'];
						
												
						header("Location: home.php");
						//die;
					}
				}
			}
			echo '<div class="wrong">';
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
			echo '</div>';
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	<title>Login</title>
</head>
<body>
	<div class="container1">
		<div class="box">
			<form method="post">
				<h2>Login</h2>
				<input id="text" type="text" class="width" name="id" placeholder=" user id"><br><br>
				<input id="text" type="password" class="width" name="password" placeholder=" password"><br><br>
				<input id="text" type="text" class="width" name="epost" placeholder=" email"><br><br>

				<input id="button" type="submit" value="Login" class="button"><br><br>

				<a href="signup.php">Not A Member</a><br><br>
				<a href="index.php">Click to Return</a><br><br>
			</form>
		</div>
	</div>
</body>
</html>