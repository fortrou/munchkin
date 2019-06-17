<?php
if(isset($_POST['create_card'])) {
	unset($_POST['create_card']);
	$cards->create_card($_POST);
}
get_header();
?>
<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="card_author" value="<?php echo $_SESSION['user']['id']; ?>">
	<br />
	<input type="text" name="card_name">
	<br />
	<textarea name="card_text" id="" cols="30" rows="10"></textarea>
	<br />
	<input type="number" name="card_value">
	<br />
	<select name="card_target" id="">
		<option value="1">На себя</option>
		<option value="2">На противника</option>
		<option value="3">Глобальная</option>
		<option value="4">На монстров</option>
		<option value="5">На карту</option>
	</select>
	<br />
	<select name="card_type" id="">
		<option value="1">Сокровище</option>
		<option value="2">Проклятие</option>
		<option value="3">Монстр</option>
	</select>
	<br />
	<select name="card_action" id="">
		<option value="0">Default</option>
	</select>
	<br />
	<input type="number" name="card_price">
	<br />
	<input type="text" class="additional" name="card_treasures">
	<br />
	<input type="text" class="additional" name="card_levels">
	<br />
	<input type="submit" name="create_card" value="Create Card">
	<br />
</form>

<script type="text/javascript">
	jQuery(document).ready(($) => {
		let $additionalFileds = $('.additional');

		$('select[name="card_type"]').on('change', function() {
			if($(this).val() == 3) {
				showAdditionalFields();
			} else hideAdditionalFields();
		})

		function showAdditionalFields() {
			$additionalFileds.fadeIn(500)
		}

		function hideAdditionalFields() {
			$additionalFileds.fadeOut(500)
		}
	})
</script>
<?php get_footer(); ?>