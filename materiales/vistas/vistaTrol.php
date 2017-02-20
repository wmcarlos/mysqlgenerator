<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTrol.php');
require_once("../modelos/clsTrol.php");
$lobjTrol = new clsTrol();
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $objFunciones->ultimo_id_plus1('trol','codigo');
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Trol</title>
<?php print($objFunciones->librerias_generales); ?>
<script>
function cargar()
{
	var operacion = '<?php print($operacion);?>';
	var listo = '<?php print($listo);?>';
	mensajes(operacion,listo);
	cargar_select(operacion,listo);
}
</script>
</head>
<body onload='cargar();'>
<?php print($objFunciones->cuadro_busqueda); ?>
<!--
	Codigo
	Antes del
	Formulario
	antes_form.php
-->
<?php @include('antes_form.php'); ?>
<div id='mensajes_sistema'></div><br />
<form name='form1' id='form1' method='post'/>
<div class='cont_frame'>
<h1>Roles</h1>
<table border='1' class='datos' align='center'>
<tr style="display:none;">
<td align='right'>codigo:</td>
<td><input type='text' class='validate[required]' disabled name='txtcodigo' value='<?php print($lcCodigo);?>' /></td>
</tr>
<tr>
<td align='right'>Nombre:</td>
<td><input type='text' class='validate[required]' disabled name='txtnombre' value='<?php print($lcNombre);?>' /></td>
</tr>
</td>
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcCodigo); ?>'>
</table>
</div>
<div class='cont_frame'>
<h1>Servicos de Accesso</h1>
<table class="datos">
	<tr align='center'>
		<td>MODULO</td>
		<td>SERVICIO</td>
		<td>URL</td>
		<td>-</td>
	</tr>
	<?php
	  $arrdata = $servicios;
	  $contador = 0;
	  while($arrdata[$contador]['modulo'] !=null){
	  		if(isset($_GET['txtcodigo']) and !empty($_GET['txtcodigo'])){
	  			if($lobjTrol->validar_existe($arrdata[$contador]['id_servicio'],$_GET['txtcodigo'])){
	  				$cad.="<tr>";
						$cad.="<td>".$arrdata[$contador]['modulo']."</td>";
						$cad.="<td>".$arrdata[$contador]['nombre']."</td>";
						$cad.="<td>".$arrdata[$contador]['url']."</td>";
						$cad.="<td><input type='checkbox' checked='checked' disabled='disabled' name='servicios[]' value='".$arrdata[$contador]['id_servicio']."'/></td>";
					$cad.="</tr>";
	  			}else{
	  				$cad.="<tr>";
						$cad.="<td>".$arrdata[$contador]['modulo']."</td>";
						$cad.="<td>".$arrdata[$contador]['nombre']."</td>";
						$cad.="<td>".$arrdata[$contador]['url']."</td>";
						$cad.="<td><input type='checkbox' disabled='disabled' name='servicios[]' value='".$arrdata[$contador]['id_servicio']."'/></td>";
					$cad.="</tr>";
	  			}
	  		}else{
	  			$cad.="<tr>";
					$cad.="<td>".$arrdata[$contador]['modulo']."</td>";
					$cad.="<td>".$arrdata[$contador]['nombre']."</td>";
					$cad.="<td>".$arrdata[$contador]['url']."</td>";
					$cad.="<td><input type='checkbox' disabled='disabled' name='servicios[]' value='".$arrdata[$contador]['id_servicio']."'/></td>";
				$cad.="</tr>";
	  		}
			
	  	$contador++;
	  }
	  print $cad;
	 ?>
</table>
<?php $objFunciones->botonera_general('Trol','total',$id); ?>
</div>
</form>
<!--
	Codigo
	Despues del
	Formulario
	despues_form.php
-->
<?php @include('despues_form.php'); ?>
</body>
</html>