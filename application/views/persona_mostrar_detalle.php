<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
if (count($arr) < 1) {
	$mensaje = "No hay usuarios activos!";
}

$htmltrow = "<tr>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
				<td>%s</td>
			 	</tr>";
$htmltrows = "";
$id_usuario = '';
foreach ($arr as $a) {
	$id_usuario = $a['id_usuario'];
	$htmltrows .= sprintf($htmltrow, $a['nombre'], $a['apellido'], $a['direccion'], htmlspecialchars($a['usuario']),htmlspecialchars($a['nacimiento']), $a['cui'], $a['numero1'], $a['numero2'], $a['email'], $a['usuario'], htmlspecialchars($a['rol']), htmlspecialchars($a['cargo']));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Incersion reciente</title>
	<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
</head>
<body>
	<?php $this->load->view('menu'); ?>
<div class="container espacio">
	  <div class="imprimir">
    <br>
  <center>
    <img src="<?=$base_url?>/recursos/img/HSS.png" class="img-fluid" width="100">
  </center>
</div>
	<header>
		<br>
		<h3 class="text-center"><i class="fa fa-user-tie"></i> Datos detallados de la Persona</h3>
	</header>
<br>
	<div class="table-responsive-sm">
 		<table class="table table-bordered responsive">
			<thead>
				<th class="text-center">Nombre y apellidos</th>
				<th class="text-center">CUI</th>
				<th class="text-center">Dirección</th>
				<th class="text-center">Municipio</th>
				<th class="text-center">Departamento</th>
			</thead>
			<tbody>
				<tr>
					<td class="text-center"><?php echo $a['nombre']; ?></td>
					<td class="text-center"><?php echo $a['cui']; ?></td>
					<td class="text-center"><?php echo $a['direccion']; ?></td>
					<td class="text-center"><?php echo $a['municipio']; ?></td>
					<td class="text-center"><?php echo $a['departamento']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="table-responsive-sm">
		<table class="table table-bordered responsive">
			<thead>
				<th class="text-center">Teléfono 1</th>
				<th class="text-center">Teléfono 2</th>
				<th class="text-center">Género</th>
				<th class="text-center">Fecha Nacimiento</th>
				<th class="text-center">Edad</th>
				<th class="text-center">Cargo</th>
			</thead>
			<tbody>
				<tr>
					<td class="text-center"><?php echo $a['numero1']; ?></td>
					<td class="text-center"><?php echo $a['numero2']; ?></td>
					<td class="text-center"><?php echo $a['genero']; ?></td>
					<td class="text-center"><?php echo $a['fecha']; ?></td>
					<td class="text-center"><?php echo $a['edad']; ?></td>
					<td class="text-center"><?php echo $a['tipo']; ?></td>
				</tr>
			</tbody>
		</table>
    <br>
	</div>
	<hr>
	<div class="imprimir">
		<p class="h6">Totonicapán, Totonicapán, Guatemala <?php echo date('d/m/Y h:i:s a' ); ?></p>
	</div>
	<div class="row">
		<center><a class='btn btn-primary btn-sm oculalimprimir' href = "javascript:history.back()"><i class="fa fa-sign-out-alt"></i> Salir</a></center>
		<?php if ($a['tipo'] != '----') { ?>
			<a class='btn btn-success btn-sm oculalimprimir' style="margin-left: 5px;" data-toggle="modal" data-target="#editar"><i class="fa fa-sync-alt"></i> Editar</a> <?php  	} ?>
		<a class='btn btn-info btn-sm oculalimprimir' style="margin-left: 5px;" onclick="window.print('')" href="#"><i class="fa fa-print" style="color: #fff;"></i> Imprimir</a>
	</div>
	<center>
		
	</center>
	<br><br><br><br><br>
</div>
<footer class=" oculalimprimir"><?php $this->load->view('footer') ?></footer>
<!-- Modal -->
<div class="modal fade" id="editar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content" style="border: #34016E; border-style: solid;">
      <div class="modal-header" style="background-color: #34016E; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Editar Datos de la Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       	<form class="needs-validation" id="registro_celador"  name="registro_celador" enctype="multipart/form-data">
       		<input type="hidden" name="personas" value="<?php echo $a['id_colaborador']; ?>">
				<div class="form-row">
					<div class="col-sm-5">
						<label for="" class="morado1"><i class="fa fa-user-plus"></i> Nombres</label>
						<input type="text" class="form-control text-center negro" name="nombre" id="nombre" value="<?php echo $a['nombre1']; ?>" minlength="3" required>
					</div>
					<div class="col-sm-4">
						<label for="" class="morado1"><i class="fa fa-user-plus"></i> Apellidos</label>
						<input type="text" class="form-control text-center negro" name="apellido" id="apellido" minlength="3" value="<?php echo $a['apellido']; ?>" required>
					</div>
					<div class="col-sm-3">
						<label for="" class="morado1"><i class="fa fa-address-card"></i> No. de CUI del DPI</label>
						<input type="text" class="form-control positive text-center negro" name="cui" id="cui" maxlength="13" length="13" value="<?php echo $a['cui']; ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-3">
						<label for="" class="morado1"><i class="fa fa-calendar-day"></i> Fecha de Nacimiento</label>
						<input type="date" class="form-control text-center negro" id="nacimiento" name="nacimiento" value="<?php echo $a['fecha1']; ?>" required>
					</div>
					<div class="col-5 col-md-1">
						<label for="" class="morado1"><i class="fa fa-heartbeat"></i> Edad</label>
						<input type="text" class="form-control text-center negro" id="edad" name="edad" value="<?php echo $a['edad']; ?>" readonly required>
					</div>
					<div class="col-7 col-md-2">
						<label for="" class="morado1"><i class="fa fa-venus-mars"></i> Género: <strong><?php echo $a['genero']; ?></strong></label>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="genero" id="generom" value="Mujer"required>
						  <label class="form-check-label" for="exampleRadios1">
						   Femenino
						  </label>
						</div>
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="genero" id="generof" value="Hombre" required>
						  <label class="form-check-label" for="exampleRadios2">
						   Masculino
						  </label>
						</div>
					</div>
					<div class="col-6 col-md-3">
						<label for="" class="morado1"><i class="fa fa-phone"></i> Celular</label>
						<input type="text" class="form-control text-center positive negro" maxlength="9" minlength="8" id="numero" name="numero" value="<?php echo $a['numero1']; ?>" required>
					</div>
					<div class="col-6 col-md-3">
						<label for="" class="morado1"><i class="fa fa-mobile"></i> Celular 2</label>
						<input type="text" class="form-control text-center positive negro" maxlength="9" id="numero2" name="numero2" value="0" value="<?php echo $a['numero2']; ?>">
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-5">
						<label for="" class="morado1"><i class="fa fa-map-marker-alt"></i> Dirección</label>
						<input type="text" class="form-control text-center negro" name="direccion" id="direccion" required value="<?php echo $a['direccion']; ?>">
					</div>
					<div class="col-md-2">
						<label for="" class="morado1"><i class="fa fa-map-marked-alt"></i> Departamento</label>
						<select class="custom-select negro" id="departamento" required>
						</select>	 
					</div>
					<div class="col-md-3">
						<label for="" class="morado1"><i class="fa fa-map-marked"></i> Municipio</label>
						<select class="custom-select negro" name="muni" id="muni" required>
							<option value="" disabled selected>Seleccionar</option>
						</select>
					</div>
					<div class="col-md-2">
						<label for="" class="morado1"><i class="fa fa-user-tie"></i> Tipo</label>
						<select class="custom-select negro" name="tipo" id="tipo" required>
							<option value="" disabled selected><?php echo $a['tipo']; ?></option>
							<option value="Celador">Celador</option>
							<option value="Coordinador">Coordinador</option>
							<option value="Colaborador" >Colaborador</option>
						</select>	 
					</div>
				</div>
				<br>
				<center><button type="submit" class="btn btn-primary" id="guardar_datos" name="guardar_datos" ><i class="fa fa-sync-alt"></i> Actualizar Datos</button></center>
				</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
      </div>
    </div> 
  </div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    	validarCualquierNumero()
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

//funcion Ajax para buscar en base de datos
	$(function(){
		$.post('<?=$base_url?>/celador/departamento').done(function(respuesta){
		$('#departamento').html(respuesta);
	});

	//lista de municipios
	$('#departamento').change(function(){
		var id_depto = $(this).val();

		$.post('<?=$base_url?>/celador/municipio',{departamento: id_depto}).done(function(respuesta){
				$('#muni').html(respuesta);
			});
		});
	});
//regis cel
	$('#registro_celador').submit(function(e){
    e.preventDefault();

    $.ajax({
      	url: '<?=$base_url?>/celador/editarDatos',
        type: "post",
        async: true,
        data: $('#registro_celador').serialize(),  
        success: function(response){
        	var inf = JSON.parse(response);
          if (response != 'error') {

            $('#nombre').val('');
            $('#apellido').val('');
            $('#cui').val('');
            $('#nacimiento').val('');
            $('#edad').val('');
            $('#generom').val('');
            $('#generof').val('');
            $('#numero').val('');
            $('#numero2').val('');
            $('#direccion').val('');
            $('#departamento').val('');
            $('#muni').val('');
            $('#tipo').val('');
            $('#guardar_datos').slideUp();

            Swal.fire({
           	title: 'Se a actualizado con éxito al Colaborador/Celador.',
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
        	else {
        		Swal.fire({
						  icon: 'error',
						  title: 'Oops...',
						  text: 'Hubo un problema en el registro, vuelva nuevamente a registrar.!',
						})
						location.reload();
        	}
        }
    });
  });

	$('#nacimiento').change(function(e){
    e.preventDefault();
    	var naci = $("#nacimiento").val();
    	var fechasel = new Date(naci);
    	var factual = new Date();
    	var edad = ((parseInt(factual - fechasel) / (1000*60*60*24*365.25)));
    	var redad = parseFloat(Math.round(edad).toFixed(2));
    	$('#edad').val(redad);
    	if(redad > 100 || redad === NaN || redad < 0 || redad < 9){
    		$('#guardar_datos').slideUp();
    	}else{
    		$('#guardar_datos').slideDown();
    	}
	});

</script>
</body>
</html>
