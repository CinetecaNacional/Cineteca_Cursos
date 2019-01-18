<?php
require_once '../config/global.php';
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Usuarios <button class="btn btn-success ml-5" id="btnagregar" onclick="mostrarform(true)"> AGREGAR</button></p>
</header>
<section class="row justify-content-center text-center">
  <article id="registros" class="col-12 mt-2 table-responsive"> <!--id = listadoregistros -->
    <table id="tbl_listado" class="table table-hover" data-page-length="-1"><!--id = tbllistado -->
      <thead>
        <tr>
          <th scope="col">Matrícula</th>
          <th scope="col">Tipo de usuario</th>
          <th scope="col">Nombre</th>
          <th scope="col">CURP</th>
          <th scope="col">Sexo</th>
          <th scope="col">Fecha de nacimiento</th>
          <th scope="col">Ocupación</th>
          <th scope="col">Estudios</th>
          <th scope="col">Correo electrónico</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Dirección</th>
          <th scope="col"></th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </article>
  <article id="frm_registros" class="col-md-7 col-12 mt-2 text-left"> <!--id=formularioregistros-->
    <form name="formulario" id="formulario">
      <p class="h2 text-info text-center m-1"> Formulario de usuarios</p>
      <div class="form-group">
        <input type="text" name="usuario_id" class="form-control" id="input_usuario_id" autocomplete="off" hidden>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
          <label for="tipo_curso">Tipo de usuario<b class="text-danger">(*)</b>:</label>
          <select id="input_tipo_usuario" name="tipo_usuario" class="form-control" required>
            <option value="Presencial">Presencial</option>
            <option value="Online">Online</option>
            <option value="Maestria">Maestría</option>
            <option value="Administrador principal">Administrador principal</option>
            <option value="Administrador linea">Administrador en línea</option>
            <option value="Administrador presencial">Administrador en presencial</option>
            <option value="Administrador finanzas">Administrador finanzas</option>
          </select>
          </div>
        </div>
        <div class="col">
          <label for="name">Matrícula:</label>
          <input type="text" name="matricula" class="form-control" id="input_matricula" placeholder="Ingrese una matrícula" autocomplete="off" minlength="9" maxlength="9" aria-describedby="matriculaHelp">
          <small id="matriculaHelp" class="form-text text-info">Ingrese una matrícula solo si el usuario ya cuenta con una</small>
        </div>
      </div>
      <div class="row" id="passwords">
        <div class="col">
          <div class="form-group">
            <label for="name">Contraseña<b class="text-danger">(*)</b>:</label>
            <input type="password" name="password" class="form-control" id="input_password" placeholder="Ingrese su contraseña" autocomplete="off">
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="name">Confirmar contraseña<b class="text-danger">(*)</b>:</label>
            <input type="password" name="password_confirm" class="form-control" id="input_password_comfirm" placeholder="Ingrese su contraseña" autocomplete="off">
          </div>
        </div>
        </div>
      <p class="h3"> Datos generales</p>
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
  </article>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/validarCurp.js" charset="utf-8"></script>
<script src="./scripts/usuario.js" charset="utf-8"></script>
