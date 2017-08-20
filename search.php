<?php
session_start();


if (!$_SESSION['loggedIn'])  
{  
    header('location: login.php');  
    exit;  
}

require_once('connect.php');





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
  <a href="editprofile.php">Edit Profile</a>
  <a class="active" href="search.php">Search</a>
  <a href="logout.php">Logout</a>
</div>

<div class="login">
<form method="POST">
	<h1>Search people</h1>
				<input type="text" name="inputName" required>
			<td align="right">
				<button type="submit" class="btn btn-primary btn-block btn-large">Search</button>
			

	
</form>
</div>


<table>
<?php
//search people
if(isset($_POST) & !empty($_POST)){
	$searchName = mysqli_real_escape_string($connection, $_POST['inputName']);
	$sql = "SELECT id, concat(name , ' ' ,surname) as fullname FROM user WHERE CONCAT(name, ' ', surname) LIKE '%$searchName%'";
	
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$count = mysqli_num_rows($result);
	
	if ($count == 0){
		echo "No result found.";
	}else{
		echo $count;
		echo " result(s) found.";
		while($row=mysqli_fetch_assoc($result)){
			echo "<tr><td>";
			echo "<a href='profile.php?id=";
			echo $row["id"];
			echo "'>";
			echo $row["fullname"];
			echo "</a>";
			echo "</td></tr>";
		}
	}
	

}
?>
</table>

</body>
</html>
