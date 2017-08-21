<?php
session_start();
require_once('connect.php');

if(isset($_SESSION['id'])){
	echo "<h1>User already logged in. Try <a href='logout.php'>logging out</a>.<br></h1>";
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
		$_SESSION['loggedName'] = $resultid['name'] . ' ' . $resultid['surname'];
		echo "Login successful<br>";

    	echo " <meta http-equiv='refresh' content='0;URL=api.php'> ";  

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

		<input type="tc" placeholder="tc" name="inputtc" required>
		
		<button type="submit" class="btn btn-primary btn-block btn-large" >Login</button>


</form>
</div>

</body>
</html>
