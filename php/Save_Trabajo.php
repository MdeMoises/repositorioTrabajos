<?php
    require_once("main.php");

//---Tomamos los datos del formulario---//

    $titulo=limpiar_cadena($_POST['titulo']);
    $nombre_autor=limpiar_cadena($_POST['nombre_autor']);
    $apellido_autor=limpiar_cadena($_POST['apellido_autor']);
    $autor=$nombre_autor." ".$apellido_autor;
    $nota=limpiar_cadena($_POST['nota']);
    $resumen=limpiar_cadena($_POST['resumen']);

    $sede=$_POST['sede'];
    $facultad=$_POST['facultad'];
    $carrera=$_POST['carrera'];
    $area=$_POST['area'];

    $anio=$_POST['anio'];
    $periodo=$_POST['periodo'];

    $tipo=$_POST['tipo'];

    $trabajo_ruta=$_FILES['trabajo']['tmp_name'];
    $trabajo_tipo=$_FILES['trabajo']['type'];
    
    


//Reset el tipo de archivo//
    $format = explode('/',$trabajo_tipo);
    $trabajo_tipo=$format[1];

//---Ruta para enviar el archivo--//

    $ruta="../trabajos";
    $rutas=[
        $ruta,
        $ruta.'/'.$facultad,
        $ruta.'/'.$facultad.'/'.$carrera
    ];


    //---Filtro para el foreach que verifica la integridad de los datos--//
    $filtros=[
        "$titulo" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ., ]{1,250}",
        "$autor" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,50}",
        "$nota" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,200}",
        "$resumen" => "[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,;-º°]{4,5000}",
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
    /*
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
        */

//--- Verificando titulo repetido ---//
    $check=conexion();
    $check=$check->query("SELECT trabajo_titulo FROM trabajo WHERE trabajo_titulo='$titulo'");
    if($check->rowCount()>0){
        echo '
            <div>
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El Titulo ingresado ya se encuentra registrado, por favor elija otro
            </div>
        ';
        exit();
    }
    $check=null;



//--- Guardar datos en base de datos---//
//-- Verificando autor repetido --//

    $check=conexion();
    $check=$check->prepare("SELECT autor_nombre, autor_id FROM autor WHERE :autor = autor_nombre");
    $check->bindParam(':autor', $autor);
    $check->execute();

//IF esta repetido, guarda $autor_id//
    if($check->rowCount()>0){
        $id = $check->fetch(PDO::FETCH_ASSOC);
        $autor_id = $id['autor_id'];
//ELSE, Guarlado, extrae el id y guarda $autor_id//
    } else{                  
//Guardamos autor//
            $guardar = conexion();
            $guardar=$guardar->prepare("INSERT INTO autor(autor_nombre,sede_id,facultad_id,carrera_id) VALUES(:autor,:sede,:facultad,:carrera)");
            $marcadores=[
            ":autor"=>$autor,
            ":sede"=>$sede,
            ":facultad"=>$facultad,
            ":carrera"=>$carrera
            ];
            $guardar->execute($marcadores);
            if($guardar->rowCount()==1){
                echo "Autor check";
        }else{
        echo "Autor fallo";
        }
        $guardar=null;


//Extraemos id del autor recien guardado//

        $autor_id = conexion(); // Conexión a la base de datos
        if (isset($autor)) {
            $query = $autor_id->prepare("SELECT autor_nombre, autor_id FROM autor WHERE :autor = autor_nombre");
            $query->bindParam(':autor', $autor);
            $query->execute();
        
            $id = $query->fetch(PDO::FETCH_ASSOC);

    // Verifica si se encontró un resultado

            if ($id) {
                $autor_id = $id['autor_id'];
            } else {
                echo "No se encontró el autor.";
            }
        } else {
            echo "La variable \$autor no está definida.";
        }

    }
    $check=null;

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




//-- Guardamos trabajo --//
    $guardar = conexion();
    $guardar=$guardar->prepare("INSERT INTO trabajo(trabajo_titulo,trabajo_resumen,trabajo_año,trabajo_periodo,trabajo_nota_grado,trabajo_link,autor_id) VALUES(:titulo,:resumen,:anio,:periodo,:nota,:link,:autor)");
    $marcadores=[
      ":titulo"=>$titulo,
      ":resumen"=>$resumen,
      ":anio"=>$anio,
      ":periodo"=>$periodo,
      ":nota"=>$nota,
      ":link"=>$nombreNuevo,
      ":autor"=>$autor_id

    ];
    $guardar->execute($marcadores);

    if($guardar->rowCount()==1){
            echo "Trabajo Check";
    }else{
            echo "Trabajo fallo";
    }
    $guardar=null;


//Extraemos id del trabajo recien guardado//
    $trabajo_id = conexion(); // Conexión a la base de datos
    if (isset($autor)) {
        $query = $trabajo_id->prepare("SELECT trabajo_titulo, trabajo_id FROM trabajo WHERE :titulo = trabajo_titulo");
        $query->bindParam(':titulo', $titulo);
        $query->execute();
    
        $id = $query->fetch(PDO::FETCH_ASSOC);
    
        // Verifica si se encontró un resultado
        if ($id) {
            $trabajo_id = $id['trabajo_id'];
        } else {
            echo "No se encontró el trabajo.";
        }
    } else {
        echo "La variable \$trabajo no está definida.";
    }
//-- Guardamos detalles --//
    $guardar = conexion();
    $guardar=$guardar->prepare("INSERT INTO trabajo_detalles(trabajo_id,sede_id,facultad_id,carrera_id,area_id) VALUES(:trabajo,:sede,:facultad,:carrera,:area)");
    $marcadores=[
      ":trabajo"=>$trabajo_id,
      ":sede"=>$sede,
      ":facultad"=>$facultad,
      ":carrera"=>$carrera,
      ":area"=>$area
    ];
    $guardar->execute($marcadores);

    if($guardar->rowCount()==1){
            echo "Ya esta hecho papi";

    }else{
            echo "Mala mia manito";
    }
    $guardar=null;

//-- Guardamos tipo trabajo --//
    $guardar = conexion();
    $guardar=$guardar->prepare("INSERT INTO trabajo_x_tipo_trabajo(trabajo_id,tipo_trabajo_id) VALUES(:trabajo,:tipo)");
    $marcadores=[
      ":trabajo"=>$trabajo_id,
      ":tipo"=>$tipo
    ];
    $guardar->execute($marcadores);

    if($guardar->rowCount()==1){
            echo "Ya esta hecho papi";
    }else{
            echo "Mala mia manito";
    }
    $guardar=null;

//-- Guardamos lineas de investigacion --//
    $guardar = conexion();
    //Obtenemos los id de las lineas seleccionadas
    for($i=1;$i<=3;$i++){
        if(isset($_POST["tipoLinea$i"])){
            $lineas[$i-1]=$_POST["tipoLinea$i"];
            $guardar=$guardar->prepare("INSERT INTO lineas_x_trabajo(trabajo_id,linea_id) VALUES(:trabajo,:linea)");
            $marcadores=[
                ":trabajo"=>$trabajo_id,
                ":linea"=>$lineas[$i-1]
            ];
            $guardar->execute($marcadores);
        }
    };
    $guardar=null;


//-- Guardamos los tutores x trabajo --//
        $guardar = conexion();
     //Obtenemos los id y nombres de los tutores del trabajo
     for($i=1;$i<=3;$i++){
        if(isset($_POST["tutor$i"])){
            $tutor=$_POST["tutor$i"];

            //Verificar tutor repetido//
            $check=conexion();
            $check=$check->query("SELECT tutor_id FROM tutor WHERE tutor_nombre='$tutor'");
            if($check->rowCount()>0){
             //extraer id de autor
                $id = $check->fetch(PDO::FETCH_ASSOC);
                $tutor_id = $id['tutor_id'];
            }else{
            //guardar tutor
                $tipo_tutor[$i-1]=$_POST["tipoTutor$i"];
                $guardar_tutor=conexion();
                $guardar_tutor=$guardar_tutor->prepare("INSERT INTO tutor(tutor_nombre,tipo_tutor_id) VALUES(:tutor, :tipot)");
                $marcadores=[
                    ":tutor"=>$tutor,
                    ":tipot"=>$tipo_tutor[$i-1]
                ];
                $guardar_tutor=$guardar_tutor->execute($marcadores);
                $guardar_tutor=null;
            //extraer id de autor recien creado
                $tutor_id=conexion();
                $tutor_id=$tutor_id->query("SELECT tutor_id FROM tutor WHERE tutor_nombre = '$tutor'");
                $tutor_id=$tutor_id->fetch(PDO::FETCH_ASSOC);
                $tutor_id=$tutor_id['tutor_id'];
                }
            $check=null;

            //Guardar tutor x trabajo//

            $guardar=$guardar->prepare("INSERT INTO tutor_x_trabajo(tutor_id,trabajo_id) VALUES(:tutor, :trabajo)");
            $marcadores=[
                ":tutor"=>$tutor_id,
                ":trabajo"=>$trabajo_id
            ];
            $guardar=$guardar->execute($marcadores);
        }
    };
    $guardar=null;
    

?>