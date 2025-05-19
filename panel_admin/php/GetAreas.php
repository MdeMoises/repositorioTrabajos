<?php
 require("main.php");

    $idCarrera= limpiar_cadena($_POST['carrera_id']);

    $areas = conexion();
    $areas = $areas->query("SELECT area_id, area_nombre FROM area_conocimiento WHERE carrera_id = $idCarrera");
    
    $resultado = "<option value='0'>Seleccionar</option>";
    
    while($row = $areas->fetch(PDO::FETCH_ASSOC)){
        $resultado .= "<option value='".$row['area_id']."'>".$row['area_nombre']."</option>";
    }

    echo json_encode($resultado,JSON_UNESCAPED_UNICODE);
?>