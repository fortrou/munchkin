<?php require_once("head.php"); ?>
<div class="header">
	<div class="logo header-element">
		<h1>LOGO</h1>
	</div>
	<div class="menu header-element">
		<ul>
			<li class="menu-item"><a href="<?php echo PROTOCOL . SITE_NAME; ?>">Main</a></li>
			<li class="menu-item"><a href="#">About</a></li>
			<li class="menu-item"><a href="#">Contacts</a></li>
			<?php if(!isset($_SESSION["user"])): ?>
				<li class="menu-item"><a href="/login">Sign in</a></li>
				<li class="menu-item"><a href="/registration">Sign up</a></li>
			<?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div>