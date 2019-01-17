<?php require '../inc/header.php';?>
<aside class="row justify-content-end text-center">
  <div class="col-12">
    <h1 class="text-center">Cursos en línea</h1>
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
<?php require '../inc/footer.php';?>
<script src="./scripts/index.js" charset="utf-8"></script>
