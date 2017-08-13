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
</head>
<body>

<form method="POST">
	<h2>Please Register</h2>
	<table>
		<tr>
			<td>
				Name
			</td>
			<td>
				<input type="text" name="inputName" required>
			</td>
		</tr>
		<tr>
			<td>
				Surname
			</td>
			<td>
				<input type="text" name="inputSurname" required>
			</td>
		</tr>
		<tr>
			<td>
				TC No
			</td>
			<td>
				<input type="text" name="inputTcno" required>
			</td>
		</tr>
		<tr>
			<td>
				Email
			</td>
			<td>
				<input type="email" name="inputMail" required>
			</td>
		</tr>
		<tr>
			<td>
				Password
			</td>
			<td>
				<input type="password" name="inputPassword" required>
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td align="right">
				<button type="submit">Register</button>
			</td>
		</tr>	
	</table>
	<a href="login.php">Login</a>
	
</form>



</body>
</html>
