<?php 
	error_reporting(E_ERROR | E_WARNING | E_PARSE); 
	include("config.php"); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Datos Para El Master</title>
<script src="jquery.js"></script>
<script src="funciones.js"></script>
</head>
<body>
<form method="post" name="form1" action="MasterGenerador.php">
	<fieldset>
		<legend>Servidor</legend>
		<table>
			<?php if($_SESSION['connect'] == "no"){ ?>
			<tr>
				<td>Listar Proyectos:</td>
				<td><select name="txtconexiones" id="txtconexiones">
					<option value="-">-</option>
					<?php
						print(listCon());
					?>
				</select></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Nombre Proyecto: </td>
				<td><input type="text" id="txtproyecto" <?php print($fielActDes); ?> name="txtnombproyect" value = "<?php print($proyecto); ?>"/></td>
			</tr>
			<tr>
				<td>Servidor:</td>
				<td><input type="text" id="txtservidor" <?php print($fielActDes); ?> name="txtservidor" value="<?php print($servidor); ?>"/></td>
			</tr>
			<tr>
				<td>Usuario:</td>
				<td><input type="text" id="txtusuario" <?php print($fielActDes); ?> name="txtusuario" value = "<?php print($usuario); ?>"/></td>
			</tr>
			<tr>
				<td>Clave:</td>
				<td><input type="password" id="txtclave" <?php print($fielActDes); ?> name="txtclave" value = "<?php print($clave); ?>"/>
					<input type="submit" id="btnaccion" name="<?php print($nambtn); ?>" value="<?php print($valbtn); ?>"/>
				</td>
			</tr>
		</table>
	</fieldset>

	<br>
	<br>
	
	<fieldset>
	<legend>Base de datos</legend>
    <table width="100%">
        	<td>Base de Datos:</td>
        	<td><select name="txtnombase" id="txtbase">
					<option value="">-</option>
					<?php print($_SESSION['lista_bd']); ?>
				</select></td>
       	 </tr>
         <tr>
        	<td>Tabla:</td>
        	<td><select name="txtnomtabla" id="txttabla">
					<option value="">-</option>
				</select>
				</td>
       	 </tr>
         <tr>
        	<td>Clase:</td>
        	<td><input type="text" id="txtnomclass" name="txtnomclass"/></td>
       	 </tr>
       	 <tr>
        	<td>Titulo Formulario:</td>
        	<td><input type="text" id="titulo_formulario" name="titulo_formulario"/></td>
       	 </tr>
         <tr>
        	<td>Atributos: </td>
        	<td>
        		<table border="1" width="100%">
        			<tr>
        				<th>Titulo</th>
        				<th>Columna</th>
        				<th>Tipo</th>
        				<th>Validaciones</th>
        				<th>-</th>
        			</tr>
        			<tbody id="atributos_col"></tbody>
        		</table>
        		</br>
        	<!--<textarea name="txtatrclass" id="txtatributos" cols="30">-->
        		

        	</textarea></td>
       	 </tr>
         <tr>
        	<td>Campos Claves:</td>
        	<td><input type="text" name="txtcamposclaves" id="txtcamposclaves" size="20" /></td>
       	 </tr>
       	 <tr>
        	<td>Ocultar Campo Clave:</td>
        	<td>Si<input type="radio" name="oculto" value="S" /> No<input type="radio" checked="checked" name="oculto" value="N" /></td>
       	 </tr>
		 <tr id="columna_relacion" style="display:none;">
        	<td>Campos Relacion:</td>
        	<td><input type="text" name="txtrelacion" id="txtrelacion" size="20" /></td>
       	 </tr>
         <tr>
        	<td>Operador logico:</td>
        	<td><input type="text" name="txtoperador" size="5" /></td>
       	 </tr>
    </table>
	</fieldset>
	
	<br>
	<br>
	

	<!--Para detalle-->
	<fieldset>
		<legend>Detalles</legend>
		<table border="1" width="800" style="text-align:center;" id="tabla_detalles">
			<tr>
				<td>Tabla</td>
				<td>Clase</td>
				<td>Atributos</td>
				<td>Campo Clave</td>
				<td>Campo Dependiente</td>
				<td>-</td>
			</tr>
			<tr>
				<td><select id="txttabla2">
					<option value="">-</option>
				</select></td>
				<td>
					<input type="text" id="clase2"/>
				</td>
				<td>
					<textarea id="atributos2"></textarea>
				</td>
				<td>
					<input type="text"  id="campoclave2"/>
				</td>
				<td>
					<input type="text"  id="campodependiente"/>
				</td>
				<td>
					<input type="button" value="+" onclick="add_column();"  id="btn_add_detalle"/>
				</td>
			</tr>
		</table>
	</fieldset>
	<br>
	<input type="submit" name="btnhacermagia" value="Hacer Magia!!" />
    </form>
</body>
</html>