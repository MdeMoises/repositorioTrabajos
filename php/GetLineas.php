<?php
require("main.php");

$idArea = limpiar_cadena($_POST['area_id']); // Asegúrate de que estás pasando el área si es necesario

$lineas = conexion();
$lineas = $lineas->query("SELECT DISTINCT linea_investigacion.linea_id, linea_investigacion.linea_nombre 
                        FROM linea_investigacion, linea_x_area 
                        WHERE linea_investigacion.linea_id = linea_x_area.linea_id 
                        AND linea_x_area.area_id = $idArea");

$resultado = [];

while ($row = $lineas->fetch(PDO::FETCH_ASSOC)) {
    $resultado[] = [
        'linea_id' => $row['linea_id'],
        'linea_nombre' => $row['linea_nombre']
    ];
}

echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
?>
