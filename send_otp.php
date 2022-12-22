<?php
	$fname = $_GET['p'];
	$email = $_GET['q'];

	$con = mysqli_connect("localhost", "root", "", "subham");
	$sql = "select * from otp order by id desc limit 1";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) == 0){
		$id = 1;
	}else{
		while($row = mysqli_fetch_array($result)){
			$id = $row['id'];
			$id = $id + 1;
		}
	}

	$otp = rand(000000, 999999);
	$sql2 = "INSERT INTO otp (id, otp) VALUES ('$id', '$otp')";

	if(mysqli_query($con, $sql2)){
		require 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->Host = "smtp.hostinger.in";
		$mail->SMTPAuth = true;
		$mail->Username = "test@questain.com";
		$mail->Password = "Liveware_532";
		$mail->SMTPSecure = "ssl";
		$mail->Port = 465;

		$mail->setFrom("test@questain.com", "Liveware Games");
		$mail->addAddress($email, $fname);
		$mail->addReplyTo("test@questain.com", "Liveware Games");
		$mail->isHTML(true);

		$mail->Subject = "OTP Verification";
		$mail->Body = "<html>
							<head>
							<title>OTP Verification</title>
							</head>
							<body>
							<span>Dear, " . $fname . "</span>
							<span>Your OTP is " . $otp . "</span>
							<span>Thank You</span>
							</body>
							</html>";

		$mail->AltBody = "Your OTP is " . $otp;

		if(!$mail->send()){
			echo "OTP could not be sent";
		}else{
			echo $id;
		}
	}else{
		echo "Failed";
	}




?>