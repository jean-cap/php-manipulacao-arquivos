<?php
/**
 * Lendo os arquivos e informações dos arquivos em um diretório
 */
$host = 'http://' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
$images = scandir('images');
$data = array();

foreach ($images as $img) {
    if (!in_array($img, array('.', '..'))) {
        $filename = 'images' . DIRECTORY_SEPARATOR . $img;
        $info = pathinfo($filename);
        $info['size'] = filesize($filename);
        $info['modified'] = date('d/m/Y H:i:s', filemtime($filename));
        $info['url'] = $host . '/' . str_replace('\\', '/', $filename);
        array_push($data, $info);
    }
}

var_dump($data);
