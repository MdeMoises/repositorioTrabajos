<?php

// Conexion a la base de datos //
    function conexion(){
		try {
			$pdo = new PDO('mysql:host=127.0.0.1:33065;dbname=repositorio', 'root', '');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo 'Error de conexión: ' . $e->getMessage();
		}
		return $pdo;
	}
	

# Limpiar cadenas de texto #
	function limpiar_cadena($cadena){
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		$cadena=str_ireplace("<script>", "", $cadena);
		$cadena=str_ireplace("</script>", "", $cadena);
		$cadena=str_ireplace("<script src", "", $cadena);
		$cadena=str_ireplace("<script type=", "", $cadena);
		$cadena=str_ireplace("SELECT * FROM", "", $cadena);
		$cadena=str_ireplace("DELETE FROM", "", $cadena);
		$cadena=str_ireplace("INSERT INTO", "", $cadena);
		$cadena=str_ireplace("DROP TABLE", "", $cadena);
		$cadena=str_ireplace("DROP DATABASE", "", $cadena);
		$cadena=str_ireplace("TRUNCATE TABLE", "", $cadena);
		$cadena=str_ireplace("SHOW TABLES;", "", $cadena);
		$cadena=str_ireplace("SHOW DATABASES;", "", $cadena);
		$cadena=str_ireplace("<?php", "", $cadena);
		$cadena=str_ireplace("?>", "", $cadena);
		$cadena=str_ireplace("--", "", $cadena);
		$cadena=str_ireplace("^", "", $cadena);
		$cadena=str_ireplace("<", "", $cadena);
		$cadena=str_ireplace("[", "", $cadena);
		$cadena=str_ireplace("]", "", $cadena);
		$cadena=str_ireplace("==", "", $cadena);
		$cadena=str_ireplace(";", "", $cadena);
		$cadena=str_ireplace("::", "", $cadena);
		$cadena=trim($cadena);
		$cadena=stripslashes($cadena);
		return $cadena;
	}

# Verificar datos #
	function verificar_datos($filtro,$cadena){
		if(preg_match("/^".$filtro."$/", $cadena)){
			return false;
        }else{
            return true;
        }
	}

// Eliminar acentos //
	function eliminar_acentos($cadena){
		
		$cadena = str_replace(
			array('Á', 'À', 'Â', 'Ä', 'É', 'È', 'Ê', 'Ë', 'Í', 'Ì', 'Ï', 'Î', 'Ó', 'Ò', 'Ö', 'Ô', 'Ú', 'Ù', 'Û', 'Ü', 'Ñ', 'Ç'),
			array('á', 'à', 'â', 'ä', 'é', 'è', 'ê', 'ë', 'í', 'ì', 'ï', 'î', 'ó', 'ò', 'ö', 'ô', 'ú', 'ù', 'ü', 'û', 'ñ', 'ç'),
			$cadena
		);
	
		return $cadena;
	}
//PAGINADORA DE TRABAJOS//
	function paginadora_trabajos($pagina,$nregistros,$query,$nombre_listado,$lq=null,$ctipo=null,$cfacultad=null,$ccarrera=null){

		//Variables iniciales//
			$tabla=" ";
			//Pagina actual//
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;
			//Inicio del registro//
			$inicio = ($pagina>0) ? (($pagina * $nregistros)-$nregistros) : 0;


		//Concatenar a la Query el limite de inicio y numero de registros a montrar//
			$query.=" LIMIT ".$inicio.",".$nregistros;

		//Conexion BD y obtener los registros//
			$conectar = conexion();
			$cone = $conectar->query($query);
		//Obtener el total de registros//
			$total= $conectar->query("SELECT FOUND_ROWS()");
			$total= (int) $total->fetchColumn();

		//Calcular los n registros a enseñar y el total de todas las paginas// 
			$enseniar = min($nregistros,$total-$inicio);

			$total_paginas = ceil($total/$nregistros);
		//Contador de registro montado en html//
			$count=0;
		//Concatenar el numero de registros enseñados sobre el total de registros//
			$tabla.="<p class='coincidencias'> Enseñando ".$enseniar." de ".$total ." coincidencias</p>";
		//WHILE que crea cada box de registro//
			while($row = $cone->fetch(PDO::FETCH_ASSOC)){
				$tabla .= '<li>
				<div class="trabajo">
					<a href="trabajo.php?id='.$row['trabajo_id'].'">


                	<div class="listado">
						<div class="imagen-trabajo">
							<img src="img/T.E/'.$row['tipo_trabajo_nombre'].'-'.$row['carrera_nombre'].'.webp" alt="">

							<span class="imagen" style="background-image: url("./img/pregrado-civilpeque.png");"></span> 
						</div>
					
						<div class="contenedor-infoTrabajo">

							<div class="metaDatos">

								<h2 class="tituloTrabajo"> 
									'.ucfirst(eliminar_acentos(strtolower($row['trabajo_titulo']))).'

								</h2>
								
								

								<div class="descripcion">
									<p>Autor: 
										<i class="fa-solid fa-user"></i>
										'.$row["autor_nombre"].'
									</p>

									<p>Carrera:
										 <i class="fa-solid fa-graduation-cap"></i>
										'.$row["carrera_nombre"].'
									</p>

									<p>Área de investigación:
										<i class="fa-solid fa-book"></i>
										'.$row["area_nombre"].'
									</p>
								</div>
							</div>

							<div class="resumen">
								<p>
									'.$row['trabajo_resumen'].'
								</p>

								<a href="trabajo.php?id='.$row['trabajo_id'].'" class="btn">Leer más →</a>
							</div>

						</div>
					</div>
				</div>
				</li>';
				$count++;
			}
		//IF para concatenar al final si no hay mas registros en la pagina//
			if($count<$nregistros){
				$tabla.="<p class='coincidencias'> No hay mas registros por aqui</p>";
			}
		//Concatenar botones de paginacion//

			$tabla.='<br>';
			$tabla.= '<div class="botones-paginadora">';
			//Variables de Clase, categorias y q//
			$clase="";
			$categorias="";
			$q="";

			//Asignar categorias si las hay//
			if(isset($ctipo)){
				$categorias.='&tipo='.$ctipo;
			}
			if(isset($cfacultad)){
				$categorias.='&facultad='.$cfacultad;
			}
			if(isset($ccarrera)){
				$categorias.='&carrera='.$ccarrera;
			}

			//Asignar q//
			if(isset($lq)){
				$q.='&q='.$lq;
			}

			//FOR que crea los botones//
			for($i=1;$i<=$total_paginas;$i++){

				//Asignacion de tipo de boton con respecto a la pagina actual//
				if($pagina==$i){
					$clase='class="boton_p"';
				} else {
					$clase='class="boton"';
				}


				//Concatenacion resultante de botones de la paginadora//
				$tabla.= '<a type="button" '.$clase.' href="/Repository/'.$nombre_listado.'.php?p='.$i.$categorias.$q.'" >'.$i.'</a>
					';
			}
			$tabla.= '</div>';
		//Retornar HTML resultante//
			return $tabla;
	}