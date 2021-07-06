<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="file-upload"><br>
    <input type="submit" value="Enviar">
</form>

<?php
/**
 * Upload de arquivo
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = $_FILES['file-upload'];

    if ($file['error']) {
        throw new Exception('Erro: ' . $file['error']);
    }

    $diretorioUpload = 'uploads';

    if (!is_dir($diretorioUpload)) {
        mkdir($diretorioUpload);
    }

    if (move_uploaded_file($file['tmp_name'], $diretorioUpload . DIRECTORY_SEPARATOR . $file['name'])) {
        echo 'Upload realizado com sucesso!';
    } else {
        throw new Exception('Não foi possível realizar o upload.');
    }
}
?>