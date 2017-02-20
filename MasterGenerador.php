<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
//Datos del formulario Servidor
$proyecto = $_POST['txtnombproyect'];
$servidor = $_POST['txtservidor'];
$usuario = $_POST['txtusuario'];
$clave = $_POST['txtclave'];

$tabla = $_POST['txtnomtabla'];
$base_de_datos = $_POST['txtnombase'];
$clase = $_POST['txtnomclass'];
$titulo_form = $_POST['titulo_formulario'];
$AtributosClase = $_POST['txtatrclass'];
$metadato = $_POST['metadato'];
$arregloAtributosClase = $AtributosClase;
$camposclaves = $_POST['txtcamposclaves'];
$oculto = $_POST['oculto'];
$arregloCamposclaves = explode(',', $camposclaves);
$operador = $_POST['txtoperador'];

function cadena_validaciones($pos,$nameCampo,$value_campo){
	$tipo_campo = $_POST['tipo_campo'];
	$cadena = "";
	$obligatorio = ($_POST['obligatorio'.$pos] == "S") ? $cadena.="validate[required]" : "";
	$solo_numeros = ($_POST['solo_numeros'.$pos] == "S") ? $cadena.=",custom[integer]" : "";
	$solo_letras = ($_POST['solo_letras'.$pos] == "S") ? $cadena.=",custom[onlyLetterSp]" : "";
	$correo = ($_POST['val_correo'.$pos] == "S") ? $cadena.=",custom[email]" : "";

	$max_char = $_POST['maxcaracteres'];
	$min_char = $_POST['mincaracteres'];
	$max_valor = $_POST['maxvalor'];
	$min_valor = $_POST['minvalor'];

	if($max_char[$pos] != "no"){
		$cadena.=",maxSize[".$max_char[$pos]."]";
		$maxlent = $max_char[$pos];
	}else{

	}


	($min_char[$pos] != "no") ? $cadena.=",minSize[".$min_char[$pos]."]" : "";
	($max_valor[$pos] != "no") ? $cadena.=",max[".$max_valor[$pos]."]" : "";
	($min_valor[$pos] != "no") ? $cadena.=",min[".$min_valor[$pos]."]" : "";

	//Campo
	$campo = "";

	switch ($tipo_campo[$pos]) {
		case 'texto':
			$campo = "<input type='text' disabled='disabled' maxlength='".$maxlent."' name='".$nameCampo."' value='".$value_campo."' id='".$nameCampo."' class='".$cadena."'/>";	
		break;
		case 'combo':
			$campo = "<select name='".$nameCampo."' disabled='disabled' id='".$nameCampo."' class='".$cadena."'><option value=''>Seleccione</option></select>";	
		break;
		case 'textarea':
			$campo = "<textarea name='".$nameCampo."' maxlength='".$maxlent."' disabled='disabled' id='".$nameCampo."' class='".$cadena."'>".$value_campo."</textarea>";	
		break;
		case 'date':
			$campo = "<input type='text' disabled='disabled' name='".$nameCampo."' value='".$value_campo."' id='".$nameCampo."' class='".$cadena." fecha_formateada'/>";
		break;
		case 'combo_dinamico':

		break;
		case 'radio':
			$radio_label = $_POST['radio_label'.$pos];
			$radio_value = $_POST['radio_value'.$pos];
			for($ra=0;$ra<count($radio_label);$ra++){
				$campo.=$radio_label[$ra]." <input type='radio' name='".$nameCampo."' value='".$radio_value[$ra]."'/> ";
			}
		break;
	}
	return $campo;
}

//Funcion para Copiar los Archivos Necesarios
function full_copy($origen,$destino){
			$totalUriOrigen = dirname(__FILE__).$origen;
			$totalUriDestino = dirname(__FILE__).$destino;
			
		if ($gestor = opendir($totalUriOrigen)) {

			while ($entrada = readdir($gestor)) {
				if($entrada!=".." && $entrada!="."){
					if(is_dir($totalUriDestino)){
						copy($totalUriOrigen.$entrada,$totalUriDestino.$entrada);
					}else{
						if (!@mkdir($totalUriDestino, 0777, true)) {
							@mkdir($totalUriDestino, 0777, true);
						}
						copy($totalUriOrigen.$entrada,$totalUriDestino.$entrada);
					}
					
				}
			}
 
			closedir($gestor);
		}
	}


if($_POST['btnhacermagia']){
//atributos de la clase
$total_atrClass = count($arregloAtributosClase);
//campos claves para la busqueda
$total_campos_claves = count($arregloCamposclaves);
//separador
$dolar = "$";
$inicio = "<?php";
$final = "?>";
//For para Generar Parametros de la clase
for($i=0;$i<$total_atrClass;$i++){
$atributos = $atributos."private ".$dolar."ac".ucwords(strtolower($arregloAtributosClase[$i])).";\n";
}

//For para Parametros del Constructor
for($i=0;$i<$total_campos_claves;$i++)
{
	if($total_campos_claves>1){
		if($i<($total_campos_claves-1)){
$campos_claves = $campos_claves.$arregloCamposclaves[$i]." = '".$dolar."this->ac".ucwords(strtolower($arregloCamposclaves[$i]))."' ".$operador." ";
		}else{
		$campos_claves = $campos_claves.$arregloCamposclaves[$i]." = '".$dolar."this->ac".ucwords(strtolower($arregloCamposclaves[$i]))."'";	
		}
	}else
	{
$campos_claves = $campos_claves.$arregloCamposclaves[$i]." = '".$dolar."this->ac".ucwords(strtolower($arregloCamposclaves[$i]))."'";
	}
}

//For para Parametros del Constructor
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$parametros = $parametros.$dolar."pc".ucwords(strtolower($arregloAtributosClase[$i])).",";
	}else{
		$parametros = $parametros.$dolar."pc".ucwords(strtolower($arregloAtributosClase[$i]));
	}
}

//funcion para asignarle valor a los atributos de la Clase segun los Parametros
for($i=0;$i<$total_atrClass;$i++)
{
$asignacion = $asignacion.$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i]))." = \"\";\n";
}

//For para generar el campos de bases de datos del buscar
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$value_campos = $value_campos.$arregloAtributosClase[$i].",";
	}else{
		$value_campos = $value_campos.$arregloAtributosClase[$i];
	}
}

//For para generar el campos de bases de datos del buscar_ajax
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$value_ajax = $value_ajax."(".$arregloAtributosClase[$i]." like '%".$dolar."valor%') or ";
	}else{
		$value_ajax = $value_ajax."(".$arregloAtributosClase[$i]." like '%".$dolar."valor%')";
	}
}

//For para generar el campos de bases de datos del grid buscar_ajax
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$grid_ajax = $grid_ajax."<td style='font-weight:bold; font-size:20px;'>".$arregloAtributosClase[$i]."</td>\n";
	}else{
		$grid_ajax = $grid_ajax."<td style='font-weight:bold; font-size:20px;'>".$arregloAtributosClase[$i]."</td>";
	}
}

//For para Generar los datos a enviar a la base de datos
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$valores_incluir = $valores_incluir."'".$dolar."this->"."ac".ucwords(strtolower($arregloAtributosClase[$i]))."'".",";
	}else{
		$valores_incluir = $valores_incluir."'".$dolar."this->"."ac".ucwords(strtolower($arregloAtributosClase[$i]))."'";
	}
}

//For para Generar el Modificar
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$valores_modificar = $valores_modificar.$arregloAtributosClase[$i]." = "."'".$dolar."this->"."ac".ucwords(strtolower($arregloAtributosClase[$i]))."'".", ";
	}else{
		$valores_modificar = $valores_modificar.$arregloAtributosClase[$i]." = "."'".$dolar."this->"."ac".ucwords(strtolower($arregloAtributosClase[$i]))."'";
	}
}

//For para Generar el Buscar
for($i=0;$i<$total_atrClass;$i++)
{
if($i<($total_atrClass-1)){
	$buscar_valores = $buscar_valores.$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."laRow['".$arregloAtributosClase[$i]."'];\n";
	}else{
		$buscar_valores = $buscar_valores.$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."laRow['".$arregloAtributosClase[$i]."'];";
	}
}

//For para Generar los datos del grid que se busco
for($i=0;$i<$total_atrClass;$i++)
{
if($i<($total_atrClass-1)){
	$buscar_grid_valores = $buscar_grid_valores."<td>\".".$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i])).".\"</td>\n";
	}else{
		$buscar_grid_valores = $buscar_grid_valores."<td>\".".$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i])).".\"</td>";
	}
}

//for para generar los get 
for($i=0;$i<$total_atrClass;$i++)
{
	if($i<($total_atrClass-1)){
	$value_get = $value_get."public function getc".ucwords(strtolower($arregloAtributosClase[$i]))."(){return ".$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i])).";}"."\n";
	}else{
		$value_get = $value_get."public function getc".ucwords(strtolower($arregloAtributosClase[$i]))."(){return ".$dolar."this->ac".ucwords(strtolower($arregloAtributosClase[$i])).";}";
	}
}

//Para Generar el Archivo

$Pagina_Clase = ''.$inicio.'
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class cls'.$clase.' extends clsDatos{
'.$atributos.'
//constructor de la clase		
public function __construct(){
'.$asignacion.'}

//metodo magico set
public function __set('.$dolar.'atributo, '.$dolar.'valor){ '.$dolar.'this->'.$dolar.'atributo = strtoupper('.$dolar.'valor);}		
//metodo get
public function __get('.$dolar.'atributo){ return trim('.$dolar.'this->'.$dolar.'atributo); }
//destructor de la clase        
public function __destruct() { }
		
//funcion Buscar        
public function buscar()
{
$llEnc=false;
$this->ejecutar("select * from '.$tabla.' where('.$campos_claves.')");
if($laRow=$this->arreglo())
{		
'.$buscar_valores.'		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax('.$dolar.'valor)
{
'.$dolar.'lrTb='.$dolar.'this->ejecutar("select * from '.$tabla.' where('.$value_ajax.')");
while('.$dolar.'laRow='.$dolar.'this->arreglo())
{		
'.$buscar_valores.'		
'.$dolar.'inicio = "</br>
		   <table class=\'tabla_datos_busqueda datos\'>
           <tr>
			   '.$grid_ajax.'
			   <td style=\'font-weight:bold; font-size:20px;\'>Accion</td>
		  </tr>";
		  
'.$dolar.'final = "</table>";
'.$dolar.'llEnc='.$dolar.'llEnc."<tr>
					'.$buscar_grid_valores.'
					<td><a href=\'?txt'.$arregloAtributosClase[0].'=".$laRow[\''.$arregloAtributosClase[0].'\']."&txtoperacion=buscar\'>Seleccione</a></td>
				</tr>";
}
return '.$dolar.'inicio.'.$dolar.'llEnc.'.$dolar.'final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into '.$tabla.'('.$value_campos.')values('.$valores_incluir.')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update '.$tabla.' set '.$valores_modificar.' where('.$campos_claves.')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from '.$tabla.' where('.$campos_claves.')");
}
//fin clase
}'.$final;
$carpeta = "modelos";
$rais = $proyecto;
$nombre_pag = "cls".$clase.".php";
$estructura = './'.$rais.'/'.$carpeta.'/';
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
$fp = fopen($rais.'/'.$carpeta.'/'.$nombre_pag,"w");
fwrite($fp, $Pagina_Clase);
fclose($fp);




//Controlador-------------------------------------------------------------------------------------------------

//for para generar parametros enviados desde la vista
for($i=0;$i<$total_atrClass;$i++)
{
	if($i==0){
		$valores_vista = $valores_vista.$dolar."lobj".$clase."->ac".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."_REQUEST['txt".$arregloAtributosClase[$i]."'];\n";
	}else{
	if($i<($total_atrClass-1)){
	$valores_vista = $valores_vista.$dolar."lobj".$clase."->ac".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."_POST['txt".$arregloAtributosClase[$i]."'];\n";
	}else{
  $valores_vista = $valores_vista.$dolar."lobj".$clase."->ac".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."_POST['txt".$arregloAtributosClase[$i]."'];";
	}
	}
}
//for para generar los atributos para mandarlos a la clase
for($i=0;$i<$total_atrClass;$i++){
if($i<($total_atrClass-1)){
	$parametro_vista = $parametro_vista.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i])).",";
	}else{
  $parametro_vista = $parametro_vista.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]));
	}
}
//for para generar retur de los Gets
for($i=0;$i<$total_atrClass;$i++){
if($i<($total_atrClass-1)){
	$get_vista = $get_vista.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."lobj".$clase."->ac".ucwords(strtolower($arregloAtributosClase[$i])).";\n";
	}else{
  $get_vista = $get_vista.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."lobj".$clase."->ac".ucwords(strtolower($arregloAtributosClase[$i])).";";
	}
}

//for para los parametros enviados a la vista como respuesta
for($i=0;$i<$total_atrClass;$i++){
if($i<($total_atrClass-1)){
	$get_enviar = $get_enviar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."&";
	}else{
  $get_enviar = $get_enviar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."&";
	}
}

$controlador =  $inicio.'
require_once("../modelos/cls'.$clase.'.php");
$lobj'.$clase.' = new cls'.$clase.'();

'.$valores_vista.'
$lcVarTem = $_POST["txtvar_tem"];
$lcOperacion=$_REQUEST["txtoperacion"];


switch($lcOperacion){

	case "incluir":
	
		if($lobj'.$clase.'->buscar()){
			$lcListo = 0;
		}else{
			$lcListo = 1;
			$lobj'.$clase.'->incluir();  
		}
	
	break;
	
	case "buscar":
	
		if($lobj'.$clase.'->buscar()){
			'.$get_vista.' 
			$lcListo = 1;
		}else{
			$lcListo = 0;
		}
	
	break;
	
	case "modificar":
	
		if($lobj'.$clase.'->modificar($lcVarTem)>=1){
		$lcListo = 1;
		}else{
		$lcListo = 0;
		}
	
	break;
	
	case "eliminar":
	
		if($lobj'.$clase.'->eliminar()>=1){   
		$lcListo = 1;	
		}else{
		$lcListo = 0;
		}
		
	break;
}

'.$final;

$carpeta = "controladores";
$rais = $proyecto;
$nombre_pag = "cor".$clase.".php";
$estructura = './'.$rais.'/'.$carpeta.'/';
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
$fp = fopen($rais.'/'.$carpeta.'/'.$nombre_pag,"w");
fwrite($fp, $controlador);
fclose($fp);

//para generar la vistas empieza desde aqui
//for para generar los datos 
for($i=0;$i<$total_atrClass;$i++){
if($i<($total_atrClass-1)){
	$vista_recibe = $vista_recibe.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."_GET['"."lc".ucwords(strtolower($arregloAtributosClase[$i]))."'];\n";
	}else{
  $vista_recibe = $vista_recibe.$dolar."lc".ucwords(strtolower($arregloAtributosClase[$i]))."=".$dolar."_GET['"."lc".ucwords(strtolower($arregloAtributosClase[$i]))."'];";
	}
}
//datos necesarios
$d = "&lt;";
$i = "&gt;";

//for para generar los campos de formulario
for($y=0;$y<$total_atrClass;$y++){
if($i<($total_atrClass-1)){
		if($arregloCamposclaves[0] == $arregloAtributosClase[$y]){
			$oc = ($oculto == "S") ? "style='display:none;'" : "";
			$inputs = $inputs."<tr ".$oc.">\n<td align='right'><span class='rojo'>*</span> ".$metadato[$y].":</td>\n<td>".cadena_validaciones($y,"txt".$arregloAtributosClase[$y],$inicio." print(".$dolar."lc".ucwords(strtolower($arregloAtributosClase[$y])).");?>")."</td>\n</tr>\n";
		}else{
			$inputs = $inputs."<tr>\n<td align='right'><span class='rojo'>*</span> ".$metadato[$y].":</td>\n<td>".cadena_validaciones($y,"txt".$arregloAtributosClase[$y],$inicio." print(".$dolar."lc".ucwords(strtolower($arregloAtributosClase[$y])).");?>")."</td>\n</tr>\n";
		}
	}else{
  		$inputs = $inputs."<tr>\n<td align='right'><span class='rojo'>*</span> ".$metadato[$y].":</td>\n<td>".cadena_validaciones($y,"txt".$arregloAtributosClase[$y],$inicio." print(".$dolar."lc".ucwords(strtolower($arregloAtributosClase[$y])).");?>")."</td>\n</tr>";
	}
}

//Verificando
$val_id_auto = ($oculto == "N") ? "'no';" : $dolar."objFunciones->ultimo_id_plus1('".$tabla."','".$arregloCamposclaves[0]."');";
//Verificando

$visa_html ="".$inicio."
require_once('../modelos/clsFunciones.php'); //Funciones PreInstaladas
require_once('../controladores/cor".$clase.".php');
".$dolar."objFunciones = new clsFunciones;
".$dolar."operacion = ".$dolar."lcOperacion;
".$dolar."listo = ".$dolar."lcListo;
if((".$dolar."operacion!='buscar' && ".$dolar."listo!=1) || (".$dolar."operacion!='buscar' && ".$dolar."listo==1))
{
".$dolar."id = ".$val_id_auto."
}
?>
<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>Gestion ".$titulo_form."</title>
".$inicio." print(".$dolar."objFunciones->librerias_generales); ".$final."
<script>
function cargar()
{
	var operacion = '<?php print(".$dolar."operacion);?>';
	var listo = '<?php print(".$dolar."listo);?>';
	mensajes(operacion,listo);
	cargar_select(operacion,listo);
}
</script>
</head>
<body onload='cargar();'>
".$inicio." print(".$dolar."objFunciones->cuadro_busqueda); ".$final."
<!--
	Codigo
	Antes del
	Formulario
	antes_form.php
-->
".$inicio." @include('antes_form.php'); ".$final."
<div id='mensajes_sistema'></div><br />
<center>Todos los campos con <span class='rojo'>*</span> son Obligatorios</center>
</br>
<form name='form1' id='form1' autocomplete='off' method='post'/>
<div class='cont_frame'>
<h1>".$titulo_form."</h1>
<table border='1' class='datos' align='center'>
".$inputs."
<input type='hidden' name='txtoperacion' value='des'>
<input type='hidden' name='txtvar_tem' value='".$inicio." print(".$dolar."lc".ucwords(strtolower($arregloAtributosClase[0]))."); ?>'>
</table>
".$inicio." ".$dolar."objFunciones->botonera_general('".ucwords(strtolower($clase))."','total',".$dolar."id); ".$final."
</div>
</form>
<!--
	Codigo
	Despues del
	Formulario
	despues_form.php
-->
".$inicio." @include('despues_form.php'); ".$final."
</body>
</html>";
$carpeta = "vistas";
$rais = $proyecto;
$nombre_pag = "vista".$clase.".php";
$estructura = './'.$rais.'/'.$carpeta.'/';
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
$fp = fopen($rais.'/'.$carpeta.'/'.$nombre_pag,"w");
fwrite($fp, $visa_html);
fclose($fp);

//for para genrar las Pociciones de los cmapos y botones
for($i=0;$i<$total_atrClass;$i++)
{
if($i<($total_atrClass-1)){
	$camybot = $camybot."f[".$i."].disabled = false;\n";
	}else{
 	 $camybot = $camybot."f[".$i."].disabled = false;";
	}
}

//generar la calse base de datos
$base_clase = ''.$inicio.'
class clsDatos
{
   private $lbCon,$result;
   protected function conectar()
   {
	  $this->lbCon=mysql_connect("'.$servidor.'","'.$usuario.'","'.$clave.'");
	  mysql_select_db("'.$base_de_datos.'",$this->lbCon);
   }

   protected function ejecutar($pcSql) { $this->conectar(); $this->result = mysql_query($pcSql) or die(" Error al Ejecutar la Consulta ".mysql_error()); return mysql_affected_rows(); }
   protected function arreglo(){ return mysql_fetch_array($this->result); }
}
?>';
$carpeta = "modelos";
$rais = $proyecto;
$nombre_pag = "clsDatos.php";
$estructura = './'.$rais.'/'.$carpeta.'/';
//Verificar
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
$fp = fopen($rais.'/'.$carpeta.'/'.$nombre_pag,"w");
fwrite($fp, $base_clase);
fclose($fp);



//Creando la Carpeta Plugins
$carpeta = "plugins";
$rais = $proyecto;
$estructura = './'.$rais.'/vistas/'.$carpeta.'/';
//Verificar
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
//Creando la Carpeta jqueryui
$carpeta = "jqueryui";
$estructura = './'.$rais.'/vistas/plugins/'.$carpeta.'/';
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}
//Creando la Carpeta imagen dentro de plugins
$carpeta = "images";
$estructura = './'.$rais.'/vistas/plugins/jqueryui/'.$carpeta.'/';
if (!@mkdir($estructura, 0777, true)) {
    @mkdir($estructura, 0777, true);
}

//Copiando Todos los Archivos
full_copy("/materiales/clases/","/".$rais."/modelos/");
full_copy("/materiales/controladores/","/".$rais."/controladores/");
full_copy("/materiales/css/","/".$rais."/vistas/css/");
full_copy("/materiales/js/","/".$rais."/vistas/js/");
full_copy("/materiales/img/","/".$rais."/vistas/img/");
full_copy("/materiales/vistas/","/".$rais."/vistas/");
full_copy("/materiales/index/","/".$rais."/");
//jqueryui
@full_copy("/materiales/plugins/jqueryui/","/".$rais."/vistas/plugins/jqueryui/");
@full_copy("/materiales/plugins/jqueryui/images/","/".$rais."/vistas/plugins/jqueryui/images/");

print("Maestro Creado con Exito<br>
	<a href='".$rais."/index.php'>Ir al sistema</a><br>
	<a href='index.php'>Volver al Inicio</a>");
}

//Conectar con el Servidor
if($_POST['btncrear']){
	$archivo = fopen("conexiones.txt","a+") or exit("Error al Abrir el Archivo");
	$conexion = $proyecto.",".$servidor.",".$usuario.",".$clave.":";
	fwrite($archivo, $conexion);
	fclose($archivo);
	$_SESSION['proyect'] = $proyecto;
	$_SESSION['server'] = $servidor;
	$_SESSION['user'] = $usuario;
	$_SESSION['pass'] = $clave;
	$_SESSION['connect'] = "yes";
	if (!mkdir($proyecto, 0, true)) {
		mkdir($proyecto, 0, true);
	}
	include("clsFunciones.php");
	$_SESSION['lista_bd'] = listar_db();
	header("location: index.php");
}

if($_POST['btnconectar']){
	$_SESSION['proyect'] = $proyecto;
	$_SESSION['server'] = $servidor;
	$_SESSION['user'] = $usuario;
	$_SESSION['pass'] = $clave;
	$_SESSION['connect'] = "yes";
	include("clsFunciones.php");
	$_SESSION['lista_bd'] = listar_db();
	header("location: index.php");
}

if($_POST['btndesconectar']){
	unset($_SESSION['proyect']);
	unset($_SESSION['server']);
	unset($_SESSION['user']);
	unset($_SESSION['pass']);
	unset($_SESSION['lista_bd']);
	$_SESSION['connect'] = "no";
	header("location: index.php");
}

if($_POST['oper'] == "checkdir"){
	if(is_dir($_POST['dirVal'])){
		print("yes");
	}else{
		print("no");
	}
}

if($_POST['oper'] == "listTables"){
	include("clsFunciones.php");
	print("<option value = '-'>-</option>".listar_tb($_POST['dirVal']));
}

if($_POST['oper'] == "listCampos"){
	include("clsFunciones.php");
	print(listar_cols($base_de_datos, $_POST['dirVal']));
}
?>