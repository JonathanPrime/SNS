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
							'rol'=>"visitante");
				$respuesta = Datos :: registroUsuarioModel($datosController,"registro");

				if ( $respuesta=="success"){

					header("location:index.php?action=ok");

				}else{
					echo $respuesta;
				}
			}//if
			
		}//registroUsuarioController

		//login
		//****************************************

		public function ingresoUsuarioController(){

			if(isset($_POST["ndl"])){
				$datosController = array( 'nd' =>$_POST["ndl"],
										  'tidoc'=>$_POST["tidocl"],
										  'contra' =>$_POST["contral"]);
				$respuesta = Datos :: ingresoUsuarioModel($datosController,"registro");
				if($respuesta["documento"]==$_POST["ndl"] && $respuesta["tipo_documento"]==$_POST["tidocl"] && $respuesta["contrasena"]==$_POST["contral"]){
					header("location:index.php?action=ok");

				}//if

				else{
					echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Atención!</strong> No se pudo ingresar.
  </div>';

				}

			}//if

		}//login

	}//clase

?>	