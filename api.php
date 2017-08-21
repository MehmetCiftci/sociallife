
<?php

require_once('connect.php');


	$tc_no = "45253442504";


	echo $tc_no;

	$sql = "SELECT name, surname, hobbies, birthday, sex FROM user WHERE (tcno like '$tc_no')";

	$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "name: " . $row["name"]. " - surname: " . $row["surname"]. " hobbies:" . $row["hobbies"]. " birthday:" . $row["birthday"]. " sex:" . $row["sex"]. "<br>";
    }
} else {
    echo "0 results";
}
$connection->close();
