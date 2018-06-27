<?php

class EnlacesPaginas{

	public static function enlacesPaginasModel($enlaces){
		if( $enlaces=="registros/registro_usuario"||$enlaces=="aplazamiento/form_aplazamiento"||$enlaces=="desercion/form_desercion"||$enlaces=="registros/form_novedades"){
			$modulo="views/modulos/formularios/".$enlaces.".php";
		}
		else if($enlaces=="index"){
			$modulo="views/modulos/cuerpo/slider.php";
		}else if($enlaces=="ok") {
			$modulo="views/modulos/cuerpo/ok.php";
		}
		else if($enlaces=="ok") {
			$modulo="views/modulos/cuerpo/ok.php";
		}else if($enlaces=="perfil") {
			$modulo="views/modulos/cuerpo/perfil.php";
		}
		else if($enlaces=="perfil_instructor") {
			$modulo="views/modulos/cuerpo/perfil_instructor.php";
		}
		else if($enlaces=="perfil_apoyo_admin") {
			$modulo="views/modulos/cuerpo/perfil_apoyo_admin.php";
		}
		/*else if($enlaces=="perfil") {
			$modulo="views/modulos/cuerpo/perfil.php";
		}*/
		else{
			$modulo="views/modulos/cuerpo/slider.php";
		}
		return $modulo;
	}

}

?>