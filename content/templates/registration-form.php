<?php 
	if(isset($_POST['register'])) {
		$appController->create_user($_POST);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>REGISTER</title>
</head>
<body>
	<form action="">
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