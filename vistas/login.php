<?php
    error_reporting(0);
    $validar = $_SESSION['nombre'];
    if(!($validar == null || $validar =="")){
        header("Location: ./");
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--    Iconos      -->
    <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
         integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" 
    />

    <!--    CSS      -->
    <link rel="stylesheet" href="./css/login-estilos.css">

    <title>Login</title>
</head>

<body>
    <a href="index.php" class="enlace"><i class="fa-brands fa-instagram"></i> Volver a inicio</a>

    <main>
        
        <div class="login-contenedor" id="login-contenedor">

            <div class="formulario-contenedor registrarse">
                <form action="./php/usuario_insertar.php" method="POST" class="FormularioAjax" autocomplete="off">
                    <h1>Crear cuenta</h1>

                    <div class="iconos-redes">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></i></a>
                        <a href="#"><i class="fa-solid fa-tv"></i></i></a>
                    </div>

                    <span>O usa tu cuenta gmail y datos para registrarte</span>

                    <input type="text" name="usuario_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" placeholder="Nombre" required>
                    <input type="email" name="usuario_email" pattern="[a-zA-Z1-9@._-]{12,40}" placeholder="Correo electrónico" required>
                    <input type="password" name="usuario_clave" placeholder="Contraseña" required>

                    <button>Registrarse</button>
                </form>
                <div style="top:85%; width:100%; text-align: center;" class="formulario-contenedor form-rest"></div> <!-- luego se borra este div de atras -->
            </div>

            <div class="formulario-contenedor acceder">
                <form action="" method="POST" autocomplete="off">
                    <h1>Iniciar sesión </h1>

                    <div class="iconos-redes">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></i></a>
                        <a href="#"><i class="fa-solid fa-tv"></i></i></a>
                    </div>

                    <span>Ingresa tu correo y contraseña</span>

                    <input type="email" name="login_correo" placeholder="Correo electrónico" required>
                    <input type="password" name="login_clave" placeholder="Contraseña" required>

                    <a href="">¿Olvidaste tu contraseña?</a>

                    <button>Acceder</button>

                    <?php
                        if(isset($_POST['login_correo']) && isset($_POST['login_clave'])){
                            require_once "./php/main.php";
                            require_once "./php/iniciar_sesion.php";
                        }

                    ?>

                </form>
                <div class="form-rest"></div>
            </div>

            <div class="interruptor-contenedor">
                <div class="interruptor">

                    <div class="interruptor-panel interruptor-izquierdo">
                        <p>Si ya tienes una cuenta ingresa tus datos para acceder al <strong>Repositorio digital UGMA</strong></p>
                        <!-- <script src="./js/script_login.js"></script> -->
                        <button class="oculto" id="acceder">Acceder</button>
                    </div>

                    <div class="interruptor-panel interruptor-derecho">
                        <h1>Bienvenido</h1>

                        <p>¿Aún no estás registrado? crea un usuario especial y accede a todo el contenido disponible en <strong>Repositorio digital UGMA</strong></p>

                        <button class="oculto" id="registrarse">Registrarse</button>
                    </div>

                </div>
            </div>

        </div>

    </main>

    <footer></footer>

    <script src="./js/script_login.js"></script>
    <script src="./js/ajax.js"></script>   
</body>
</html>

