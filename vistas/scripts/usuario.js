function init(){
  mostrarform(false);
  listar();
  $("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});
  var tipo_usuario = $("#input_tipo_usuario option:selected").text();
  if(tipo_usuario=="Presencial"){
    $("#passwords").hide();
    $('#input_password').removeAttr('required');
    $('#input_password_comfirm').removeAttr('required');
    $('#input_password').val('');
    $('#input_password_comfirm').val();
  }else{
    $("#passwords").show();
    $('#input_password').attr("required","true");
    $('#input_password_comfirm').attr("required","true");
  }
  var cp = document.getElementById('input_codigo_postal');
  if(cp){
    cp.addEventListener("input",function(){
      if((this.value).length>=5){
        getCodigoPostal(this.value);
      } else if ((this.value).length==0) {
        $('#msg').html('');
      }else{
        $('#msg').html('Código postal no válido');
        $('#input_municipio').val('');
        $('#input_estado').val('');
        $('#input_colonia').html('');
      }
    });
  }
}
function upperCase(input){
  if(input.value){
    input.value = input.value.toUpperCase();
  }
}
//Función limpiar
function limpiar(){
  $("#input_curso_id").val("");
  $("#input_tipo_usuario").val("");
  $("#input_matricula").val("");
  $("#input_password").val("");
  $("#input_password_comfirm").val("");
  $("#input_apellido_paterno").val("");
  $("#input_apellido_materno").val("");
  $("#input_nombre").val("");
  $("#input_curp").val("");
  $("#input_sexo").val("");
  $("#input_fecha_nacimiento").val("");
  $("#input_ocupacion").val("");
  $("#input_estudios").val("");
  $("#input_codigo_postal").val("");
  $("#input_municipio").val("");
  $("#input_estado").val("");
  $("#input_colonia").val("");
  $("#input_email").val("");
  $("#input_telefono").val("");
}
function getCodigoPostal(cp){
  var codigo_postal = cp;
  $.ajax({
    url: 'https://api-codigos-postales.herokuapp.com/v2/codigo_postal/' + codigo_postal,
    dataType: 'json',
    success: function(json) {
      if(json.municipio){
        var options =''
        for(var i=0; i<json.colonias.length; i++){
          options+='<option value="'+json.colonias[i]+'">'+json.colonias[i]+'</option>'
        }
        $('#input_municipio').val(json.municipio);
        $('#input_estado').val(json.estado);
        $('#input_colonia').html(options);
        $('#msg').html('');
      }else{
        $('#msg').html('Código postal no válido');
      }
    }
  });
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
      url:'../ajax/usuario.php?op=listar',
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
function mostrar(usuario_id){
    $.post("../ajax/usuario.php?op=mostrar",{usuario_id : usuario_id}, function(data, status){
        data = JSON.parse(data);
        mostrarform(true);
        $("#input_usuario_id").val(data.usuario_id);
        $("#input_tipo_usuario").val(data.tipo_usuario);
        $("#input_matricula").val(data.matricula);
        $("#input_password").val(data.password);
        $("#input_password_comfirm").val(data.password);
        $("#input_apellido_paterno").val(data.apellido_paterno);
        $("#input_apellido_materno").val(data.apellido_materno);
        $("#input_nombre").val(data.nombre);
        $("#input_curp").val(data.curp);
        $("#input_sexo").val(data.sexo);
        $("#input_fecha_nacimiento").val(data.fecha_nacimiento);
        $("#input_ocupacion").val(data.ocupacion);
        $("#input_estudios").val(data.estudios);
        $("#input_codigo_postal").val(data.codigo_postal);
        $("#input_municipio").val(data.municipio);
        $("#input_estado").val(data.estado);
        $("#input_colonia").val(data.colonia);
        $("#input_email").val(data.email);
        $("#input_telefono").val(data.telefono);
    })
}

function guardaryeditar(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);
	$.ajax({
		url: "../ajax/usuario.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,
	    success: function(datos){
        alert(datos);
        mostrarform(false);
        tabla.ajax.reload();
	    }

	});
	limpiar();
}
//Función para desactivar registros
function desactivar(usuario_id){
	var result = confirm("¿Está Seguro dar de baja al usuario?");
  if(result){
    $.post("../ajax/usuario.php?op=desactivar", {usuario_id : usuario_id}, function(e){
      alert(e);
      tabla.ajax.reload();
    });
  }
}
//Función para activar registros
function activar(usuario_id)
{
	var result =confirm("¿Está seguro de volver a darle acceso a la persona al sistema?");
		if(result==true){
        	$.post("../ajax/usuario.php?op=activar", {usuario_id : usuario_id}, function(e){
        		alert(e);
	            tabla.ajax.reload();
        	});
        }else{
          alert("Has cancelado el dar acceso al sistema al usuario")
        }
}
$('#input_tipo_usuario').on('change',function(){
    var tipo_usuario = $("#input_tipo_usuario option:selected").text();
    if(tipo_usuario=="Presencial" || tipo_usuario=="Online"){
      if(tipo_usuario=="Presencial"){
        $("#passwords").hide();
        $('#input_password').removeAttr('required');
        $('#input_password').val('');
        $('#input_password_comfirm').removeAttr('required');
        $('#input_password_comfirm').val();
      }else{
        $("#passwords").show();
        $('#input_password').attr("required","true");
        $('#input_password_comfirm').attr("required","true");
      }
      $('#matriculaHelp').removeClass('text-danger').addClass('text-info');
      $('#matriculaHelp').html('Ingrese una matrícula solo si el usuario ya cuenta con una');
      $('#input_matricula').removeAttr('required');
    }else{
      $("#passwords").show();
      $('#matriculaHelp').removeClass('text-info').addClass('text-danger');
      $('#matriculaHelp').html('Debe ingresar una matrícula para este tipo de usuario');
      $('#input_matricula').attr("required","true");
    }
});
$('#input_matricula').on('input',function(){
    if($('#input_matricula').val().length==9 && $('#input_usuario_id')==''){
      $('#matriculaHelp').removeClass('text-info').removeClass('text-danger').addClass('text-success');
      $('#matriculaHelp').html('Matrícula válida');
      $.post("../ajax/usuario.php?op=verificar_matricula",{matricula : $('#input_matricula').val()}, function(data, status){
        console.log(data);
          if(data>0){
            document.getElementById('input_matricula').setCustomValidity('Esta matrícula ya ha sido asignada con anterioridad');
            $('#matriculaHelp').removeClass('text-success').addClass('text-danger');
            $('#matriculaHelp').html('Esta matrícula ya ha sido asignada con anterioridad');
          }else{
            $('#matriculaHelp').removeClass('text-info').removeClass('text-danger').addClass('text-success');
            $('#matriculaHelp').html('Matrícula válida');
            document.getElementById('input_matricula').setCustomValidity('');
          }
      });
    }else{
      var tipo_usuario = $("#input_tipo_usuario option:selected").text();
      if(tipo_usuario=="Presencial" || tipo_usuario=="Online"){
        $('#matriculaHelp').removeClass('text-danger').addClass('text-info');
        $('#matriculaHelp').html('Ingrese una matrícula solo si el usuario ya cuenta con una');
      }else{
        $('#matriculaHelp').removeClass('text-info').addClass('text-danger');
        $('#matriculaHelp').html('Debe ingresar una matrícula para este tipo de usuario');
      }
    }
});
init();
