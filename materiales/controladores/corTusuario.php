<?php
session_start();
require_once("../modelos/clsTusuario.php");
$lobjTusuario = new clsTusuario();

$lobjTusuario->acNombre_usu=$_REQUEST['txtnombre_usu'];
$lobjTusuario->acClave=$_POST['txtclave'];
$lobjTusuario->acTipo=$_POST['txttipo'];
$lobjTusuario->acPregunta=$_POST['txtpregunta'];
$lobjTusuario->acRespuesta=$_POST['txtrespuesta'];
$lobjTusuario->estatus = $_POST['txtestatus'];
$lobjTusuario->nombre_completo = $_POST["txtnombre_completo"];
$lobjTusuario->correo = $_POST["txtcorreo"];
$lobjTusuario->id_pais = $_POST["txtid_pais"];
$lobjTusuario->url_avatar = $_POST["txturl_avatar"];
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){
	case "entrar":
		$arrData = $lobjTusuario->validar_entrada($lobjTusuario->acNombre_usu,$lobjTusuario->acClave);
		if(count($arrData) > 0){
			$_SESSION['user'] = $arrData[0]['nombre_usu'];
			$_SESSION['pass'] = $arrData[0]['clave'];
			$_SESSION['type'] = $arrData[0]['tipo'];
			$_SESSION['full_name'] = $arrData[0]['nombre_completo'];
			$lobjTusuario->reiniciar_contador($_SESSION['user']);
			if($arrData[0]['estatus'] == 2){
				header("location: ../index.php?valido=bloqueado");
			}else{
				header("location: ../vistas/index.php");
			}
			
		}else{
			$arr = $lobjTusuario->getData($_POST['txtnombre_usu']);
			//print_r ($arr); 
			if($arr[0]['estatus'] == 2){
				header("location: ../index.php?valido=bloqueado");
			}else{
			$lobjTusuario->incrementar_intentos($arr[0]['nombre_usu'],$arr[0]['intentos']);

						if($arr[0]['intentos'] == 3){
							$lobjTusuario->bloq_des($arr[0]['nombre_usu'], 2);
							$lobjTusuario->reiniciar_contador($arr[0]['nombre_usu']);
							header("location: ../index.php?valido=user_block");
						}else{
							header("location: ../index.php?valido=no_pass");
						}
			}
		}
	break;

	case "incluir":
	
		if($lobjTusuario->buscar2()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobjTusuario->incluir();  
		}
	
	break;
	
	case "buscar2":
	
		if($lobjTusuario->buscar2()){
			$lcNombre_usu=$lobjTusuario->acNombre_usu;
			$lcClave=$lobjTusuario->acClave;
			$lcTipo=$lobjTusuario->acTipo;
			$lcPregunta=$lobjTusuario->acPregunta;
			$lcRespuesta=$lobjTusuario->acRespuesta; 
			$estatus = $lobjTusuario->estatus;
			$nombre_completo = $lobjTusuario->nombre_completo;
			$correo = $lobjTusuario->correo;
			$id_pais = $lobjTusuario->id_pais;
			$url_avatar = $lobjTusuario->url_avatar;
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobjTusuario->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobjTusuario->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;

	case "comprobar_usuario":
	$arrData = $lobjTusuario->comprobar_usuarios($_POST['txtnombre_usu']);
	if(count($arrData) > 0){
		$_SESSION['user'] = $arrData[0]['nombre_usu'];
		$_SESSION['pregunta'] = $arrData[0]['pregunta'];
		header("location: ../vistas/responder_preguntas.php");
	}else{
		header("location: ../vistas/comprobar_usuario.php?error=si");
	}
	break;

	case "responder_preguntas":
		$arrData = $lobjTusuario->validar_respuesta($_POST['txtnombre_usu'],$_POST['txtrespuesta']);
		if(count($arrData) > 0){
			$_SESSION['user'] = $arrData[0]['nombre_usu'];
			header("location: ../vistas/cambiar_contrasena.php");
		}else{
			header("location: ../vistas/responder_preguntas.php?error=si");
		}
	break;

	case "cambiar_contra":
		if($lobjTusuario->cambiar_contra($_POST['txtnombre_usu'],$_POST['txtnueva_contra'])){
			header("location: ../index.php?valido=si");
		}else{
			header("location: ../index.php?valido=no");
		}
	break;
}

?>