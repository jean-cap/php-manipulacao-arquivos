<?php
/**
 * Download de arquivo
 */
$link = 'https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png';

$conteudo = file_get_contents($link);

$info = parse_url($link);

$nomeArquivo = basename($info['path']);

$file = fopen($nomeArquivo, 'w+');

fwrite($file, $conteudo);

fclose($file);
?>

<img src="<?= $nomeArquivo ?>" alt="Logo Google">
