<table>
	<tr>
		<td>Id</td>
		<td>Login</td>
		<td>Avatar</td>
		<td>Registation date</td>
		<td>Role</td>
		<td>Birthday</td>
	</tr>
	<?php foreach ($data as $value): ?>
	<tr>
		<td>
			<?php echo $value['id']; ?>
		</td>
		<td>
			<?php echo $value['user_login']; ?>
		</td>
		<td>
			<img src="<?php echo AVATARS . $value['user_avatar']; ?>" alt="" width="30" height="30">
		</td>
		<td>
			<?php echo $value['user_regDate']; ?>
		</td>
		<td>
			<?php echo $value['user_role']; ?>
		</td>
		<td>
			<?php echo $value['user_birthday']; ?>
		</td>
	</tr>
	<?php endforeach; ?>
</table>