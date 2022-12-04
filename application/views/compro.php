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
<body>
    <div class="row">
      <div class="col-sm-4"></div>
      <div class="col-sm-7">
         <?php foreach ($arr as $a){ ?>
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
      <div class="col-md-8 forma">
        <h5 class="centra">Totonicapán, <?php echo $dia[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " de ".date('Y') ; ?>.</h5>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-2 forma">
        <h5 class="centra text-center">Q. <?php echo number_format($a['cantidad'],2) ;?></h5>
      </div>
    </div>
    <br>
    <div class="form-row forma">
      <div class="col-md-3 "><h5 class="centra">RECIBI DE:</h5></div>
      <div class="col-md-6 raya"><h5 class="centra"><?php echo $a['nombre'] ;?></h5></div>
      <div class="col-md-3 raya"><h5 class="centra"><center>SOCIO: <strong><?php echo $a['persona'] ;?></strong></center></h5></div>
    </div>
    <div class="form-row forma">
      <div class="col-md-3"><h5 class="centra">LA CANTIDAD DE:</h5></div>
      <div class="col-md-6 raya"><h5 class="centra"><?php echo $letra; ?></h5></div>
      <div class="col-md-3 raya"><h5 class="centra text-center"><?php echo $a['tipo'] ;?></h5></div>
    </div>
    <div class="form-row forma">
      <div class="col-md-3"><h5 class="centra">POR CONCEPTO DE:</h5></div>
      <div class="col-md-9 raya"><h5 class="centra"><?php echo $a['descripcion'] ;?></h5></div>
    </div>
     <?php }?>
    <br>
    <br>
  </div>
</div>
<br><br>

<center>
  <div class="form-row container-fluid">
    <div class="col-sm-3"><button class="btn btn-sm btn-primary botones oculalimprimir" id="imprimir" type="button">Imprimir</button></div>
    <div class="col-sm-3"><a href="<?=$base_url?>/celador" class="btn btn-sm btn-success botones oculalimprimir" > Inscribir a otro Celador | Colaborador <i class="fa fa-user"></i></a></div>
    <div class="col-sm-3"><a href="<?=$base_url?>/inicio" class="btn btn-sm btn-info botones oculalimprimir" > Salir <i class="fa fa-door-open"></i></a></div>
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

