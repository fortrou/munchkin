<h1>
    <?php echo "Hello, {$_SESSION['user']['user_nickname']}"; ?>
</h1>

<form action="" method="post" enctype="multipart/form-data">
    <label>
	    <input type="text" name="login" value="<?php echo $_SESSION['user']['id']; ?>" disabled hidden>
    </label>
    <label>
        <input type="text" name="user_nickname" value="<?php echo $data['user_nickname']; ?>">
    </label>
	<img src="<?php echo AVATARS . $data['user_avatar']; ?>" alt="avatar" width="100" height="100">
	<br>
	<div class="avatar">
		<div class="upload">
			<input type="file" name="user_avatar" id="files" accept="image/*">
		</div>
		<div class="preview" id="preview"></div>
	</div>

	<br>
	<input type="date" name="user_birthday" value="<?php echo $data['user_birthday']; ?>">
	<input type="submit" name="change" value="Change">
	<br>
</form>

<script type="text/javascript">
    jQuery(document).ready(($) => {
        $('#files').on('change', function () {
            let file = $(this)[0].files[0];

            if (file.type.match(/image.*/)) {
                let reader = new FileReader();
                reader.onload = (function (theFile) {
                    return function (e) {
                        let elem = `<img class="thumb" alt="thumbnail" src="${e.target.result}" title="${theFile.name}"/>`;
                        $('#preview').empty().append(elem);
                    };
                })(file);
                reader.readAsDataURL(file);
            }
        })
    })
</script>