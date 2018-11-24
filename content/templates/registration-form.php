<?php 
	if(isset($_POST['register'])) {
		try {
			$this->create_user($_POST);
		} catch (Exception $e) {
			switch ($e->getMessage()) {
				case "e_1":
					$error = "Empty form data";
					break;
				case "e_2":
					$error = "Login already exists";
					break;
				case "e_3":
					$error = "Incorrect data input";
					break;
				default:
					$error = "Unknown error";
			}
			print($error);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>REGISTER</title>
</head>
<body>
	<form action="" method="post">
		<input type="text" name="login">
		<br>
		<input type="password" name="password">
		<br>
		<input type="password" name="password_repeat">
		<br>
		<input type="submit" name="register" value="Register">
		<br>
	</form>
</body>
</html>