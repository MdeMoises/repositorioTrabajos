<?php 
require_once '../php/main.php';

//Obtener tipo de trabajo//
    if(isset($_GET['tipo'])){
        $tipo = $_GET['tipo'];
    } else{
        $tipo=1;
    }


//Declarar la query principal//
    $query="SELECT SQL_CALC_FOUND_ROWS DISTINCT trabajo.trabajo_titulo, trabajo.trabajo_resumen, trabajo.trabajo_id, tipo_trabajo.tipo_trabajo_nombre, autor.autor_nombre, carrera.carrera_nombre, area_conocimiento.area_nombre 
    FROM trabajo
    INNER JOIN autor ON trabajo.autor_id=autor.autor_id
    INNER JOIN trabajo_detalles ON trabajo.trabajo_id=trabajo_detalles.trabajo_id
    INNER JOIN carrera ON trabajo_detalles.carrera_id=carrera.carrera_id
    INNER JOIN facultad ON trabajo_detalles.facultad_id=facultad.facultad_id
    INNER JOIN trabajo_x_tipo_trabajo ON trabajo.trabajo_id=trabajo_x_tipo_trabajo.trabajo_id
    INNER JOIN tipo_trabajo ON trabajo_x_tipo_trabajo.tipo_trabajo_id=tipo_trabajo.tipo_trabajo_id
    INNER JOIN area_conocimiento ON trabajo_detalles.area_id=area_conocimiento.area_id
    WHERE trabajo_x_tipo_trabajo.tipo_trabajo_id=".$tipo;

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
    <link rel="stylesheet" href="/Repository/panel_admin/css/estilos-listadoNew.css">
    <link rel="stylesheet" href="/Repository/css/estilos-paginadora.css">
    </head>
    <body>
        <main>
            <section>
                <ul class="listado-trabajos">
                    <?php $html = paginadora_trabajos_admin($pagina,2,$query,null,1,null,null);
                    echo $html; 
                    ?>
                </ul>
            </section>

            <a href="#" id="circular-buttonaa" class="circular-buttonaa" onclick='loadContent("new")'>
            <i class="fas fa-plus"></i>
            </a>


            </main>
    </body>
