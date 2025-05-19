<?php
    
    require_once "../php/main.php";

    #Almacenar Datos
    $id = limpiar_cadena($_POST['usuario_id']);

    #Verificar los campos obligatorios si estan vacios
    if($id==""){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El campo del id se encuentra vacio
        </div>
        ';
        exit();
    }


    # Comprobar integridad de los datos (formato)
    //verificar id
    if(verificar_datos("[0-9]{1,5}",$id)){
        echo '
        <div class="notificacion peligro ">
        <strong>¡Ocurrio un error inesperado!</strong><br>
        El id no coincide con el formato adecuado
        </div>
        ';
        exit();
    }

    #Eliminar usuario
    $eliminar_usuario = conexion();
    $eliminar_usuario = $eliminar_usuario->prepare("DELETE FROM usuario WHERE usuario_id = :id");

    $marcadores=[
        ":id"=>$id
    ];

    $eliminar_usuario->execute($marcadores);

    if($eliminar_usuario->rowCount()==1){
        echo '
            <div class="notificacion">
                <strong>¡USUARIO ELIMINADO!</strong><br>
                El usuario se eliminó con éxito
            </div>
        ';
    }else{
        echo '
        <div class="notificacion alerta">
            <strong>¡Ocurrio un error !</strong><br>
            No se pudo eliminar al usuario, por favor intente nuevamente
        </div>
    ';
    }
    $eliminar_usuario=null;