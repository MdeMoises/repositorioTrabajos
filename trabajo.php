<?php
    require("inc/header.php");
    require("php/main.php");

//Trabajo especifico consultado//
        $trabajo_id= $_GET['id'];

//Conexion a la base de datos//
    $conexion = conexion();
//  Querys   //
    $sql='SELECT trabajo.trabajo_titulo, autor.autor_nombre, tipo_trabajo.tipo_trabajo_nombre, facultad.facultad_nombre, carrera.carrera_nombre,
    trabajo.trabajo_resumen, area_conocimiento.area_nombre, trabajo.trabajo_periodo, trabajo.trabajo_año, trabajo.trabajo_link
    FROM trabajo
    INNER JOIN autor ON trabajo.autor_id=autor.autor_id
    INNER JOIN trabajo_detalles ON trabajo.trabajo_id=trabajo_detalles.trabajo_id
    INNER JOIN facultad ON trabajo_detalles.facultad_id=facultad.facultad_id
    INNER JOIN carrera ON trabajo_detalles.carrera_id=carrera.carrera_id
    INNER JOIN area_conocimiento ON trabajo_detalles.area_id=area_conocimiento.area_id
    INNER JOIN trabajo_x_tipo_trabajo ON trabajo.trabajo_id=trabajo_x_tipo_trabajo.trabajo_id
    INNER JOIN tipo_trabajo ON trabajo_x_tipo_trabajo.tipo_trabajo_id=tipo_trabajo.tipo_trabajo_id
    WHERE trabajo.trabajo_id='. $trabajo_id;

    $sql2='SELECT linea_investigacion.linea_nombre
    FROM linea_investigacion
    INNER JOIN lineas_x_trabajo ON lineas_x_trabajo.linea_id = linea_investigacion.linea_id
    WHERE lineas_x_trabajo.trabajo_id='.$trabajo_id;

// Ejecutar la query  //
    $resultado = $conexion->query($sql);
    $trabajo = $resultado->fetch(PDO::FETCH_ASSOC);

    $resultado = $conexion->query($sql2);

    $conexion=null;

// Nombre del archivo //
 $archivoNombre = substr(strrchr($trabajo['trabajo_link'],"/"),1);
 $direccionArchivo = substr($trabajo['trabajo_link'],27);

//  Nombre de imagen //
$nombre_img = "img/T.E/".$trabajo['tipo_trabajo_nombre']."-".$trabajo['carrera_nombre'].".webp";


?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>UGMA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
         <link rel="stylesheet" href="css/estilos-trabajo-especifico.css">

         <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
         integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" />

         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    </head>
    <body>
        <main>
            <div class="contenedor-trabajo-especifico">
                    <div class="seccion-arriba">
                        <div class="imagen">
                            <img src="<?php echo $nombre_img ?>" alt="">
                        </div>
                        <div class="propiedades-trabajo-especifico">
                            <h2><?php echo eliminar_acentos(ucfirst(strtolower($trabajo['trabajo_titulo']))) ?></h2><h3 class="titulo-2"></h3>
                            <p id="autor"><i class="fa-solid fa-user-pen"></i><?php echo $trabajo['autor_nombre'] ?></p>
                            <p id="facultad"><i class="fa-solid fa-landmark"></i><?php echo $trabajo['facultad_nombre'] ?></p>
                            <p id="carrera"><i class="fa-solid fa-graduation-cap"></i><?php echo $trabajo['carrera_nombre'] ?></p>
                            <button class="btn-primario-azul" id="descarga" onclick="descargarArchivo()"><i class="fa-solid fa-download"></i>DESCARGAR</button>
                        </div>
                    </div>
                    <div class="seccion-abajo">
                        <div class="resumen">
                            <span>Resumen</span>
                            <p><?php echo $trabajo['trabajo_resumen'] ?></p>
                        </div>
                        <div class="complementos">
                            <span>Áreas de conocimiento</span>
                            <p><?php echo $trabajo['area_nombre']?></p>
                            <br>
                            <span>Líneas de investigación</span>
                                <?php while($linea = $resultado->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <p>
                                    <?php echo "- ".$linea['linea_nombre'] ?>
                                    </p><br>
                                <?php } ?>
                            <span>Periodo</span>
                            <p><?php echo $trabajo['trabajo_año']." - ".$trabajo['trabajo_periodo']  ?></p>
                            <br>
                            <span>Archivos complementarios</span>
                            <p><i class="fa-solid fa-download"></i>Lorem ipsum dolor sit</p>
                            <p><i class="fa-solid fa-download"></i>Lorem ipsum dolor sit</p>
                        </div>
                    </div>
            </div>
        </main>
        <script>
            function descargarArchivo() {
            const link = document.createElement('a');
            link.href = '<?php echo $direccionArchivo; ?>';
            link.download =  '<?php echo $archivoNombre; ?>';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
        </script>
    </body>
    <?php     require("inc/footerugma.php"); ?>
</html>