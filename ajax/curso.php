<?php
require_once '../modelos/Curso.php';
require_once '../config/global.php';
$curso = new Curso();
//Se establece la region para obtener la fecha y hora de la CdMx
ini_set('date.timezone', DATE_TIMEZONE);
setlocale(LC_TIME, IDIOMA);
/*Campo que se esperan obtener de los formularios*/

$curso_id = isset($_POST["curso_id"])? limpiarCadena($_POST["curso_id"]):"";

$nombre = isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$disponible = isset($_POST["disponible"])? limpiarCadena($_POST["disponible"]):"";
$descripcion = isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen = isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";
$precio = isset($_POST["precio"])? limpiarCadena($_POST["precio"]):"";
$tipo_curso = isset($_POST["tipo_curso"])? limpiarCadena($_POST["tipo_curso"]):"";
$precio_promocion = isset($_POST["precio_promocion"])? limpiarCadena($_POST["precio_promocion"]):"";
if($precio_promocion){
  $vigencia_promocion = isset($_POST["vigencia_promocion"])? limpiarCadena($_POST["vigencia_promocion"]):"";
  $fecha = getdate();
  $hoy = $fecha['year']."-".$fecha['mon']."-".$fecha['mday'];
  if(strtotime($vigencia_promocion)<strtotime($hoy)){
    $promocion_disponible = 0;
  }else{
    $promocion_disponible = 1;
  }
}else{
  $vigencia_promocion = 'NULL';
  $promocion_disponible = 'NULL';
}

switch ($_GET["op"]) {
  case 'guardaryeditar':
  if (!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name'])){
    $imagen=$_POST["imagenactual"];
  }
  else{
    $ext = explode(".", $_FILES["imagen"]["name"]);
    if ($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png"){
      $imagen = round(microtime(true)) . '.' . end($ext);
      move_uploaded_file($_FILES["imagen"]["tmp_name"], "../files/cursos/" . $imagen);
    }
  }
    if(empty($curso_id)){
      $response = $curso -> insertar($nombre, $disponible, $descripcion, $imagen, $precio, $tipo_curso, $precio_promocion, $vigencia_promocion, $promocion_disponible);
      echo $response ? "Se registro con éxito el curso $nombre": "No se pudo registrar el curso";
    }else{
      $response = $curso -> editar($curso_id , $nombre, $disponible, $descripcion, $imagen, $precio, $tipo_curso, $precio_promocion, $vigencia_promocion, $promocion_disponible);
      echo $response ? "Se actualizo con éxito el curso $nombre": "No se pudo actualizar el curso";
    }
    break;
  case 'desactivar':
    $response = $curso -> desactivar($curso_id);
    echo $response ? "Se desactivo con éxito el curso": "No se pudo desactivar el curso";
    break;
  case 'desactivar_promocion':
    $response = $curso -> desactivar_promocion($curso_id);
    echo $response ? "Se desactivo la promocion con éxito del curso": "No se pudo desactivar la promoción del curso";
    break;
  case 'activar':
    $response = $curso -> activar($curso_id);
    echo $response ? "Se activo con éxito el curso": "No se pudo activar el curso";
    break;
  case 'mostrar':
    $response = $curso -> mostrar($curso_id);
    //Codificar el resultado utilizando JSON
    echo json_encode($response);
    break;
  case 'listar_vista':
    $response = $curso -> listar_online_disponibles();
    $html='';
    while ($registro = $response->fetch_object()){
      if($registro->promocion_disponible){
        $precio = '<p><b>Precio de promoción:</b> '.number_format($registro->precio_promocion,2,".",",").'MXN vigente hasta el <b>'.strftime("%d de %B de %Y", strtotime($registro->vigencia_promocion)).'</b></p>';
      }else{
        $precio = '<p>Precio del curso '.number_format($registro->precio,2,".",",").'MXN.</p>';
      }
      $html.='
      <article class="col-sm-6 col-md-5 col-lg-3 m-md-2 my-2 card">
        <div class="card-body">
          <h5 class="card-title">'.$registro->nombre.'</h5>
          <h6 class="card-subtitle mb-2 text-muted">'.$registro->tipo_curso.'</h6>
          <p class="card-text">
            '.$precio.'
          </p>
          <button type="button" class="btn btn-primary" onclick="inscribir('.$registro->curso_id.')">Registrarme</button>
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#curso'.$registro->curso_id.'">Más información</button>
        </div>
      </article>
      <!-- Modal -->
      <div class="modal fade" id="curso'.$registro->curso_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">'.$registro->nombre.'</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body text-justify">
              <p class="h3 text-secondary">'.$registro->nombre.'</p>
              <p class="text-dark">'.preg_replace('/\r?\n|\r/','<br/>',$registro->descripcion).'</p>
              <p class="text-dark">'.$precio.'</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary" onclick="inscribir('.$registro->curso_id.')">Registrarme</button>
            </div>
          </div>
        </div>
      </div>
      ';
    }
    echo $html;
    break;
  case 'listar':
    $response = $curso -> listar();
    //Se declara un array
    $data = Array();
    while ($registro = $response->fetch_object()){
      if($registro->disponible==1){
        $btn_disponible = '<button class="btn btn-danger" onclick="desactivar('.$registro->curso_id.')">Desactivar</button>';
      }else{
        $btn_disponible = '<button class="btn btn-success" onclick="activar('.$registro->curso_id.')">Activar</button>';
      }
      if($registro->promocion_disponible==0 || empty($registro->promocion_disponible)){
        $btn_promocion_disponible = '<div class="alert alert-primary text-center" role="alert">Sin promoción</div>';
      }else{
        $btn_promocion_disponible = '<button class="btn btn-danger" onclick="desactivar_promocion('.$registro->curso_id.')">Desactivar promoción</button>';
      }
      if($registro->imagen){
        $etiqueta_imagen = "<img src='../files/cursos/".$registro->imagen."' height='50px' width='50px' >";
      }else{
        $etiqueta_imagen = "<p>Sin definir<p>";
      }
      if($registro->descripcion){
        $etiqueta_descripcion = '
        <div class="accordion" id="accordionExample">
          <div class="card">
            <div class="card-header" id="Curso'.$registro->curso_id.'">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse'.$registro->curso_id.'" aria-expanded="true" aria-controls="collapseOne">
                  Ver detalles
                </button>
              </h5>
            </div>
            <div id="collapse'.$registro->curso_id.'" class="collapse" aria-labelledby="Curso'.$registro->curso_id.'" data-parent="#accordionExample">
              <div class="card-body">
                '.preg_replace('/\r?\n|\r/','<br/>',$registro->descripcion).'
              </div>
            </div>
          </div>
        </div>';
        }else{
          $etiqueta_descripcion = '';
        }
      $data[]=array(
        "0" => $registro->curso_id,
        "1" => $registro->nombre,
        "2" => $etiqueta_imagen,
        "3" => $etiqueta_descripcion,
        "4" => "$ ".number_format($registro->precio,2,".",",")." MXN",
        "5" => $btn_disponible,
        "6" => $registro->tipo_curso,
        "7" => $registro->precio_promocion ? "$ ".number_format($registro->precio_promocion,2,".",",") ." MXN":" ",
        "8" => !empty($registro->vigencia_promocion) ?strftime("%d de %B de %Y", strtotime($registro->vigencia_promocion)):"",
        "9" => $btn_promocion_disponible,
        "10" => '<button class="btn btn-primary" onclick="mostrar('.$registro->curso_id.')">Editar</button>'
      );
    }
    $results = array(
      "sEcho" => 1, //Información ára el datatables
      "iTotalRecords" => count($data), //enviamos el total de registros al datatables
      "iTotalDisplayRecords" => count($data),//enviamos el total de registros a visualizar
      "aaData"=>$data);
    echo json_encode($results);
    break;
}
?>
