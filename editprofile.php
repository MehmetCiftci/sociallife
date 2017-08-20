<?php
session_start();


if (!$_SESSION['loggedIn'])  
{  
    header('location: login.php');  
    exit;  
}

require_once('connect.php');


if(isset($_POST) & !empty($_POST)){
	$user_id = $_SESSION['id'];
	$name = mysqli_real_escape_string($connection, $_POST['inputName']);
	$surName = mysqli_real_escape_string($connection, $_POST['inputSurName']);
	$tel = mysqli_real_escape_string($connection, $_POST['inputTel']);
	$mail = mysqli_real_escape_string($connection, $_POST['inputMail']);
	$birthday = mysqli_real_escape_string($connection, $_POST['inputBirthday']);
	$sex = mysqli_real_escape_string($connection, $_POST['inputSex']);
	$hobbies = mysqli_real_escape_string($connection, $_POST['inputHobbies']);

	$sql = "UPDATE user SET name = '$name', surname = '$surName', tel = '$tel', mail = '$mail', birthday = '$birthday', sex = '$sex', hobbies = '$hobbies' WHERE id = '$user_id'";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	if($result){
		echo "Update successfull.";
	}else{
		echo "Update failed.";
	}
	
}

?>

<html>
<head>
<title>Social Life</title>
<link rel="stylesheet" type="text/css" href="css/mystyle.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="feed.php">My Feed</a>
  <a href="profile.php">Profile</a>
  <a class="active" href="editprofile.php">Edit Profile</a>
  <a href="search.php">Search</a>
  <a href="logout.php">Logout</a>
</div>

<form method="POST">
	<h2>Edit Profile</h2>
	<?php //get current values for input boxes
	$profileId = $_SESSION['id'];
	$sql = "SELECT * FROM user WHERE id = '$profileId'";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$row=mysqli_fetch_assoc($result);
	$curName = $row["name"];
	$curSurName = $row["surname"];
	$curTel = $row["tel"];
	$curMail = $row["mail"];
	$curBirthday = $row["birthday"];
	$curSex = $row["sex"];
	$curHobbies = $row["hobbies"];
	
	
	?>
	<table>
		<tr>
			<td>
				Name*
			</td>
			<td>
				<input type="text" name="inputName" value = "<?php echo $curName ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				Surname*
			</td>
			<td>
				<input type="text" name="inputSurName" value = "<?php echo $curSurName ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				Tel
			</td>
			<td>
				<input type="text" name="inputTel" value = "<?php echo $curTel ?>" >
			</td>
		</tr>
		<tr>
			<td>
				Mail*
			</td>
			<td>
				<input type="text" name="inputMail" value = "<?php echo $curMail ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				Birthday
			</td>
			<td>
				<input type="date" name="inputBirthday" value = "<?php echo $curBirthday ?>" >
			</td>
		</tr>
		<tr>
			<td>
				Sex
			</td>
			<td>
				<input type="text" name="inputSex" value = "<?php echo $curSex ?>" >
			</td>
		</tr>
		<tr>
			<td>
				Hobbies
			</td>
			<td>
				<input type="text" name="inputHobbies" value = "<?php echo $curHobbies ?>" >
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td align="right">
				<button type="submit">Edit</button>
			</td>
		</tr>	
	</table>
	
</form>


<a href="deleteaccount.php">DELETE MY ACCOUNT</a>

</body>
</html>
