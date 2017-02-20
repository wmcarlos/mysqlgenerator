<?php
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/corTusuario.php');
$objFunciones = new clsFunciones;
$operacion = $lcOperacion;
$listo = $lcListo;
if(($operacion!='buscar' && $listo!=1) || ($operacion!='buscar' && $listo==1))
{
$id = "no";
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion Tusuario</title>
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
<h1>Usuario</h1>
<table border='1' class='datos' align='center'>
<tr>
<td align='right'>Nombre Usuario:</td>
<td><input type='text' class='validate[required]' disabled name='txtnombre_usu' value='<?php print($lcNombre_usu);?>' /></td>
</tr>
<tr>
<td align='right'>Clave:</td>
<td><input type='text' class='validate[required]' disabled name='txtclave' value='<?php print($lcClave);?>' /></td>
</tr>
<tr>
<td align='right'>Rol:</td>
<td><select class='validate[required]' disabled name='txttipo'>
	<option value="">-</option>
	<?php print $objFunciones->crear_combo("trol","codigo","nombre",$lcTipo); ?>
</select></td>
</tr>
<tr>
<td align='right'>Pregunta:</td>
<td><input type='text' size="40" class='validate[required]' disabled name='txtpregunta' value='<?php print($lcPregunta);?>' /></td>
</tr>
<tr>
<td align='right'>Respuesta:</td>
<td><input type='text' size="40" class='validate[required]' disabled name='txtrespuesta' value='<?php print($lcRespuesta);?>' /></td>
</tr>
<tr>
<tr>
<td align='right'>Nombre Completo:</td>
<td><input type='text' size="40" class='validate[required]' disabled name='txtnombre_completo' value='<?php print($nombre_completo);?>' /></td>
</tr>
<tr>
<td align='right'>Correo:</td>
<td><input type='text' size="50" class='validate[required]' disabled name='txtcorreo' value='<?php print($correo);?>' /></td>
</tr>
<tr>
<td align='right'>Estatus:</td>
<td>
	Desbloqueado <input type='radio' checked="checked" class='validate[required]' disabled name='txtestatus' value='1' />
	Bloqueado <input type='radio' <?php if($estatus==2){ print "checked='checked'"; }?> class='validate[required]' disabled name='txtestatus' value='2' /></td>
</tr>
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='<?php print($lcNombre_usu); ?>'>
</table>
<?php $objFunciones->botonera_general('Tusuario','total',$id); ?>
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