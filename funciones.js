function primeraLetraMayuscula(cadena){
	return cadena.charAt(0).toUpperCase()+cadena.slice(1);
}

function add_column(){
	var contenedor = document.getElementById("tabla_detalles");
	var tabla = document.getElementById("txttabla2").value;
	var clase = document.getElementById("clase2").value;
	var atributos = document.getElementById("atributos2").value;
	var campo_clave = document.getElementById("campoclave2").value;
	var campo_dependiente = document.getElementById("campodependiente").value;
	
	var tupla = document.createElement("tr");
		tupla.innerHTML = "<td><input type='text' name='arr_tabla[]' value='"+tabla+"'/></td><td><input type='text' name='arr_clase[]' value='"+clase+"'/></td><td><textarea name='arr_atributos[]'>"+atributos+"</textarea></td><td><input type='text' name='arr_campo_clave[]' value='"+campo_clave+"'/></td><td><input type='text' name='arr_campo_dependiente[]' value='"+campo_dependiente+"'/></td><td><input type='button' onclick='del_column(this);' value='X'/></td>";
		contenedor.appendChild(tupla);
		
	document.getElementById("txttabla2").value = "-";
	document.getElementById("clase2").value = "";
	document.getElementById("atributos2").value = "";
	document.getElementById("campoclave2").value = "";
	document.getElementById("campodependiente").value = "";
	
	
}

function del_column(e){
	var contenedor = document.getElementById("tabla_detalles");
	var celda = e.parentNode;
	var tupla = celda.parentNode;
	contenedor.removeChild(tupla);
}

function delete_campo(e){
	var tr = e.parentNode.parentNode;
	document.getElementById("atributos_col").removeChild(tr);
}

function deleteradio(e){
	var tr = e.parentNode.parentNode;
	var tbody = tr.parentNode;
	tbody.removeChild(tr);
}

function addRadio(e){
	var number = e.getAttribute("data-get-ancla");
	var contenedor = document.getElementById("htmlInner"+number);
	var radio_label = document.getElementById("radio_label"+number);
	var radio_value = document.getElementById("radio_value"+number);
	contenedor.innerHTML+='<tr><td><input type="" value="'+radio_label.value+'" name="radio_label'+number+'[]"/></td><td><input type="" value="'+radio_value.value+'" name="radio_value'+number+'[]"/></td><td><button type="button" onclick="deleteradio(this);">X</button></td></tr>';
	radio_label.value = "";
	radio_value.value = "";
}

function select_type(e){
	var number = e.getAttribute("data-get-number");
	var cadena="";
	switch(e.value){
		case "radio":
			var contenedor = document.getElementById("campos_extras"+number);
			cadena+="<table border='1'>";

				cadena+="<tr>";
					cadena+="<td>Label</td>";
					cadena+="<td>Value</td>";
					cadena+="<td>-</td>";
				cadena+="</tr>";

				cadena+="<tr>";
					cadena+="<td><input type='text' id='radio_label"+number+"'/></td>";
					cadena+="<td><input type='text' id='radio_value"+number+"'/></td>";
					cadena+="<td><button type='button' onclick='addRadio(this)' data-get-ancla='"+number+"'>+</button></td>";
				cadena+="</tr>";

				cadena+="<tbody id='htmlInner"+number+"'></tbody>";
			cadena+="</table>";

			contenedor.innerHTML = cadena;
		break;
		default:
			var contenedor = document.getElementById("campos_extras"+number);
			contenedor.innerHTML = "";
		break;
	}
	
}

$(document).ready(function(){

		//verificar si la carpeta del proyecto existe
		$("#txtproyecto").blur(function(){
			var f = document.form1;
			var dir = $(this).val();
			$.post("MasterGenerador.php", { oper: "checkdir", dirVal: dir },
				function(data){
					if(data=="yes"){
						alert("El Proyecto ya Existe Ingrese Otro Nombre");
						f.txtproyecto.focus();
					}
              });
		});
		
		$("#txtconexiones").change(function(){
			var valor = $(this).val();
			if(valor!="-"){
			var arrValor = valor.split(",");
				$("#txtproyecto").val(arrValor[0]); 
				$("#txtservidor").val(arrValor[1]); 
				$("#txtusuario").val(arrValor[2]); 
				$("#txtclave").val(arrValor[3]); 
				$("#btnaccion").attr("name","btnconectar");
				$("#btnaccion").val("Conectar");
			}else{
				$("#txtproyecto").val(""); 
				$("#txtservidor").val("localhost"); 
				$("#txtusuario").val("root"); 
				$("#txtclave").val(""); 
				$("#btnaccion").attr("name","btncrear");
				$("#btnaccion").val("Crear");
			}
		});
		
		$("#txtbase").change(function(){
			var f = document.form1;
			var dir = $(this).val();
			$.post("MasterGenerador.php", { oper: "listTables", dirVal: dir },
				function(data){
					$("#txttabla").html(data);
					$("#txttabla2").html(data);
              });
		});
		
		$("#txttabla").change(function(){
			var f = document.form1;
			var dir = $(this).val();
			$("#txtnomclass").val(primeraLetraMayuscula(dir));
			$("#titulo_formulario").val(dir);
			if(dir!="-"){
				var database = $("#txtbase").val();
				$.post("MasterGenerador.php", { oper: "listCampos", dirVal: dir, txtnombase : database },
					function(data){
					var arr = data.split("-");
						$cadenita = arr[0].substr(0,arr[0].length-1);
						var arreglo = $cadenita.split(",");
						var enlace = "";
						$("#txtatributos").val($cadenita);
						$("#txtcamposclaves").val(arr[1]);

						for(var i=0;i<arreglo.length;i++){
							enlace += "<tr>";
							enlace += "<td><input type='text' name='metadato[]' value='"+arreglo[i]+"'/></td>";
							enlace += "<td><input type='text' readOnly='readOnly' name='txtatrclass[]' value='"+arreglo[i]+"'/></td>";
							enlace += "<td><select name='tipo_campo[]' data-get-number='"+i+"' onchange='select_type(this);'><option value='texto'>Text</option><option value='combo'>Select</option><option value='radio'>Radio</option><option value='checkbox'>Checkbox</option><option value='textarea'>Textarea</option><option value='date'>Date</option></select><div id='campos_extras"+i+"'></div></td>";
							enlace += "<td>Obligatorio Si<input type='radio' name='obligatorio"+i+"' checked='checked' value='S'/> No<input type='radio' name='obligatorio"+i+"' value='N'/><br/> Solo Numeros  Si<input type='radio' name='solo_numeros"+i+"' value='S'/> No<input type='radio' checked='checked' name='solo_numeros"+i+"' value='N'/><br/> Solo letras  Si<input type='radio' name='solo_letras"+i+"' value='S'/> No<input type='radio' checked='checked' name='solo_letras"+i+"' value='N'/><br/> Correo  Si<input type='radio' name='val_correo"+i+"' value='S'/> No<input type='radio' checked='checked' name='val_correo"+i+"' value='N'/>  <br/> Max Caracteres <input type='text' name='maxcaracteres[]' value='no' size='2'/><br/> Min Caracteres <input type='text' name='mincaracteres[]' value='no' size='2'/><br/> Max Valor <input type='text' name='maxvalor[]' value='no' size='2'/><br/> Min valor <input type='text' name='minvalor[]' value='no' size='2'/></td>";
							enlace += "<td><button type='button' onclick='delete_campo(this);'>X</button></td>";
							enlace += "</tr>";
						}

						document.getElementById("atributos_col").innerHTML = enlace;
				  });
			}else{
				$("#txtatributos").val("");
				$("#txtnomclass").val("");
				$("#txtcamposclaves").val("");
			}
		});
		
		$(".que").click(function(){
			var value = $(this).val();
			if(value == "DE"){
				$("#columna_relacion").show();
			}else if(value == "MA"){
				$("#columna_relacion").hide();
			}
		});
		
		
		$("#txttabla2").change(function(){
			var f = document.form1;
			var dir = $(this).val();
			$("#clase2").val(primeraLetraMayuscula(dir));
			if(dir!="-"){
				var database = $("#txtbase").val();
				$.post("MasterGenerador.php", { oper: "listCampos", dirVal: dir, txtnombase : database },
					function(data){
					var arr = data.split("-");
						$cadenita = arr[0].substr(0,arr[0].length-1);
						$("#atributos2").val($cadenita);
						$("#campoclave2").val(arr[1]);
						$("#campodependiente").val($("#txtcamposclaves").val());
				  });
			}else{
				$("#atributos2").val("");
				$("#clase2").val("");
				$("#campoclave2").val("");
				$("#campodependiente").val("");
				
			}
		});
		
});