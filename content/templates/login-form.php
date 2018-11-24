<?php 
	if(isset($_POST['go_login'])) {
		try {
			$this->authorize_user($_POST);
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
<?php get_header(); ?>
	<form action="" method="post">
		<input type="text" name="login">
		<br>
		<input type="password" name="password">
		<br>
		<input type="submit" name="go_login" value="login now">
		<br>
	</form>
<?php get_footer(); ?>