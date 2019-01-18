<?php
require '../config/Conexion.php';
class Descuento{
  function __construct(){
  }
  //Implementamos nuestro método para insertar registros
  public function insertar($nombre, $porcentaje,$disponible){
    $sql = "INSERT INTO descuentos (nombre, porcentaje, disponible)
    VALUES('$nombre', '$porcentaje', '$disponible')";
    return ejecutarConsulta($sql);
  }
  //Implementamos nuestro método para actualizar registros
  public function editar($descuento_id, $nombre, $porcentaje,$disponible){
    $sql = "UPDATE descuentos SET nombre = '$nombre', porcentaje = '$porcentaje', disponible = '$disponible'
    WHERE descuento_id = '$descuento_id'";
    return ejecutarConsulta($sql);
  }
  public function desactivar($descuento_id){
    $sql = "UPDATE descuentos SET disponible = '0' WHERE descuento_id = '$descuento_id'";
    return ejecutarConsulta($sql);
  }
  public function activar($descuento_id){
    $sql = "UPDATE descuentos SET disponible = '1' WHERE descuento_id = '$descuento_id'";
    return ejecutarConsulta($sql);
  }
  public function mostrar($descuento_id){
    $sql = "SELECT * FROM descuentos WHERE descuento_id = '$descuento_id'";
    return ejecutarConsultaSimpleFila($sql);
  }
  public function listar(){
    $sql = "SELECT * FROM descuentos";
    return ejecutarConsulta($sql);
  }
  public function listar_disponibles(){
    $sql = "SELECT * FROM descuentos WHERE disponible='1'";
    return ejecutarConsulta($sql);
  }
}
?>
