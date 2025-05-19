<?php

    require_once("main.php");


    //---Guardamos los datos---//
    $titulo=limpiar_cadena($_POST['titulo']);
    $autor=limpiar_cadena($_POST['autor']);
    $nota=limpiar_cadena($_POST['nota']);
    $resumen=limpiar_cadena($_POST['resumen']);

    $sede=$_POST['sede'];
    $facultad=$_POST['facultad'];
    $carrera=$_POST['carrera'];
    $area=$_POST['area'];
    $linea=$_POST['linea'];
    $fecha=$_POST['fecha'];
    $trabajo_ruta=$_FILES['trabajo']['tmp_name'];
    $trabajo_tipo=$_FILES['trabajo']['type'];   

    //-Reset la fecha-//
    $format = explode('-',$fecha);
    $format[0]=substr($format[0],2); 
    $fecha= $format[1].'-'.$format[0];

    //-Reset el tipo de archivo-//
    $format = explode('/',$trabajo_tipo);
    $trabajo_tipo=$format[1];

    //---Ruta para enviar el archivo--//
    $ruta="C:/Users/User/Desktop/REPOSITORY UGMA/TRABAJOS";
    $rutas=[
        $ruta,
        $ruta.'/'.$facultad,
        $ruta.'/'.$facultad.'/'.$carrera
    ];


    //---Filtro para el foreach que verifica la integridad de los datos--//
    $filtros=[
        "$titulo" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,250}",
        "$autor" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",
        "$nota" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",
        "$resumen" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,5000}"
    ];

    //---Verificando campos obligatorios ---//
    if($titulo==""||$autor==""||$nota==""||$resumen==""){
        echo'
            <div>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }

    //--- Verificando integridad de los datos ---//
    foreach($filtros as $variable=>$filtro){
        if(verificar_datos($filtro,$variable)){
            echo '
                <div>
                    <strong>¡Ocurrio un error inesperado!</strong><br>
                    "'.$variable.'" no coincide con el formato solicitado para ese campo
                </div>
            ';
            exit();
        }
    }
/*
    //--- Verificando titulo repetido ---//
    $check_titulo=conexion();
    $check_titulo=$check_titulo->query("SELECT titulo_nombre FROM titulo WHERE titulo_nombre='$titulo'");
    if($check_titulo->rowCount()>0){
        echo '
            <div>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Titulo ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check_titulo=null;

    //--- Guardar datos en base de datos---//
    $guardar = conexion();
    $guardar=$guardar->prepare("INSERT INTO trabajo(trabajo_titulo,trabajo_resumen,trabajo_fecha_e,trabajo_nota_grado) VALUES(:titulo,:resumen,:fecha,:nota)");
    $marcadores=[
      ":titulo"=>$titulo,
      ":resumen"=>$resumen,
      ":fecha"=>$fecha,
      ":nota"=>$nota
    ];
    $guardar->execute($marcadores);
    $guardar=null;
    */
    


    //---Enviar archivo pdf---//

       //-Verificar si la carpeta ya existe y crearla sino-//
    foreach($rutas as $valor){
        if(!file_exists($valor)){
            if(!mkdir($valor,0777)){
                echo "error al crear el directorio";
                exit();
            }
        }
        chmod($valor,0777); //Asignarle permisos de lectura y escritura//
    }

    if(move_uploaded_file($trabajo_ruta,$rutas[2].'/'.$fecha.'-'.$autor.'.'.$trabajo_tipo)){
        echo "archivo subido con exito";
    }else{
        echo "error al subir el archivo";
    }




?>