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
<link rel="stylesheet" href="css/loginstyle.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <a>
  <?php 
  echo $_SESSION['loggedName'];
  ?>
  	
  </a>
  <a href="feed.php">My Feed</a>
  <a href="profile.php">Profile</a>
  <a class="active" href="editprofile.php">Edit Profile</a>
  <a href="search.php">Search</a>
  <a href="logout.php">Logout</a>
</div>

<div class="login">
<form method="POST">
	<h1>Edit Profile</h1>
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
				<font color="white">
				Name*
				</font>
			</td>
			<td>
				<input type="text" name="inputName" value = "<?php echo $curName ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Surname*
				</font>
			</td>
			<td>
				<input type="text" name="inputSurName" value = "<?php echo $curSurName ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Tel
				</font>
			</td>
			<td>
				<input type="text" name="inputTel" value = "<?php echo $curTel ?>" >
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Mail*
				</font>
			</td>
			<td>
				<input type="text" name="inputMail" value = "<?php echo $curMail ?>" required>
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Birthday
				</font>
			</td>
			<td>
				<input type="date" name="inputBirthday" value = "<?php echo $curBirthday ?>" >
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Sex
				</font>
			</td>
			<td>
				<select name="inputSex">
   					<option value="-">Select Sex</option>
					<?php
						if ($curSex == 'male') {
						echo "<option value='male' selected='selected'>Male</option>";
					}else{
						echo "<option value='male'>Male</option>";
					}
						if ($curSex == 'female') {
						echo "<option value='female' selected='selected'>Female</option>";
					}else{
						echo "<option value='female'>Female</option>";
					}


			?>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<font color="white">
				Hobbies
				</font>
			</td>
			<td>
				<input type="text" name="inputHobbies" value = "<?php echo $curHobbies ?>" >
			</td>
		</tr>
		<tr>
			<td>
			</td>
			<td align="right">
				<button type="submit" class="btn btn-primary btn-block btn-large" >Edit</button>
			</td>
		</tr>	
	</table>
	
</form>
<form action="deleteaccount.php">
    <button type="submit" class="btn btn-primary btn-block btn-large btn-red" >DELETE MY ACCOUNT</button>
</form>
</div>


</body>
</html>
