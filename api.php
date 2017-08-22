
<?php

require_once('connect.php');


if(isset($_POST) & !empty($_POST)){
	$api = mysqli_real_escape_string($connection, $_POST['inputApi']);
	$tc = mysqli_real_escape_string($connection, $_POST['inputTC']);
	
	if ($api == "1122334455MA"){

	$sql = "SELECT * FROM user WHERE tcno = '$tc'";
	$results = mysqli_query($connection, $sql) or die(mysqli_error($connection));
	$count = mysqli_num_rows($results);
	$result=mysqli_fetch_assoc($results);

	//show result
	if($count == 0) {
	if (!isset($jsonResult)) $jsonResult = new stdClass();
		$jsonResult->sonuc = -2;
		$jsonResult->mesaj = "kişi bulunamadı";

	}	
	if($count == 1) {
	if (!isset($jsonResult)) $jsonResult = new stdClass();
		$jsonResult->sonuc = 1;
		$jsonResult->isim = $result['name'] . " " . $result['surname'];
		$jsonResult->hobiler = $result['hobbies'];
		$age = date_diff(date_create($result['birthday']), date_create('now'))->y;
		$jsonResult->yas = $age;
		$jsonResult->cinsiyet = $result['sex'];

	}

	}
	else{//wrong api

		if (!isset($jsonResult)) $jsonResult = new stdClass();
		$jsonResult->sonuc = -1;
		$jsonResult->mesaj = "yanlış api key";
	}



}

	if (!isset($jsonResult)) {
		$jsonResult = new stdClass();

		$jsonResult->sonuc = -3;
		$jsonResult->mesaj = "beklenmeyen hata";

	}

header('Content-Type: application/json');

	$Json = json_encode($jsonResult);
	echo $Json;

$connection->close();
?>
