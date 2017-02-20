<?php
require_once("../modelos/clsTmodulo.php");
$lobjTmodulo = new clsTmodulo();

$lobjTmodulo->acId_modulo=$_REQUEST['txtid_modulo'];
$lobjTmodulo->acNombre=$_POST['txtnombre'];
$lobjTmodulo->url_modulo = $_POST['txturl_modulo'];
$lobjTmodulo->posicion = $_POST['txtposicion'];
$lobjTmodulo->icono = $_POST['txticono'];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTmodulo->buscar2()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTmodulo->incluir();  
		}
	
	break;
	
	case "buscar2":
	
		if($lobjTmodulo->buscar2()){
			$lcId_modulo=$lobjTmodulo->acId_modulo;
			$lcNombre=$lobjTmodulo->acNombre; 
			$url_modulo = $lobjTmodulo->url_modulo;
			$posicion = $lobjTmodulo->posicion;
			$icono = $lobjTmodulo->icono;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTmodulo->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTmodulo->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>