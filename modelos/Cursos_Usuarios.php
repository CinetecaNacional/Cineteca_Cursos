<?php
require '../config/Conexion.php';
/*
----Tabla de 'cursos_usuarios'----
Descripción en esta tabla se almacenan los datos necesarios del curso que se toma y el usuario
que lo toma, con algunos otros datos para realizar el pago de inscripción en el banco.
----Campos----
->cursos_usuarios_id
->curso_id
->usuario_id
->comprobante_pago
->password
->estatus
->experiencia
->fecha_limite_pago
->link_curso
->pago
->precio
->referencia
*/
class Cursos_Usuarios{
  function __construct(){
  }
  //Implementamos nuestro método para registrar un nuevo usuario en X curso
  public function insertar($curso_id, $usuario_id, $descuento, $estatus, $fecha_limite_pago, $precio, $referencia, $pago){
    $sql = "INSERT INTO cursos_usuarios (curso_id, usuario_id, descuento, estatus, fecha_limite_pago, precio, referencia, pago)
    VALUES('$curso_id', '$usuario_id', '$descuento', '$estatus' , '$fecha_limite_pago', '$precio', '$referencia', '$pago')";
    return ejecutarConsulta($sql);
  }
  //Implementamos este método cuando la persona nos notifica que ha realizado su pago.
  public function notificar_pago($cursos_usuarios_id){
    $sql = "UPDATE cursos_usuarios SET estatus = 1
    WHERE cursos_usuarios_id = '$cursos_usuarios_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos este método cuando corroboramos que la persona ha realizado su pago y le asignamos credenciales de acceso.
  public function notificar_credenciales($cursos_usuarios_id, $password, $link_curso, $vigencia_curso){
    $sql = "UPDATE cursos_usuarios SET password = '$password', link_curso = '$link_curso', vigencia_curso = '$vigencia_curso',pago = 1
    WHERE cursos_usuarios_id = '$cursos_usuarios_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos este método cuando la persona indica cual ha sido su experiencia en el proceso
  public function notificar_experiencia($cursos_usuarios_id, $experiencia){
    $sql = "UPDATE cursos_usuarios SET experiencia = '$experiencia'
    WHERE cursos_usuarios_id = '$cursos_usuarios_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos este método para solicitar una nueva fecha de pago si ya ha vencido.
  public function solicitar_referencia($cursos_usuarios_id, $curso_id, $usuario_id, $fecha_limite_pago, $precio, $referencia){
    $sql = "UPDATE cursos_usuarios SET curso_id = '$curso_id',usuario_id = '$usuario_id', estatus = 0 , fecha_limite_pago='$fecha_limite_pago', precio='$precio', referencia ='$referencia'
    WHERE cursos_usuarios_id = '$cursos_usuarios_id'";
    return ejecutarConsulta($sql);
  }
  public function verificar_inscripciones_pasadas($curso_id, $usuario_id){
    $sql = "SELECT * FROM cursos_usuarios WHERE curso_id = '$curso_id' AND usuario_id = '$usuario_id'";
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql = "SELECT * FROM cursos_usuarios";
    return ejecutarConsulta($sql);
  }
  public function listar_notificaciones_pago(){
    $sql = "SELECT cu.cursos_usuarios_id, cu.curso_id, c.nombre AS curso, u.nombre AS nombre_usuario, u.apellido_paterno AS apellido_paterno, u.apellido_materno AS apellido_materno , u.matricula AS matricula, u.password AS password, cu.precio, cu.fecha_limite_pago, cu.referencia FROM cursos_usuarios cu INNER JOIN cursos c ON cu.curso_id=c.curso_id INNER JOIN usuarios u ON cu.usuario_id = u.usuario_id WHERE estatus=1 AND pago=0";
    return ejecutarConsulta($sql);
  }
  public function listar_en_proceso($usuario_id){
    $sql="SELECT cu.cursos_usuarios_id, cu.curso_id, c.nombre AS curso, cu.precio, cu.fecha_limite_pago FROM cursos_usuarios cu INNER JOIN cursos c ON cu.curso_id=c.curso_id WHERE cu.pago=0 AND cu.usuario_id='$usuario_id'";
    return ejecutarConsulta($sql);
  }
  public function mostrar($cursos_usuarios_id){
    $sql="SELECT cu.curso_id, cu.usuario_id, c.nombre AS curso, u.nombre AS nombre_usuario, u.matricula AS matricula ,u.apellido_paterno AS apellido_paterno, u.apellido_materno AS apellido_materno, cu.precio, cu.fecha_limite_pago, cu.referencia FROM cursos_usuarios cu INNER JOIN cursos c ON cu.curso_id=c.curso_id INNER JOIN usuarios u ON cu.usuario_id = u.usuario_id WHERE cu.cursos_usuarios_id='$cursos_usuarios_id'";
    return ejecutarConsulta($sql);
  }
  public function listar_credenciales($usuario_id){
    $sql="SELECT cu.cursos_usuarios_id, cu.curso_id, c.nombre AS curso, cu.precio, cu.vigencia_curso, cu.link_curso, cu.password FROM cursos_usuarios cu INNER JOIN cursos c ON cu.curso_id=c.curso_id WHERE cu.estatus=1 AND cu.pago=1 AND cu.usuario_id='$usuario_id'";
    return ejecutarConsulta($sql);
  }
}
?>
