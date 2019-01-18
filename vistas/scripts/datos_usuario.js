function init(){
  $('#frmDatos').hide();
  $('#frmPassword').hide();
  $("#frmDatos").on("submit",function(e){
		editarDatos(e);
	});
  $("#frmPassword").on("submit",function(e)
	{
		editarPassword(e);
	});
}
function mostrar(usuario_id){
    $.post("../ajax/usuario.php?op=mostrar",{usuario_id : usuario_id }, function(data, status){
        data = JSON.parse(data);
        $("#dato-nombre").html(data.nombre +' ' +data.apellido_paterno+' '+data.apellido_materno );
        $("#dato-CURP").html(data.curp);
        $("#dato-fecha_nacimiento").html(data.fecha_nacimiento);
        $("#dato-sexo").html(data.sexo);
        $("#dato-ocupacion").html(data.ocupacion);
        $("#dato-estudios").html(data.estudios);
        $("#dato-correo_electronico").html(data.email);
        $("#dato-telefono").html(data.telefono);
        $("#dato-cp").html(data.codigo_postal);
        $("#dato-estado").html(data.estado);
        $("#dato-colonia").html(data.colonia);
        $("#dato-municipio").html(data.municipio);
    })
}
function editarDatos(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
  usuario_id=$("#input_usuario_id").val();
  matricula=$("#input_matricula").val();
  password=$("#input_password2").val();
  tipo_usuario=$("#input_tipo_usuario").val();
  apellido_paterno=$("#input_apellido_paterno").val();
  apellido_materno=$("#input_apellido_materno").val();
  nombre=$("#input_nombre").val();
  curp=$("#input_curp").val();
  sexo=$("#input_sexo").val();
  fecha_nacimiento=$("#input_fecha_nacimiento").val();
  ocupacion=$("#input_ocupacion").val();
  estudios=$("#input_estudios").val();
  codigo_postal=$("#input_codigo_postal").val();
  municipio=$("#input_municipio").val();
  estado=$("#input_estado").val();
  colonia=$("#input_colonia").val();
  email=$("#input_email").val();
  telefono=$("#input_telefono").val();
  $.post("../ajax/usuario.php?op=guardaryeditar",
	    {'usuario_id':usuario_id ,'matricula': matricula, 'password':password, 'tipo_usuario':tipo_usuario, 'apellido_paterno':apellido_paterno, 'apellido_materno':apellido_materno, 'nombre':nombre, 'curp':curp, 'sexo':sexo, 'fecha_nacimiento':fecha_nacimiento,'ocupacion':ocupacion, 'estudios':estudios, 'codigo_postal':codigo_postal, 'municipio':municipio, 'estado':estado, 'colonia':colonia, 'email':email, 'telefono':telefono},
	    function(datos){
        alert(datos);
        $('#resultado').html('<script>location.reload();</script>')
	    });
}
function editarPassword(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
  usuario_id=$("#input_usuario_id2").val();
  password=$("#input_password").val();
  $.post("../ajax/usuario.php?op=editar_contraseña",
	    {'usuario_id':usuario_id ,'password': password},
	    function(datos){
        alert(datos);
        $('#resultado').html('<script>location.reload();</script>')
	    });
}


function mostrarForm(usuario_id){
    $.post("../ajax/usuario.php?op=mostrar",{usuario_id : usuario_id}, function(data, status){
        data = JSON.parse(data);
        $("#input_usuario_id").val(data.usuario_id);
        $("#input_usuario_id2").val(data.usuario_id);
        $("#input_matricula").val(data.matricula);
        $("#input_tipo_usuario").val(data.tipo_usuario);
        $("#input_password2").val(data.password);
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
        $("#input_colonia").html('<option>'+data.colonia+'</option>');
        $("#input_email").val(data.email);
        $("#input_telefono").val(data.telefono);
    });
}
function formulario_password(usuario_id){
  mostrarForm(usuario_id);
  $('#frmPassword').show();
  $('#seccion_datos').hide();
}
function formulario_datos(usuario_id){
  $('#frmDatos').show();
  $('#seccion_datos').hide();
  mostrarForm(usuario_id);
}
function cancelarform(){
  $('#frmDatos').hide();
  $('#frmPassword').hide();
  $('#seccion_datos').show();
}

init();
