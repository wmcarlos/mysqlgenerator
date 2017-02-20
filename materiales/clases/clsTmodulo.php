<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTmodulo extends clsDatos{
private $acId_modulo;
private $acNombre;
private $posicion;
private $icono;
private $url_modulo;

//constructor de la clase		
public function __construct(){
$this->acId_modulo = "";
$this->acNombre = "";
$this->posicion ="";
$this->icono ="";
$this->url_modulo ="";
}

//metodo magico set
public function __set($atributo, $valor){ $this->$atributo = strtoupper($valor);}		
//metodo get
public function __get($atributo){ return trim(strtoupper($this->$atributo)); }
//destructor de la clase        
public function __destruct() { }
		
//funcion Buscar        
public function buscar2()
{
$llEnc=false;
$this->ejecutar("select * from tmodulo where(id_modulo = '$this->acId_modulo')");
if($laRow=$this->arreglo())
{		
$this->acId_modulo=$laRow['id_modulo'];
$this->acNombre=$laRow['nombre'];	
$this->url_modulo = $laRow['url_modulo'];	
$this->posicion = $laRow['posicion'];	
$this->icono = $laRow['icono'];	
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from tmodulo where((id_modulo like '%$valor%') or (nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acId_modulo=$laRow['id_modulo'];
$this->acNombre=$laRow['nombre'];
$this->url_modulo = $laRow['url_modulo'];
$this->posicion = $laRow['posicion'];	
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>id_modulo</td>
				<td style='font-weight:bold; font-size:20px;'>nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Url</td>
				<td style='font-weight:bold; font-size:20px;'>Posicion</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acId_modulo."</td>
					<td>".$this->acNombre."</td>
					<td>".$this->url_modulo."</td>
					<td>".$this->posicion."</td>
					<td><a href='?txtid_modulo=".$laRow['id_modulo']."&txtoperacion=buscar2'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tmodulo(id_modulo,nombre,url_modulo,posicion,icono)values('$this->acId_modulo','$this->acNombre','$this->url_modulo','$this->posicion','$this->icono')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tmodulo set nombre = '$this->acNombre', url_modulo = '$this->url_modulo', posicion = '$this->posicion', icono = '$this->icono' where(id_modulo = '$this->acId_modulo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tmodulo where(id_modulo = '$this->acId_modulo')");
}
//fin clase
}?>