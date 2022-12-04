<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {
  $mensaje = "<script>alertify.set('notifier','position', 'top-right');alertify.success('No hay ningún usuario registrado');</script>";
}

$htmltrow = "<tr>
        <td>%s</td>
        <td>%s</td> 
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>  
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
       </tr>\n";
$htmltrows = "";

foreach ($arr as $a) {
$htmltrows .= sprintf($htmltrow, 
    $a['id_usuario'], $a['nombre'], $a['apellido'], $a['cui'], $a['telefono'], $a['direccion'], $a['usuario'], $a['estado'], $a['rol'], $a['id_usuario']);
}
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
    <br>
  <center>
    <img src="<?=$base_url?>/recursos/img/cruz.jpg" class="img-fluid" width="100">
  </center>
</div>
<br>
  <center>
  <h3 style="color: #03064A"><i class="fa fa-clipboard-list"></i> Listado de usuarios del sistema</h3></center>
</header>
<br>
<section>
  <div class="table-responsive-sm">
    <table class="table table-striped table-bordered">
    <thead> 
      <tr>
        <th class="text-center">Código</th>
        <th class="text-center">Nombres y Apellidos</th>
        <th class="text-center">DPI-CUI</th>
        <th class="text-center">Dirección</th>
        <th class="text-center">Teléfono</th>
        <th class="text-center oculalimprimir">Nombre de Usuario</th>
        <th class="text-center oculalimprimir">Estado</th>
        <th class="text-center oculalimprimir">Rol en el sistema</th>
        <th class="text-center oculalimprimir">Acción</th>
      </tr>
    </thead>
    <tbody>
       <?php
          foreach ($arr as $a){
         ?>

          <tr>
            <td class="text-center"><?php echo $a['id_usuario'] ;?></td>
            <td class="text-center"><?php echo $a['nombre'] ;?> <?php echo $a['apellido'] ;?></td>
            <td class="text-center"><?php echo $a['cui'] ;?></td>
            <td class="text-center"><?php echo $a['direccion'] ;?></td>
            <td class="text-center"><?php echo $a['telefono'] ;?></td>
            <td class="text-center oculalimprimir"><strong><?php echo $a['usuario'] ;?></td>
            <td class="text-center oculalimprimir"><?php echo $a['estado'] ;?></td>
            <td class="text-center oculalimprimir"><?php echo $a['rol'] ;?></td>
            <th class="text-center oculalimprimir"><a class='btn btn-danger btn-sm botones' onchange="return llenar("href='<?=$base_url?>/Usuario/baja/<?php echo $a['id_usuario']; ?>') id="id_usuario"><i class="fa fa-trash-alt"></i></a></th>
          </tr>
         <?php
            }
          ?>
    </tbody>
    </table>
    <div class="label label-danger label-md" onclick="$(this).hide(1000)"><?=$mensaje?></div>
  </div>
</section>
</div>
<footer class="oculalimprimir"><?php $this->load->view('footer') ?></footer>
</body>
</html>

