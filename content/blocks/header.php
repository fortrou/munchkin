<?php require_once("head.php"); ?>

<header>
	<h1>LOGO</h1>
	<nav>
		<a href="<?php echo PROTOCOL . SITE_NAME; ?>">Main</a>
		<a href="#">About</a>
		<a href="#">Contacts</a>
		<?php if(!isset($_SESSION["user"])): ?>
			<a href="/authorization/login">Sign in</a>
			<a href="/authorization/registration">Sign up</a>
		<?php endif; ?>
    </nav>
</header>