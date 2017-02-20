<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTservicio extends clsDatos{
private $acId_servicio;
private $acId_modulo;
private $acNombre;
private $acUrl;
private $posicion;
private $icono;

//constructor de la clase		
public function __construct(){
$this->acId_servicio = "";
$this->acId_modulo = "";
$this->acNombre = "";
$this->acUrl = "";
$this->posicion ="";
$this->icono = "";
}

//metodo magico set
public function __set($atributo, $valor){ $this->$atributo = $valor;}		
//metodo get
public function __get($atributo){ return trim($this->$atributo); }
//destructor de la clase        
public function __destruct() { }
		
//funcion Buscar        
public function buscar()
{
$llEnc=false;
$this->ejecutar("select * from tservicio where(nombre = '$this->acNombre' and id_modulo = '$this->acId_modulo')");
if($laRow=$this->arreglo())
{		
$this->acId_servicio=$laRow['id_servicio'];
$this->acId_modulo=$laRow['id_modulo'];
$this->acNombre=$laRow['nombre'];
$this->acUrl=$laRow['url'];
$this->posicion = $laRow['posicion'];
$this->icono = $laRow['icono'];		
$llEnc=true;
}
return $llEnc;
}

public function buscar2()
{
$llEnc=false;
$this->ejecutar("select * from tservicio where(id_servicio = '$this->acId_servicio')");
if($laRow=$this->arreglo())
{		
$this->acId_servicio=$laRow['id_servicio'];
$this->acId_modulo=$laRow['id_modulo'];
$this->acNombre=$laRow['nombre'];
$this->acUrl=$laRow['url'];		
$this->posicion = $laRow['posicion'];
$this->icono = $laRow['icono'];
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select tservicio.*, tmodulo.nombre as modulo from tservicio
inner join tmodulo on (tmodulo.id_modulo=tservicio.id_modulo)
where((tservicio.id_servicio like '%$valor%') or (tservicio.id_modulo like '%$valor%') or (tservicio.nombre like '%$valor%') or (tservicio.url like '%$valor%')) order by tmodulo.nombre asc");
while($laRow=$this->arreglo())
{		
$this->acId_servicio=$laRow['id_servicio'];
$this->acId_modulo=$laRow['id_modulo'];
$this->acNombre=$laRow['nombre'];
$this->acUrl=$laRow['url'];		
$this->posicion = $laRow['posicion'];
$this->icono = $laRow['icono'];
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
				<td style='font-weight:bold; font-size:20px;'>Modulo</td>
				<td style='font-weight:bold; font-size:20px;'>Nombre</td>
				<td style='font-weight:bold; font-size:20px;'>Url</td>
				<td style='font-weight:bold; font-size:20px;'>Posicion</td>
				<td style='font-weight:bold; font-size:20px;'>Icono</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$laRow['modulo']."</td>
					<td>".$this->acNombre."</td>
					<td>".$this->acUrl."</td>
					<td>".$this->posicion."</td>
					<td>".$this->icono."</td>
					<td><a href='?txtid_servicio=".$laRow['id_servicio']."&txtoperacion=buscar2'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into tservicio(id_servicio,id_modulo,nombre,url,posicion,icono)values('$this->acId_servicio','$this->acId_modulo','$this->acNombre','$this->acUrl','$this->posicion','$this->icono')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update tservicio set id_modulo = '$this->acId_modulo', nombre = '$this->acNombre', url = '$this->acUrl', posicion = '$this->posicion', icono = '$this->icono' where(id_servicio = '$this->acId_servicio')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from tservicio where(id_servicio = '$this->acId_servicio')");
}
//fin clase
}?>