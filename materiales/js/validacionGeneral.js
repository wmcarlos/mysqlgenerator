function Incluir($id){
var f = document.form1;
$('#form1').find('input').attr("disabled",false);
$('#form1').find('textarea').attr("disabled",false);
$('#form1').find('select').attr("disabled",false);		
if($id=="no"){
	f[0].value = "";
	f[0].focus();
}else{
	f[0].value = $id;
	f[1].focus();
}
//botones	
f.txtoperacion.value = 'incluir';
f.btnincluir.disabled = true;
f.btnbuscar.disabled = true;
f.btnmodificar.disabled = true;
f.btneliminar.disabled = true;
f.btncancelar.disabled = false;
f.btnguardar.disabled = false;
}

function Modificar(){
var f = document.form1;
//campos		
$('#form1').find('input').attr("disabled",false);
$('#form1').find('textarea').attr("disabled",false);
$('#form1').find('select').attr("disabled",false);	
f[0].disabled = true;
f[1].focus();
//botones	
f.txtoperacion.value = 'modificar';
f.btnincluir.disabled = true;
f.btnbuscar.disabled = true;
f.btnmodificar.disabled = true;
f.btneliminar.disabled = true;
f.btncancelar.disabled = false;
f.btnguardar.disabled = false;
}

function Eliminar()
		{
			var f = document.form1;
			if(confirm('Desea Eliminar Este Registro?'))
			{
				f[0].disabled = false;
				f.txtoperacion.value = 'eliminar';
				f.submit();
			}
		}
		
		function Cancelar(redirec){
			
			location.href='../vistas/vista'+redirec+'.php';	
		}

function cargar_select(operacion,listo)
		{
			var f = document.form1;
			if(listo==1 && operacion=='buscar')
			{
				f.btnincluir.disabled = true;
				f.btnbuscar.disabled = true;
				f.btnmodificar.disabled = false;
				f.btneliminar.disabled = false;
				f.btncancelar.disabled = false;
			}

			if(listo==1 && operacion=='buscar2')
			{
				f.btnincluir.disabled = true;
				f.btnbuscar.disabled = true;
				f.btnmodificar.disabled = false;
				f.btneliminar.disabled = false;
				f.btncancelar.disabled = false;
			}
}

//Funcion para Agregar Detalles no Importa Cuantos Sean
function add_column(e,id){
	var table = document.getElementById(id);
	var tr = document.createElement("tr");
	var data_array = e.getAttribute("rel").split(",");
	var total_data = data_array.length;
	var cadena = "";
	var value;
	var selected;
	for(var i=0;i<total_data;i++){
		if(document.getElementById(data_array[i]).getAttribute("is_select")=="si"){
			selected = document.getElementById(data_array[i]).options[document.getElementById(data_array[i]).selectedIndex].text;
			value = document.getElementById(data_array[i]).value;
			cadena = cadena+"<td><input type='hidden' name='"+data_array[i]+"[]' value='"+value+"'/>"+selected+"</td>";
			document.getElementById(data_array[i]).value = "-";
		}else{
			value = document.getElementById(data_array[i]).value;
			cadena = cadena+"<td><input type='hidden' name='"+data_array[i]+"[]' value='"+value+"'/>"+value+"</td>";
			document.getElementById(data_array[i]).value = "";
		}
	}
	tr.innerHTML = cadena+"<td><input type='button' value='X' rel='"+id+"' onclick='del_column(this)'/></td>";
	table.appendChild(tr);
}

//Eliminar una tupla de tabla sin importar su tamano
function del_column(e){
	
	var table = document.getElementById(e.getAttribute("rel"));
	var td = e.parentNode;
	var tr = td.parentNode;
		table.removeChild(tr);
}

$(function() {
	$( ".fecha_formateada" ).datepicker({
		dateFormat : 'dd/mm/yy'
	});
});