<?php
require_once '../config/global.php';
require '../inc/header.php';
require '../inc/navbar.php';
?>
<header class="row justify-content-center text-center">
  <p class="text-center h1">Mis cursos</p>
</header>
<section class="row justify-content-center text-center">
  <article class="col-lg-8">
    <div class="alert alert-warning" role="alert">
    Cursos a los que estoy en proceso de inscripción
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Costo</th>
          <th scope="col">fecha límite de pago</th>
        </tr>
      </thead>
      <tbody id="cursos_en_proceso">
      </tbody>
    </table>
    <div class="alert alert-success" role="alert">
    Cursos a los que estoy inscrito
    </div>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Costo</th>
          <th scope="col">Vigencia del curso</th>
          <th scope="col">link del curso</th>
          <th scope="col">contraseña</th>
        </tr>
      </thead>
      <tbody id="cursos_inscritos">
      </tbody>
    </table>
    <div id="resultado"></div>
  </article>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/cursos_usuario.js" charset="utf-8"></script> 
