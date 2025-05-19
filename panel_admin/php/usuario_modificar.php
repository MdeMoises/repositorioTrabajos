<?php
    
    require_once "../php/main.php";

    #Almacenar Datos
    $id = limpiar_cadena($_POST['usuario_id']);
    $nombre = limpiar_cadena($_POST['usuario_nombre']);
    $email = limpiar_cadena($_POST['usuario_email']);
    $clave = limpiar_cadena($_POST['usuario_clave']);
    $rol = limpiar_cadena($_POST['usuario_rol']);

    #Verificar los campos obligatorios si estan vacios
    if($id=="" || $nombre=="" || $email == "" || $clave== ""){
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
            $chequear_usuario=$chequear_usuario->query("SELECT usuario_correo FROM usuario WHERE usuario_correo='$email' AND NOT usuario_id='$id'");
            if($chequear_usuario->rowCount()>0){//verifica si hay al menos un registro con el correo ingresado
                echo '
                    <div class="notification is-danger is-light">
                        <strong>¡Ocurrio un error!</strong><br>
                        El correo ingresado ya se encuentra registrado, por favor ingrese otro
                    </div>
                    '.$nombre.$email.$clave.$rol.'
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
    if(verificar_datos("[0-9]{1,2}",$rol)){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La rol no coincide con el formato adecuado
        </div>
        ';
        exit();
    }

    $clave_usuario = password_hash($clave, PASSWORD_BCRYPT,["cost"=>10]);

    #Modificar Datos
    $modificar_usuario = conexion();
    $modificar_usuario = $modificar_usuario->prepare("UPDATE usuario SET
    usuario_correo = :email,
    usuario_contraseña = :clave_usuario,
    usuario_nombre = :nombre,
    rol_id = :rol
    WHERE usuario_id = :id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":clave_usuario"=>$clave_usuario,
        ":email"=>$email,
        ":rol"=>$rol,
        ":id"=>$id
    ];

    $modificar_usuario->execute($marcadores);

    if($modificar_usuario->rowCount()==1){
        echo '
            <div class="notificacion">
                <strong>¡USUARIO MODIFICADO!</strong><br>
                El usuario se modificó con éxito
            </div>
        ';
    }else{
        echo '
        <div class="notificacion alerta">
            <strong>¡Ocurrio un error !</strong><br>
            No se pudo realizar los cambios al usuario, por favor intente nuevamente
        </div>
    ';
    }
    $modificar_usuario=null;