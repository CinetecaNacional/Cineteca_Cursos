<?php
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Descuentos <button class="btn btn-success ml-5" id="btnagregar" onclick="mostrarform(true)"> AGREGAR</button></p>
</header>
<section class="row justify-content-center text-center">
  <article id="registros" class="col-12 col-lg-8 mt-2 table-responsive"> <!--id = listadoregistros -->
    <table id="tbl_listado" class="table table-hover" data-page-length="-1"><!--id = tbllistado -->
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Porcentaje</th>
          <th scope="col">Disponible</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </article>
  <article id="frm_registros" class="col-md-5 col-12 mt-2 text-left"> <!--id=formularioregistros-->
    <form name="formulario" id="formulario">
      <p class="h2 text-info text-center m-1"> Formulario de descuentos</p>
      <div class="form-group">
        <label for="name">Nombre del descuento:</label>
        <input type="hidden" name="descuento_id" id="input_descuento_id">
        <input type="text" name="nombre" class="form-control" id="input_name" placeholder="Ingrese un nombre para la promoción" oninput="upperCase(this);" required autocomplete="off" maxlength="55">
      </div>
      <div class="form-group">
        <label for="porcentaje">Porcentaje de descuento</label>
        <div class="input-group">
          <input type="number" name="porcentaje" step=".01" min="0" max="100.00" onblur="pesos(this);" class="form-control" id="input_porcentaje" placeholder="Ingrese porcentaje de descuento" required autocomplete="off">
          <div class="input-group-prepend">
          <div class="input-group-text">%</div>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="avalaible">Descuento disponible:</label>
        <select id="input_available" name="disponible" class="form-control" aria-describedby="avalaibleHelp" required>
          <option value="1">Si</option>
          <option value="0">No</option>
        </select>
        <small id="avalaibleHelp" class="form-text text-muted">El descuento estará disponible actualmente</small>
      </div>
      <button type="submit" class="btn btn-primary">Guardar</button>
      <button class="btn btn-danger" onclick="cancelarform()" type="button">Cancelar</button>
    </form>
  </article>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/descuento.js" charset="utf-8"></script>
