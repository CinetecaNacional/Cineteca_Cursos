<?php require '../inc/header.php';?>
<?php require '../inc/navbar.php';?>
<aside class="row justify-content-end text-center">
  <div class="col-12">
    <p class="text-center h1">Cursos en línea</p>
  </div>
  <section id="section_tipos_cambio" class="col-auto">
    <p class="font-weight-bold m-0">Tipos de cambio</p>
    <button type="button" class="btn btn-info">
    1 Euro  = <span id="Euro" class="badge badge-light"></span>
    </button>
    <button type="button" class="btn btn-info">
      1 = Dolar <span id="Dolar" class="badge badge-light"></span>
    </button>
    <p class="small">Fuente de consulta: <a href="https://fixer.io/" target="_blank">https://fixer.io/</a></p>
  </section>
</aside>
<section id="cursos_online" class="row no-gutters justify-content-center text-center">
</section>
<div id="resultado"></div>
<?php require '../inc/footer.php';?>
<script src="./scripts/index.js" charset="utf-8"></script>
<script src="./scripts/validarCurp.js" charset="utf-8"></script>
<script src="./scripts/validarPassword.js" charset="utf-8"></script>
