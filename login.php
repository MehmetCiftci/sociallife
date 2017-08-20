<?php
session_start();
require_once('connect.php');

if(isset($_SESSION['id'])){
	echo "User already logged in. Try <a href='logout.php'>logging out</a>.<br>";
}


if(isset($_POST) & !empty($_POST)){
	$mail = mysqli_real_escape_string($connection, $_POST['inputMail']);
	$password = md5($_POST['inputPassword']);
	
	$sql = "SELECT * FROM user WHERE mail = '$mail' AND password = '$password'";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
	$resultid=mysqli_fetch_assoc($result);
	if($count == 1) {
		$_SESSION['id'] = $resultid['id'];
		$_SESSION['loggedIn'] = true;
		echo "Login successful<br>";

    	header('location: feed.php');  
	}else{
		echo "Invalid mail or password";
	}
}
?>

<html>
<head>
<title>Social Life</title>
  <link rel="stylesheet" href="css/loginstyle.css">

</head>
<body>
<div class="login">
<form method="POST">
	<h1>Please Login</h1>
	
				<input type="email" placeholder="Email" name="inputMail" required>
				<input type="password" placeholder="Password" name="inputPassword"  required>
				<button type="submit" class="btn btn-primary btn-block btn-large">Login</button>
	<a href="register.php">Register</a>
	
</form>
</div>


</body>
</html>
