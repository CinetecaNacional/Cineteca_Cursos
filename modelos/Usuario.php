<?php
require '../config/Conexion.php';
class Usuario{
  function __construct(){

  }
  //Implementamos nuestro método para insertar registros
  public function insertar($matricula, $password, $tipo_usuario, $disponible, $apellido_paterno, $apellido_materno, $nombre, $curp, $sexo, $fecha_nacimiento, $ocupacion, $estudios, $email, $telefono, $codigo_postal, $municipio, $estado, $colonia){
    $sql = "INSERT INTO usuarios (matricula, password, tipo_usuario, disponible, apellido_paterno, apellido_materno, nombre, curp, sexo, fecha_nacimiento, ocupacion, estudios, email, telefono, codigo_postal, municipio, estado, colonia)
    VALUES('$matricula', '$password', '$tipo_usuario', '$disponible', '$apellido_paterno', '$apellido_materno', '$nombre', '$curp', '$sexo', '$fecha_nacimiento', '$ocupacion', '$estudios', '$email', '$telefono', '$codigo_postal', '$municipio', '$estado', '$colonia')";
    return ejecutarConsulta_retornar_ID($sql);
  }
  //Implementamos nuestro método para actualizar registros
  public function editar($usuario_id, $matricula, $password, $tipo_usuario, $disponible, $apellido_paterno, $apellido_materno, $nombre, $curp, $sexo, $fecha_nacimiento, $ocupacion, $estudios, $email, $telefono, $codigo_postal, $municipio, $estado, $colonia){

    $sql = "UPDATE usuarios SET nombre = '$matricula', password = '$password',  tipo_usuario = '$tipo_usuario', disponible = '$disponible', apellido_paterno = '$apellido_paterno', apellido_materno = '$apellido_materno', nombre = '$nombre', curp = '$curp', sexo = '$sexo', fecha_nacimiento = '$fecha_nacimiento', ocupacion = '$ocupacion', estudios = '$estudios', email = '$email', telefono = '$telefono', codigo_postal = '$codigo_postal', municipio = '$municipio', estado = '$estado', colonia = '$colonia' WHERE usuario_id = '$usuario_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para actualizar registros
  public function editar_password($usuario_id, $password){
    $sql = "UPDATE usuarios SET password = '$password' WHERE usuario_id = '$usuario_id'";
    return ejecutarConsulta($sql);
  }
  public function mostrar($usuario_id){
    $sql = "SELECT * FROM usuarios WHERE usuario_id = '$usuario_id'";
    return ejecutarConsultaSimpleFila($sql);
  }
  public function mostrar_curp($usuario_id){
    $sql = "SELECT * FROM usuarios WHERE curp = '$curp'";
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql = "SELECT * FROM usuarios";
    return ejecutarConsulta($sql);
  }
  public function listar_tipo_usuario($tipo_usuario){
    $sql = "SELECT * FROM usuarios WHERE tipo_usuario = '$tipo_usuario'";
    return ejecutarConsulta($sql);
  }
  //Función para verificar el acceso al sistema
  public function verificar($matricula,$password){
    $sql="SELECT * FROM usuarios WHERE matricula='$matricula' AND password='$password'";
    return ejecutarConsulta($sql);
  }
  public function verificar_matricula($matricula){
    $sql="SELECT * FROM usuarios WHERE matricula='$matricula'";
    return contarRegistros($sql);
  }
  public function verificar_email($email){
    $sql="SELECT * FROM usuarios WHERE email='$email'";
    return contarRegistros($sql);
  }
  public function contar(){
    $sql="SELECT * FROM usuarios";
    return contarRegistros($sql);
  }
}
?>
