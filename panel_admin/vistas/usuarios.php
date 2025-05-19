<?php   
    session_name("SESION"); //<!--/Repository-Ugma/panel_admin/inc/session_start.php-->     
    session_start();
                    
                    echo '<h1 class="bienvenido">Gestión de Usuarios</h1>';

    require_once("../php/main.php");
    $roles=conexion();
    $roles=$roles->query("SELECT rol_id, rol_nombre FROM roles");
    
    $usuarios=conexion();
    $usuarios= $usuarios->query("SELECT usuario_id, usuario_nombre ,usuario_correo, rol_id FROM usuario");
    ?>

<div>

    <!-- Seccion de Registrar usuario-->
    <div class="formulario-contenedor registrarse">
        <form action="./php/usuario_insertar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <h1>Crear Usuario</h1>
            
            <input type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" placeholder="Nombre" required>
            <input type="email" name="usuario_email" pattern="[a-zA-Z1-9@._-]{12,40}" placeholder="Correo electrónico" required>
            <input type="password" name="usuario_clave" placeholder="Contraseña" required>
            <select name="usuario_rol" value="Rol"required>
                    <option value="">Seleccionar</option>
                    <?php 
                    while ($row = $roles->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['rol_id']; ?>"><?php echo $row['rol_nombre'];?></option>
                        <?php } ?>                                      
            </select>
            
            <button type="">Registrarse</button>
        </form>
        <div class="form-rest"></div>
    </div>
    <br>
    

    <!-- Seccion Lista de usuarios-->
    <div>
        <h2>Lista de Usuarios</h2>
        <ul>
        <?php            
            while ($row = $usuarios->fetch(PDO::FETCH_ASSOC)) { ?>

            <li valor-id="<?php echo $row['usuario_id']; ?>" valor-nombre="<?php echo $row['usuario_nombre']; ?>" valor-correo="<?php echo $row['usuario_correo']; ?>" valor-rol-id="<?php echo $row['rol_id']; ?>">
                <form action="./php/usuario_eliminar.php" method="post" class="FormularioAjax" autocomplete="off" style="display:inline;">

                    <span><?php echo $row['usuario_nombre']; ?> <?php echo $row['usuario_correo'];?> </span>: 
                    <?php echo $row['rol_id']; ?>

                    <input type="hidden" name="usuario_id" value="<?php echo $row['usuario_id']; ?>">
                    <button type="submit">Eliminar</button>
                </form>
            
                <button type="button" onclick="modificarUsuario(this)">Modificar</button>
            </li>

         <?php } ?>               
        </ul>
    </div>

    <!-- Seccion de Modificar usuario-->
    <div class="formulario-contenedor modificar">
        <form action="./php/usuario_modificar.php" method="POST" class="FormularioAjax" autocomplete="off">
            <h1>Modificar cuenta</h1>
            <input type="text" id="input-id" name="usuario_id" pattern="[1-9]{1,4}" hidden>
            <input type="text" id="input-nombre" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" placeholder="Nombre" required>
            <input type="email" id="input-correo" name="usuario_email" pattern="[a-zA-Z1-9@._-]{12,40}" placeholder="Correo electrónico" required>
            <input type="password" id="input-clave" name="usuario_clave" placeholder="Contraseña" required>
            <select id="select-rol" name="usuario_rol" value="Rol" required>
                    <option value="">Seleccionar</option>
                    <?php 
                    $roles=conexion();
                    $roles=$roles->query("SELECT rol_id, rol_nombre FROM roles");    
                    
                    while ($row = $roles->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row['rol_id']; ?>"><?php echo $row['rol_nombre'];?></option>
                        <?php } ?>
                                       
            </select>
            
            <button>Confirmar Cambios</button>
        </form>
        <div class="form-rest"></div>
    </div>
    <br>

</div>

