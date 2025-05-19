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

    <link rel="stylesheet" href="/Repository/css/estilos-header.css">

    <title>Repositorio UGMA</title>
</head>
<body>
    <header>
        <div class="contenedor-header">
                
            <div class="logo">
                <img src="/Repository/img/UGMA-logo.png" alt="Logo">
                <span>Universidad Noriental <br> "Gran Mariscal de Ayacucho"</span>
            </div>

            <nav>
                <div class="buscador-header">

                    <form action="/Repository/listado.php" method="get">
                    <input type="search" name="q" placeholder="Buscar" class="input-primario">
                    <button type="submit" class="btn-primario-amarillo" id="lupitabuscador"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <ul class="bar">
                    <li><a href="/Repository/" class="active"><i class="fa-solid fa-house"></i></a></li>

                    <li><a href="/Repository/sobreUgma.php"><i class="fa-solid fa-book-open"></i> Sobre UGMA</a></li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-briefcase"></i> Trabajos <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="/Repository/categorias.php?p=1&tipo=1">Tesis pregrado</a></li>
                            <li><a href="/Repository/categorias.php?p=1&tipo=3">Tesis posgrado</a></li>
                            <li><a href="/Repository/categorias.php?p=1&tipo=2">Pasantías</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown">
                        <a href="#"><i class="fa-solid fa-landmark"></i> Facultades <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="/Repository/categorias.php?p=1&facultad=1">Ingeniería</a></li>
                            <li><a href="/Repository/categorias.php?p=1&facultad=3">Derecho</a></li>
                            <li><a href="/Repository/categorias.php?p=1&facultad=2">FACES</a></li>
                            <li><a href="/Repository/categorias.php?p=1&facultad=5">Psicología</a></li>
                        </ul>
                    </li>

                    <li class="has-dropdown carreras">
                        <a href="#"><i class="fa-solid fa-graduation-cap"></i> Carreras <i class="fa-solid fa-chevron-down"></i></a>
                        <ul class="dropdown">
                            <li><a href="/Repository/categorias.php?p=1&carrera=1"><center>Ingeniería en Sistemas</center></cente></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=2"><center>Ingeniería Informática</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=3"><center>Ingeniería Civil</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=4"><center>Ingeniería en mantenimiento</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=5"><center>Administración de empresas</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=6"><center>Economía</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=7"><center>Derecho</center></a></li>
                            <li><a href="/Repository/categorias.php?p=1&carrera=8"><center>Psicología</center></a></li>
                        </ul>
                    </li>
                    


                    
                </ul>
            </nav>

            <div class="enlaces-header">
                <div class="ugma">
                    <a href="https://ugma.terna.net/" class="enlace"><i class="fa-solid fa-chalkboard-user"></i>Estudia con nosotros</a>
                    <button class="btn-secundario-azul"><a href="https://www.facebook.com/UGMAENLINEA/"><i class="fa-brands fa-facebook only"></i></a></button>
                    <button class="btn-secundario-amarillo"><a href="https://www.instagram.com/ugma_guayana/"><i class="fa-brands fa-instagram only"></i></a></button>
                </div>  
                </div>

            </div>
        </div>

    </header>

    <?php 
    error_reporting(0);
    $nombre_usuario = $_SESSION['nombre'];
    
    ?>
    

</body>
</html>