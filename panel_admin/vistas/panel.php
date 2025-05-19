<?php   
    session_name("SESION"); //<!--/Repository-Ugma/panel_admin/inc/session_start.php-->     
    session_start();

                    $nombre_usuario = $_SESSION['nombre'];
                    echo '<h1 class="bienvenido">Bienvenido, '.$nombre_usuario.'</h1>';
                ?>

                <!-- INDICADOR PAGINA
                    Para indicarle al usuario donde se encuentra dentro de las categorias que son desplegables u opciones con formularios que puedan cambiar

                    ejemplo: GESTIONAR TRABAJOS / pasantias / subir pasantia
                             GESTIONAR CARRERA / agregar carrera
                             PERFIL / cambio de contraseña
                -->
                <ul class="indicador-pagina">
                    <li><a href="#">Inicio</a></li>

                    <li class="divider">/</li>

                    <li><a href="#" class="active">Panel principal</a></li>
                </ul>

                
                <!-- INFO-DATA
                    Numeros que indican los trabajos que se hallan en la base de datos
                        ✔ Cada clase .card es un cuadrito

                        ✔ Los H2 señalan la cantidad de trabajos que hay por categoria en la base de datos 
                            (pregrado, posgrado, pasantias)

                        ✔ los span con la clase .progreso son las barras azules que indican que porcentaje es esa categoria, 
                            para modificar su largo se actualiza el valor del atributo "data-value"

                        ✔ label es el porcentaje
                -->
                <div class="info-data">

                    <!-- trabajos -->
                    <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2><!-- 1500 -->
                                    <?php
                                        require_once("../php/contarTrabajos.php");
                                        echo "$totalTrabajos";  
                                    ?>
                                </h2>
                                <p>Trabajos</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>

                        <span class="progreso" data-value="100%" style="--value: 100%;"></span>
                        <span class="label">100%</span>
                    </div>
                    
                    <!-- pregrado -->
                    <div class="card"> 
                        <div class="porcentajes">
                            <div>
                                <h2><!--900-->
                                <?php
                                        require_once("../php/contarTrabajos.php");
                                        echo "$totalPregrado";  
                                ?>

                                </h2>
                                <p>Tesis de pregrado</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>
                            
                        <?php
                            require_once("../php/contarTrabajos.php");
                            $porcentaje = $totalPregrado*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".' style="--value: '.$porcentaje.'%;"></span>

                                <span class="label">'."$porcentaje%".' </span>
                            ';  
                        
                        ?>
                    </div>
                    
                    <!-- posgrado -->
                    <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2><!--900-->
                                <?php
                                        require_once("../php/contarTrabajos.php");
                                        echo "$totalPosgrado";  
                                ?>

                                </h2>
                                <p>Tesis de posgrado</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>
                        
                        <?php
                            require_once("../php/contarTrabajos.php");
                            $porcentaje = $totalPosgrado*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".' style="--value: '.$porcentaje.'%;"></span>

                                <span class="label">'."$porcentaje%".'</span>
                            ';  
                        
                        ?>

                    </div>
                    
                     <!-- pasantias -->
                     <div class="card">
                        <div class="porcentajes">
                            <div>
                                <h2>
                                <?php
                                        require_once("../php/contarTrabajos.php");
                                        echo "$totalPasantia";  
                                ?>
                                </h2>
                                <p>Pasantías</p>
                            </div>
                            <i class="fa-solid fa-briefcase icon"></i>
                        </div>

                        <?php
                            require_once("../php/contarTrabajos.php");
                            $porcentaje = $totalPasantia*100/$totalTrabajos;
                            $porcentaje = round($porcentaje,2);
                            echo '
                                <span class="progreso" data-value='."$porcentaje%".' style="--value: '.$porcentaje.'%;"></span>

                                <span class="label">'."$porcentaje%".'</span>
                            ';  
                        
                        ?>

                    </div>

                </div>