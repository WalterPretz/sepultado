<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
date_default_timezone_set("America/Guatemala");
?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Cargador</title>
</head>
<br><br><br>
<body>
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-7">
    
  <div class="caja ">
    <div class="form-row">
         <?php foreach ($arr as $a){ ?>
    </div>
    <br><br>
    <?php
    //formato dia
    $dia = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");

    //Incluímos la clase pago
    $transformar =  str_replace(',00', '', number_format($a['cantidad'], 2, ',', ''));
    require_once("recursos/numLetras/CifrasEnLetras.php");
    $v =new CifrasEnLetras(); 
    //Convertimos el total en letras
    $letra = ($v->convertirEurosEnLetras($transformar));
    ?>
    <div class="form-row">
      <div class="col-md-8">
        <h6 class="centra">Totonicapán, <?php echo $dia[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ; ?>.</h6>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-2">
        <h6 class="centra text-center">Q. <?php echo number_format($a['cantidad'],2) ;?></h6>
      </div>
    </div>
    <br>
    <div class="form-row forma">
      <div class="col-md-3 "><h6 class="centra">RECIBI DE:</h6></div>
      <div class="col-md-6 raya"><h6 class="centra"><?php echo $a['nombre'] ;?></h6></div>
      <div class="col-md-3 raya"><h6 class="centra"><center>SOCIO: <strong><?php echo $a['persona'] ;?></strong></center></h6></div>
    </div>
    <div class="form-row forma">
      <div class="col-md-3"><h6 class="centra">LA CANTIDAD DE:</h6></div>
      <div class="col-md-6 raya"><h6 class="centra"><?php echo $letra; ?></h6></div>
      <div class="col-md-3 raya"><h6 class="centra text-center"><?php echo $a['tipo'] ;?></h6></div>
    </div>
    <div class="form-row forma">
      <div class="col-md-4"><h6 class="centra">POR CONCEPTO DE:</h6></div>
      <div class="col-md-8 raya"><h6 class="centra"><?php echo $a['descripcion'] ;?></h6></div>
    </div>
    <div class="form-row forma">
      <div class="col-md-4"><h6 class="centra">ALTURA:</h6></div>
      <div class="col-md-8 raya"><h6 class="centra"><?php echo $a['altura']; ?> mts.</h6></div>
    </div>
     <?php }?>
    <br>
    <br>
</div>
  </div>
</div>
<br><br>
<center>
  <div class="form-row container-fluid">
    <div class="col-sm-3"><button class="btn btn-sm btn-primary botones oculalimprimir" id="imprimir" type="button">Imprimir</button></div>
    <div class="col-sm-3"><a href="<?=$base_url?>/cargador" class="btn btn-sm btn-success botones oculalimprimir" > Inscribir a otro Cargador <i class="fa fa-user"></i></a></div>
    <div class="col-sm-3"><a href="<?=$base_url?>/inicio" class="btn btn-sm btn-info botones oculalimprimir" > Salir <i class="fa fa-door-open"></i></a></div>
    <div class="col-sm-3"><a href="<?=$base_url?>/cargador/listado" class="btn btn-sm btn-secondary botones oculalimprimir" > Listado <i class="fa fa-th-list"></i></a></div>
  </div>
</center>
<br><br><br>
<script type="text/javascript">
  $(document).ready(function(){
      window.print();
      return false;
    });

  $('#imprimir').click(function(){
    window.print();
    return false;
  });
</script>
</body>
</html>

