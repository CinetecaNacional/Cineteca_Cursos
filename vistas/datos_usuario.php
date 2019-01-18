<?php
require_once '../config/global.php';
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Mis datos</p>
</header>
<section class="row justify-content-center text-justify" id="seccion_datos">
  <article class="col-lg-8">
    <div class="datos_usuario">
      <p><b>Nombre:</b> <span id="dato-nombre"></span></p>
      <p><b>CURP:</b> <span id="dato-CURP"></span> <b>Fecha nacimiento:</b> <span id="dato-fecha_nacimiento"></span> <b>Sexo:</b> <span id="dato-sexo"></span></p>
      <p><b>Ocupación:</b> <span id="dato-ocupacion"></span> </p>
      <p><b>Nivel de estudios:</b> <span id="dato-estudios"></span> </p>
      <p class="text-center h4 text-body"><b>Datos de contacto</b></p>
      <p><b>Correo electrónico:</b> <span id="dato-correo_electronico"></span> </p>
      <p><b>Télefono:</b> <span id="dato-telefono"></span> </p>
      <p><b class="h5 text-primary">Domicilio: </b><b>Estado</b> <span id="dato-estado"></span>, <b>Municipio</b> <span id="dato-municipio"></span>, <b>Colonia</b> <span id="dato-colonia"></span>, <b>C.P</b> <span id="dato-cp"></span>.</p>
    </div>
  </article>
  <!-- Force next columns to break to new line -->
  <div class="w-100"></div>

  <div class="col-auto">
  <?php
  if (isset($_SESSION['usuario_id'])){
    echo '<button type="button" class="btn btn-dark" onclick="formulario_datos('.$_SESSION['usuario_id'].')">Actualizar mis datos</button>
    <button type="button" class="btn btn-info" onclick="formulario_password('.$_SESSION['usuario_id'].')">Cambiar contraseña</button>';
  }
  ?>
  </div>
</section>
<section class="row justify-content-center text-justify">
  <form name="frmPassword" id="frmPassword" class="col-md-6">
    <p class="h3 text-center">Cambiar contraseña</p>
    <input type="hidden" name="usuario_id" class="form-control" id="input_usuario_id2" autocomplete="off" required>
    <div class="row" id="passwords">
      <div class="col">
        <div class="form-group">
          <label for="name">Nueva contraseña<b class="text-danger">(*)</b>:</label>
          <input type="password" name="password" class="form-control" id="input_password" placeholder="Ingrese su contraseña" autocomplete="off" required>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Confirmar contraseña<b class="text-danger">(*)</b>:</label>
          <input type="password" name="password_confirm" class="form-control" id="input_password_comfirm" placeholder="Ingrese su contraseña" autocomplete="off" required>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button class="btn btn-danger" onclick="cancelarform()" type="button">Cancelar</button>
  </form>
</section>
<section class="row justify-content-center text-justify">
  <form name="frmDatos" id="frmDatos" class="col-md-6">
    <p class="h3 text-center">Actualizar datos</p>
    <p class="h3"> Datos generales</p>
    <div class="form-group">
    <input type="hidden" name="matricula" class="form-control" id="input_matricula" autocomplete="off" minlength="9" maxlength="9" required>
    <input type="hidden" name="usuario_id" class="form-control" id="input_usuario_id" autocomplete="off" required>
    <input type="hidden" name="password" class="form-control" id="input_password2" autocomplete="off" required>
    <input type="hidden" name="tipo_usuario" class="form-control" id="input_tipo_usuario" required>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="name">Apellido paterno<b class="text-danger">(*)</b>:</label>
          <input type="text" name="apellido_paterno" class="form-control" id="input_apellido_paterno" placeholder="Ingrese su apellido paterno" autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Apellido materno<b class="text-danger">(*)</b>:</label>
          <input type="text" name="apellido_materno" class="form-control" id="input_apellido_materno" placeholder="Ingrese su apellido materno" autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);" >
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="name">Nombre(s)<b class="text-danger">(*)</b>:</label>
      <input type="text" name="nombre" class="form-control" id="input_nombre" placeholder="Ingrese su(s) nombre(s)" autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);" >
    </div>
    <div class="form-group">
      <label for="name">CURP<b class="text-danger">(*)</b>:</label>
      <input type="text" name="curp" class="form-control" id="input_curp" placeholder="Ingrese su CURP" required autocomplete="off" maxlength="18" oninput="validarInput(this);">
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="name">Sexo:</label>
          <input type="text" name="sexo" class="form-control" id="input_sexo" required>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Fecha de nacimiento:</label>
          <input type="date" name="fecha_nacimiento" class="form-control" id="input_fecha_nacimiento" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="avalaible">Ocupación<b class="text-danger">(*)</b>:</label>
          <select id="input_ocupacion" name="ocupacion" class="form-control" required>
            <option value="Estudiante">Estudiante</option>
            <option value="Empleado institución pública">Empleado institución pública</option>
            <option value="Empleado institución de gobierno">Empleado institución de gobierno</option>
            <option value="Ama de casa">Ama de casa</option>
            <option value="Pensionado">Pensionado</option>
            <option value="Sin empleo">Sin empleo</option>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="avalaible">Nivel de estudios<b class="text-danger">(*)</b>:</label>
          <select id="input_estudios" name="estudios" class="form-control" required>
            <option value="Educación básica">Educación básica</option>
            <option value="Bachillerato sin carrera técnica">Bachillerato sin carrera técnica</option>
            <option value="Bachillerato con carrera técnica">Bachillerato con carrera técnica</option>
            <option value="Licenciatura">Licenciatura</option>
            <option value="Maestría">Maestría</option>
            <option value="Doctorado">Doctorado</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="form-group">
          <label for="name">Código postal:</label>
          <input type="text" name="codigo_postal" pattern="[0-9]{5}" title="El código postal debe de tener 5 dígitos" class="form-control" id="input_codigo_postal" placeholder="Código postal"autocomplete="off">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Municipio:</label>
          <input type="text" name="municipio" class="form-control" id="input_municipio" autocomplete="off">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Estado:</label>
          <input type="text" name="estado" class="form-control" id="input_estado" autocomplete="off">
        </div>
      </div>
      <div class="col">
        <div class="form-group">
          <label for="name">Colonia:</label>
          <select id="input_colonia" name="colonia" class="form-control">
          </select>
        </div>
      </div>
    </div>
    <small id="msg" class="text-danger"></small>
    <p class="h3"> Datos de contacto</p>
    <div class="form-group">
      <label for="name">Correo electrónico<b class="text-danger">(*)</b>:</label>
      <input type="text" name="email" class="form-control" id="input_email" placeholder="Ingrese su correo electrónico" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="user@dominio.extension">
    </div>
    <div class="form-group">
      <label for="name">Teléfono:</label>
      <input type="tel" name="telefono" class="form-control" id="input_telefono" placeholder="Ingrese un número de contacto" autocomplete="off">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <button class="btn btn-danger" onclick="cancelarform()" type="button">Cancelar</button>
  </form>
</section>
<div id="resultado"></div>
<?php require '../inc/footer.php';?>
<script src="./scripts/datos_usuario.js" charset="utf-8"></script>
<script src="./scripts/validarPassword.js" charset="utf-8"></script>
<script src="./scripts/validarCurp.js" charset="utf-8"></script>
<?php
if (isset($_SESSION['usuario_id'])){
  echo "<script>mostrar($_SESSION[usuario_id])</script>";
}
?>
