<?php
/**
 * Recuperando um Cookie
 */
if (isset($_COOKIE['nome_do_cookie'])) {
    $array = json_decode($_COOKIE['nome_do_cookie'], true);
    print_r($array);
}