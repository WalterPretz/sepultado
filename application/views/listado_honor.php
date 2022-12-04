<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {
  $mensaje = "<script>
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No hay ninguna persona registrado en el sistema!',
  }) 
  </script>";
}
$cantidadcargadores = 0;

foreach ($arr as $b){ 
    $cantidadcargadores = $cantidadcargadores + 1;
}
$cantcargadores = 0;
foreach ($arr1 as $c){ 
    $cantcargadores = $cantcargadores + 1;
}
$grupode = 0;
foreach ($grupo as $c){
  $grupode = $c['numero'];
}
$laditos = $grupode/2;

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Usuarios</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<div class="container-fluid">
<header>
  <div class="imprimir">
    <div class="form-row">
      <div class="col-4">
          <img src="<?=$base_url?>/recursos/img/HSS.ico" class="img-fluid" width="75" align="right">
      </div>
      <div class="col-8">
        <h3 style="margin-top: 25px; text-align: left;">Listado de Turnos de Honor <?php echo date('Y'); ?> (Salida)</h3>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="oculalimprimir"><br>
    <div class="form-row oculalimprimir">
      <div class="col-3 col-sm-2">
        <h5 class="text-center">Cantidad de Cargadores Salida: <strong><?php echo $cantidadcargadores; ?></strong> </h5>
      </div>
      <div class="col-3 col-sm-2">
        <h5 class="text-center">Cantidad de Cargadores Entrada: <strong><?php echo $cantcargadores; ?></strong> </h5>
      </div>
      <div class="col-6 col-sm-2">
        <h6 class="text-center">Turnos de: <strong><?php echo $laditos; ?> Cargadores </strong> Total: <strong><?php echo $grupode; ?></strong></h6>
      </div>
      <div class="col-9 col-sm-6">
        <h4 class="text-center" style="margin-top: 5px;">Turnos de Honor <?php echo date('Y'); ?> (Salida)</h4>
      </div>
    </div><br>
    </div>
<section>
  <div class="table-responsive">
    <table class="table-striped table-bordered" width="100%" cellspacing="0" id="cargadoress">
    <thead> 
      <tr>
        <th class="text-center">No.</th>
            <th class="text-center">Cargador</th>
            <th class="text-center">Turno</th>
            <th class="text-center">Lado</th>
      </tr>
    </thead>
    <tbody>
       <?php 
        $cant = $grupode;
        $limite = $cant;
        $lim = $limite + 1;
        $turno = 'Honor';
        $lado = $limite / 2;
        $ladoCarga = '';
        $secuencia = 0;

       foreach ($arr as $a){ 
        $secuencia = $secuencia + 1;
            if ($secuencia == $lim) {
              $secuencia = 1;
            }

            if ($secuencia <= $lado) {
              $ladoCarga = 'Derecha';
            } else {
              $ladoCarga = 'Izquierda';
            }
        ?>
          <tr>
            <td class='text-center'><?php echo $secuencia ;?></td>
            <td><?php echo $a['nombre'] ;?> <?php echo $a['apellido'] ;?></td>
            <td class='text-center'><?php echo $turno;?></td>
            <td class='text-center'><?php echo $ladoCarga;?></td>
          </tr>
         <?php } ?>
    </tbody>
    </table>
  </div>
</section>
<br><br>
<section class="saltoDePagina">
  <div class="imprimir">
    <div class="form-row">
      <div class="col-4">
          <img src="<?=$base_url?>/recursos/img/HSS.ico" class="img-fluid" width="75" align="right">
      </div>
      <div class="col-8">
        <h3 style="margin-top: 25px; text-align: left;">Listado de Turnos de Honor <?php echo date('Y'); ?> (Entrada)</h3>
      </div>
    </div>
  </div>
 <h4 class="text-center oculalimprimir" style="margin-top: 5px;">Turnos de Honor <?php echo date('Y'); ?> (Entrada)</h4>
 <div class="table-responsive">
    <table class="table-striped table-bordered" width="100%" cellspacing="0" id="cargadoress">
    <thead> 
      <tr>
        <th class="text-center">No.</th>
            <th class="text-center">Cargador</th>
            <th class="text-center">Turno</th>
            <th class="text-center">Lado</th>
      </tr>
    </thead>
    <tbody>
       <?php 
        $cant = $grupode;
        $limite = $cant;
        $lim = $limite + 1;
        $turno = 'Honor';
        $lado = $limite / 2;
        $ladoCarga = '';
        $secuencia = 0;

       foreach ($arr1 as $b){ 
        $secuencia = $secuencia + 1;
            if ($secuencia == $lim) {
              $secuencia = 1;
            }

            if ($secuencia <= $lado) {
              $ladoCarga = 'Derecha';
            } else {
              $ladoCarga = 'Izquierda';
            }
        ?>
          <tr>
            <td class='text-center'><?php echo $secuencia ;?></td>
            <td><?php echo $b['nombre'] ;?> <?php echo $b['apellido'] ;?></td>
            <td class='text-center'><?php echo $turno;?></td>
            <td class='text-center'><?php echo $ladoCarga;?></td>
          </tr>
         <?php } ?>
    </tbody>
    </table>
  </div>
  </section>
</div>
<br><br>
</body>
</html>