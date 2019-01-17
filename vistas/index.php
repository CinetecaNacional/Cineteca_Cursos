<?php require '../inc/header.php';?>
<?php require '../inc/navbar.php';?>
<aside class="row justify-content-end text-center">
  <div class="col-12">
    <p class="text-center h1">Cursos en línea</p>
  </div>
  <section id="section_tipos_cambio" class="col-auto" hidden>
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
<section class="row no-gutters justify-content-center text-center">
  <article class="col-sm-6 col-md-5 col-lg-3 m-md-2 my-2 card">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <h6 class="card-subtitle mb-2 text-muted">Tipo_curso</h6>
      <p class="card-text">
        Precio / (Precio_promocion vigente hasta al fecha_promocion)
      </p>
      <button type="button" class="btn btn-primary">Registrarme</button>
      <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">Más información</button>
    </div>
  </article>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary">Registrarme</button>
        </div>
      </div>
    </div>
  </div>
</section>
<?php require '../inc/footer.php';?>
<script src="./scripts/index.js" charset="utf-8"></script>
<script src="./scripts/validarCurp.js" charset="utf-8"></script>
<script src="./scripts/validarPassword.js" charset="utf-8"></script>
