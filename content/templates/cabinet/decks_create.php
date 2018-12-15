<?php
if(isset($_POST["create_deck"])) {
	unset($_POST['create_deck']);
	$decks->create_deck($_POST);
}
get_header(); ?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="deck_author" value="<?php echo $_SESSION['user']['id']; ?>">
	<br>
	<input type="text" name="deck_name">
	<br>
	<!-- <input type="file" name="deck_image">
	<br> -->
	<input type="submit" name="create_deck" value="Create Deck">
	<br>
</form>
<?php get_footer(); ?>