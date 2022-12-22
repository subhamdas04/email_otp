<!DOCTYPE html>
<html>
<head>
	<title>Email OTP Verification</title>
	<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

	<style type="text/css">
		.main{
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			width: 300px;
			height: auto;
			border: 1px solid red;
			border-radius: 10px;
		}
		.textbox{
			width: 90%;
			height: 30px;
			border: 1px solid #888;
			border-radius: 5px;
			outline: none;
			padding-left: 5px;
			margin-bottom: 20px;
		}
		.btn{
			width: 90%;
			height: 30px;
			border-radius: 10px;
			border: 0;
			background: green;
			cursor: pointer;
			color: white;
			font-size: 16px;
			outline: none;
			margin-bottom: 20px;
			margin-top: 20px;
		}
		.btn:active{
			background: red;
		}
		.over{
			display: none;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			position: fixed;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			background-color: rgba(0, 0, 0, 0.5);
		}
		.child{
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			background: white;
			border-radius: 10px;
			width: 400px;
			height: auto;
		}
	</style>

</head>
<body>
	<center>
		<div class="main">
			<h2>Signup</h2>
			<input type="text" name="fname" placeholder="Enter Full Name" class="textbox">
			<input type="email" name="email" placeholder="Enter Email" class="textbox">
			<input type="password" name="pass" placeholder="Enter Password" class="textbox">
			<button class="btn" id="signup">Signup</button>			
		</div>
	</center>

	<div class="over">
		<div class="child">
			<h2>OTP Verification</h2>
			<input type="text" name="otp" class="textbox" placeholder="Enter OTP">
			<a href="#">Resend OTP</a>
			<div>
				<button class="btn" id="verify" style="width: auto; padding: 0 10px 0 10px; margin-right: 30px;">Verify</button>
				<button class="btn" id="cancel" style="width: auto; padding: 0 10px 0 10px">Cancel</button>
			</div>
			<input type="text" name="temp" style="display: none;">
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#cancel').click(function(){
				document.getElementsByClassName("over")[0].style.display = "none";
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#signup').click(function(){
				var fname = document.getElementsByName("fname")[0].value;
				var email = document.getElementsByName("email")[0].value;

				$.ajax({
					type: "GET",
					url: "send_otp.php",
					data: {
						p: fname,
						q: email
					},
					success: function(data){
						if(data != "OTP could not be sent" || data != "Failed"){
							document.getElementsByClassName("over")[0].style.display = "flex";
							document.getElementsByName("temp")[0].value = data;
						}else{
							alert(data);
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#verify').click(function(){
				var a = document.getElementsByName("fname")[0].value;
				var b = document.getElementsByName("email")[0].value;
				var c = document.getElementsByName("pass")[0].value;
				var d = document.getElementsByName("otp")[0].value;
				var e = document.getElementsByName("temp")[0].value;

				$.ajax({
					type: "GET",
					url: "signup.php",
					data: {
						p: a,
						q: b,
						r: c,
						s: d,
						t: e
					},
					success: function(data){
						if(data == "Success"){
							alert("User registered successfully");
							location.reload();
						}else{
							alert(data);
						}
					}
				});

			});
		});
	</script>

</body>
</html>