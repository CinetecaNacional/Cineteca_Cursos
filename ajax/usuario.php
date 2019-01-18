<?php
session_start();
require_once "../modelos/Usuario.php";

$usuario = new Usuario();

$usuario_id=isset($_POST["usuario_id"])? limpiarCadena($_POST["usuario_id"]):"";
$matricula=isset($_POST["matricula"])? limpiarCadena($_POST["matricula"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$tipo_usuario=isset($_POST["tipo_usuario"])? limpiarCadena($_POST["tipo_usuario"]):"";
$apellido_paterno=isset($_POST["apellido_paterno"])? limpiarCadena($_POST["apellido_paterno"]):"";
$apellido_materno=isset($_POST["apellido_materno"])? limpiarCadena($_POST["apellido_materno"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$curp=isset($_POST["curp"])? limpiarCadena($_POST["curp"]):"";
$sexo=isset($_POST["sexo"])? limpiarCadena($_POST["sexo"]):"";
$fecha_nacimiento=isset($_POST["fecha_nacimiento"])? limpiarCadena($_POST["fecha_nacimiento"]):"";
$ocupacion=isset($_POST["ocupacion"])? limpiarCadena($_POST["ocupacion"]):"";
$estudios=isset($_POST["estudios"])? limpiarCadena($_POST["estudios"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$codigo_postal=isset($_POST["codigo_postal"])? limpiarCadena($_POST["codigo_postal"]):"";
$municipio=isset($_POST["municipio"])? limpiarCadena($_POST["municipio"]):"";
$estado=isset($_POST["estado"])? limpiarCadena($_POST["estado"]):"";
$colonia=isset($_POST["colonia"])? limpiarCadena($_POST["colonia"]):"";

switch ($_GET["op"]){
  case 'contar':
    $response = $usuario -> contar();
    echo $response;
    break;
  case 'verificar_matricula':
    $response = $usuario -> verificar_matricula($matricula);
    echo $response;
    break;
  case 'guardaryeditar':
      if (empty($usuario_id)){
          $response=$usuario -> insertar($nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $codigo_postal, $curp, $password,$sexo,$ocupacion, $estudios, $fecha_nacimiento,$matricula,$tipo_usuario);
          echo json_encode($response);
      }
      else {
          $response=$usuario->editar($usuario_id, $nombre, $apellido_paterno, $apellido_materno, $email, $telefono, $codigo_postal, $curp,$sexo,$ocupacion, $estudios, $fecha_nacimiento,$matricula,$tipo_usuario);
          echo $response ? "Usuario actualizado" : "Usuario no se pudo actualizar";
      }
      break;
  case 'editar_contraseña':
    $response=$usuario->editar_password($usuario_id, $password);
    echo $response ? "Contraseña actualizada" : "No se pudo actualizar la contraseña";
    break;
  case 'mostrar':
      $response=$usuario->mostrar($usuario_id);
      //Codificar el resultado utilizando json
      echo json_encode($response);
      break;
  case 'mostrar_curp':
    $response=$usuario->mostrar_curp($curp);
    //Codificar el resultado utilizando json
      echo json_encode($response);
      break;
  case 'listar':
    $response=$usuario->listar();
    //Vamos a declarar un array
    $data= Array();
    while ($reg=$response->fetch_object()){
        $data[]=array(
              "0"=>$reg->matricula,
              "1"=>$reg->nombres.' '.$reg->apellido_paterno.' '.$reg->apellido_materno,
              "2"=>$reg->curp,
              "3"=>$reg->sexo,
              "4"=>$reg->fecha_nacimiento,
              "5"=>$reg->codigo_postal,
              "6"=>$reg->email,
              "7"=>$reg->telefono,
              "8"=>$reg->password);
      }
      $results = array(
          "sEcho"=>1, //Información para el datatables
          "iTotalRecords"=>count($data), //enviamos el total registros al datatable
          "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
          "aaData"=>$data);
      echo json_encode($results);
      break;
  case 'verificar':
    $matricula=$_POST['matricula'];
    $password=$_POST['password'];
    $response=$usuario->verificar($matricula, $password);
    $fetch=$response->fetch_object();
    if (isset($fetch)){
          //Declaramos las variables de sesión
          $_SESSION['usuario_id']=$fetch->usuario_id;
          $_SESSION['matricula']=$fetch->matricula;
          $_SESSION['tipo_usuario']=$fetch->tipo_usuario;
          $_SESSION['nombre']=$fetch->nombres.' '.$fetch->apellido_paterno.' '.$fetch->apellido_materno;
      }
    echo json_encode($fetch);
    break;
  case 'salir':
      //Limpiamos las variables de sesión
      session_unset();
      //Destruìmos la sesión
      session_destroy();
      //Redireccionamos al login
      header("Location: ../vistas/index.php");
      break;
}
?>
