<?php require_once("head.php"); ?>

<header>
	<h1>LOGO</h1>
    <ul>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>">Main</a>
        </li>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/user-list">Users</a>
        </li>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/decks">Decks</a>
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/decks">Deck List</a>
                </li>
                <li>
                    <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/deck_create">Create Deck</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/cards">Cards</a>
            <ul class="sub-menu">
                <li>
                    <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/cards">Card List</a>
                </li>
                <li>
                    <a href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet/card_create">Create Card</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">Settings</a>

        </li>
        <li>
            <a href="#">Logs</a>

        </li>
        <li>
            <a href="#">Search game</a>
        </li>
        <li>
            <a href="/goout.php">Sign out</a>
        </li>
    </ul>
</header>
