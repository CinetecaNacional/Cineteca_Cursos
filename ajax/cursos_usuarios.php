<?php
require_once '../modelos/Cursos_Usuarios.php';
require_once '../modelos/Curso.php';
require_once '../modelos/Referencia.php';
require_once '../config/global.php';
setlocale(LC_TIME, IDIOMA);
$Cursos_Usuarios = new Cursos_Usuarios();
$Curso = new Curso();
//Activamos el almacenamiento en el buffer
ob_start();
session_start();
$usuario_id = isset($_SESSION['usuario_id'])? limpiarCadena($_SESSION['usuario_id']):"";
$matricula = isset($_SESSION['matricula'])? limpiarCadena($_SESSION['matricula']):"";
$curso_id = isset($_POST["curso_id"])? limpiarCadena($_POST["curso_id"]):"";
$cursos_usuarios_id = isset($_POST["cursos_usuarios_id"])? limpiarCadena($_POST["cursos_usuarios_id"]):"";
$password = isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$link_curso = isset($_POST["link_curso"])? limpiarCadena($_POST["link_curso"]):"";
$vigencia_curso = isset($_POST["vigencia_curso"])? limpiarCadena($_POST["vigencia_curso"]):"";
$descuento = isset($_POST["descuento"])? limpiarCadena($_POST["descuento"]):"SIN DESCUENTO";
switch ($_GET["op"]){
  case 'guardar':
    if(empty($usuario_id)){
      echo "<script>
       alert('Debe iniciar sesión para poder inscribirse al curso!');
     </script>";
    }else{
      $inscripcion_previa =  $Cursos_Usuarios->verificar_inscripciones_pasadas($curso_id, $usuario_id);
      if($inscripcion_previa){
        echo "<script>
         alert('Ya te has registrado previamente a este curso, dirígete al apartado de mis cursos si quieres ver los detalles de pago.');
       </script>";
      }else{
        $datos_curso = $Curso->mostrar($curso_id);
        if($datos_curso['promocion_disponible'] =='1'){
          $precio = $datos_curso['precio_promocion'];
        }else{
          $precio = $datos_curso['precio'];
        }
        $Referencia = new Referencia($matricula,$curso_id,$precio);
        $referencia = $Referencia-> get_referencia();
        $fecha_limite_pago = $Referencia-> get_fecha_limite_pago();
        $year = date("Y", $fecha_limite_pago);
        $month= date("m", $fecha_limite_pago);
        $day = date("j", $fecha_limite_pago);
        $fecha_limite_pago02 = $year.'-'.$month.'-'.$day;
        $estatus = '0';
        $pago = '0';
        $response = $Cursos_Usuarios -> insertar($curso_id, $usuario_id, $descuento, $estatus, $fecha_limite_pago02, $precio, $referencia,$pago);
        $resultado = $Cursos_Usuarios ->verificar_inscripciones_pasadas($curso_id, $usuario_id);
        $_SESSION['cursos_usuarios_id']= $resultado['cursos_usuarios_id'];
        echo $response ? "<script>
        alert('Se registro con éxito al curso');
          window.open('./comprobante-pago.php', '_blank');
          location.href ='./cursos_usuario.php';
        </script>": "<script>
          alert('No se pudo registrar al curso');
        </script>";
      }
    }
    break;
  case 'listar_en_proceso':
    if(!empty($usuario_id)){
      $response = $Cursos_Usuarios->listar_en_proceso($usuario_id);
      if($response){
        $html ='';
        //Se declara un array
        $data = Array();
        while ($registro = $response->fetch_object()){
          $fecha_limite_pago = strftime("%d de %B de %Y", strtotime ($registro->fecha_limite_pago));
          $html.='<tr>
            <td scope="row">'.$registro->curso.'</td>
            <td>'.number_format($registro->precio,2,".",",").' MXN</td>
            <td>'.$fecha_limite_pago.'</td>
            <td>
              <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" onclick="detalles_pago('.$registro->cursos_usuarios_id.');">Detalles de pago</button>
                <button type="button" class="btn btn-success" onclick="notificar_pago('.$registro->cursos_usuarios_id.');">Ya he realizado mi pago</button>
              </div>
            </td>
          </tr>';
        }
        if(empty($html)){
          $html.='<tr class="table-danger text-center"><td colspan="3">No hay cursos en proceso de inscripción actualmente.</td></tr>';
        }
        echo $html;
      }
    }else{
      echo "No has iniciado sesión";
    }
    break;
    case 'listar_credenciales':
      if(!empty($usuario_id)){
        $response = $Cursos_Usuarios->listar_credenciales($usuario_id);
        if($response){
          $html ='';
          //Se declara un array
          $data = Array();
          while ($registro = $response->fetch_object()){
            $vigencia_curso = strftime("%d de %B de %Y", strtotime ($registro->vigencia_curso));
            $html.='<tr>
              <td scope="row">'.$registro->curso.'</td>
              <td>'.number_format($registro->precio,2,".",",").' MXN</td>
              <td>'.$vigencia_curso.'</td>

              <td><a href="'.$registro->link_curso.'" target="_blank">'.$registro->link_curso.'</a></td>
              <td>'.$registro->password.'</td>
              <!--<td>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-primary">Solicitar factura</button>
                </div>
              </td>-->
            </tr>';
          }
          if(empty($html)){
            $html.='<tr class="table-danger text-center">
              <td colspan="5">Aún no has concluido el tramite de registro de algún curso</td>
            </tr>';
          }
          echo $html;
        }
      }else{
        echo "No has iniciado sesión";
      }
      break;
    case 'listar_notificaciones_pago':
      if(!empty($usuario_id)){
        $response = $Cursos_Usuarios->listar_notificaciones_pago();
        if($response){
          $html ='';
          //Se declara un array
          $data = Array();
          while ($registro = $response->fetch_object()){
            $nombre_completo = $registro->nombre_usuario.' '.$registro->apellido_paterno.' '.$registro->apellido_materno;
            $html.='<tr>
              <td scope="row">'.$nombre_completo.'</td>
              <td>'.$registro->curso.'</td>
              <td>'.number_format($registro->precio,2,".",",").' MXN</td>
              <td>'.$registro->referencia.'</td>
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#form_credenciales" onclick="mostrar_form(\''.$registro->cursos_usuarios_id.'\',\''.$registro->matricula.'\',\''.$registro->curso.'\', \''.$registro->precio.'\', \''.$nombre_completo.'\', \''.$registro->referencia.'\', \''.$registro->password.'\');">
                  Asignar credenciales
                </button>
              </td>
            </tr>';
          }
          if(empty($html)){
            $html.='<tr class="table-danger text-center"><td colspan="4">No hay solicitudes por el momento</td></tr>';
          }
          echo $html;
        }
      }else{
        echo "No has iniciado sesión";
      }
      break;
    case 'notificar_pago':
      $response = $Cursos_Usuarios->notificar_pago($cursos_usuarios_id);
      echo $response ? "Se ha notificado a los administradores que usted ya ha realizado su pago": "No se pudo notificar a los administradores";
      break;
    case 'notificar_credenciales':
      $response = $Cursos_Usuarios->notificar_credenciales($cursos_usuarios_id, $password, $link_curso, $vigencia_curso);
      echo $response ? "Se han registrado las credenciales de acceso.": "No se pudo registrar las credenciales de acceso";
      break;
    case 'detalles_pago':
      if($cursos_usuarios_id){
        $_SESSION['cursos_usuarios_id']=$cursos_usuarios_id;
        echo "<script>
          window.open('./comprobante-pago.php', '_blank');
        </script>";
      }else{
        echo "No ha iniciado sesión";
      }
      break;
}
?>
