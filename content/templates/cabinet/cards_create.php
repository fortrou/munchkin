<form action="" method="post" enctype="multipart/form-data">
	<input type="hidden" name="card_author" value="<?php echo $_SESSION['user']['id']; ?>">
    <label>
        Название Карты
        <input type="text" name="card_name">
    </label>
    <label>
        Описание Карты
        <textarea name="card_text" id="" cols="30" rows="10"></textarea>
    </label>
    <label>
        <input type="number" name="card_value">
    </label>
    <label>
        Цель Карты
        <select name="card_target" id="">
            <option value="1">На себя</option>
            <option value="2">На противника</option>
            <option value="3">Глобальная</option>
            <option value="4">На монстров</option>
            <option value="5">На карту</option>
        </select>
    </label>
    <label>
        Тип Карты
        <select name="card_type" id="">
            <option value="1">Сокровище</option>
            <option value="2">Проклятие</option>
            <option value="3">Монстр</option>
        </select>
    </label>
    <label>
        Действие Карты
        <select name="card_action" id="">
            <option value="0">Default</option>
        </select>
    </label>
    <label>
        Стоимость Карты
        <input type="number" name="card_price">
    </label>
    <label class="additional">
        Кол-во Получаемых Сокровищ
        <input type="number" name="card_treasures">
    </label>
    <label class="additional">
        Кол-во Получаемых Уровней
        <input type="number" name="card_levels">
    </label>
    <button type="submit" name="create_card" value="create_card">
        <span>
            Create Card
        </span>
    </button>
</form>

<script type="text/javascript">
	jQuery(document).ready(($) => {
		let $additionalFileds = $('.additional');
		$('select[name="card_type"]').on('change', function() {
			if($(this).val() == 3) {
                $additionalFileds.fadeIn(500);
			} else $additionalFileds.fadeOut(500);
		});
	})
</script>