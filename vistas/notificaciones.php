<?php
require_once '../config/global.php';
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Notificaciones</p>
</header>
<section class="row justify-content-center text-center">
<div class="col-md-10">
<div class="alert alert-warning" role="alert">
Personas que han notificado realizar el pago
</div>
  <table class="table table-striped table-responsive">
    <thead>
      <tr>
        <th scope="col">Nombre</th>
        <th scope="col">Curso</th>
        <th scope="col">Monto</th>
        <th scope="col">N° referencia</th>
      </tr>
    </thead>
    <tbody id="notificaciones_pago">
    </tbody>
  </table>
<!--<div class="alert alert-success" role="alert">
Personas que han solicitado factura
</div>
<table class="table table-striped table-responsive">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Razon social</th>
      <th scope="col">Correo electronico</th>
      <th scope="col">RFC</th>
      <th scope="col">Dirección</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Carlos</td>
      <td>Persona física</td>
      <td>josecarlos19979@hotmail.com </td>
      <td>HECC970929CL0</td>
      <td>Av. Morelos 577 </td>
      <td>
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" class="btn btn-primary">Notificar envio a email</button>
        </div>
      </td>
    </tr>
  </tbody>
</table>-->
</div>
<div class="col-md-6">
  <!-- Modal -->
  <div class="modal fade" id="form_credenciales" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Asignar credenciales de acceso</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form name="formulario" id="formulario" method="POST">
            <div class="form-group">
              <input type="text" name="cursos_usuarios_id" class="form-control" id="input_cursos_usuarios_id" required hidden>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Curso:</label>
                  <input type="text" name="curso" class="form-control" id="input_curso" required autocomplete="off" required disabled>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Precio:</label>
                  <input type="text" name="precio" class="form-control" id="input_precio" required autocomplete="off"  required disabled>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Nombre:</label>
              <input type="text" name="nombre" class="form-control" id="input_nombre" required disabled>
            </div>
            <div class="form-group">
              <label for="name">N° Referencia:</label>
              <input type="text" name="referencia" class="form-control" id="input_referencia" required disabled>
            </div>
            <div class="form-group">
              <label for="name">Link curso:</label>
              <input type="text" name="link" class="form-control" id="input_link_curso" value="https://cursosenlinea.cinetecanacional.net" required>
            </div>
            <div class="form-group">
              <label for="name">Matricula:</label>
              <input type="text" name="boleta" class="form-control" id="input_matricula" required disabled>
            </div>
            <div class="form-group">
              <label for="name">Contraseña:</label>
              <input type="text" name="referencia" class="form-control" id="input_password" required disabled>
            </div>
            <div class="form-group">
              <label for="name">Vigencia del curso:</label>
              <?php
              $hoy = date('Y-m-j'); //formato de fecha
              $fecha = strtotime ( '+9 week' , strtotime ( $hoy ) ) ;
              $despues = date("Y", $fecha).'-'.str_pad(date("m", $fecha), 2, "0", STR_PAD_LEFT).'-'.str_pad(date("j", $fecha), 2, "0", STR_PAD_LEFT);
              echo '<input type="date" id="input_vigencia_curso" name="vigencia_curso" value="'.$despues.'" min="2019-1-13">';
              ?>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="button" id="btnGuardar" onclick="notificar_credenciales();">Guardar datos</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/notificaciones.js" charset="utf-8"></script>
