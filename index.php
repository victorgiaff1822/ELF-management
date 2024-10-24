<?php

	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$name = $_POST['name'];
		$password = $_POST['password'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$userAgent = $_SERVER['HTTP_USER_AGENT'];

		$servername = "localhost";
		$username = "root";
		$passwordMySql = "";
		$dbname = "logins";

		$conn = new mysqli($servername, $username, $passwordMySql, $dbname);

		if ($conn->connect_error) {
			die('Error: ' . mysqli_error($conn));
		} else {
			$sql = 'SELECT * FROM users WHERE name="'.$name.'"'.'AND password="'.$password.'"';
			$result = $conn->query($sql);

			if($result->num_rows > 0)
			{
				//$sql = "UPDATE `users` SET `ip` = '".$ip."' AND SET `useragent` = ".$userAgent." WHERE `users`.`name` = 1";
				$sql = "UPDATE `users` SET `ip` = '".$ip."', `useragent`='".$userAgent."' WHERE `users`.`name`='".$name."'";
				$result = $conn->query($sql);
				if (!mysqli_query($conn,$sql))
				{
					die('Error: ' . mysqli_error($conn));
				}
				header('Location: /workskjhgkjhgkjhgkaaaaaaaaaaaaaaapace.html');
			} else {
				//echo $result->num_rows;
				header('Location: /basdf.html');
			}
		}

	}

	//header('Location: '.$uri.'/index.html');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ELF | Login</title>
		<link rel="stylesheet" type="text/css" href="style.css">

		<script>
			function collectFingerprint() {
				var userAgent = navigator.userAgent;

				document.getElementById('user_agent').value = userAgent;
			}
		</script>
	</head>

	<body onload="collectFingerprint()">
		<img src="ELF.png" style="height: 190px;">

		<div id="login-box">
			<h1>Login here</h1>

			<form method="POST" action="">
				<label for="name">Enter your name:</label><br>
				<input type="text" id="name" name="name" required><br><br>

				<label for="password">Enter your password:</label><br>
				<input type="password" id="password" name="password" required><br><br>
				
				<input type="hidden" id="user_agent" name="user_agent">

				<input type="submit" value="Submit">
			</form>

		</div>

	</body>
</html>