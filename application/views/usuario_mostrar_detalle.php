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
	$htmltrows .= sprintf($htmltrow, $a['nombre'],$a['direccion'], htmlspecialchars($a['usuario']),htmlspecialchars($a['nacimiento']), $a['cui'], $a['numero1'], $a['numero2'], $a['email'], $a['usuario'], htmlspecialchars($a['rol']), htmlspecialchars($a['cargo']));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Incersion reciente</title>
</head>
<body>
	<?php $this->load->view('menu'); ?>
	<script type="text/javascript">document.oncontextmenu = function(){return false;}</script>
<div class="container espacio">
	<br>
  	  <div class="imprimir">
    <br>
  <center>
    <img src="<?=$base_url?>/recursos/img/cruz.jpg" class="img-fluid" width="100">
  </center>
</div>
	<header>
		<br>
		<h3 class="text-center"><i class="fa fa-user-tie"></i> Datos detallados del Usuario Ingresado</h3>
	</header>
<br>
	<div class="table-responsive-sm">
 		<table class="table table-bordered responsive">
			<thead>
				<th>Nombre y apellidos</th>
				<th class="text-center">CUI</th>
				<th>Dirección</th>
			</thead>
			<tbody>
				<tr>
					<td><?php echo $a['nombre']; ?></td>
					<td class="text-center"><?php echo $a['cui']; ?></td>
					<td><?php echo $a['direccion']; ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="table-responsive-sm">
		<table class="table table-bordered responsive">
			<thead>
				<th class="text-center">No. de Teléfono 1</th>
				<th class="text-center">No. de Teléfono 2</th>
				<th class="text-center">Correo Electrónico</th>
				<th class="text-center">Usuario</th>
				<th class="text-center">Rol</th>
				<th>Cargo</th>
			</thead>
			<tbody>
				<tr>
					<td class="text-center"><?php echo $a['numero1']; ?></td>
					<td class="text-center"><?php echo $a['numero2']; ?></td>
					<td class="text-center"><?php echo $a['email']; ?></td>
					<td class="text-center"><?php echo $a['usuario']; ?></td>
					<td class="text-center"><?php echo $a['rol']; ?></td>
					<td><?php echo $a['cargo']; ?></td>
				</tr>
			</tbody>
		</table>
    <br>
	</div>
	<br>
	<div class="imprimir">
		<p class="h6">Totonicapán, Totonicapán, Guatemala <?php echo date('d/m/Y h:i:s a' ); ?></p>
	</div>
	<hr>
	
		<div class="row">
			<a class='btn btn-primary btn-sm oculalimprimir' href="<?=$base_url?>/usuario/listado"><i class="fa fa-sign-out-alt"></i> Salir</a>
			<a class='btn btn-success btn-sm oculalimprimir' style="margin-left: 5px;" data-toggle="modal" data-target="#editar"><i class="fa fa-sync-alt"></i> Editar</a>
			<a class='btn btn-info btn-sm oculalimprimir' style="margin-left: 5px;" onclick="window.print('')" href="#"><i class="fa fa-print" style="color: #fff;"></i> Imprimir</a>
		</div>

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
        <form class="needs-validation" id="registrar_usuario" name="registrar_usuario" method="POST">
								<input type="hidden" name="cod" value="<?php echo $a['id_usuario']; ?>">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-6-lg-6">
										<label for="validationCustom01"><strong><i class="fa fa-signature"></i> Nombres</strong></label>
										<input type="text" class="form-control" id="nombre" placeholder="Nombres" name="nombre" maxlength="50" minlength="3" size="50"  value="<?php echo $a['nombre1']; ?>" required>
									</div>
									<div class="col-sm-6 col-md-6 col-6-lg-6">
										<label for="validationCustom02"><strong><i class="fa fa-signature"></i> Apellidos</strong></label>
										<input type="text" class="form-control" id="apellido" placeholder="Apellidos" name="apellido" maxlength="50" minlength="3" size="50"  value="<?php echo $a['apellido']; ?>" required>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom03"><strong><i class="fa fa-address-card"></i> No. de CUI del DPI</strong></label>
										<input type="text" class="form-control form-control-user integer" id="cui" placeholder="CUI del DPI" name="cui" maxlength="13"  value="<?php echo $a['cui']; ?>" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom04"><strong><i class="fa fa-mobile-alt"></i> No. de Teléfono</strong></label>
										<input type="text" class="form-control form-control-user integer" id="telefono" placeholder="Teléfono" name="telefono" maxlength="8"  value="<?php echo $a['numero1']; ?>" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom04"><strong><i class="fa fa-mobile-alt"></i> No. de Teléfono 2</strong></label>
										<input type="text" class="form-control form-control-user integer" placeholder="Teléfono" name="telefono2" id="telefono2" maxlength="8" value="<?php echo $a['numero2']; ?>" > <div class="valid-feedback">Correcto!</div>
									</div>
								</div>
								<br>
								<div class="form-row">
									<div class="col-sm-8">
									<label for="validationCustom05"><strong><i class="fa fa-map-signs"></i> Dirección</strong></label>
									<input type="text" class="form-control form-control-user" id="direccion" placeholder="Dirección" name="direccion" required maxlength="70" minlength="7" size="50" required  id="validationCustom05" value="<?php echo $a['direccion']; ?>" >
								</div>
								<div class="col-sm-4">
									<label for="correo"><strong><i class="fa fa-envelope"></i> Correo Electrónico</strong></label>
									<input type="email" class="form-control form-control-user" placeholder="Correo Electrónico" name="email" maxlength="70" minlength="7" value="<?php echo $a['email']; ?>">
								</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom14"><strong><i class="fa fa-user-tie"></i> Cargo</strong></label>
										<input type="text" class="form-control form-control-user" placeholder="Cargo que empeña" name="cargo" id="cargo" minlength="5" required value="<?php echo $a['cargo']; ?>"> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom06"><strong><i class="fa fa-user-plus"></i> Usuario</strong></label>
										<input type="text" class="form-control form-control-user" placeholder="Usuario para el sistema" name="usuario" id="usuario" autocomplete="false" value="<?php echo $a['usuario']; ?>" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<br>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom07"><strong><i class="fa fa-user-tag"></i> Rol del usuario </strong></label>
										<select id="rol"class="custom-select" name="rol" required>
										<option value="" selected disabled><?php echo $a['rol']; ?></option>
										<option value="Colaborador">Colaborador</option>
										<option value="Director">Director</option>
										</select>
									</div>
								</div>
								<br>
								<center>
								    <td colspan="2">
								      <center>
								      	<button type="submit" class="btn btn-primary" id="guardar" name="guardar" ><i class="fa fa-sync-alt"></i> Actualizar Registro</button>
								      </center>
								    </td>
								 </center>
							</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
      </div>
    </div> 
  </div>
</div>
<script type="text/javascript">
	//save
  $('#registrar_usuario').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '<?=$base_url?>/usuario/updateUser',
        type: "POST",
        async: true,
        data: $('#registrar_usuario').serialize(),  
        success: function(response){
        	var inf = JSON.parse(response);
          if (response != 'error') {
            $('#nombre').val('');
            $('#apellido').val('');
            $('#cui').val('');
            $('#telefono').val('');
            $('#telefono2').val('');
            $('#direccion').val('');
            $('#email').val('');
            $('#cargo').val('');
            $('#usuario').val('');
            $('#rol').val('');
            $('#guardar').slideUp();

            Swal.fire({
           	title: 'Se a actualizado con éxito al usuario.',
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
</script>
</body>
</html>
