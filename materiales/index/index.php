<?php 
  session_start();
  if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
      header("location: vistas/index.php");
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Entrar</title>
<link href="vistas/css/global.css" rel="stylesheet" type="text/css" />
<script src="vistas/js/jquery.js"></script>
</head>
<body>
<div id="contenedor">
	<div id="cintillo" style='height:auto;'>
		<img src="vistas/img/cintillo.png" style='width:100%;'/>
    </div>
	<!--Estructura para el banner-->
    <div id="banner" style="height:auto;">
    	<img src="vistas/img/banner.png" style='width:100%;'/>
    </div>
   <!--Contenedor del Contenido Central-->
   <div id="contenido">
        <div id="derecho">
        <span id="fecha">Domingo, 10 de Noviembre del 2012</span>
		    <!--Cuadros para Colocar Informacion-->
        	<div class="cuadro">
            	<h1 class="titulo2">Iniciar Sesion</h1>
                <p>
                    <table>
                        <form name="fentrar" action="controladores/corTusuario.php" method="post">
                        	<tr>
                            	<td>Usuario:</td>
                                <td><input type="text" name="txtnombre_usu" size="15" /></td>
                            </tr>
                            <tr>
                            	<td>Clave:</td>
                                <td><input type="password" name="txtclave" size="15" /></td>
                            </tr>
                             <tr>
								<td colspan="2" align="center"><input type="submit" name="btn_entrar" value="ENTRAR" /><input type="hidden" name="txtoperacion" value="ingresar" /></td>
                            </tr>
                            <tr>
								<td colspan="2" align="center"><a href="vistas/comprobar_usuario.php">¿Olvidaste Tu Contraseña?</a></td>
                            </tr>
                            <input type="hidden" name='txtoperacion' value='entrar'/>
                            </form>
                    </table>
                </p>
            </div>
        </div>
   </div>
   <!--Pie de Pagina-->
   <!--Pie de Pagina-->
   <div id="pie">
                <p id="contenido_pie">
					Calle San Felipe entre avenidas Libertador y Miranda Frente a la Plaza Bolivar Sarare Estado Lara<br />
					 <a href="#">Codigo Postal: 3015</a><br />
           <a href="#">Telefonos: 0251-9921112</a><br />
                </p>
   </div>
</div>
</body>
</html>
<script type="text/javascript">
mostrar_mensaje = function(){
  <?php
    $error = (isset($_GET['valido']) and !empty($_GET['valido'])) ? $_GET['valido'] : "";
  ?>
  var error = '<?php print $error; ?>';
  if(error == "si"){
      alert("Contraseña Cambiada Con  Existo");
  }else if(error == "no"){
  	alert("Ocurrio un Error al Cambiar la Contraseña");
  }else if(error == "no_pass"){
  	alert("Usuario o Contraseña Invalidos");
  }else if( error == "bloqueado" ){
  	alert("Este Usuario esta Bloqueado");
  }else if( error == "user_block"){
  	alert("Has Superado el Limite de Intentos Fallidos, tu usuario a sido bloqueado");
  }
}

window.onLoad = mostrar_mensaje();
</script>