<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
session_start();
require_once("clsDatos.php");
$clavePrimaria;
function listar_db(){
	$lobCon = new clsDatos();
	$sql = "SHOW DATABASES";
	$result = $lobCon->filtro($sql);
	while($row = $lobCon->proximo($result)){
		$cadena = $cadena."<option value='".$row[0]."'>".$row[0]."</option>";
	}
	
	$lobCon->cierrafiltro($result);
	$lobCon->desconectar();
	return $cadena;
}

function listar_tb($database){
	$lobCon = new clsDatos();
	$lobCon->select_db($database);
	$sql = "SHOW TABLES from $database";
	$result = $lobCon->filtro($sql);
	while($row = $lobCon->proximo($result)){
		$cadena = $cadena."<option value='".$row[0]."'>".$row[0]."</option>";
	}
	
	$lobCon->cierrafiltro($result);
	$lobCon->desconectar();
	return $cadena;
}

function listar_cols($database, $table){
	$lobCon = new clsDatos();
	$lobCon->select_db($database);
	$sql = "SHOW COLUMNS from $table from $database";
	$result = $lobCon->filtro($sql);
	
	while($row = $lobCon->proximo($result)){
		$cadena = $cadena.$row[0].",";
		if($row[3]=="PRI"){
			$clavePrimaria = "-".$row[0];
		}
	}
	
	$lobCon->cierrafiltro($result);
	$lobCon->desconectar();
	return $cadena.$clavePrimaria;
}
?>