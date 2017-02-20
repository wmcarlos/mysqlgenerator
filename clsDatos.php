<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE); 
class clsDatos
{
   private $lbCon;
   function __construct()
   {
      $lcServidor=$_SESSION['server'];
	  $lcUsuario=$_SESSION['user'];
	  $lcContrasena=$_SESSION['pass'];
	  $this->lbCon=mysql_connect($lcServidor,$lcUsuario,$lcContrasena) or die("Error al Conectarse al Servidor"); 
 }
   
   function select_db($bd){
	 $lcBaseDatos=$bd;  
	 mysql_select_db($lcBaseDatos,$this->lbCon) or die("Error al Seleccionar la Base de datos".mysql_error());
   }
  
   function __destruct()
   {
      
   }
   public function filtro($pcSql)
   {
	  $lbTb=mysql_query($pcSql,$this->lbCon);
	  return $lbTb;
   }
   public function cierrafiltro($pbTb)
   {
      mysql_free_result($pbTb);
   }
   
   
   public function ejecutar($pcSql)
   {
      mysql_query($pcSql,$this->lbCon);
   }
   
   
   public function proximo($pbTb)
   {
      $laRow=mysql_fetch_array($pbTb);
	  return $laRow;
   } 
   public function desconectar()
   {
      mysql_close($this->lbCon);
   }
    function num_registros($pbTb)
      {  
 	     $lnRegistros=mysql_num_rows($pbTb);
 	     return $lnRegistros;
      }
	   
      function begin()
	  {
	     mysql_query("BEGIN",$this->lbCon);
	  }
	  
	  function commit()
	  {
	     mysql_query("COMMIT",$this->lbCon);
	  }
	  
	  function rollback()
	  {
	     mysql_query("ROLLBACK",$this->lbCon);
	  }
      
   function fechabd($pcFecha)
	  {
	  	 $lcNow="now()";
	  	 if (strlen($pcFecha)==10)
	  	 {
	  	 	$lcDia=substr($pcFecha,0,2);
	  	 	$lcMes=substr($pcFecha,3,2);
	  	 	$lcAno=substr($pcFecha,6,4);
	  	 	$lcNow=$lcAno."-".$lcMes."-".$lcDia;
	  	 }
	  	 return $lcNow;
	  }
}
?>