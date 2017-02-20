<ul id="jsddm" class="clearfix">
<li><a href="index.php">Inicio</a></li>



<?php
session_start();
require_once("../modelos/clsTrol.php");
$lobjTrol = new clsTrol();
$arrDataMod = $lobjTrol->listar_modulos_por_rol($_SESSION['type']);
$contadorModulos = 0;
	while($arrDataMod[$contadorModulos]['id_modulo'] != null){
		echo "<li><a href='#'>".$arrDataMod[$contadorModulos]['modulo']."</a><ul>";

			$contadorServ=0;
			$arrDataSer=$lobjTrol->listar_servicios_x_rol($arrDataMod[$contadorModulos]['id_modulo'],$_SESSION['type']);
			while($arrDataSer[$contadorServ]['id_servicio'] != null){
				 echo "<li><a href='".$arrDataSer[$contadorServ]['url']."'>".$arrDataSer[$contadorServ]['nombre']."</a></li>";
				 $contadorServ++;
			}
			echo "</ul></li>";

		$contadorModulos++;
	}
?>




<li><a href="cerrar.php">Salir</a></li>
</ul>