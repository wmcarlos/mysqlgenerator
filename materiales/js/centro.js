$(document).ready(function(){
	$(".datos_busqueda").empty();
	
  function centro(){
	   var window_height = $(window).height();
	   var window_width = $(window).width();
	   var div_height = $('#contenedor_resultados_busqueda').height();
	   var div_width = $('#contenedor_resultados_busqueda').width();
	   $('#contenedor_resultados_busqueda').css('margin-top',(window_height/2)-(div_height/2)).css('margin-left',(window_width /2)-(div_width/2) );
	}
  centro();
	
	$(".btn_buscar").click(function(){
		 var operacion = $(this).attr("operacion");
		 var salir = $(this).attr("salir");
		 var clas = $(this).attr("clase");
		 $(".txtbuscador").attr("clase",clas);
		 
		 $('.cerrar_resultados').attr("salir",salir);
		 $("#mascara").fadeIn(500);
		 $('#contenedor_resultados_busqueda').show().hide().delay(1).fadeIn(600);
	});
	

 
   /*para el boton de buscar cerrar*/
  $('.cerrar_resultados').click(function(){
		var salir = $(this).attr("salir");
		var vista = $("#txtreloadclass").val();
	   if(salir=="total"){
			$('#mascara').fadeOut(500);
			$('#contenedor_resultados_busqueda').show().hide().delay(1).fadeOut(600);
			Cancelar(vista);
	   }
	   
	   if(salir=="local"){
			$('#mascara').fadeOut(500);
			$('#contenedor_resultados_busqueda').show().hide().delay(1).fadeOut(600);
	   }
  });

  
/*en caso de que achiquemos el window*/
   $(window).resize(function(){
       centro();
   }); 
 //para hacer busquedas ajax 
   $(".txtbuscador").keyup(function(){
        var val = $(this).val();
		var clas = $(this).attr("clase");
		
        $.post("../controladores/ajaxdata.php", { datos: val, clase: clas },
              function(data){
                 $(".datos_busqueda").html(data);
              });						
   });
   
   $(".select_change").change(function(){
	  	   var load_data = $(this).attr("load_data");
	   	  $("#"+load_data).empty();
          var val = $(this).val();
		  var oper = $(this).attr("operacion");
          $.post("../controladores/ajaxdata.php", { operacion: oper, datos: val },
              function(data){
          $("#"+load_data).html(data);
       });						
    });
 
});//cierre del ready