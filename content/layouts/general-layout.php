<?php

if(!isset($_SESSION['user'])) {
    require_once(DOC_ROOT . '/content/blocks/header.php');
} else if($_SESSION['user']['user_role'] == 1) {
    require_once(DOC_ROOT . '/content/blocks/header-user.php');
} else if($_SESSION['user']['user_role'] == 2) {
    require_once(DOC_ROOT . '/content/blocks/header-admin.php');
}

require_once DOC_ROOT . '/content/templates/' . $template;

require_once(DOC_ROOT . '/content/blocks/footer.php');