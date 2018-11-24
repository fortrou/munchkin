<?php get_header(); ?>

<?php
	$result = $this->get_usersList(0);
	echo "<table>";
	print('<tr>
				<td>Id</td>
				<td>Login</td>
				<td>Avatar</td>
				<td>Registation date</td>
				<td>Role</td>
				<td>Birthday</td>
			</tr>');
	foreach ($result as $value) {
		printf('<tr>
					<td>%s</td>
					<td>%s</td>
					<td><img src="%s" alt="" width="20" height="20"></td>
					<td>%s</td>
					<td>%s</td>
					<td>%s</td>
				</tr>', $value['id'], $value['user_login'], AVATARS . $value['user_avatar'], $value['user_regDate'], $value['user_role'], $value['user_birthday']);
	}
	echo "</table>";

?>




<?php get_footer(); ?>