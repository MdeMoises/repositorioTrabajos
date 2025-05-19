    <head>
        <title>UGMA</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
         <link rel="stylesheet" href="css/estilos-carousel.css">
    </head>
    <body>
        <main>
        
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <img src="img/img.jpeg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/img.jpeg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/img.jpeg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/img.jpeg" alt="">
                    </div>
                    <div class="item">
                        <img src="img/img.jpeg" alt="">
                    </div>
                </div>
                <div class="buttons">
                    <button id="prev"></button>
                    <button id="next"></button>
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
            
        </main>
    </body>