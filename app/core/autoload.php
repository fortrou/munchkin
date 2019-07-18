<?php

ini_set('display_errors','-1');

require_once "functions.php";

spl_autoload_register(function ($class) {
    if (false !== strpos($class, 'Controller')) {
        include APP_DIR . '/controllers/class' . $class . '.php';
    } else if (false !== strpos($class, 'Model')) {
        include APP_DIR . '/models/class' . $class . '.php';
    } else if (false !== strpos($class, 'View')) {
        include APP_DIR . '/views/class' . $class . '.php';
    } else {
        include APP_DIR . '/core/class' . $class . '.php';
    }
});