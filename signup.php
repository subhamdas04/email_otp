<?php 
	$fname = $_GET['p'];
	$email = $_GET['q'];
	$pass = $_GET['r'];
	$otp = $_GET['s'];
	$temp = $_GET['t'];

	$con = mysqli_connect("localhost", "root", "", "subham");
	$sql = "select * from otp where id='$temp' limit 1";
	$result = mysqli_query($con, $sql);

	while($row = mysqli_fetch_array($result)){
		$otp2 = $row['otp'];
	}

	if($otp == $otp2){
		$sql2 = "INSERT INTO signup (fname, email, pass) VALUES ('$fname', '$email', '$pass')";

		if(mysqli_query($con, $sql2)){
			echo "Success";
		}else{
			echo "Error";
		}
	}else{
		echo "Wrong otp entered";
	}


 ?>