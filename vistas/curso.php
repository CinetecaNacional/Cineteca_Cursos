<?php
require_once '../config/global.php';
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Cursos <button class="btn btn-success ml-5" id="btnagregar" onclick="mostrarform(true)"> AGREGAR</button></p>
</header>
<section class="row justify-content-center text-center">
  <article id="registros" class="col-12 mt-2 table-responsive"> <!--id = listadoregistros -->
    <table id="tbl_listado" class="table table-hover" data-page-length="-1"><!--id = tbllistado -->
      <thead>
        <tr>
          <th scope="col">Clave</th>
          <th scope="col">Nombre</th>
          <th scope="col">Imagen</th>
          <th scope="col">Descripción</th>
          <th scope="col">Precio</th>
          <th scope="col">Disponible</th>
          <th scope="col">Tipo de curso</th>
          <th scope="col">Precio de promoción</th>
          <th scope="col">Vigencia de promoción</th>
          <th scope="col">Promoción disponible</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </article>
  <article id="frm_registros" class="col-md-5 col-12 mt-2 text-left"> <!--id=formularioregistros-->
    <form name="formulario" id="formulario">
      <p class="h2 text-info text-center m-1"> Formulario de cursos</p>
      <div class="form-group">
        <label for="name">Nombre del curso:</label>
        <input type="hidden" name="curso_id" id="input_curso_id">
        <input type="text" name="nombre" class="form-control" id="input_name" placeholder="Ingrese un nombre para el curso" required autocomplete="off" maxlength="55">
      </div>
      <div class="form-group">
        <label>Imagen:</label>
        <input type="file" class="form-control" name="imagen" id="imagen">
        <input type="hidden" name="imagenactual" id="imagenactual">
        <img src="" width="150px" height="150px" id="imagenmuestra" alt="este curso no tiene imagen registrado">
      </div>
      <div class="form-group">
        <label for="description">Descripción del curso</label>
        <textarea name="descripcion" rows="6" cols="80" class="form-control" id="textarea_description" autocomplete="off"></textarea>
      </div>
      <div class="form-group">
        <label for="price">Precio:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">$</div>
          </div>
          <input type="number" name="precio" step=".01" min="0" class="form-control" id="input_price" placeholder="Ingrese un precio" required autocomplete="off" onblur="pesos(this);">
        </div>
      </div>
      <div class="form-group">
        <label for="avalaible">Curso disponible:</label>
        <select id="input_available" name="disponible" class="form-control" aria-describedby="avalaibleHelp" required>
          <option value="1">Si</option>
          <option value="0">No</option>
        </select>
        <small id="avalaibleHelp" class="form-text text-muted">El curso estará disponible al público actualmente</small>
      </div>
      <div class="form-group">
        <label for="kindCourse">Tipo de curso:</label>
        <select id="input_kindCourse" name="tipo_curso" class="form-control" required>
          <option value="Online">Online</option>
          <option value="Presencial">Presencial</option>
          <option value="Maestría">Maestría</option>
        </select>
      </div>
      <div class="form-group" id="form-group-offerPrice">
        <label for="offerPrice">Precio promoción:</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <div class="input-group-text">$</div>
          </div>
          <input type="number" name="precio_promocion" step=".01" min="0" class="form-control" id="input_offerPrice" placeholder="Ingrese un precio de promoción" autocomplete="off" onblur="pesos(this);">
        </div>
        <small id="avalaibleHelp" class="form-text text-muted">Ingrese un precio de promoción solo si este tiene una</small>
      </div>
      <div class="form-group" id="form-group-dateAvailable">
        <label for="dateAvailable">Promoción valida hasta:</label>
        <?php
        ini_set('date.timezone',DATE_TIMEZONE);
        $fecha = getdate();
        $mes = str_pad($fecha['mon'], 2, "0", STR_PAD_LEFT);
        $hoy = $fecha['year']."-".$mes."-".$fecha['mday'];
        echo '<input type="date" name="vigencia_promocion" id="input_dateAvailable" class="form-control" min="'.$hoy.'">';
        ?>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button">Cancelar</button>
    </form>
  </article>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/curso.js" charset="utf-8"></script>
