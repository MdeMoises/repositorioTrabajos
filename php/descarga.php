<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filepath = 'ruta/a/tu/archivo/' . $file;

    if (file_exists($filepath)) {
        // Define las cabeceras
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        
        // Limpia el búfer de salida
        ob_clean();
        flush();
        
        // Lee el archivo y envíalo al navegador
        readfile($filepath);
        exit;
    } else {
        echo "El archivo no existe.";
    }
} else {
    echo "No se ha especificado ningún archivo.";
}
?>