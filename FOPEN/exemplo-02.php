<?php
/**
 * Criando um arquivo CSV com dados da base de dados
 */
require_once 'config.php';

$sql = new Sql();
$usuarios = $sql->select('SELECT * FROM tb_usuarios ORDER BY deslogin');

$headers = array();

// Cria o cabeçalho:
foreach ($usuarios[0] as $key => $value) {
    array_push($headers, ucfirst($key));
}

$file = fopen('usuarios.csv', 'w+');

fwrite($file, implode(',', $headers) . "\r\n");

// Cria as linhas com dados:
foreach ($usuarios as $row) {
    $data = array();

    foreach ($row as $key => $value) {
        array_push($data, $value);
    }

    fwrite($file, implode(',', $data) . "\r\n");
}

fclose($file);