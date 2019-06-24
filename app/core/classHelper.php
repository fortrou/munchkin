<?php

class Helper
{

    public static function dump(...$vars) {
        echo '<pre>';
        foreach ($vars as $var) {
            var_dump($var);
        }
        echo '</pre>';
    }

    public static function escape_html($str) {
        return htmlspecialchars(strip_tags($str));
    }

}