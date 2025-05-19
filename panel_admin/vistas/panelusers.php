<?php

//Iniciar la sesion//
session_name("SESION"); //<!--/Repository-Ugma/panel_admin/inc/session_start.php-->     
session_start();

//Declarar la query principal//
$query="SELECT SQL_CALC_FOUND_ROWS DISTINCT usuario_id, usuario_correo, usuario_contraseña, usuario_nombre, rol_nombre 
FROM usuario
INNER JOIN roles ON usuario.rol_id=roles.rol_id
WHERE usuario_id != ".$_SESSION['id'];




?>