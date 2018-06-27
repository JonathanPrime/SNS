<?php
	class MvcController{
		
		public function plantilla(){
			include('views/plantilla.php');
		}
		public function enlacesPaginasController(){
			if (isset($_GET["action"])){
	
				$enlaces=$_GET["action"];
			
			}else{

				$enlaces="index";

			}
			$respuesta= EnlacesPaginas::enlacesPaginasModel($enlaces);	
			echo'<br><br><br>';
			include $respuesta;
		}

		//login
		//****************************************

		public function ingresoUsuarioController(){

			if(isset($_POST["ndl"])){
				$datosController = array( 'nd' =>$_POST["ndl"],
										  'tidoc'=>$_POST["tidocl"],
										  'contra' =>$_POST["contral"]);
				$respuesta = Datos :: ingresoUsuarioModel($datosController,"registro");
				if($respuesta["documento"]==$_POST["ndl"] && $respuesta["tipo_documento"]==$_POST["tidocl"] && $respuesta["contrasena"]==$_POST["contral"]){
					$_SESSION["n"]=$respuesta["primer_nombre"];
					$_SESSION["a"]=$respuesta["primer_apellido"];
					$_SESSION["c"]=$respuesta["correo"];
					$_SESSION["r"]=$respuesta["rol"];
					$_SESSION["documento"]=$respuesta["documento"];
					$_SESSION["tidocumento"]=$respuesta["tipo_documento"];
					//echo $_SESSION["r"];
					header("location:index.php?action=perfil");

				}//if

				else{
					echo '<div class="alert alert-danger alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Atención!</strong> No se pudo ingresar.
				  	</div>';

				}

			}//if

		}//login

		//registro
		//******************************************
		public function registroUsuarioController(){

			if(isset($_POST["pn"])){
				$datosController = array( 'pn' =>$_POST["pn"],
							'sn'=>$_POST["sn"],
							'pa' =>$_POST["pa"],
							'sa'=>$_POST["sa"],
							'nd'=>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'correo'=>$_POST["correo"],
							'contra'=>$_POST["contra"],
							'rol'=>"instructor");
				$respuesta = Datos :: registroUsuarioModel($datosController,"registro");

				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}
			}//if
			
		}//registroUsuarioController

		public function navController(){
			session_start();
			if(isset($_SESSION["documento"])){
				$datosController = array( 'nd' =>$_SESSION["documento"],
										  'tidoc'=>$_SESSION["tidocumento"]);

			$respuesta = Datos :: navModel($datosController,"registro");
			if ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="instructor") {
				include("./views/modulos/cuerpo/nav2.php");
				//echo "instructor";
			}//if
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="administrador") {
				include("./views/modulos/cuerpo/nav3.php");
				//echo "administrador";
			}
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="apoyoadministrador") {
				include("./views/modulos/cuerpo/nav3.php");
				//echo "apoyoadministrador";
			}
			elseif ($_SESSION["documento"]=="" && $_SESSION["tidocumento"]=="" ) {
				include("./views/modulos/cuerpo/nav1.php");
				//echo "apoyoadministrador";
			}
			}//if
			else{
				include("./views/modulos/cuerpo/nav1.php");
			}
			
		}//navController

		public function perfilController(){
			if(isset($_SESSION["documento"])){
				$datosController = array( 'nd' =>$_SESSION["documento"],
										  'tidoc'=>$_SESSION["tidocumento"]);

			$respuesta = Datos :: perfilModel($datosController,"registro");
			if ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="instructor") {
				include("./views/modulos/cuerpo/perfil_instructor.php");
				
			}//if
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="administrador") {
				include("./views/modulos/cuerpo/perfil_admin.php");
				
			}//elseif
			elseif ($respuesta["documento"]==$_SESSION["documento"] && $respuesta["tipo_documento"]==$_SESSION["tidocumento"] && $respuesta["rol"]=="apoyoadministrador") {
				include("./views/modulos/cuerpo/perfil_apoyo_admin.php");
				
			}//elseif
			
			}//if
			else{
				include("./views/modulos/cuerpo/nav1.php");
			}
		}//perfilController

		public function registroNovedadController(){

			if(isset($_POST["nd"])){





				if($_POST["novedad"] == "deserciones"){
					//echo "desercion";
					$tabla =$_POST["novedad"];
					$campos ="documento_aprendiz, tipo_documento, fecha_desercion, fallas, motivo, respuestas";
					$valores=":nd,:tidoc,:fecha,:fallas,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'fallas'=>$_POST["fallas"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>"respuesta");
				$respuesta = Datos :: registroDesercionModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}
				}//deseiciones
				//****************************************************************
				elseif($_POST["novedad"] == "cambio_de_jornada"){
					echo "cambio_de_jornada";

					$tabla =$_POST["novedad"];
					$campos ="documento_aprendiz, tipo_documento, jornada, fecha_cambio_jornada, motivo, respuestas";
					$valores=":nd,:tidoc,:jornada,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'jornada'=>$_POST["jornada"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>"respuesta");
				$respuesta = Datos :: registroCambioDeJornadaModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}	

					}//CAMBIO_jornada
				elseif($_POST["novedad"] == "reintegro"){
					echo "reintegro";

						$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, fecha_reintegro, sede_reintegro, motivo, respuesta";
					
					$valores=":nd,:tidoc,:fecha,:sede_reintegro,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'sede_reintegro'=>$_POST["sede_reintegro"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroReintegroModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

				}//reintegro
				elseif($_POST["novedad"] == "traslado"){
					echo "traslado";
					$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, sede_traslado, fecha_traslado, motivo, respuesta";
					
					$valores=":nd,:tidoc,:sede_traslado,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'sede_traslado'=>$_POST["sede_traslado"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroTrasladoModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

				}//traslado
				else{
					echo "la novedad que ha escogido tiene 5 opciones";
					$tabla =$_POST["novedad"];
					
					$campos ="documento_aprendiz, tipo_documento, fecha, motivo, respuesta";
					
					$valores=":nd,:tidoc,:fecha,:motivo,:respuesta";
					//echo $tabla .$campos.$valores;
					$datosController = array('nd' =>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'fecha'=>$_POST["fecha"],
							'motivo'=>$_POST["motivo"],
							'respuesta'=>$_POST["respuesta"]);
				$respuesta = Datos :: registroNovedadModel($datosController,$tabla,$campos,$valores);
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}

			}//if

			}
		}//registroNovedadController

		public function CambioRolController(){
				if(isset($_POST["nd"])){
				$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										   'rol' =>$_POST["rol"]);

			$respuesta = Datos :: CambioRolModel($datosController,"registro");
				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> se ha realizado el cambio de rol con exito.
				  	</div>';

				}else{
					echo $respuesta;
				

			}//if
			}
		}//CambioRolController

		public function consultaNovedadController(){
			
			if(isset($_POST["nd"])){
				
				$datosController = array( 'nd' =>$_POST["nd"],
										  'tidoc'=>$_POST["tidoc"],
										  );
				$tabla =$_POST["novedad"];
				$respuesta = Datos :: consultaNovedadModel($datosController,$tabla);
				var_dump($respuesta);
			}//if

		}//consultaNovedadController

		public function vistaAprendizController(){
			$respuesta=Datos :: vistaAprendizModel("registroaprendiz");
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>'.$key["TipoDocumento"].'</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			<td><img src="./views/i/editar.png" width="20"/></td>
			<td><img src="./views/i/elimi.png" width="20"/></td>
			</tr>';	
			}//foreach
			
		}//vistaAprendizController
		public function vistaAprendiziController(){
			$respuesta=Datos :: vistaAprendizModel("registroaprendiz");
			foreach ($respuesta as $key) {
			echo '<tr>
			<td>'.$key["PrimerNombre"]." ".$key["SegundoNombre"]." ".$key["PrimerApellido"]." ".$key["SegundoApellido"].'</td>
			<td>'.$key["Documento"].'</td>
			<td>'.$key["TipoDocumento"].'</td>
			<td>'.$key["Direccion"].'</td>
			<td>'.$key["Correo"].'</td>
			<td>'.$key["Telefono"].'</td>
			<td>'.$key["Ficha"].'</td>
			<td>'.$key["Sede"].'</td>
			<td>'.$key["Modalidad"].'</td>
			<td>'.$key["Jornada"].'</td>
			<td>'.$key["TipoFormacion"].'</td>
			
			</tr>';	
			}//foreach
			
		}//vistaAprendizController
		public function registroAprendizController(){

			if(isset($_POST["pn"])){
				$datosController = array( 'pn' =>$_POST["pn"],
							'sn'=>$_POST["sn"],
							'pa' =>$_POST["pa"],
							'sa'=>$_POST["sa"],
							'nd'=>$_POST["nd"],
							'tidoc'=>$_POST["tidoc"],
							'dir'=>$_POST["dir"],
							'correo'=>$_POST["correo"],
							'tel'=>$_POST["tel"],
							'ficha'=>$_POST["ficha"],
							'sede'=>$_POST["sede"],
							'modal'=>$_POST["modal"],
							'jornada'=>$_POST["jornada"],
							'tipo_form'=>$_POST["tipo_form"]
						);
				$respuesta = Datos :: registroAprendizModel($datosController,"registroaprendiz");

				if ( $respuesta=="success"){

					//header("location:index.php?action=ok");
					echo '<div class="alert alert-success alert-dismissible">
				    <button type="button" class="close" data-dismiss="alert">×</button>
				    <strong>Exito!</strong> El usuario se ha registrado correctamente. Ingresa desde el inicio.
				  	</div>';

				}else{
					echo $respuesta;
				}
			}//if
			
		}//registroaprendizcontroller


	}//clase

?>	