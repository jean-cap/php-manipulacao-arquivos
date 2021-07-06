<?php
/**
 * Removendo arquivos
 */
$file = fopen('teste.txt', 'w+');
fclose($file);

// Remove o arquivo criado acima:
unlink('teste.txt');

echo 'Arquivo removido com sucesso';
