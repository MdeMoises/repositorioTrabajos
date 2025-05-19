<?php    require("main.php");
$sedes=conexion();
$sedes=$sedes->query("SELECT sede_id, sede_nombre FROM sede");
$facultades=conexion();
$facultades=$facultades->query("SELECT facultad_id, facultad_nombre FROM facultad");
$tipo_trabajo=conexion();
$tipo_trabajo=$tipo_trabajo->query(("SELECT tipo_trabajo_id, tipo_trabajo_nombre FROM tipo_trabajo"));
$tipo_tutor=conexion();
$tipo_tutor=$tipo_tutor->query("SELECT * FROM tipo_tutor");
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Subir trabajo</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
    </head>
    <body>
        <main>
            <h1>Formulario</h1> 
            <form action="Save_Trabajo.php" autocomplete="off" method="POST" enctype="multipart/form-data" class="FormularioAjax">
                <label for="titulo">Titulo:</label><br>
                    <input type="text" name="titulo" id="titulo" placeholder="escriba el titulo"><br><br>

                <label>Autor:</label><br>
                    <label for="nombre_autor">Nombre:</label><br>
                    <input type="text" name="nombre_autor" id="nombre_autor" placeholder="escriba el nombre"><br>
                    <label for="apellido_autor">Apellido:</label><br>
                    <input type="text" name="apellido_autor" id="apellido_autor" placeholder="escriba el apellido"><br><br>

                <label for="nota">Nota de grado:</label><br>
                    <input type="text" name="nota" id="nota" placeholder="Nota de grado"><br><br>

                    <label for="tipo">Tipo de trabajo: </label><br>
                    <select name="tipo" id="tipo">
                        <option value="">Seleccionar</option>
                        <?php while ($row = $tipo_trabajo->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['tipo_trabajo_id']; ?>"><?php echo $row['tipo_trabajo_nombre'];?></option>
                        <?php } ?>
                    </select><br><br>

                <label for="sede">Sede: </label><br>
                    <select name="sede" id="sede">
                        <option value="">Seleccionar</option>
                        <?php while ($row = $sedes->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['sede_id'];?>"><?php echo $row['sede_nombre'];?></option>
                        <?php } ?>
                    </select><br><br>

                <label for="facultad">Facultad: </label><br>
                    <select name="facultad" id="facultad">
                        <option value="">Seleccionar</option>
                        <?php while ($row = $facultades->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['facultad_id'];?>"><?php echo $row['facultad_nombre'];?></option>
                        <?php } ?>  
                    </select><br><br>

                <label for="carrera">Carrera: </label><br>
                    <select name="carrera" id="carrera">
                        <option value="">Seleccionar</option>
                    </select><br><br>

                <label for="area">Area de conocimiento: </label><br>
                    <select name="area" id="area" onchange="actualizarLineas()">
                        <option value="">Seleccionar</option>
                    </select><br><br>

                    <label for="cantidadLineas">Cantidad de lineas de investigacion:</label> <br>
                    <select name="cantidadLineas" id="cantidadLineas" onchange="actualizarLineas()">
                        <?php for($i=0;$i<=3;$i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <br><br>

                    <div id="contenedorLineas">
                    </div> <br><br>

                <label for="anio">Periodo de entrega: </label>
                    <select id="anio" name="anio">
                        <?php for($i=2000;$i<2035;$i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php } ?>
                    </select>

                <select name="periodo" id="periodo">
                    <option value="I">I</option>
                    <option value="II">II</option></select>
                <br><br>

                <label for="resumen">Resumen: </label> <br>
                    <textarea name="resumen" id="resumen"></textarea><br><br>

                <label for="cantidadTutores">Cantidad de tutores/asesores:</label> <br>
                    <select name="cantidadTutores" id="cantidadTutores" onchange="actualizarTutores()">
                        <?php for($i=0;$i<=3;$i++) { ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <br><br>

                <div id="contenedorTutores">
                </div> <br><br>

                <laber for="trabajo">Trabajo o informe de grado:</laber> <br>
                    <input type="file" name="trabajo" id="trabajo"><br><br>

                <label>Limpiar:</label><br>
                    <input type="reset"><br><br>

                <input type="submit">

            </form>
            <script src="../js/ajax.js"></script>
            <script src="../js/script_formulario.js" defer></script>
        </main>
    </body>