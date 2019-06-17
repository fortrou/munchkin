<?php
if(isset($_POST["create_deck"])) {
	unset($_POST['create_deck']);
	$decks->create_deck($_POST);
}
get_header();
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="deck_author" value="<?php echo $_SESSION['user']['id']; ?>">
	<br>
	<input type="text" name="deck_name">
	<br>
	<select name="deck_status" id="">
		<option value="1">Базовая</option>
		<option value="2">Дополнение</option>
		<option value="3">Кастомные</option>
	</select>
	<input type="submit" name="create_deck" value="Create Deck">
	<br>
</form>
<?php get_footer(); ?>