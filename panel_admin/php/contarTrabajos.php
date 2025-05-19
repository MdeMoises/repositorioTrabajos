<?php

    error_reporting(0);
    include "php/main.php";
    error_reporting(0);
    include "../php/main.php";

    error_reporting(0);

    $totalTrabajos;
    $totalPregrado;
    $totalPosgrado;
    $totalPasantia;

    $conexion = conexion();
    $chequear_trabajos = $conexion->query("SELECT trabajo_id FROM trabajo_x_tipo_trabajo ");

    if($chequear_trabajos->rowCount() >= 0){
        $totalTrabajos = $chequear_trabajos->rowCount();
    }
    
    $chequear_trabajos = $conexion->query("SELECT trabajo_id FROM trabajo_x_tipo_trabajo JOIN tipo_trabajo on tipo_trabajo.tipo_trabajo_id = trabajo_x_tipo_trabajo.tipo_trabajo_id WHERE tipo_trabajo.tipo_trabajo_nombre = 'Pregrado'");
    if($chequear_trabajos->rowCount() >= 0){
        $totalPregrado = $chequear_trabajos->rowCount();        
    }
    
    $chequear_trabajos = $conexion->query("SELECT trabajo_id FROM trabajo_x_tipo_trabajo JOIN tipo_trabajo on tipo_trabajo.tipo_trabajo_id = trabajo_x_tipo_trabajo.tipo_trabajo_id WHERE tipo_trabajo.tipo_trabajo_nombre = 'Posgrado'");
    if($chequear_trabajos->rowCount() >= 0){
        $totalPosgrado = $chequear_trabajos->rowCount();
    }

    $chequear_trabajos = $conexion->query("SELECT trabajo_id FROM trabajo_x_tipo_trabajo JOIN tipo_trabajo on tipo_trabajo.tipo_trabajo_id = trabajo_x_tipo_trabajo.tipo_trabajo_id WHERE tipo_trabajo.tipo_trabajo_nombre = 'Pasantia'");
    if($chequear_trabajos->rowCount() >= 0){
        $totalPasantia = $chequear_trabajos->rowCount();
    }


?>