<?php 
require_once '../php/main.php';

//--- Extraer y separar palabras ---//
    if(isset($_GET['q'])){
        $q=$_GET['q'];
        $q=explode(" ",$q);
        }

//--- Crear lq ---/// lq= Link query para el url
    $lq="";
    foreach($q as $valor){
        $lq.=$valor."+";
    }
    $lq= substr($lq,0,-1);

//Declarar la query principal//
    $query="SELECT SQL_CALC_FOUND_ROWS DISTINCT trabajo.trabajo_titulo, autor.autor_nombre, carrera.carrera_nombre, area_conocimiento.area_nombre 
    FROM trabajo
    INNER JOIN autor ON trabajo.autor_id=autor.autor_id
    INNER JOIN trabajo_detalles ON trabajo.trabajo_id=trabajo_detalles.trabajo_id
    INNER JOIN carrera ON trabajo_detalles.carrera_id=carrera.carrera_id
    INNER JOIN facultad ON trabajo_detalles.facultad_id=facultad.facultad_id
    INNER JOIN trabajo_x_tipo_trabajo ON trabajo.trabajo_id=trabajo_x_tipo_trabajo.trabajo_id
    INNER JOIN tipo_trabajo ON trabajo_x_tipo_trabajo.tipo_trabajo_id=tipo_trabajo.tipo_trabajo_id
    INNER JOIN area_conocimiento ON trabajo_detalles.area_id=area_conocimiento.area_id
    WHERE trabajo.trabajo_titulo";

//--- Concatenar a la query cada coincidencia de palabras ---//
$first_foreach=null;
foreach($q as $palabra){
    if($first_foreach==true){
        $query.=" OR trabajo_titulo";
    }
    $query.=" LIKE '%$palabra%'"; 
    $first_foreach=true;
}


//Obtener el nro de la pagina//
    if(isset($_GET['p'])){
        $pagina = $_GET['p'];
    }else{
        $pagina = 1;
    }

?>


<!DOCTYPE HTML>
<html lang="es">
    <head>
    <link rel="stylesheet" href="/Repository/css/estilos-paginadora.css">
    <link rel="stylesheet" href="/Repository/css/estilos-listado.css">
    </head>
    <body>
        <main>
            <div class="bodylistado">
            </div>

            <?php $html = paginadora_trabajos_admin($pagina,2,$query,$lq,null,null,null);
            echo $html; 
            ?>


            </main>
    </body>
