<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	session_start();
	function listCon(){
		$file = file_get_contents("conexiones.txt");
		$arrLine = explode(':', $file);
		for($e = 0;$e<count($arrLine)-1;$e++){
					$arrAtri = explode(',', $arrLine[$e]);
					$cadena = $cadena."<option value = '".$arrAtri[0].",".$arrAtri[1].",".$arrAtri[2].",".$arrAtri[3]."'>".$arrAtri[0]."</option>";
		}
		
		return $cadena;
		
	}
	
	if($_SESSION['connect'] == "yes"){
		$valbtn = "Desconectar";
		$nambtn = "btndesconectar";
		$fielActDes = "readOnly = 'true'";
		$proyecto = $_SESSION['proyect'];
		$servidor = $_SESSION['server'];
		$usuario = $_SESSION['user'];
		$clave = $_SESSION['pass'];
	}else{
		$valbtn = "Crear";
		$nambtn = "btncrear";
		$servidor = "localhost";
		$usuario = "root";
		$fielActDes = "";
		$_SESSION['connect'] = 'no';
	}
?>