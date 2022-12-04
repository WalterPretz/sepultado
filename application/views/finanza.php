<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Finanza</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
  <script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
<div class="container-fluid">
<header>
  <div class="imprimir">
    <br>
    <center>
      <img src="<?=$base_url?>/recursos/img/cruz.jpg" class="img-fluid" width="100">
    </center>
    <br>
  </div>
  <center>
  <h4 style="color: #03064A">Ingresos HSS <?php echo date('Y'); ?></h4></center>
</header>
<!---------------------------------------------------------->
<br>
<div class="for-row">
  <h5 class="text-center">Ingresos por Cargadores</h5>
  <div class="table-responsive">
        <table class="table table-sm table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th scope="col">Descripción de la Ofrenda</th>
              <th scope="col">Ofrenda</th>
              <th scope="col">No. Cargadores</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="detalle"></tbody>
          <tbody id="totales"></tbody>
        </table>
    </div>
    <div class="table-responsive">
    <h5 class="text-center">Ingresos por Colaboradores</h5>
        <table class="table table-sm table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th scope="col">Descripción de la Ofrenda</th>
              <th scope="col">Ofrenda</th>
              <th scope="col">No. Colaboradores</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="detalleC"></tbody>
          <tbody id="totalesC"></tbody>
        </table>
    </div>
    <div class="table-responsive">
    <h5 class="text-center">Ingresos por Celadores</h5>
        <table class="table table-sm table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th scope="col">Descripción de la Ofrenda</th>
              <th scope="col">Ofrenda</th>
              <th scope="col">No. Celadores</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="detalleCel"></tbody>
          <tbody id="totalesCel"></tbody>
        </table>
    </div>
    <div class="table-responsive">
    <h5 class="text-center">Ingresos por Coordinadores</h5>
        <table class="table table-sm table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th scope="col">Descripción de la Ofrenda</th>
              <th scope="col">Ofrenda</th>
              <th scope="col">No. Coordinadores</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody id="detalleCoor"></tbody>
          <tbody id="totalesCoor"></tbody>
        </table>
    </div>
    <div class="table-responsive">
    <h5 class="text-center">Resumen General</h5>
        <table class="table table-sm table-bordered table-striped">
          <thead class="text-center">
            <tr>
              <th scope="col">Descripción de la Ofrenda</th>
              <th scope="col">Total Personas</th>
              <th scope="col">TOTAL Q.</th>
            </tr>
          </thead>
          <tbody id="Entrada"></tbody>
        </table>
    </div>
</div>
</div>
<br><br>
<div class="col-sm-3"><button class="btn btn-sm btn-primary botones oculalimprimir" id="imprimir" type="button">Imprimir</button></div>
<br><br>
<script type="text/javascript">
    $(document).ready(function () {
      $.ajax({
          url: '<?=$base_url?>/listados/ingresocargadores',
          type: "POST",
          async: true,
        }).done(function(response){
          if(response == 'error'){
            alertify.set('notifier','position', 'top-right');alertify.error('No hay datos en el Sistema.');
          } else {
            var informacion = JSON.parse(response);
            $('#detalle').html(informacion.detalle);
            $('#totales').html(informacion.totales);    
          } 
      })
    });

    $(document).ready(function () {
      $.ajax({
          url: '<?=$base_url?>/listados/ingresocolaboradores',
          type: "POST",
          async: true,
        }).done(function(response){
          if(response == 'error'){
            alertify.set('notifier','position', 'top-right');alertify.error('No hay datos en el Sistema.');
          } else {
            var informacion = JSON.parse(response);
            $('#detalleC').html(informacion.detalle);
            $('#totalesC').html(informacion.totales);    
          } 
      })
    });

    $(document).ready(function () {
      $.ajax({
          url: '<?=$base_url?>/listados/ingresoceladores',
          type: "POST",
          async: true,
        }).done(function(response){
          if(response == 'error'){
            alertify.set('notifier','position', 'top-right');alertify.error('No hay datos en el Sistema.');
          } else {
            var informacion = JSON.parse(response);
            $('#detalleCel').html(informacion.detalle);
            $('#totalesCel').html(informacion.totales);    
          } 
      })
    });

    $(document).ready(function () {
      $.ajax({
          url: '<?=$base_url?>/listados/ingresocoordinadores',
          type: "POST",
          async: true,
        }).done(function(response){
          if(response == 'error'){
            alertify.set('notifier','position', 'top-right');alertify.error('No hay datos en el Sistema.');
          } else {
            var informacion = JSON.parse(response);
            $('#detalleCoor').html(informacion.detalle);
            $('#totalesCoor').html(informacion.totales);    
          } 
      })
    });

    $(document).ready(function () {
      $.ajax({
          url: '<?=$base_url?>/listados/ingresoofrendass',
          type: "POST",
          async: true,
        }).done(function(response){
          if(response == 'error'){
            alertify.set('notifier','position', 'top-right');alertify.error('No hay datos en el Sistema.');
          } else {
            var informacion = JSON.parse(response);
            $('#Entrada').html(informacion.totales);    
          } 
      })
    });

     $('#imprimir').click(function(){
    window.print();
    return false;
  });
</script>
</body>
</html>