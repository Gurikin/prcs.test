<?php
/**
 * Created by PhpStorm.
 * User: gurik
 * Date: 11.09.2018
 * Time: 7:09
 */

namespace app\models;


class Utils
{
    public static function debug($data) {
        $script = $_SERVER['REQUEST_URI'];
        echo "<pre><h1>Дебажим...</h1><hr>";
        $type = gettype($data);
        $name = Utils::print_var_name($data);
        echo "<h3>Выполненяем $script. Переменная имеет тип $type и содержит:</h3>";
        var_dump($data);
        echo "<hr><h1>Не дебажим...</h1></pre>";
    }

    public static function print_var_name($var) {
        foreach($GLOBALS as $var_name => $value) {
            if ($value === $var) {
                return $var_name;
            }
        }
        return false;
    }

}