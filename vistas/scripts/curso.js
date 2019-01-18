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
//Función limpiar
function limpiar(){
  $("#input_curso_id").val("");
  $("#input_name").val("");
  $("#imagenmuestra").attr("src","");
  $("#imagen").val("");
  $("#imagenactual").val("");
  $("#textarea_description").val("");
  $("#input_price").val("");
  $("#input_available").val("");
  $("#input_kindCourse").val("");
  $("#input_offerPrice").val("");
  $("#input_dateAvailable").val("");
  $('#input_dateAvailable').removeAttr("required");
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
      url:'../ajax/curso.php?op=listar',
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
function mostrar(curso_id){
    $.post("../ajax/curso.php?op=mostrar",{curso_id : curso_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#input_curso_id").val(data.curso_id);
        $("#input_name").val(data.nombre);
        $("#imagenmuestra").show();
        $("#imagenmuestra").attr("src","../files/cursos/"+data.imagen);
        $("#imagenactual").val(data.imagen);
        $("#textarea_description").val(data.descripcion);
        $("#input_price").val(data.precio);
        $("#input_available").val(data.disponible);
        $("#input_kindCourse").val(data.tipo_curso);
        $("#input_offerPrice").val(data.precio_promocion);
        $("#input_dateAvailable").val(data.vigencia_promocion);
        var offerPrice = $('#input_offerPrice');
        var dateAvailable = $('#input_dateAvailable');
        var kindCourse = $("#input_kindCourse option:selected").text();
        if(kindCourse=="Online"){
          $('#form-group-dateAvailable').removeAttr("hidden");
          $('#form-group-offerPrice').removeAttr("hidden");
          validarPrecios();
        }else{
          $('#form-group-offerPrice').attr("hidden","true");
          $('#form-group-dateAvailable').attr("hidden","true");
          dateAvailable.val("");
          offerPrice.val("");
        }
    })
}

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/curso.php?op=guardaryeditar",
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
function desactivar(curso_id)
{
	var result = confirm("¿Está Seguro de quitar el curso al público?");
  if(result){
    $.post("../ajax/curso.php?op=desactivar", {curso_id : curso_id}, function(e){
      alert(e);
      tabla.ajax.reload();
    });
  }
}
//Función para desactivar promoción registros
function desactivar_promocion(curso_id)
{
	var result = confirm("¿Está Seguro de quitar la promoción del curso?");
  if(result){
    $.post("../ajax/curso.php?op=desactivar_promocion", {curso_id : curso_id}, function(e){
      alert(e);
      tabla.ajax.reload();
    });
  }
}
//Función para activar registros
function activar(curso_id)
{
	var result =confirm("¿Está seguro de poner al público el curso?");
		if(result==true){
        	$.post("../ajax/curso.php?op=activar", {curso_id : curso_id}, function(e){
        		alert(e);
	            tabla.ajax.reload();
        	});
        }else{
          alert("Has cancelado la publicación del curso")
        }
}
function validarPrecios(){
  var offerPrice = $('#input_offerPrice');
  var price = $('#input_price');
  offerPrice.on('input',function(){
    console.log("hola1");
  });
  price.on('input',function(){
    console.log("hola");
  })
}
$(document).ready(function(){
  init();
  var offerPrice = $('#input_offerPrice');
  var price = $('#input_price');
  var dateAvailable = $('#input_dateAvailable');
    $('#input_kindCourse').on('change',function(){
        var kindCourse = $("#input_kindCourse option:selected").text();
        if(kindCourse=="Presencial"){
          $('#form-group-offerPrice').attr("hidden","true");
          $('#form-group-dateAvailable').attr("hidden","true");
          dateAvailable.val("");
          offerPrice.val("");
        }else if(kindCourse=="Online"){
          $('#form-group-dateAvailable').removeAttr("hidden");
          $('#form-group-offerPrice').removeAttr("hidden");
          validarPrecios();
        }
    });
    offerPrice.blur(function(){
      console.log(offerPrice.val());
      if(offerPrice.val()){
        offerPrice.val(parseFloat(offerPrice.val()).toFixed(2));
        dateAvailable.attr("required","true");
        if(parseFloat(offerPrice.val())>=parseFloat(price.val())){
          document.getElementById('input_offerPrice').setCustomValidity('El precio de oferta tiene que ser menor al normal');
          price.blur(function(){
            if(parseFloat(offerPrice.val())>=parseFloat(price.val())){
              document.getElementById('input_offerPrice').setCustomValidity('El precio de oferta tiene que ser menor al normal');
            }else{
              document.getElementById('input_offerPrice').setCustomValidity('');
            }
          });
        }else{
          document.getElementById('input_offerPrice').setCustomValidity('');
        }
      }else {
        dateAvailable.removeAttr("required");
        dateAvailable.val(" ");
      }
    });
    price.blur(function(){
      if(price.val()){
        price.val(parseFloat(price.val()).toFixed(2));
      }
    });
});
