<?php
require_once '../modelos/Descuento.php';
$descuento = new Descuento();
$descuento_id = isset($_POST["descuento_id"])? limpiarCadena($_POST["descuento_id"]):"";
$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$porcentaje = isset($_POST["porcentaje"])? limpiarCadena($_POST["porcentaje"]):"";
$disponible = isset($_POST["disponible"])? limpiarCadena($_POST["disponible"]):"";
switch ($_GET["op"]) {
  case 'guardaryeditar':
    if(empty($descuento_id)){
      $response = $descuento -> insertar($nombre, $porcentaje, $disponible);
      echo $response ? "Se registro con éxito el descuento $nombre": "No se pudo registrar el descuento";
    }else{
      $response = $descuento -> editar($descuento_id ,$nombre, $porcentaje, $disponible);
      echo $response ? "Se actualizo con éxito el descuento $nombre": "No se pudo actualizar el descuento";
    }
    break;
  case 'desactivar':
    $response = $descuento-> desactivar($descuento_id);
    echo $response ? "Se desactivo con éxito el descuento": "No se pudo desactivar el descuento";
    break;
  case 'activar':
    $response = $descuento-> activar($descuento_id);
    echo $response ? "Se activo con éxito el descuento": "No se pudo activar el descuento";
    break;
  case 'mostrar':
    $response = $descuento-> mostrar($descuento_id);
    //Codificar el resultado utilizando JSON
    echo json_encode($response);
    break;
  case 'listar':
    $response = $descuento-> listar();
    //Se declara un array
    $data = Array();
    while ($registro = $response->fetch_object()){
      if($registro->disponible==1){
        $btn_disponible = '<button class="btn btn-danger" onclick="desactivar('.$registro->descuento_id.')">Desactivar</button>';
      }else{
        $btn_disponible = '<button class="btn btn-success" onclick="activar('.$registro->descuento_id.')">Activar</button>';
      }
      $data[]=array(
        "0" => $registro->nombre,
        "1" => number_format($registro->porcentaje,2,".",",")." %",
        "2" => $btn_disponible,
        "3" => '<button class="btn btn-primary" onclick="mostrar('.$registro->descuento_id.')">Editar</button>'
      );
    }
    $results = array(
      "sEcho" => 1, //Información para el datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatables
      "iTotalDisplayRecords" => count($data),//enviamos el total de registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;
}
?>
