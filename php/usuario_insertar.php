<?php
    
    require_once "../php/main.php";

    #Almacenar Datos
    $nombre = limpiar_cadena($_POST['usuario_nombre']);
    $email = limpiar_cadena($_POST['usuario_email']);
    $clave = limpiar_cadena($_POST['usuario_clave']);

    #Verificar los campos obligatorios si estan vacios
    if($nombre=="" || $email == "" || $clave== ""){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No has llenado todos los campos que son obligatorios
        </div>
        ';
        exit();
    }


    # Comprobar integridad de los datos (formato)
    //verificar nombre
    if(verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El nombre no coincide con el formato adecuado
        </div>
        ';
        exit();
    }
    //verificar email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $chequear_usuario=conexion();
            $chequear_usuario=$chequear_usuario->query("SELECT usuario_correo FROM usuario WHERE usuario_correo='$email'");
            if($chequear_usuario->rowCount()>0){//verifica si hay al menos un registro con el correo ingresado
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error!</strong><br>
                        El correo ingresado ya se encuentra registrado, por favor ingrese otro
                    </div>
                ';
                exit();
            }
            $chequear_usuario=null;
    }else{
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El correo no coincide con el formato adecuado
        </div>
        ';
        exit();
    }
    //verificar clave
    if(verificar_datos("[a-zA-Z0-9$@*._-]{8,20}",$clave)){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La clave no coincide con el formato adecuado
        </div>
        ';
        exit();
    }

    $clave_usuario = password_hash($clave, PASSWORD_BCRYPT,["cost"=>10]);

    #Guardando Datos
    $guardar_usuario = conexion();
    $guardar_usuario = $guardar_usuario->prepare("INSERT INTO usuario
    (usuario_correo,usuario_contraseña, usuario_nombre) 
    VALUES(:email, :clave_usuario, :nombre)");

    $marcadores=[
        ":nombre"=>$nombre,
        ":clave_usuario"=>$clave_usuario,
        ":email"=>$email
    ];

    $guardar_usuario->execute($marcadores);

    if($guardar_usuario->rowCount()==1){
        echo '
            <div class="notificacion">
                <strong>¡USUARIO REGISTRADO!</strong><br>
                El usuario se registro con éxito
            </div>
        ';
    }else{
        echo '
        <div class="notificacion alerta">
            <strong>¡Ocurrio un error !</strong><br>
            No se pudo registrar el usuario, por favor intente nuevamente
        </div>
    ';
    }
    $guardar_usuario=null;