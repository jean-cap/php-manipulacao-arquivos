<?php
/**
 * Criando e removendo diretórios
 */
$name = 'images';

if (!is_dir($name)) {
    mkdir($name);
    echo "O diretório <strong>$name</strong> foi criado com sucesso!";
} else {
    rmdir($name);
    echo "O diretório <strong>$name</strong> já existe e foi removido!";
}