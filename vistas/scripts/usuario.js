function init(){

}
function upperCase(input){
  if(input.value){
    input.value = input.value.toUpperCase();
  }
}
$('#input_tipo_usuario').on('change',function(){
    var tipo_usuario = $("#input_tipo_usuario option:selected").text();
    if(tipo_usuario=="Presencial" || tipo_usuario=="Online"){
      $('#matriculaHelp').removeClass('text-danger').addClass('text-info');
      $('#matriculaHelp').html('Ingrese una matrícula solo si el usuario ya cuenta con una');
      $('#input_matricula').removeAttr('required');
    }else{
      $('#matriculaHelp').removeClass('text-info').addClass('text-danger');
      $('#matriculaHelp').html('Debe ingresar una matrícula para este tipo de usuario');
      $('#input_matricula').attr("required","true");
    }
});
$('#input_matricula').on('input',function(){
    if($('#input_matricula').val().length==9){
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

      })
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
