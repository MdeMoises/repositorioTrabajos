<?php
 require("main.php");

    $idFacultad= limpiar_cadena($_POST['facultad_id']);

    $carreras = conexion();
    $carreras = $carreras->query("SELECT carrera_id, carrera_nombre FROM carrera WHERE facultad_id = $idFacultad");
    
    $resultado = "<option value='0'>Seleccionar</option>";
    
    while($row = $carreras->fetch(PDO::FETCH_ASSOC)){
        $resultado .= "<option value='".$row['carrera_id']."'>".$row['carrera_nombre']."</option>";
    }

    echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
?>