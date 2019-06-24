<?php require_once("head.php"); ?>

<header>
    <h1>LOGO</h1>
    <ul>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>">Main</a>
        </li>
        <li>
            <a href="#">My decks</a
        </li>
        <li>
            <a href="#">Contacts</a>
        </li>
        <li>
            <a href="#">Search game</a>
        </li>
        <li>
            <a href="<?php echo PROTOCOL . SITE_NAME; ?>/authorization/sign_out">Sign out</a>
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