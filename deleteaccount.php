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
	
	if($_POST['sure'] == "sure"){

		$sql = "DELETE FROM post WHERE user_id = '$user_id'";
		$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		if($result){
			echo "Posts delete successfull.";
		}else{
			echo "Posts delete failed.";
		}
		$sql = "DELETE FROM user WHERE id = '$user_id'";
		$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
		if($result){
			echo "User delete successfull.";
			header('location: logout.php');
		}else{
			echo "User delete failed.";
		}
		
	}
}

?>

<html>
<head>
<title>Social Life</title>
</head>
<body>

<form method="POST">
	<h2>Delete Account</h2>

				Are you sure to delete your account?<br>
				This action can not be undone.<br>
				<input type="checkbox" name="sure" value="sure">I'm sure.<br>
				<button type="submit">DELETE</button>

	
</form>



</body>
</html>
