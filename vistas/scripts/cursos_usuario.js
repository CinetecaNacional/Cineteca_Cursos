function init(){
  listar_en_proceso();
  listar_credenciales();
}
//Función listar
function listar_en_proceso(){
  $.get("../ajax/cursos_usuarios.php?op=listar_en_proceso",
  function(data){
    $('#cursos_en_proceso').html(data);
  });
}
//Función listar
function detalles_pago(cursos_usuarios_id){
  $.post("../ajax/cursos_usuarios.php?op=detalles_pago",
  {"cursos_usuarios_id":cursos_usuarios_id},
  function(data){
    $('#resultado').html(data);
  });
}
//Función listar
function listar_credenciales(){
  $.get("../ajax/cursos_usuarios.php?op=listar_credenciales",
  function(data){
    $('#cursos_inscritos').html(data);
  });
}

//Función listar
function notificar_pago(cursos_usuarios_id){
  $.post("../ajax/cursos_usuarios.php?op=notificar_pago",
  {"cursos_usuarios_id":cursos_usuarios_id},
  function(data){
    alert(data);
  });
}
init();
