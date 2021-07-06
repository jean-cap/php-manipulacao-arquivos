<?php
/**
 * Excluindo todos os arquivos num diretório
 */
$nomeDiretorio = 'images';

if (!is_dir($nomeDiretorio)) {
    mkdir($nomeDiretorio);
}

foreach (scandir($nomeDiretorio) as $item) {
    if (!in_array($item, array('.', '..'))) {
        unlink($nomeDiretorio . DIRECTORY_SEPARATOR . $item);
    }
}

echo 'OK';