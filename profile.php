<?php
session_start();


if (!$_SESSION['loggedIn'])  
{  
    header('location: login.php');  
    exit;  
}

require_once('connect.php');



//send post
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
</head>
<body>

<div class="topnav" id="myTopnav">
  <a href="feed.php">My Feed</a>
  <a class="active" href="profile.php">Profile</a>
  <a href="editprofile.php">Edit Profile</a>
  <a href="search.php">Search</a>
  <a href="logout.php">Logout</a>
</div>


<?php
	if(isset($_GET['id'])) {
		$getId = mysqli_real_escape_string($connection, $_GET['id']);
	}
	if(!isset($getId) || $_SESSION['id'] == $getId) { //if its your profile
		$profileId = $_SESSION['id']; //set profileId to show content
		
		//show post content form
		echo '<form method="POST">';
		echo "<h3>What's on your mind?</h3>";
		echo "<table>";
		echo "<tr>";
		echo "<td>";
		echo "<input type='text' name='inputBody' required>";
		echo "</td>";
		echo "<tr>";
		echo "<td>";
		echo "</td>";
		echo "<td align='right'>";
		echo "<button type='submit'>Share</button>";
		echo "</td>";
		echo "</tr>";
		echo "</table>";
		echo "</form>";
		
	}else{//if its other people's profile
		$profileId = $getId;
	}

	$sql = "SELECT * FROM post WHERE user_id = '$profileId' ORDER BY created_at DESC";
	$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	
	echo "<table>";
	while($row=mysqli_fetch_assoc($result)){// show posts
		echo "<tr><td>";
		echo $row["body"];
		echo "</td></tr>";
		echo "<tr><td>Posted at: </td><td align='right'>";
		echo $row["created_at"];
		echo "</td></tr>";
	}
	echo "</table>";
	


?>

</body>
</html>
