
<?php 
            require_once('./panel_admin/php/ContarTrabajos.php');

            echo  '
            <div style="background-color: var(--color-seccion);width: 100%;height: 200px;display: flex;flex-direction: row;padding: 40px;position: relative;align-items: center;text-align: center;margin-top: 100px;justify-content: center;">
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>500</div> Trabajos PreGrado Publicados </div>  
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>'.$totalPasantia.'</div> Trabajos Pasantias Publicados </div> 
            <div style="padding: 0 5%;"> <div style="font-size: 40px; font-weight: bold;" data-countup>'.$totalPosgrado.'</div> Trabajos Posgrado Publicados </div> 
            </div>  
            ';

            

?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
<script src="/Repository/js/contadorArriba.js"></script>