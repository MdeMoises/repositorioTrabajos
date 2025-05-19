    
    <head>
        <title>Mi caja</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,
         user-scalable=no, initial-scale=1, maximum-scale=1, minimun-scale=1">
    </head>
    <body>
        <main>
            <h1>Formulario</h1> 
            <form action="./php/formulario_guardar.php" autocomplete="off" method="post" enctype="multipart/form-data" class="FormularioAjax">
                <label for="titulo">Titulo:</label><br>
                    <input type="text" name="titulo" id="titulo" placeholder="escriba el titulo"><br><br>

                <label for="autor">Autor:</label><br>
                    <input type="text" name="autor" id="autor" placeholder="escriba el autor"><br><br>

                <label for="notagrado">Nota de grado:</label><br>
                    <input type="text" name="nota" id="nota" placeholder="Nota de grado"><br><br>

                <label>Sede: </label><br>
                    <select name="sede" id="sede">
                        <option value="">Ciudad Guayana</option>
                        <option value="">Anaco</option>
                        <option value="">Acarigua estado Cinamonroll</option>
                    </select><br><br>

                <label>Facultad: </label><br>
                    <select name="facultad" id="facultad">
                        <option value="">Ingenieria</option>
                        <option value="">FACES</option>
                        <option value="">Derecho</option>
                    </select><br><br>

                <label>Carrera: </label><br>
                    <select name="carrera" id="carrera">
                        <option value="">Ingenieria en sistemas</option>
                        <option value="">Ingenieria informatica</option>
                        <option value="">Ingenieria civil</option>
                        <option value="">League of Legend</option>
                    </select><br><br>

                <label>Area de conocimiento: </label><br>
                    <select name="area" id="area">
                        <option value="">Redes y Telemática</option>
                        <option value="">Ingeniería del Software</option>
                        <option value="">Gerencia Informática</option>
                        <option value="">Arquitectura del Computador</option>
                    </select><br><br>

                <label>Linea de investigacion: </label><br>
                    <select name="linea" id="linea">
                        <option value="">1- Sistemas de información de apoyo a la gestión de empresas comerciales y de
                        servicios de pequeñas, medianas y gran envergadura</option>
                        <option value="">2- Sistemas de información de apoyo a la gestión de empresas públicas y de
                        servicios comunitarios</option>
                        <option value="">3- Análisis, desarrollo y evaluación de métodos numéricos de ingeniería</option>
                    </select><br><br>

                <label>Fecha de entrega: </label>
                    <input type="month" name="fecha" id="fecha"><br><br>

                <label>Resumen: </label> <br>
                    <textarea name="resumen" id="resumen"></textarea><br><br>

                <laber>Trabajo o informe de grado:</laber> <br>
                    <input type="file" name="trabajo" id="trabajo"><br><br>

                <label>Limpiar:</label><br>
                    <input type="reset"><br><br>

                <input type="submit">

            </form>
        </main>
        <script src="./js/ajax.js"></script>
    </body>