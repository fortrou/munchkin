<?php
	if(isset($_POST['change'])) {
		try {
			Authorization::edit_user($_POST);
			header("Location:" . $_SERVER['REQUEST_URI']);
		} catch(Exception $e) {

		}
	}
?>
<?php get_header(); ?>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="text" name="login" value="<?php echo $_SESSION['user']['user_login']; ?>" disabled>
		<br>
		<img src="<?php echo AVATARS . $_SESSION['user']['user_avatar']; ?>" alt="" width="100" height="100">
		<br>
		<div class="avatar">
			<div class="upload">
				<input type="file" name="user_avatar" id="files">
			</div>
			<div class="preview" id="preview"></div>
		</div>
		
		<br>
		<input type="date" name="user_birthday" value="<?php echo $_SESSION['user']['user_birthday']; ?>">
		<input type="submit" name="change" value="Change">
		<br>
	</form>

	<script type="text/javascript">
		function handleFileSelect(evt) {
			var files = evt.target.files; // FileList object
			// Loop through the FileList and render image files as thumbnails.
			for (var i = 0, f; f = files[i]; i++) {
			// Only process image files.
				if (!f.type.match('image.*')) {
					continue;
				}
				var reader = new FileReader();
				// Closure to capture the file information.
				reader.onload = (function(theFile) {
					return function(e) {
						// Render thumbnail.
						var span = document.createElement('span');
						span.innerHTML = ['<img class="thumb" src="', e.target.result,
											'" title="', theFile.name, '"/>'].join('');
						document.getElementById('preview').insertBefore(span, null);
					};
				})(f);
				// Read in the image file as a data URL.
				reader.readAsDataURL(f);
			}
		}
		document.getElementById('files').addEventListener('change', handleFileSelect, false);
	</script>
<?php get_footer(); ?>