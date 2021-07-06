<?php
/**
 * Carregando arquivo e exibindo
 */
$filename = 'mk.jpg';

$base64 = base64_encode(file_get_contents($filename));

$fileInfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $fileInfo->file($filename);
$imgEncoded = "data:$mimeType;base64,$base64";
?>

<a href="<?= $imgEncoded ?>" target="_blank">Link para imagem.</a>
<img src="<?= $imgEncoded ?>" alt="Mortal Kombat">