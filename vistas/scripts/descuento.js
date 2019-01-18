var tabla;
function init(){
  mostrarform(false);
  listar();
  $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});
  $("#imagenmuestra").hide();
}
function pesos(input){
  if(input.value){
    input.value = parseFloat(input.value).toFixed(2);
  }
}
function upperCase(input){
  if(input.value){
    input.value = input.value.toUpperCase();
  }
}
//Función limpiar
function limpiar(){
  $("#input_descuento_id").val("");
  $("#input_name").val("");
  $("#input_porcentaje").val("");
  $("#input_available").val("");
}
//Función mostrat formulario
function mostrarform(flag){
  limpiar();
  if(flag){
    $("#registros").hide();
    $("#frm_registros").show();
    $("#btnGuardar").prop("disabled",false);
    $("#btnagregar").hide();
  }else{
    $("#registros").show();
    $("#frm_registros").hide();
    $("#btnGuardar").prop("disabled",true);
    $("#btnagregar").show();
  }
}

//Función cancelar formulario
function cancelarform(){
  limpiar();
  mostrarform(false);
}

//Función listar
function listar(){
  tabla = $("#tbl_listado").dataTable({
    "aProcessing":true, //Activamos el procesamiento del datatables
    "aServerSide":true, //Paginación y filtrado realizados por el servidor
    dom:'Bfrtip',
    buttons:[
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdf'
    ],
    "ajax":{
      url:'../ajax/descuento.php?op=listar',
      type:"get",
      dataType: "json",
      error: function(e){
        console.log(e.responseText);
      },
      "bDestroy": true,
      "iDisplayLength": 15,//Paginación
      "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
    }
  }).DataTable();
}
function mostrar(descuento_id){
    $.post("../ajax/descuento.php?op=mostrar",{descuento_id : descuento_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#input_descuento_id").val(data.descuento_id);
        $("#input_name").val(data.nombre);
        $("#input_porcentaje").val(data.porcentaje);
        $("#input_available").val(data.disponible);
    })
}

function guardaryeditar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/descuento.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos)
	    {
        alert(datos);
        mostrarform(false);
        tabla.ajax.reload();
	    }

	});
	limpiar();
}
//Función para desactivar registros
function desactivar(descuento_id){
	var result = confirm("¿Está Seguro de desactivar el descuento?");
  if(result){
    $.post("../ajax/descuento.php?op=desactivar", {descuento_id : descuento_id}, function(e){
      alert(e);
      tabla.ajax.reload();
    });
  }
}

//Función para activar registros
function activar(descuento_id){
	var result =confirm("¿Está seguro activar el descuento?");
		if(result==true){
        	$.post("../ajax/descuento.php?op=activar", {descuento_id : descuento_id}, function(e){
        		alert(e);
	            tabla.ajax.reload();
        	});
        }else{
          alert("Has cancelado la activación del descuento")
        }
}
init();
