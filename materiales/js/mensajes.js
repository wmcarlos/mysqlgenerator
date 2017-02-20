function mensajes(operacion,listo){
	
			if(listo==1 && operacion=='incluir')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("exito");
				$("#mensajes_sistema").text("Registro Incluido Con Exito");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}
			
			if(listo==0 && operacion=='incluir')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("error");
				$("#mensajes_sistema").text("El Registro que intenta Incluir ya Existe, puede que este Desactivado");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}
			
			if(listo==1 && operacion=='modificar')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("exito");
				$("#mensajes_sistema").text("Registro Modificado Con Exito");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}
			
			if(listo==0 && operacion=='modificar')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("error");
				$("#mensajes_sistema").text("No se Realizaron Cambios");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}
			
			if(listo==1 && operacion=='eliminar')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("exito");
				$("#mensajes_sistema").text("Registro Eliminado Con Exito");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}
			
			if(listo==0 && operacion=='eliminar')
			{
				$("#mensajes_sistema").addClass("notificacion");
				$("#mensajes_sistema").addClass("error");
				$("#mensajes_sistema").text("Error al Eliminar Registro");
				$("#mensajes_sistema").hide().delay(1).slideDown(500).delay(2000).slideUp(500);
			}			
}