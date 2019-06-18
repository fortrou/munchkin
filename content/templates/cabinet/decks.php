<?php get_header(); ?>

<?php $result = $this->get_decksArray(); ?>

<table>
	<tr>
		<td>Deck Id</td>
		<td>Deck Author</td>
		<td>Deck Name</td>
		<td>Deck Image</td>
		<td>Deck Status</td>
	</tr>
	<?php foreach ($result as $value): ?>
	<tr>
		<td>
			<?php echo $value["id"]; ?>
		</td>
		<td>
			<?php echo $value["deck_author"]; ?>
		</td>
		<td>
			<?php echo $value["deck_name"]; ?>
		</td>
		<td>
			<?php echo $value["deck_image"]; ?>
		</td>
		<td>
			<?php echo $value["deck_status"]; ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>

<?php get_footer(); ?>