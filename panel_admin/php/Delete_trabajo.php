<?php
    require_once("main.php");

    $id=$_GET['id'];

// Conexion a la base de datos
    $conexion = conexion();

// Delete trabajo_detalles //
    $sql = "DELETE FROM trabajo_detalles WHERE trabajo_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount()==1){
        //echo "Trabajo_detalles eliminado ";
    }
// Delete lineas_x_trabajo //
    $sql = "DELETE FROM lineas_x_trabajo WHERE trabajo_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount()==1){
       // echo "Lineas_x_trabajo eliminado ";
    }

// Delete trabajo_x_tipo_trabajo //
    $sql = "DELETE FROM trabajo_x_tipo_trabajo WHERE trabajo_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount()==1){
       // echo "Trabajo_x_tipo_trabajo eliminado ";
    }

// Delete tutor_x_trabajo //
    $sql = "DELETE FROM tutor_x_trabajo WHERE trabajo_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount()==1){
       // echo "Tutor_x_trabajo eliminado ";
    }

// Delete trabajo //   
    $sql = "DELETE FROM trabajo WHERE trabajo_id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    if($stmt->rowCount()==1){
        echo "Trabajo eliminado satisfactoriamente ";
    }



    ?>