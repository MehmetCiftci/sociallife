<?php
require_once('connect.php');

if(isset($_POST) & !empty($_POST)){
	$name = mysqli_real_escape_string($connection, $_POST['inputName']);
	$surname = mysqli_real_escape_string($connection, $_POST['inputSurname']);
	$tcno = mysqli_real_escape_string($connection, $_POST['inputTcno']);
	$mail = mysqli_real_escape_string($connection, $_POST['inputMail']);
	$password = md5($_POST['inputPassword']);

	$sql = "INSERT INTO user (name, surname, tcno, mail, password) VALUES ('$name', '$surname', '$tcno', '$mail', '$password')";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	if($result){
		echo "Register successfull.";
	}else{
		echo "Register failed.";
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
	<h1>Please Register</h1>

				<input type="text" name="inputName" placeholder="Name" required>

				<input type="text" name="inputSurname" placeholder="Surname" required>

				<input type="text" name="inputTcno" placeholder="TC No" required>

				<input type="email" name="inputMail" placeholder="Email" required>

				<input type="password" name="inputPassword" placeholder="Password" required>

				<button type="submit" class="btn btn-primary btn-block btn-large">Register</button>

	
</form>



<form action="login.php">
    <button type="submit" class="btn btn-primary btn-block btn-large" >Login </button>
</form>

</div>

</body>
</html>
