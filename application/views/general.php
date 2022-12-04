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

?><!DOCTYPE html>
<html lang="es">
<html>
<head>
	<?php $this->load->view('header'); ?>
	<title>Inscripcion</title>
</head>
<body>
	<header class="oculalimprimir">
		<?php $this->load->view('menu'); ?>
		<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
	</header>
	<div class="imprimir">
		<div class="row">
			<div class="col-3">
	    		<img src="<?=$base_url?>/recursos/img/HSS.png" class="img-fluid" width="70" align="right">
			</div>
			<div class="col-9">
				<h3 style="margin-top: 25px; text-align: left;">Datos Generales Hermanos <?php echo date('Y'); ?></h3>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="oculalimprimir"><br>
		<div class="row oculalimprimir">
			<div class="col-2 col-sm-2">
				<button type="button" class="btn btn-primary btn-sm botones" style="color: #fff" id="imprimir"><i class="fa fa-print"></i> Imrpimir</button>
			</div>
			
		</div><br>
		</div>
		<div>

		<table class="table table-sm table-hover" id="personas">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Nombre y Apellidos</th>
		      <th scope="col">CUI</th>
		      <th scope="col">F. Nacimiento</th>
		      <th scope="col">Edad</th>
		      <th scope="col">Teléfono</th>
		      <th scope="col">Teléfono 2</th>
		      <th scope="col">Altura</th>
		      <th scope="col">Dirección</th>
		      <th scope="col">Municipio</th>
		      <th scope="col">Departamento</th>
		      <th scope="col">Años Carga</th>
		      <th scope="col">Dosis</th>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php 
		    $secuencia = 0;
		  	foreach ($arr as $b){ 
	  		$secuencia = $secuencia + 1;
    			
    		?>	
		    <tr>
		      <th scope="row"><?php echo $secuencia ;?></th>
		      <td><?php echo $b['nombre']; ?></td>
		      <td><?php echo $b['cui']; ?></td>
		      <td><?php echo $b['fecha']; ?></td>
		      <td><?php echo $b['edad']; ?></td>
		      <td><?php echo $b['numero1']; ?></td>
		      <td><?php echo $b['numero2']; ?></td>
		      <td><?php echo $b['altura']; ?></td>
		      <td><?php echo $b['direccion']; ?></td>
		      <td><?php echo $b['muni']; ?></td>
		      <td><?php echo $b['depto']; ?></td>
		      <td><?php echo $b['años']; ?></td>
		      <td><?php echo $b['dosis']; ?></td>
		    </tr>	
		    <?php
			 		}
			 	?>
		  </tbody>
		</table>
		
		</div>
	</div>
	<br><br>
	<script type="text/javascript">
	  $('#imprimir').click(function(){
	    window.print();
	    return false;
	  });

	
	</script>
</body>
</html>