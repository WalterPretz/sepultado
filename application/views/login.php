<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";
?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Autenticación</title>
</head>
<body>
	<?php $this->load->view('menu'); ?>
	<header>
		<br>
		<center><h3 style="color: #3538A7"><img src="<?=$base_url?>/recursos/img/HSS.png" class="img-fluid" width="50"> Hermandad del Señor Sepultado</h3></center>
	</header>
	<br>
<section>
	<div class="contorno">
		<div>
			<div class="row">
				<form class="form-container needs-validation" novalidate action="<?=$base_url?>/usuario" method="POST">
					<div class="form-group">
						<label for="user1 validationUsername"><i class="fa fa-user"></i> Usuario</label>
						<input type="text" class="form-control" name="usuario" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
						<div class="invalid-feedback">Ingrese su usuario.</div>
					</div>
					<div class="form-group">
						<label for="Pasword"><i class="fa fa-key"></i> Contraseña</label>
						<input type="password" class="form-control" name="clave" autocomplete="false" required>
						<div class="invalid-feedback">Ingrese su contraseña.</div>
					</div>
					<td colspan="2">
						<center><input type="submit" id="btnAL_1" class="btn btn-primary btn-md botones" role="button" name="login" value="Ingresar"></center>
					</td>
					<center>
						<br>
						<img src="<?=$base_url?>/recursos/img/adorno.png" width="200">
					</center>
				</form>						
		</div>
		<div class="alert alert" role="alert" class="alert-link" style="color: #4B019F" onclick="$(this).hide(1000)"><h5><?=$mensaje?></h5>
	</div>
</div>
</section>
</body>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

	 
</script>
</html>
