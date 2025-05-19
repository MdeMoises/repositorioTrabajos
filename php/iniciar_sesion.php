<?php
    require_once "./php/main.php";
    #Almacenar Datos
    $email = limpiar_cadena($_POST['login_correo']);
    $clave = limpiar_cadena($_POST['login_clave']);

    $limpio = true;

    
    #Verificar los campos obligatorios si estan vacios
    if($email == "" || $clave== ""){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        No has llenado todos los campos que son obligatorios
        </div>
        ';
        exit();
    }

    # Comprobar integridad de los datos (formato)
    //verificar email
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

    }else{
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El correo no coincide con el formato adecuado
        </div>
        ';
        //exit();
    }
    //verificar clave
    if(verificar_datos("[a-zA-Z0-9$@*._-]{8,20}",$clave)){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        La clave no coincide con el formato adecuado
        </div>
        ';
        //exit();
    }

    $chequear_usuario = conexion();
    $chequear_usuario = $chequear_usuario->query("SELECT * FROM usuario 
    WHERE usuario_correo='$email' ");

    if($chequear_usuario->rowCount()==1){

        $chequear_usuario = $chequear_usuario->fetch();

        if($chequear_usuario['usuario_correo'] == $email && 
        password_verify($clave, $chequear_usuario['usuario_contraseña'])){
            //session_start();
            $_SESSION['id'] = $chequear_usuario['usuario_id'];
            $_SESSION['nombre'] = $chequear_usuario['usuario_nombre'];
            $_SESSION['correo'] = $chequear_usuario['usuario_correo'];

            if(headers_sent()){
                echo "<script> windows.location.href='index.php'</script>";
            }else{
                header("Location: ./index.php");
            }
            

        }else{
            echo '
            <div class="notificacion peligro ">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            Correo o constraseña incorrecta
            </div>
            ';
        }

    }else{
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        Usuario o clave incorrecto. No existe
        </div>
        ';
    }
    $chequear_usuario = null;


?>