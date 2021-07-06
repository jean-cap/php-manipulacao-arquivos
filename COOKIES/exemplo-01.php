<?php
/**
 * Criando um Cookie
 */
$data = array('nome' => 'Jean');

setcookie('nome_do_cookie', json_encode($data), time() + 3600);

echo 'OK';