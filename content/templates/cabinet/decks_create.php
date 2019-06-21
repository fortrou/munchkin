<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="deck_author" value="<?php echo $_SESSION['user']['id']; ?>">
	<label>
        <span>
            Название Колоды
        </span>
        <input type="text" name="deck_name">
    </label>
    <label>
        <span>
            Статус Колоды
        </span>
        <select name="deck_status" id="">
            <option value="1">Базовая</option>
            <option value="2">Дополнение</option>
            <option value="3">Кастомные</option>
        </select>
    </label>
    <button type="submit" name="create_deck" value="create_deck">
        <span>
            Create Deck
        </span>
    </button>
	<br>
</form>