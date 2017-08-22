<?php
session_start();


if (!$_SESSION['loggedIn'])  
{  
    header('location: /login.php');  
    exit;  
}

require_once('connect.php');


if(isset($_POST) & !empty($_POST)){
	$user_id = $_SESSION['id'];
	$body = mysqli_real_escape_string($connection, $_POST['inputBody']);

	$sql = "INSERT INTO post (user_id, body) VALUES ('$user_id', '$body')";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	if($result){
		echo "Post successfull.";
	}else{
		echo "Post failed.";
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
  <a class="active" href="feed.php">My Feed</a>
  <a href="profile.php">Profile</a>
  <a href="editprofile.php">Edit Profile</a>
  <a href="search.php">Search</a>
  <a href="logout.php">Logout</a>
</div>



<table >
<?php
	$profileId = $_SESSION['id'];
	$sql = "SELECT post.body, post.created_at, user.name, user.surname FROM post INNER JOIN user ON post.user_id = user.id ORDER BY post.created_at DESC";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	
	while($row=mysqli_fetch_assoc($result)){
		echo "<tr><td>";
		echo $row["body"];
		echo "</td></tr>";
		echo "<tr><td><font size='1' >Posted by: </font></td><td align='right'>";
		echo $row["name"];
		echo " ";
		echo $row["surname"];
		echo "</td></tr>";
		echo "<tr><td><font size='1' >Posted at: </font></td><td align='right'>";
		echo $row["created_at"];
		echo "</td></tr>";
	}
	


?>
</table>
</body>
</html>
