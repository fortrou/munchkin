<?php get_header(); ?>

<?php $result = $this->get_cardsArray(); ?>

    <table id="cards-list">
        <tr>
            <td>Card Id</td>
            <td>Card Author</td>
            <td>Card Name</td>
            <td>Card Text</td>
            <td>Card Art</td>
            <td>Card Value</td>
            <td>Card Target</td>
            <td>Card Type</td>
            <td>Card Action</td>
            <td>Card Price</td>
            <td>Card Treasures</td>
            <td>Card Levels</td>
        </tr>
        <?php foreach ($result as $value): ?>
            <tr>
                <td>
                    <?php echo $value["id"]; ?>
                </td>
                <td>
                    <?php echo $value["card_author"]; ?>
                </td>
                <td>
                    <?php echo $value["card_name"]; ?>
                </td>
                <td>
                    <?php echo $value["card_text"]; ?>
                </td>
                <td>
                    <?php echo $value["card_art"]; ?>
                </td>
                <td>
                    <?php echo $value["card_value"]; ?>
                </td>
                <td>
                    <?php echo $value["card_target"]; ?>
                </td>
                <td>
                    <?php echo $value["card_type"]; ?>
                </td>
                <td>
                    <?php echo $value["card_action"]; ?>
                </td>
                <td>
                    <?php echo $value["card_price"]; ?>
                </td>
                <td>
                    <?php echo $value["card_treasures"]?: '-'; ?>
                </td>
                <td>
                    <?php echo $value["card_levels"]?: '-'; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php get_footer(); ?>