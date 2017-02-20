<?php
require_once("clsDatos.php"); //Clase Base de Datos Poner Ruta de Clase
class clsTrol extends clsDatos{
private $acCodigo;
private $acNombre;

//constructor de la clase		
public function __construct(){
$this->acCodigo = "";
$this->acNombre = "";
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
$this->ejecutar("select * from trol where(codigo = '$this->acCodigo')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];		
$llEnc=true;
}
return $llEnc;
}

public function buscar()
{
$llEnc=false;
$this->ejecutar("select * from trol where(nombre = '$this->acNombre')");
if($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];		
$llEnc=true;
}
return $llEnc;
}

//Busqueda Ajax
public function busqueda_ajax($valor)
{
$lrTb=$this->ejecutar("select * from trol where((codigo like '%$valor%') or (nombre like '%$valor%'))");
while($laRow=$this->arreglo())
{		
$this->acCodigo=$laRow['codigo'];
$this->acNombre=$laRow['nombre'];		
$inicio = "</br>
		   <table class='tabla_datos_busqueda datos'>
           <tr>
			   <td style='font-weight:bold; font-size:20px;'>codigo</td>
<td style='font-weight:bold; font-size:20px;'>nombre</td>
			   <td style='font-weight:bold; font-size:20px;'>Accion</td>
		  </tr>";
		  
$final = "</table>";
$llEnc=$llEnc."<tr>
					<td>".$this->acCodigo."</td>
<td>".$this->acNombre."</td>
					<td><a href='?txtcodigo=".$laRow['codigo']."&txtoperacion=buscar2'>Seleccione</a></td>
				</tr>";
}
return $inicio.$llEnc.$final;
}

//funcion inlcuir
public function incluir()
{
return $this->ejecutar("insert into trol(codigo,nombre)values('$this->acCodigo','$this->acNombre')");
}
        


//funcion modificar
public function modificar($lcVarTem)
{
return $this->ejecutar("update trol set codigo = '$this->acCodigo', nombre = '$this->acNombre' where(codigo = '$this->acCodigo')");
}
 
 
//funcion eliminar        
public function eliminar()
{
return $this->ejecutar("delete from trol where(codigo = '$this->acCodigo')");
}
public function validarDetalle($id_rol){
	$this->ejecutar("select count(*) as cantidad from trol_servicio where id_rol = '$id_rol'");
	if($row = $this->arreglo()){ $cantidad = $row['cantidad']; }
	return $cantidad;
}
public function delete_detalle($id_rol){
	return $this->ejecutar("delete from trol_servicio where id_rol = '$id_rol'");
}
public function incluir_detalle($id_rol,$id_servicio){
	$this->ejecutar("insert into trol_servicio(id_rol,id_servicio) values ('$id_rol','$id_servicio')");
}

public function validar_existe($id_serv,$id_rol){
	$existe = false;
	$this->ejecutar("select * from trol_servicio where id_rol = '$id_rol' and id_servicio = '$id_serv'");
	if($row=$this->arreglo()){
		$existe = true;
	}	
	return $existe;
}


public function listar_modulos(){
	$this->ejecutar("select tservicio.*, tmodulo.nombre as modulo from tservicio
	inner join tmodulo on (tmodulo.id_modulo=tservicio.id_modulo) order by posicion asc");
		while($row=$this->arreglo()){ $cad[] = $row; }
	return $cad;
}

public function listar_modulos_por_rol($rol){
	$this->ejecutar("SELECT distinct(tmodulo.nombre) as modulo, tmodulo.id_modulo as id_modulo FROM trol_servicio
	inner join tservicio on (tservicio.id_servicio=trol_servicio.id_servicio)
	inner join tmodulo on (tmodulo.id_modulo=tservicio.id_modulo)
	where (trol_servicio.id_rol = '$rol') order by tmodulo.posicion asc");
	while($row = $this->arreglo()){
		$arrData[] = $row;
	}
	return $arrData;
}

public function listar_servicios_x_rol($id_modulo,$rol){
	$this->ejecutar("select tservicio.* from tservicio
	inner join trol_servicio on (trol_servicio.id_servicio=tservicio.id_servicio and trol_servicio.id_rol = $rol)
	where id_modulo = '$id_modulo' order by tservicio.posicion asc");
	while($row=$this->arreglo()){
		$arrData[] = $row;
	}
	return $arrData;
}
//fin clase
}?>