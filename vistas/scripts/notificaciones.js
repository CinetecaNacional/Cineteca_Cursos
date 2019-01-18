function init(){
  listar_notificaciones_pago();
}
//Función listar
function listar_notificaciones_pago(cursos_usuarios_id){
  $.get("../ajax/cursos_usuarios.php?op=listar_notificaciones_pago",
  function(data){
    $('#notificaciones_pago').html(data);
  });
}
function mostrar_form(cursos_usuarios_id, matricula, curso, precio, nombre, referencia, password){
  $('#input_cursos_usuarios_id').val(cursos_usuarios_id);
  $('#input_matricula').val(matricula);
  $('#input_curso').val(curso);
  $('#input_precio').val(precio);
  $('#input_nombre').val(nombre);
  $('#input_referencia').val(referencia);
  $('#input_password').val(password);
}
function notificar_credenciales(){
  var cursos_usuarios_id = $('#input_cursos_usuarios_id').val(),
  password = $('#input_password').val(),
  link_curso = $('#input_link_curso').val(),
  vigencia_curso = $('#input_vigencia_curso').val();
  $.post("../ajax/cursos_usuarios.php?op=notificar_credenciales",
  {'cursos_usuarios_id':cursos_usuarios_id, 'password':password, 'link_curso':link_curso, 'vigencia_curso':vigencia_curso},
  function(data){
    alert(data);
    location.reload();
  });
}
init();
