<head>
        <title>UGMA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
         <link rel="stylesheet" href="./css/estilos-carousel.css">

         <link rel="stylesheet" 
         href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
         integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
         crossorigin="anonymous" 
         referrerpolicy="no-referrer" />

         <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        
    </head>
    <body>
        <header>
        </header>
        <main>
            <!-- -----------------------------CARRUSEL----------------------------- -->
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="img/carrusel/2.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/carrusel/3.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/carrusel/6.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/carrusel/5.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/carrusel/4.jpg" alt="">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"><i class="fa-solid fa-arrow-left"></i></button>
                    <button id="next"><i class="fa-solid fa-arrow-right"></i></button>
                </div>
            </div>
            <div class="slider2">
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
            <button class="btn-primario-azul" id="boton-sobre-ugma">Somos UGMA</button>
            </div>
            <!-- -----------------------------CARRUSEL SCRIPT----------------------------- -->
            <script>
                let slider = document.querySelector('.slider .list');
                let items = document.querySelectorAll('.slider .list .item');
                let next = document.getElementById('next');
                let prev = document.getElementById('prev');
                let dots = document.querySelectorAll('.slider2 .dots li');

                let lengthItems = items.length - 1;
                let active = 0;
                next.onclick = function(){
                    active = active + 1 <= lengthItems ? active + 1 : 0;
                    reloadSlider();
                }
                prev.onclick = function(){
                    active = active - 1 >= 0 ? active - 1 : lengthItems;
                    reloadSlider();
                }
                let refreshInterval = setInterval(()=> {next.click()}, 7000);
                function reloadSlider(){
                    slider.style.left = -items[active].offsetLeft + 'px';
                // 
                    let last_active_dot = document.querySelector('.slider2 .dots li.active');
                    last_active_dot.classList.remove('active');
                    dots[active].classList.add('active');

                    clearInterval(refreshInterval);
                    refreshInterval = setInterval(()=> {next.click()}, 7000);

    
                }

                dots.forEach((li, key) => {
                li.addEventListener('click', ()=>{
                    active = key;
                    reloadSlider();
                    })
                })
                window.onresize = function(event) {
                    reloadSlider();
                };
            </script>

        <!-- -----------------------------CONTEO Trabajos----------------------------- -->
        <?php 
            
        require("panel_admin/php/contarTrabajos.php");
            
            echo  '
            <div style="background-color: var(--color-seccion);width: 100%;height: 200px;display: flex;flex-direction: row;padding: 40px;position: relative;align-items: center;text-align: center;margin-top: -40px;justify-content: center;">
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>'.$totalPregrado.'</div> Trabajos Pregrado Publicados </div>  
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>'.$totalPasantia.'</div> Trabajos Pasantias Publicados </div> 
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>'.$totalPosgrado.'</div> Trabajos Posgrado Publicados </div> 
            </div>  
            ';
                
        ?>

            <!-- -----------------------------SITIO----------------------------- -->
             <div class="sitio">
                <div class="sitioizq">
                    <img src="img/sobre-sitio-img.jpg" alt="">
                </div>
                
                <div class="sitioder">

                    <div class="descripcion">
                        <p>Este repositorio es un espacio de intercambio y <span>colaboracion ademica</span>, donde estudiantes, docentes e investigadores pueden acceder a una vasta <span>coleccion de tesis</span> y <span>pasantias.</span></p>
                        <br>
                        <p>Al compartir nuestros trabajos, fortalecemos nuestra comunidad y contribuimos al <span>avance del conocimiento en diversas disciplinas</span></p>
                    </div>

                    <div class="filas">

                        <div class="inspiracion">
                            <img src="iconos/inspiracion (1).png" class="imgfilas">
                            <div class="filatext">
                                <h3>Inspiracion:</h3>
                                <p>descubre nuevas ideas y enfoques para tu investigacion.</p>
                            </div>
                        </div>

                        <div class="aprendizaje">
                            <img src="iconos/ocurrencia (1).png" alt="" class="imgfilas">
                            <div class="filatext">
                                <h3>Aprendizaje:</h3>
                                <p>Conoce las metodologias y herramientas utilizadas en diferentes areas del conocimiento.</p>
                            </div>
                        </div>

                        <div class="guia">
                            <img src="iconos/plano (1).png" class="imgfilas">
                            <div class="filatext">
                                <h3>Guia</h3>
                                <p>Utiliza estos trabajos como referencia para estructurar tu propio proyecto.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        
        <script src="/Repository/js/contadorArriba.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
        </main>
    </body>