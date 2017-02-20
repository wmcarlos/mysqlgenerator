<?php
require_once("clsDatos.php");
class clsFunciones extends clsDatos{
public $librerias_generales = '<link href="css/form_detalle.css" rel="stylesheet" type="text/css" />
			<link href="css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="plugins/jqueryui/jquery-ui.min.css">
			<!--Css-->
			<script src="js/jquery.js"></script>
			<script src="js/jquery.validationEngine-es.js"></script>
			<script src="js/jquery.validationEngine.js"></script>
			<script src="plugins/jqueryui/jquery-ui.min.js"></script>
			<script>
					$(document).ready(function(){
						var f = document.form1;
						$(".validaciones").click(function(){
						var f = document.form1;
						if(f.txtoperacion.value == "incluir"){
							f[0].disabled = false;
						}
						if(f.txtoperacion.value == "modificar"){
							f[0].disabled = false;
							f[0].readOnly = true;
						}
					$("#form1").validationEngine();});});
			</script>
			<script src="js/mensajes.js"></script>
			<script src="js/centro.js"></script>
			<script src="js/validacionGeneral.js"></script>
			<!--JS-->
			';

public $cuadro_busqueda = '<div id="mascara"></div><div id="contenedor_resultados_busqueda"><form method="post" name="form2"><table class="datos" width="100%"><tr><th colspan="2">Busqueda<input type="button" title="Cerrar Ventana" style="float:right; padding:5px; font-size:14px;" salir="" class="cerrar_resultados" name="btn_cerrar" value="X" /></th></tr><tr><td colspan="2" align="center"><input type="text" class="txtbuscador" style="padding:5px;" placeholder="Ingresa una palabra Clave Para Tu Busqueda" style="height:20px; padding:5px;" name="txtbuscador" id="txtbuscador_tabla" size="50" /></td></tr></table><div class="datos_busqueda"></div></form></div>';

function botonera_general($clase,$salir='total',$id){$botonera = '<table border="1" class="botonera datos" align="center"><tr><td><input type="button" name="btnincluir" onclick="Incluir(\''.$id.'\');"  /></td><td><input type="button" name="btnbuscar" class="btn_buscar" clase="'.$clase.'"  salir="'.$salir.'" /></td><td><input type="button" name="btnmodificar" onclick="Modificar();" disabled  /></td><td><input type="button" name="btneliminar" onclick="Eliminar();" disabled /></td><td><input type="submit" name="btnguardar" class="validaciones" disabled value="" /></td><td><input type="button" name="btncancelar" onclick="Cancelar(\''.$clase.'\');" disabled  /><input type="hidden" id="txtreloadclass" value="'.$clase.'"/></td><tr></table>';print($botonera);}

 
	function crear_combo($tabla,$value,$text,$selected)
	{
		$this->ejecutar("select $value,$text from $tabla order by $text asc");
		while($laRow=$this->arreglo())
		{	
			if( (isset($selected)) && ($selected == trim($laRow[$value])) ){
				$llEnc=$llEnc."<option value='".trim($laRow[$value])."' selected>".strtoupper($laRow[$text])."</option>";
			}else{
				$llEnc=$llEnc."<option value='".trim($laRow[$value])."'>".strtoupper($laRow[$text])."</option>";
			}
		}
		return $llEnc;
	}

	function combo_segun_combo($tabla,$value,$text,$padre,$value_padre,$selected)
	{
		$this->ejecutar("select $value,$text from $tabla where $padre = $value_padre order by $text asc");
		while($laRow=$this->arreglo())
		{	
			if( (isset($selected)) && ($selected == trim($laRow[$value])) ){
				$llEnc=$llEnc."<option value='".trim($laRow[$value])."' selected>".strtoupper($laRow[$text])."</option>";
			}else{
				$llEnc=$llEnc."<option value='".trim($laRow[$value])."'>".strtoupper($laRow[$text])."</option>";
			}
		}
		return $llEnc;
	}

	function listar_checkbox($tabla,$value,$name,$id,$text,$prefijo)
	{
			$this->ejecutar("select * from $tabla");
			while($laRow=$this->arreglo())
			{
				$llEnc=$llEnc."<input type='checkbox' disabled id='".$prefijo."_".$laRow[$id]."' name='$name' value='".$laRow[$value]."'>".$laRow[$text]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			}
			return $llEnc;
	}
		
	function cargar_checkbox($tabla,$valor,$where,$campo)
	{
			$arr = array();
			$con = 0;
			$this->ejecutar("select * from  $tabla where($where='$valor')");
			while($laRow=$this->arreglo()){
				$arr[$con] = $laRow[$campo];
				$con++;
			}
			return $arr;
	}

	function ultimo_id_plus1($tabla,$value)
	{
		$this->ejecutar("SELECT MAX($value) AS id FROM $tabla");
		if($laRow=$this->arreglo())
		{		
			$id = trim($laRow['id']);
		}
		return ($id+1);
	}

	function sacar_id($table,$campo,$value,$sacar)
	{
		$this->ejecutar("select * from $table where($campo = '$value')");
		if($laRow=$this->arreglo())
		{		
			$id	= $laRow[$sacar];
		}
			return $id;
	}

}

?>