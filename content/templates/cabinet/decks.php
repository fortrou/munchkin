<?php get_header(); ?>
<?php 
	print('<table>
				<tr>
					<td>Deck Id</td>
					<td>Deck Author</td>
					<td>Deck Name</td>
					<td>Deck Image</td>
					<td>Deck Status</td>
				</tr>');
	foreach ($result as $value) {
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
				</tr>', $value["id"], $value["deck_author"], $value["deck_name"], $value["deck_image"], $value["deck_status"]);
	}
	print('</table>');
	


?>
<?php get_footer(); ?>