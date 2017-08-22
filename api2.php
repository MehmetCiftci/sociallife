<?php
session_start();
require_once('connect.php');



?>

<html>
<head>
<title>Social Life</title>
  <link rel="stylesheet" href="css/loginstyle.css">

</head>
<body>
<div class="login">
<form method="POST" action="api.php">
	<h1>Please Login</h1>

		<input type="tc" placeholder="api" name="inputApi" required>
		<input type="tc" placeholder="tc" name="inputTC" required>
		
		<button type="submit" class="btn btn-primary btn-block btn-large" >Login</button>


</form>
</div>

</body>
</html>
