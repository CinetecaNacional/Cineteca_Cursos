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
        if($usuario -> verificar_curp($curp)<1){
          if($usuario -> verificar_email($email)<1){
            if($usuario -> verificar_matricula($matricula)<1){
              $response=$usuario -> insertar($matricula, $password, $tipo_usuario, "1", $apellido_paterno, $apellido_materno, $nombre, $curp, $sexo, $fecha_nacimiento, $ocupacion, $estudios, $email, $telefono, $codigo_postal, $municipio, $estado, $colonia);
              echo $response;
            }else{
              echo "Ingrese otra matrícula, debido a que este ya ha sido registrado";
            }
          }else{
            echo "Ingrese otro email, debido a que este ya ha sido registrado";
          }
        }else{
          echo "Ingrese otro CURP, debido a que este ya ha sido registrado";
        }
      }
      else {
          $response=$usuario->editar($usuario_id, $matricula, $password, $tipo_usuario, $apellido_paterno, $apellido_materno, $nombre, $curp, $sexo, $fecha_nacimiento, $ocupacion, $estudios, $email, $telefono, $codigo_postal, $municipio, $estado, $colonia);
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
  case 'listar':
    $response=$usuario->listar();
    //Vamos a declarar un array
    $data= Array();
    while ($reg=$response->fetch_object()){
      if($reg->disponible==1){
        $btn_disponible = '<button class="btn btn-danger" onclick="desactivar('.$reg->usuario_id.')">Desactivar</button>';
      }else{
        $btn_disponible = '<button class="btn btn-success" onclick="activar('.$reg->usuario_id.')">Activar</button>';
      }
        $data[]=array(
              "0"=>$reg->matricula,
              "1"=>$reg->tipo_usuario,
              "2"=>$reg->nombre.' '.$reg->apellido_paterno.' '.$reg->apellido_materno,
              "3"=>$reg->curp,
              "4"=>$reg->sexo,
              "5"=>$reg->fecha_nacimiento,
              "6"=>$reg->ocupacion,
              "7"=>$reg->estudios,
              "8"=>$reg->email,
              "9"=>$reg->telefono,
              "10"=>!empty($reg->codigo_postal) ? $reg->estado.', Municipio '.$reg->municipio.', Colonia '. $reg->colonia.', CP.'.$reg->codigo_postal.'.':'',
              "11" => '<button class="btn btn-primary" onclick="mostrar('.$reg->usuario_id.')">Editar</button>',
              "12"=> $btn_disponible
            );
      }
      $results = array(
          "sEcho"=>1, //Información para el datatables
          "iTotalRecords"=>count($data), //enviamos el total registros al datatable
          "iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
          "aaData"=>$data);
      echo json_encode($results);
      break;
    case 'desactivar':
      $res = $usuario-> desactivar($usuario_id);
      echo $res ? "Se desactivo con éxito el usuario": "No se pudo desactivar el usuario";
      break;
    case 'activar':
      $res = $usuario-> activar($usuario_id);
      echo $res ? "Se activo con éxito el usuario": "No se pudo activar el usuario";
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
          $_SESSION['nombre']=$fetch->nombre.' '.$fetch->apellido_paterno.' '.$fetch->apellido_materno;
      }
    echo json_encode($fetch);
    break;
    case 'verificar2':
      $usuario_id=$_POST['usuario_id'];
      $password=$_POST['password'];
      $response=$usuario->verificar2($usuario_id, $password);
      $fetch=$response->fetch_object();
      if (isset($fetch)){
            //Declaramos las variables de sesión
            $_SESSION['usuario_id']=$fetch->usuario_id;
            $_SESSION['matricula']=$fetch->matricula;
            $_SESSION['tipo_usuario']=$fetch->tipo_usuario;
            $_SESSION['nombre']=$fetch->nombre.' '.$fetch->apellido_paterno.' '.$fetch->apellido_materno;
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
