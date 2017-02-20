<?php
require_once("../modelos/clsTrol.php");
require_once("../modelos/clsFunciones.php");
$objFunciones = new clsFunciones;
$lobjTrol = new clsTrol();

$lobjTrol->acCodigo=$_REQUEST['txtcodigo'];
$lobjTrol->acNombre=$_POST['txtnombre'];
$lcVarTem = $_POST["txtvar_tem"];
$servi = $_POST['servicios'];
$lcOperacion=$_REQUEST["txtoperacion"];

$servicios = $lobjTrol->listar_modulos();
switch($lcOperacion){

	case "incluir":
		$contador = 0;
		if($lobjTrol->buscar()){
			$lcListo = 0;
		}else{
			$lobjTrol->incluir();
			$id=$objFunciones->ultimo_id_plus1("trol","codigo");
			$id=($id-1);
			for($i=0;$i<count($servi);$i++){
				$lobjTrol->incluir_detalle($id,$servi[$i]);
			}
			$lcListo = 1;
		}
	
	break;
	
	case "buscar2":
	
		if($lobjTrol->buscar2()){
			$lcCodigo=$lobjTrol->acCodigo;
			$lcNombre=$lobjTrol->acNombre; 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
		$lobjTrol->modificar($lcVarTem);
		if($lobjTrol->validarDetalle($_REQUEST['txtcodigo']) > 0){
			$lobjTrol->delete_detalle($_REQUEST['txtcodigo']);
			for($i=0;$i<count($servi);$i++){
				$lobjTrol->incluir_detalle($_REQUEST['txtcodigo'],$servi[$i]);
			}
		}else{
			for($i=0;$i<count($servi);$i++){
				$lobjTrol->incluir_detalle($_REQUEST['txtcodigo'],$servi[$i]);
			}
		}
		$lcListo = 1;
	
	break;
	
	case "eliminar":
	
		if($lobjTrol->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

?>