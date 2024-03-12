<?php
$zipFile = 'sweetkaze.zip'; // Nombre del archivo ZIP
$extractPath = './'; // Carpeta donde se extraerán los archivos

// Crear una instancia de la clase ZipArchive
$zip = new ZipArchive();

// Abrir el archivo ZIP
if ($zip->open($zipFile) === true) {
    // Extraer todos los archivos en la carpeta especificada
    $zip->extractTo($extractPath);
    
    // Cerrar el archivo ZIP
    $zip->close();
    
    echo 'Extracción completada exitosamente.';
} else {
    echo 'No se pudo abrir el archivo ZIP.';
}
?>
