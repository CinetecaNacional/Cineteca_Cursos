var dolar = 0, euro=0;
function init(){
  $("#frmRegistro").on("submit",function(e){
		registro(e);
	});
  getCurrency();
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
  $.get("../ajax/curso.php?op=listar_vista", function(e){
    $('#cursos_online').html(e);
  });

}
function getCurrency(){
  // set endpoint and your access key
  endpoint = 'latest'
  //Token correcto
  access_key = 'd11ad76b3a4242395b58c2de978d8605';
  //Token erroneo
  //access_key = 'd11ad76b3a4242395b58c2de978d860';

  // get the most recent exchange rates via the "latest" endpoint:
  $.ajax({
    url: 'http://data.fixer.io/api/' + endpoint + '?access_key=' + access_key,
    dataType: 'jsonp',
    success: function(json) {
      if(json.success){
        euro = json.rates.MXN.toFixed(2)+' MXN';
        dolar = (json.rates.MXN/json.rates.USD).toFixed(2) +' MXN';
        $('#Dolar').html(dolar);
        $('#Euro').html(euro);
        $('#section_tipos_cambio').show();
      }else{
        $('#section_tipos_cambio').hide();
      }
    }
  });
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
function upperCase(input){
  if(input.value){
    input.value = input.value.toUpperCase();
  }
}
function inscribir(curso_id){
  $.post("../ajax/cursos_usuarios.php?op=guardar",{'curso_id': curso_id }, function(data, status){
    $("#resultado").html(data);
  })
}
$(document).ready(function(){
  $('.form_singUp').hide();
  var btn_logIn = $('#btn_logIn'),
  btn_singUp =$('#btn_singUp');
  btn_logIn.click(function(){
    btn_logIn.removeClass("btn-light").addClass("btn-primary");
    btn_singUp.removeClass("btn-primary").addClass("btn-light");
    $('.form_singUp').hide();
    $('.form_logIn').show();
  });
  btn_singUp.click(function () {
    btn_logIn.removeClass("btn-primary").addClass("btn-light");
    btn_singUp.removeClass("btn-light").addClass("btn-primary");
    $('.form_logIn').hide();
    $('.form_singUp').show();
  });
  $("#frmAcceso").on('submit',function(e){
      e.preventDefault();
      matricula=$("#input_login_matricula").val();
      password=$("#input_login_password").val();
      $.post("../ajax/usuario.php?op=verificar",
      {"matricula":matricula,"password":password},
      function(data){
        if (data!="null"){
          data = JSON.parse(data);
          alert('Bienvendo '+ data.nombre +'!');
          $(location).attr("href","index.php");
        }
        else{
          alert("Usuario y/o Password incorrectos");
        }
      });
    });
  init();
});

function registro(e){
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btn_registro").prop("disabled",true);
  password=$("#input_password").val();
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
	    {'password':password, 'tipo_usuario':tipo_usuario, 'apellido_paterno':apellido_paterno, 'apellido_materno':apellido_materno, 'nombre':nombre, 'curp':curp, 'sexo':sexo, 'fecha_nacimiento':fecha_nacimiento,'ocupacion':ocupacion, 'estudios':estudios, 'codigo_postal':codigo_postal, 'municipio':municipio, 'estado':estado, 'colonia':colonia, 'email':email, 'telefono':telefono},
	    function(datos){
        console.log(datos);
        if(!isNaN(datos)){
          alert("Usuario registrado exitosamente");
          $.post("../ajax/usuario.php?op=verificar2",
          {"usuario_id":datos,"password":password},
          function(data){
            if (data!="null"){
              data = JSON.parse(data);
              alert('Bienvendo '+ data.nombre +'! \nSu matrícula de acceso es '+data.matricula+'.');
              location.reload();
            }
            else{
              alert("Usuario y/o Password incorrectos");
            }
          });
        }else{
          alert("No se pude registrar al usuario");
        }
	    });
}
