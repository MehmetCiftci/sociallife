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
</head>
<body>

<form method="POST">
	<h3>Search people</h3>
	<table>
		<tr>
			<td>
				<input type="text" name="inputName" required>
			</td>
		<tr>
			<td>
			</td>
			<td align="right">
				<button type="submit">Search</button>
			</td>
		</tr>	
	</table>
	
</form>



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
