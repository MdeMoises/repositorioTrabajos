<?php
    error_reporting(0);
    $validar = $_SESSION['nombre'];
    if($validar == null || $validar ==""){
        header("Location: ../index.php");
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

    <link rel="stylesheet" href="./css/estilos-panel.css">

    <title>Panel administrador</title>
</head>

<body>

    <!--=== 👀 #SIDEBAR
            Seccion de barra lateral desplegable que se reduce al presionar => (.interruptor-sidebar)
            
            Contiene 3 elementos principales:
                1)  Titulo de la pagina: => (".titulo-pagina") 
                    lo que dice "Administrador"

                2)  Usuario: => (".usuario") 
                    incluye la FOTO del usuario, su CARGO y/o FACULTAD que administra (sub-cargo) 

                3)  Opciones del menu (Menu lateral): => (side-menu)
                        Incluye todos los elementos seleccionables del menu que no estan relacionados con el usuario:
                            Panel 
                            JEFE DE FACULTAD: Gestionar trabajos / Gestionar lineas de investigacion / Gestionar areas de conocimiento
                            ADMINISTRADOR: Gestionar usuarios / Gestionar facultades / Gestionar carreras 

                        y sus respectivos sepadores (elementos li con la clase divider)
    ===-->
        <section id="sidebar">
            <!-- 1) Titulo de la pagina -->
                <h1 class="titulo-pagina">Administrador</h1>

            <!-- 2) Usuario -->
                <div class="usuario">
                    <img src="./img/6325109.png" alt="imagen admin">

                    <div class="cargo">
                        <span>Nombre:</span><p>
                            <?php
                                $nombre_usuario = $_SESSION['nombre'];
                                echo $nombre_usuario;

                            ?>
                        </p>
                    </div>

                    <div class="sub-cargo">
                        <span>Rol:</span><p>
                            <?php
                                $rol_usuario = $_SESSION['rol'];
                                echo $rol_usuario;

                            ?>
                        </p>
                    </div>
                </div>

            <!-- 3) Opciones del menu 
                ✔ La clase .active señala en que posicion de la pagina se encuentra, es la que hace que el elemento sea azul, para indicarle al usuario 
                    que se encuentra en PANEL (o en GESTIONAR...{trabajos, lineas,areas,usuarios,facultades,carreras})
                
                ✔ La clase .divider son elementos li que separan al menu VISUALMENTE en dos categorias 
                    (jefe de facultad y administrador)
                
                ✔ La clase .side-dropdown engloba a los elementos li desplegables y en conjunto con js permite que pueda mostrase u ocultarse
            -->
            <ul class="side-menu">
                <li><a href="#" class="active" id="panel"><i class="fa-solid fa-table-columns icon"></i>Panel</a></li>

                <!--separador: JEFE FACULTAD -->
                    <li class="divider" data-text="Trabajos de grado"></li> <!--li separador-->
                            
                    <li>
                        <a href="#" id="panel"><i class="fa-solid fa-briefcase icon"></i>Gestionar trabajos<i class="fa-solid fa-chevron-down icon-derecho"></i></i></a>

                        <ul class="side-dropdown">
                            <?php 
                                error_reporting(0);
                                $cargo_usuario = $_SESSION['rol_id'];
                                
                                switch($cargo_usuario){
                                    //ADMINISTRADOR
                                    case 1:                                        
                                        echo '
                                        <li><a href="#" id="pregrado"> Trabajos de pregrado</a></li>
                                        <li><a href="#" id="posgrado"> Trabajos de posgrado</a></li>
                                        <li><a href="#" id="pasantia"> Trabajos de Pasantías</a></li>
                                        ';
                                        break;
                                    //JEFES DE FACULTAD
                                    case 2:
                                    case 3:
                                    case 4:
                                    case 5:
                                    case 6:
                                        echo '
                                        <li><a href="#" id="pregrado"> Trabajos de pregrado</a></li>
                                        <li><a href="#" id="pasantia"> Trabajos de Pasantias</a></li>';
                                        break;
                                    //JEFE DE POSTGRADO
                                    case 7:
                                        echo '<li><a href="#" id="posgrado"> Trabajos de Posgrado</a></li>';
                                        break;
                                    default:
                                        echo '
                                        <li><a href="#" id="error">Error en la pagina</a></li>
                                        ';

                                }
                            
                            ?>
                            
                        </ul>
                    </li>

                    
                
                <!--separador: ADMINISTRADOR -->
                    <?php 
                                error_reporting(0);
                                $cargo_usuario = $_SESSION['rol_id'];
                                
                                if($cargo_usuario == '1'){
                                        echo '
                                        <li class="divider" data-text="administrador"></li> <!-- li separador-->
                                        <li><a href="#" id="usuarios"><i class="fa-solid fa-user icon"></i> Gestionar usuarios</a></li>
                                        <li><a href="#" id="proxi"><i class="fa-solid fa-landmark icon"></i> Gestionar facultades</a></li>
                                        <li><a href="#" id="proxi"><i class="fa-solid fa-graduation-cap icon"></i> Gestionar carreras</a></li>
                                        <li><a href="#" id="proxi"><i class="fa-solid fa-glasses icon"></i> Gestionar lineas de investigación</a></li>
                                        <li><a href="#" id="proxi"><i class="fa-solid fa-book icon"></i> Gestionar áreas de conocimiento</a></li>
                                        ';
                                }
                            
                                ?>
                
            </ul>
        </section>

    <!--=== 👀 #CONTENIDO: 
        Lo que no pertenece a la barra lateral 
    ===-->
        <section id="contenido">

            <!-- #nav 
                Toda la barra que se encuentra por encima-->
            <nav>
                <!-- boton interruptor: el que despliega el side-menu -->
                <i class="fa-solid fa-bars btn-menu interruptor-sidebar"></i>

                <!-- barra de busqueda -->
                    <form action="#">
                        <div class="form-grupo">
                                <input type="text" placeholder="Buscar..." id="busqueda">
                                <i class="fa-solid fa-magnifying-glass icon" id="buscar" onclick="loadContent('buscar',1)" ></i>
                        </div>
                    </form>
        
                <span class="divider"></span>

                <!-- Perfil para configuracion de usuario -->
                    <div class="perfil">
                        <img src="img/6325109.png" alt="">
                        <ul class="perfil-link">
                            <li><a href="#"><i class="fa-solid fa-pen-to-square icon"></i>Editar perfil</a></i></li>
                            <li><a href="./vistas/logout.php"><i class="fa-solid fa-right-from-bracket icon"></i> Salir</a></i></li>
                        </ul>
                    </div>
            </nav>

        <!-- 👀 #main: 
            Todo lo que cambia en cada pagina que pertenezca al panel de administracion 
                BIENVENIDO / INDICADOR DE PAGINA / INFO-DATA (cuadritos de porcentajes): pregrado, posgrado, pasantias
        -->
            <main id="main-content">
            <?php $nombre_usuario = $_SESSION['nombre'];
            echo '<h1 class="bienvenido">Bienvenido, '.$nombre_usuario.'</h1>'; ?>

            </main>
    </section>

</body>

<footer></footer>
<script src="js/admin-script.js"></script>
<script src="js/ajax.js"></script>
<script src="js/gestion-usuarios.js"></script>
</body>
</html>