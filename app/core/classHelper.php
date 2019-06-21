<?php

class Helper
{

    public static function dump($var) {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }

    public static function escape_html($string) {
        return htmlspecialchars(strip_tags($string));
    }

}