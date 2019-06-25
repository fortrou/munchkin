<?php require_once("head.php"); ?>

<header>
    <img src="<?php echo PROTOCOL . SITE_NAME; ?>/content/images/logo.png" alt="">
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
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>authorization/sign_out">Sign out</a>
        </li>
    </ul>

    <a class="profile" href="<?php echo PROTOCOL . SITE_NAME; ?>cabinet">
        <span>
            <?php echo $_SESSION['user']['user_nickname']; ?>
        </span>
        <img src="<?php echo AVATARS . $_SESSION['user']['user_avatar']; ?>" alt="profile-img">
    </a>
</header>
<div class="content-wrapper">