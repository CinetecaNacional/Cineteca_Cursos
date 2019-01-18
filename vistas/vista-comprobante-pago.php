<!doctype html>
<html>
<head>
  <meta charset=utf-8>
  <link rel="icon" href="../public/img/ic_cineteca_nacional.png">
  <title>Comprobante-pago</title>
  <style media="screen">
    p{
      font-size:19px;
      margin:6px 25px;
      text-align:justify;
    }
    div{
      border-radius: 10px;
      border: 2.5px solid black;
      margin: 10px 0px;
    }
    span{
      font-size:22px;
      color:#00046f;
    }
  </style>
</head>
<body>
  <img src="../public/img/CulturaCineteca.png" style="margin-left:60%; width:40%;">
  <?php
  require_once '../modelos/Cursos_Usuarios.php';
  setlocale(LC_TIME, IDIOMA);
  session_start();
  $Cursos_Usuarios = new Cursos_Usuarios();
  $response = $Cursos_Usuarios->mostrar($_SESSION['cursos_usuarios_id']);

  while ($registro = $response->fetch_object()){
    $nombre_completo = $registro->nombre_usuario.' '.$registro->apellido_paterno.' '.$registro->apellido_materno;
    $nombre_curso = $registro->curso;
    $precio = number_format($registro->precio,2,".",",");
    $fecha_limite_pago = strftime("%d de %B de %Y", strtotime ($registro->fecha_limite_pago));
    $nombre_banco = 'BANOBRAS, S.N.C. FIDEICOMISO PARA LA CINETECA NACIONAL';
    $referencia = $registro->referencia;
    $clabe_rap = '1937';
    $clabe_interbancaria = '021180550300019373';
  }

  echo '<p>Estimad@ <b>'.$nombre_completo.'</b>.</p>
  <p>Usted se ha pre-registrado con éxito al curso <b>'.$nombre_curso.'</b>.</p>
  <p>El monto a pagar es <b>'.$precio.' MXN</b> antes del <b>'.$fecha_limite_pago.'</b>.</p>
  <p>Puede usted realizar el pago directo en sucursal, en un cajero automático HSBC o un cajero depositador, a través de su Banca Personal por Internet (BPI), HSBCnet o bien pago interbancario (SPEI). Por favor conserve el comprobante de pago.</p>
  <hr>
  <p><span>Datos para pago en el banco HSBC</span></p>
  <div>
    <p>Nombre del cliente: <b>'.$nombre_banco.'</b></p>
    <p>Linea de captura <b>'.$referencia.'</b></p>
    <p>Clave RAP: <b>'.$clabe_rap.'</b></p>
  </div>
  <hr>
  <p><span>Datos para pago por transferencia interbancaria</span></p>
  <div>
    <p>Nombre del cliente: <b>'.$nombre_banco.'</b></p>
    <p>Clabe interbancaria: <b>'.$clabe_interbancaria.'</b></p>
    <p>Concepto del pago: <b>'.$referencia.'</b></p>
    <p>Clave RAP: <b>'.$clabe_rap.'</b></p>
  </div>
  <p>Nosotros le enviaremos un correo electrónico para concluir su registro y brindarle su contraseña de acceso a la plataforma y al curso elegido.</p>';
  ?>
  <img src="../public/img/footerPdf.png" style="margin:150px 0px; width:100%;">
</body>
</html>
