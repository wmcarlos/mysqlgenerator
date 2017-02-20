<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTmodulo.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = $objFunciones->ultimo_id_plus1('tmodulo','id_modulo');
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Tmodulo</title>
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
<h1>Modulo</h1>
<table border='1' class='datos' align='center'>
<tr style="display:none;">
<td align='right'>id_modulo:</td>
<td><input type='text' class='validate[required]' disabled name='txtid_modulo' value='<?php print($lcId_modulo);?>' /></td>
</tr>
<tr>
<td align='right'>Nombre:</td>
<td><input type='text' class='validate[required]' disabled name='txtnombre' value='<?php print($lcNombre);?>' /></td>
</tr>
<tr>
<td align='right'>Url Modulo:</td>
<td><input type='text' size="50" disabled name='txturl_modulo' value='<?php print($url_modulo);?>' /></td>
</tr>
<tr>
<td align='right'>Posicion :</td>
<td><input type='text' class='validate[required]' size="1" disabled name='txtposicion' value='<?php print($posicion);?>' /></td>
</tr>
<tr>
<td align='right'>Icono:</td>
<td><input type='text' disabled name='txticono' value='<?php print($icono);?>' /></td>
</tr>
</td>
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcId_modulo); ?>'>
</table>
<?php $objFunciones->botonera_general('Tmodulo','total',$id); ?>
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