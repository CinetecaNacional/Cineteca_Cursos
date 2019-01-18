<?php
require '../config/Conexion.php';
/*
----Tabla de 'cursos'----
Descripción en esta tabla se almacenan los datos necesarios de los cursos que la cineteca nacional imparte.
----Campos----
->curso_id
->nombre
->disponible
->descripcion
->imagen
->precio
->tipo_curso
->precio_promocion
->vigencia_promocion
->promocion_disponible
*/
class Curso{
  function __construct(){
  }
  //Implementamos nuestro método para insertar un nuevo curso
  public function insertar($nombre, $disponible, $descripcion, $imagen, $precio, $tipo_curso, $precio_promocion, $vigencia_promocion, $promocion_disponible){
    $sql = "INSERT INTO cursos (nombre, disponible, descripcion, imagen, precio, tipo_curso, precio_promocion, vigencia_promocion, promocion_disponible)
    VALUES('$nombre', '$disponible', '$descripcion', '$imagen','$precio', '$tipo_curso', '$precio_promocion', '$vigencia_promocion' , '$promocion_disponible')";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para actualizar los datos de los cursos
  public function editar($curso_id, $nombre, $disponible, $descripcion, $imagen, $precio, $tipo_curso, $precio_promocion, $vigencia_promocion, $promocion_disponible){
    if(empty($precio_promocion)){
      $sql = "UPDATE cursos SET nombre = '$nombre', disponible= '$disponible',descripcion = '$descripcion', imagen = '$imagen', precio = '$precio', tipo_curso = '$tipo_curso', precio_promocion = NULL, vigencia_promocion = NULL, promocion_disponible = '$promocion_disponible'
      WHERE curso_id = '$curso_id'";
    }else{
      $sql = "UPDATE cursos SET nombre = '$nombre', disponible= '$disponible',descripcion = '$descripcion', imagen = '$imagen', precio = '$precio', tipo_curso = '$tipo_curso', precio_promocion = '$precio_promocion', vigencia_promocion = '$vigencia_promocion', promocion_disponible = '$promocion_disponible'
      WHERE curso_id = '$curso_id'";
    }
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para desactivar un curso
  public function desactivar($curso_id){
    $sql = "UPDATE cursos SET disponible = '0' WHERE curso_id = '$curso_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para desactivar alguna promoción
  public function desactivar_promocion($curso_id){
    $sql = "UPDATE cursos SET promocion_disponible = '0', precio_promocion = Null, vigencia_promocion = Null  WHERE curso_id = '$curso_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para activar un curso
  public function activar($curso_id){
    $sql = "UPDATE cursos SET disponible = '1' WHERE curso_id = '$curso_id'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para mostrar un curso en especifico
  public function mostrar($curso_id){
    $sql = "SELECT * FROM cursos WHERE curso_id = '$curso_id'";
    return ejecutarConsultaSimpleFila($sql);
  }
  //Implementamos nuestro método para listar todos los cursos
  public function listar(){
    $sql = "SELECT * FROM cursos";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para listar los cursos online disponibles
  public function listar_online_disponibles(){
    $sql = "SELECT * FROM cursos WHERE disponible='1' AND tipo_curso='Online'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para listar todos los cursos online
  public function listar_online(){
    $sql = "SELECT * FROM cursos WHERE tipo_curso='Online'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para listar todos los cursos presenciales
  public function listar_presencial(){
    $sql = "SELECT * FROM cursos WHERE tipo_curso='Presencial'";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para listar todos los cursos de maestría
  public function listar_maestria(){
    $sql = "SELECT * FROM cursos WHERE tipo_curso='Maestría'";
    return ejecutarConsulta($sql);
  }
}
?>
