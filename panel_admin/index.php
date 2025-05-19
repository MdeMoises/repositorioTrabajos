<?php require("../inc/session_start.php"); //<!--/Repository-Ugma/inc/session_start.php-->

    error_reporting(0);
    $validar = $_SESSION['nombre'];
    // echo "Hola: '$validar'";
    if($validar == null || $validar == ''){
        //echo('<br> epa, no estas logeado, chau') ;
        include("./vistas/login.php");
    }
    else{
        include("./vistas/paneladmin.php");
    }
?>