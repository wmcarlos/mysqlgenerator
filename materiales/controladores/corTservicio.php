<?php
require_once("../modelos/clsTservicio.php");
$lobjTservicio = new clsTservicio();

$lobjTservicio->acId_servicio=$_REQUEST['txtid_servicio'];
$lobjTservicio->acId_modulo=$_POST['txtid_modulo'];
$lobjTservicio->acNombre=strtoupper($_POST['txtnombre']);
$lobjTservicio->acUrl=$_POST['txturl'];
$lobjTservicio->posicion =  $_POST["txtposicion"];
$lobjTservicio->icono = $_POST["txticono"];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobjTservicio->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTservicio->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobjTservicio->buscar()){
			$lcId_servicio=$lobjTservicio->acId_servicio;
			$lcId_modulo=$lobjTservicio->acId_modulo;
			$lcNombre=$lobjTservicio->acNombre;
			$lcUrl=$lobjTservicio->acUrl; 
			$posicion = $lobjTservicio->posicion;
			$icono = $lobjTservicio->icono;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;

	case "buscar2":
	
		if($lobjTservicio->buscar2()){
			$lcId_servicio=$lobjTservicio->acId_servicio;
			$lcId_modulo=$lobjTservicio->acId_modulo;
			$lcNombre=$lobjTservicio->acNombre;
			$lcUrl=$lobjTservicio->acUrl; 
			$posicion = $lobjTservicio->posicion;
			$icono = $lobjTservicio->icono;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTservicio->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTservicio->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>