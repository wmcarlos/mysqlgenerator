<?php
  session_start();
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Cambiar Contrase&ntilde;a</title>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.js"></script>
</head>
<body>
<div id="contenedor">
	 <div id="cintillo" style='height:auto;'>
      <img src="img/cintillo.png" style='width:100%;'/>
    </div>
    <div id="banner" style="height:auto;">
      <img src="img/banner.png" style='width:100%;'/>
    <div id="contenido">
		<!--Contenido derecho-->
        <div id="derecho">
         <span id="fecha">Domingo, 10 de Noviembre del 2012</span>
  				<p class="parrafo">
  					<div class="cuadro">
                <h1 class="titulo2">Nueva Contrase&ntilde;a</h1>
                  <p>
                      <table>
                          <form name="fentrar" action="../controladores/corTusuario.php" method="post">
                            <tr>
                                <td>Nueva Contrase&ntilde;a</td>
                                  <td> <input type="text" name="txtnueva_contra" size="15" /></td>
                              </tr>
                               <tr>
                  <td colspan="2" align="center"><a href="../index.php">Volver</a>  <input type="submit" name="btn_entrar" value="Responder" /><input type="hidden" name="txtoperacion" value="ingresar" /></td>
                              </tr>
                              <input type="hidden" name="txtnombre_usu" value="<?php print $_SESSION['user']; ?>">
                              <input type="hidden" name='txtoperacion' value='cambiar_contra'/>
                              </form>
                      </table>
                  </p>
              </div>
  				</p>
        </div>
   </div>
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