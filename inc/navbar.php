<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="./">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./curso.php">Cursos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./usuario.php">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="./descuento.php">Descuento</a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
      <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#formSesion">Iniciar sesión / Registro</button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="formSesion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="btn-group" role="group" aria-label="Basic example">
              <button type="button" class="btn btn-primary" id="btn_logIn">Iniciar sesión</button>
              <button type="button" class="btn btn-light" id="btn_singUp">Registro</button>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form class="form_logIn" id="frmAcceso" method="post">
              <div class="form-group">
                <label for="name">Matrícula<b class="text-danger">(*)</b>:</label>
                <input type="text" name="matricula" class="form-control" id="input_login_matricula" placeholder="Ingrese su matrícula" required autocomplete="off" maxlength="9">
              </div>
              <div class="form-group">
                <label for="name">Contraseña<b class="text-danger">(*)</b>:</label>
                <input type="password" name="password" class="form-control" id="input_login_password" placeholder="Ingrese su contraseña" required autocomplete="off">
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
            <form class="form_singUp" id="frmRegistro" name="frmRegistro" method="post">
            <p class="h3"> Datos generales</p>
            <!--<div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Apellido paterno<b class="text-danger">(*)</b>:</label>
                  <input type="text" name="apellido_paterno" class="form-control" id="input_apellido_paterno" placeholder="Ingrese su apellido paterno" required autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Apellido materno<b class="text-danger">(*)</b>:</label>
                  <input type="text" name="apellido_materno" class="form-control" id="input_apellido_materno" placeholder="Ingrese su apellido materno" required autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);" >
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="name">Nombre(s)<b class="text-danger">(*)</b>:</label>
              <input type="text" name="nombre" class="form-control" id="input_nombre" placeholder="Ingrese su(s) nombre(s)" required autocomplete="off" minlength="2" maxlength="50" required pattern="[A-Za-záéíóúÁÉÍÓÚ ]+" title="Ingrese solo letras" oninput="upperCase(this);" >
            </div>
            <div class="form-group">
              <label for="name">CURP<b class="text-danger">(*)</b>:</label>
              <input type="text" name="curp" class="form-control" id="input_curp" placeholder="Ingrese su CURP" required autocomplete="off" maxlength="18" oninput="validarInput(this);">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Sexo:</label>
                  <input type="text" name="sexo" class="form-control" id="input_sexo" required disabled>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Fecha de nacimiento:</label>
                  <input type="date" name="fecha_nacimiento" class="form-control" id="input_fecha_nacimiento" required disabled>
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
                  <input type="text" name="codigo_postal" pattern="[0-9]{5}" title="El código postal debe de tener 5 dígitos" class="form-control" id="input_codigo_postal" placeholder="Ingrese su código postal"autocomplete="off">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Municipio:</label>
                  <input type="text" name="municipio" class="form-control" id="input_municipio" autocomplete="off" disabled>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Estado:</label>
                  <input type="text" name="estado" class="form-control" id="input_estado" autocomplete="off" disabled>
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
              <input type="text" name="correo_electronico" class="form-control" id="input_correo_electronico" placeholder="Ingrese su correo electrónico" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" title="user@dominio.extension">
            </div>
            <div class="form-group">
              <label for="name">Teléfono:</label>
              <input type="tel" name="telefono" class="form-control" id="input_telefono" placeholder="Ingrese un número de contacto" autocomplete="off">
            </div>
            <div class="form-group">
              <input type="hidden" name="tipo_usuario" class="form-control" id="input_tipo_usuario" value="Online">
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Contraseña<b class="text-danger">(*)</b>:</label>
                  <input type="password" name="password" class="form-control" id="input_password" placeholder="Ingrese su contraseña" required autocomplete="off">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="name">Confirmar contraseña<b class="text-danger">(*)</b>:</label>
                  <input type="password" name="password_confirm" class="form-control" id="input_password_comfirm" placeholder="Ingrese su contraseña" required autocomplete="off">
                </div>
              </div>
            </div>-->
              <div class="alert alert-danger" role="alert" id="mensaje" hidden></div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="my-2 my-lg-0">
      <button type="button" class="btn btn-outline-primary" name="button">Cerrar sesión</button>
    </div>
  </div>
</nav>
