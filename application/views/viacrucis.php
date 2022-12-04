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
$grupode = 0;
foreach ($grupo as $c){
	$grupode = $c['numero'];
}
$laditos = $grupode/2;

?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Inscripcion</title>
</head>
<body>
	<header>
		<?php $this->load->view('menu'); ?>
		<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
	</header>
	<div class="imprimir">
		<div class="form-row">
			<div class="col-4">
	    		<img src="<?=$base_url?>/recursos/img/HSS.ico" class="img-fluid" width="70" align="right">
			</div>
			<div class="col-8">
				<h3 style="text-align: left;">Turnos HSS <?php echo date('Y'); ?></h3>
			</div>
		</div>
	</div>
	<div class="container-fluid">
		<div class="oculalimprimir"><br>
		<div class="form-row oculalimprimir">
			<div class="col-6 col-sm-3">
				<h5 class="text-center">Cantidad de Cargadores: <strong><?php echo $cantidadcargadores; ?></strong> </h5>
			</div>
			<div class="col-6 col-sm-2">
				<h6 class="text-center">Turnos de: <strong><?php echo $laditos; ?> Cargadores </strong> Total: <strong><?php echo $grupode; ?></strong></h6>
			</div>
			<div class="col-5 col-sm-3">
				<h4 class="text-center" style="margin-top: 5px;">Turnos HSS <?php echo date('Y'); ?></h4>
			</div>
			 <?php if ($this->session->ROL == 'Director') { ?>
			<div class="col-3 col-sm-2">
				<button type="button" class="btn btn-primary btn-sm" id="gruposde" data-toggle="modal" data-target="#gruposdedatos"><i class="fa fa-users"></i> Grupo</button>
			</div>
			<div class="col-3 col-sm-2">
			<input type="button" value="Imprimir" class="printbutton btn btn-primary btn-sm">
		</div>
			<?php  } ?>
		</div><br>
		</div>
		<div class="">
				<section>
					<table class="table table-striped table-bordered table-sm" id="cargadoresinscritso">
			  <thead>
			    <tr>
			      <th class="text-center">No.</th>
			      <th class="text-center">Cargador</th>
			      <th class="text-center">Altura</th>
			      <th class="text-center">Turno No.</th>
			      <th class="text-center">Lado</th>
			    </tr>
			  </thead>
			  <tbody>
			<?php 
				$cant = $grupode;
				$limite = $cant;
				$lim = $limite + 1;
				$turno = 1;
				$lado = $limite / 2;
				$ladoCarga = '';
		    $secuencia = 0;

	  	foreach ($arr as $b){ 
	  	$secuencia = $secuencia + 1;
      	if ($secuencia == $lim) {
      		$turno = $turno + 1;
      		$secuencia = 1;
      	}

      	if (($secuencia % 2) == 0) {
      		$ladoCarga = 'Izquierda';
      	} else {
      		$ladoCarga = 'Derecha';
      		?>            
      		<tr>
			   		<td class='text-center'><?php echo $secuencia ;?></td>
	            <td><?php echo $b['nombre']; ?></td>
	            <td class='text-center'><?php echo $b['vestimenta'];?></td>
	            <td class='text-center' style="font-weight: bold;"><?php echo $turno;?></td>
	            <td class='text-center'><?php echo $ladoCarga;?></td>
			   	</tr>
			   	 <?php
    		}
			} 
			?>
			  </tbody>
			</table>
				</section>
				<section class="saltoDePagina">
				<table class="table table-striped table-bordered table-sm" id="cargadoresinscritso">
			  <thead>
			    <tr>
			      <th class="text-center">No.</th>
			      <th class="text-center">Cargador</th>
			      <th class="text-center">Altura</th>
			      <th class="text-center">Turno No.</th>
			      <th class="text-center">Lado</th>
			    </tr>
			  </thead>
			  <tbody>
			<?php 
				$cant = $grupode;
				$limite = $cant;
				$lim = $limite + 1;
				$turno = 1;
				$lado = $limite / 2;
				$ladoCarga = '';
		    $secuencia = 0;

	  	foreach ($arr as $b){ 
	  	$secuencia = $secuencia + 1;
      	if ($secuencia == $lim) {
      		$turno = $turno + 1;
      		$secuencia = 1;
      	}

      	if (($secuencia % 2) == 0) {
      		$ladoCarga = 'Izquierda';
      		?>            
      		<tr>
			   		<td class='text-center'><?php echo $secuencia ;?></td>
	            <td><?php echo $b['nombre']; ?></td>
	            <td class='text-center'><?php echo $b['vestimenta'];?></td>
	            <td class='text-center' style="font-weight: bold;"><?php echo $turno;?></td>
	            <td class='text-center'><?php echo $ladoCarga;?></td>
			   	</tr>
			   	 <?php
      	} else {
      		$ladoCarga = 'Derecha';
    		}
			} 
			?>
			  </tbody>
			</table>
			</section>
		</div>
	<br><br>
	<!-- Modal -->
<div class="modal fade" id="gruposdedatos" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border: #005653; border-style: solid;">
      <div class="modal-header" style="background-color: #005653; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-users"></i> Editar la Cantidad de Cargadores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="caja">
        <center>
          <label for="nombre"><i class="fa fa-user-tie"></i> Cantidad de Cargadores por cada Turno</label>
          <input type="text" class="ford text-center" id="numero" style="color: #000; font-weight: bold;" readonly>
          <br>
          <label for="nombre"><i class="fa fa-user-tie"></i> Cantidad de Cargadores por Lado</label>
          <input type="text" class="ford text-center" id="ladoss" style="color: #000; font-weight: bold;" readonly>
          <br>
          <form name="cambiarnumero" id="cambiarnumero">
          	<center>
          		<label><i class="fa fa-users"></i> Cambiar la Cantidad de cargadores por cada turno</label>
          		<input type="text" class="ford positive text-center" id="nuevo" name="nuevo" style="color: #B90000; font-weight: bold;" maxlength="4" required>
          	</center>
        </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
        <button type="submit" id="chang" class="btn btn-primary" ><i class="fa fa-sync-alt"></i> Actualizar cantidad</button>
        </form>
      </div>
    </div> 
  </div>
</div>
	<script type="text/javascript">
	$(document).ready(function(){
		validarCualquierNumero();
	});

    $('#gruposde').click(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/cargador/trarnumero',
            type: "POST",
            async: true,
            success: function(response){
  			data = $.parseJSON(response);
	            if(data.length > 0){
	               $('#numero').val(data); 
	               $('#nuevo').val(data);
	               var cant = data / 2;
	               $('#ladoss').val(cant);
	               $('#chang').slideDown();
                   $('#caja').slideDown();
	            }
            }
        });
  	});

  	function validarCualquierNumero(){
	    $(".numeric").numeric();
	    $(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	    $(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	    $(".decimal-2-places").numeric({ decimalPlaces: 2 });
	    $("#remove").click(
	      function(e)
	      {
	        e.preventDefault();
	        $(".numeric,.positive,.decimal-2-places").removeNumeric();
	      }
	      );
	  };

	$('#cambiarnumero').submit(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/cargador/updatetrarnumero',
            type: "POST",
            async: true,
            data: $('#cambiarnumero').serialize(),
            success: function(response){
  			if (response == 'true') {
                $('#numero').val('');
                $('#nuevo').val('');
                $('#ladoss').val('');
                $('#chang').slideUp();
                $('#caja').slideUp();
               
                Swal.fire({
                title: 'Se a actualizado con éxito la cantidad de Cargadores.',
                icon: 'success',
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
                 }).then((result) => {
                  if (result.isConfirmed) {
                   location.reload();
                  } else {
                  location.reload();
                  }
                }); 
           	}
           }
        });
  	});

	document.querySelectorAll('.printbutton').forEach(function(element) {
    element.addEventListener('click', function() {
        print();
    });
});
	</script>
</body>
</html>