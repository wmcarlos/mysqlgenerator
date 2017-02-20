<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..::Pronutrico - <?php print $title; ?>::..</title>
<link href='img/favicon.ico' rel='shortcut icon' type='image/x-icon'/>
<link href='img/favicon.ico' rel='icon' type='image/x-icon'/>
<link href="css/global.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.9.0.custom.min.js" ></script>
<script type="text/javascript" src="js/jquery-ui-tabs-rotate.js" ></script>
<script type="text/javascript">
	$(document).ready(function(){
        fechahoy();
		$("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
	});
</script>
</head>
<body>
<div id="contenedor">
    <div id="banner" style="height:auto;">
    	<img src="img/banner.png" style='width:100%;'/>
    </div>
    <div id="nav">
        <ul id="jsddm" class="clearfix">
            <li><a href="./" <?php if($v=="home"){print 'class="active"'; } ?>>Inicio</a></li>
            <li><a href="?v=about" <?php if($v=="about"){print 'class="active"'; } ?>>Quienes Somos</a></li>
            <li><a href="?v=history" <?php if($v=="history"){print 'class="active"'; } ?>>Reseña Historica</a></li>
            <li><a href="?v=news" <?php if($v=="news"){print 'class="active"'; } ?>>Noticias</a></li>
            <li><a href="?v=contacts" <?php if($v=="contacts"){print 'class="active"'; } ?>>Contactanos</a></li>
            <li><a href="admin/">Entrar</a></li>
        </ul>
   </div>