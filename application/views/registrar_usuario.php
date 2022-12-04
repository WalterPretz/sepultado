<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

foreach ($cod as $a) { $a['cod']; }
$cod = $a['cod'];

?><!DOCTYPE html>
<html lang="es">
<head>
	<?php $this->load->view('header'); ?>
	<title>Crear Usuario</title>
</head>
<body>
<header>
<?php $this->load->view('menu'); ?>
</header>
<br>
  	<h4 class="text-center"><i class="fa fa-user-plus"></i> Crear cuenta de usuario</h4>
</header><br>
<div>
<section>
	<div class="container">
		<div class="card o-hidden border-0 shadow-lg">
			<div class="row">
				<div class="col-lg-12">
					<div class="p-5">
						<div class="text-center">
							<form class="needs-validation" id="registrar_usuario" name="registrar_usuario" method="POST">
								<input type="hidden" name="cod" value="<?php echo $cod; ?>">
								<div class="row">
									<div class="col-sm-6 col-md-6 col-6-lg-6">
										<label for="validationCustom01"><strong><i class="fa fa-signature"></i> Nombres</strong></label>
										<input type="text" class="form-control" id="nombre" placeholder="Nombres" name="nombre" maxlength="50" minlength="3" size="50" required>
									</div>
									<div class="col-sm-6 col-md-6 col-6-lg-6">
										<label for="validationCustom02"><strong><i class="fa fa-signature"></i> Apellidos</strong></label>
										<input type="text" class="form-control" id="apellido" placeholder="Apellidos" name="apellido" maxlength="50" minlength="3" size="50" required>
									</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom03"><strong><i class="fa fa-address-card"></i> No. de CUI del DPI</strong></label>
										<input type="text" class="form-control form-control-user integer" id="cui" placeholder="CUI del DPI" name="cui" maxlength="13" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom04"><strong><i class="fa fa-mobile-alt"></i> No. de Teléfono</strong></label>
										<input type="text" class="form-control form-control-user integer" id="telefono" placeholder="Teléfono" name="telefono" maxlength="8" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom04"><strong><i class="fa fa-mobile-alt"></i> No. de Teléfono 2</strong></label>
										<input type="text" class="form-control form-control-user integer" placeholder="Teléfono" name="telefono2" id="telefono2" maxlength="8"> <div class="valid-feedback">Correcto!</div>
									</div>
								</div>
								<br>
								<div class="form-row">
									<div class="col-sm-8">
									<label for="validationCustom05"><strong><i class="fa fa-map-signs"></i> Dirección</strong></label>
									<input type="text" class="form-control form-control-user" id="direccion" placeholder="Dirección" name="direccion" required maxlength="70" minlength="7" size="50" required  id="validationCustom05">
								</div>
								<div class="col-sm-4">
									<label for="correo"><strong><i class="fa fa-envelope"></i> Correo Electrónico</strong></label>
									<input type="email" class="form-control form-control-user" placeholder="Correo Electrónico" name="email" maxlength="70" minlength="7">
								</div>
								</div>
								<br>
								<div class="row">
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom14"><strong><i class="fa fa-user-tie"></i> Cargo</strong></label>
										<input type="text" class="form-control form-control-user" placeholder="Cargo que empeña" name="cargo" id="cargo" minlength="5" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom06"><strong><i class="fa fa-user-plus"></i> Usuario</strong></label>
										<input type="text" class="form-control form-control-user" placeholder="Usuario para el sistema" name="usuario" id="usuario" autocomplete="false" required> <div class="valid-feedback">Correcto!</div>
									</div>
									<br>
									<div class="col-sm-4 col-md-4 col-lg-4">
										<label for="validationCustom07"><strong><i class="fa fa-user-tag"></i> Rol del usuario </strong></label>
										<select id="rol"class="custom-select" name="rol" required>
										<option value="" selected disabled>Seleccionar</option>
										<option value="Colaborador">Colaborador</option>
										<option value="Director">Director</option>
										</select>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 col-md-6 col-lg-6">
										<label for="validationCustom07"><strong><i class="fa fa-key"></i> Ingrese  contraseña</strong></label>
										<div class="input-group">
								    <input id="password_clave" type="Password" Class="form-control" name="clave" minlength="8" required>
								      <div class="input-group-append">
								        <button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button>
								      </div>
								    </div>
									</div>
									<div class="col-sm-6 col-md-6 col-lg-6">
										<label for="validationCustom07"><strong><i class="fa fa-key"></i> Escriba la contraseña</strong></label>
										<div class="input-group">
								    <input id="clave2" type="Password" Class="form-control" name="clave2" minlength="8" required>
								      <div class="input-group-append">
								        <button id="show_clave2" class="btn btn-primary" type="button" onclick="mostrarPassword2()"> <span class="fa fa-eye-slash icon1"></span> </button>
								      </div>
								    </div>
									</div>
								</div>
								<br>
								<center>
								    <td colspan="2">
								      <center>
								      	<button type="submit" class="btn btn-primary" id="guardar" name="guardar" ><i class="fa fa-save"></i> Guardar Registro</button>
								      </center>
								    </td>
								 </center>
								 <center><div id="mensaje"></div></center>
								<center><div><?php echo $mensaje; ?></div></center>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<footer><?php $this->load->view('footer') ?></footer>
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

  //view pass
  function mostrarPassword(){
		var cambio = document.getElementById("password_clave");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	};
	//view pass
  function mostrarPassword2(){
		var cambio = document.getElementById("clave2");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	};

	$('#clave2').keyup(function(e){
    e.preventDefault();

    var valor1 = $("#password_clave").val();
		var valor2 = $("#clave2").val();
		var botonEnviar = document.getElementById('guardar');

		if (valor1 != valor2) {
			$("#mensaje").text("Contraseñas no coinciden");
			$("#mensaje").addClass("alert alert-danger");
			botonEnviar.disabled = true;//desactiva el boton
		}else {
			botonEnviar.disabled = false;//activa el boton
			$("#mensaje").removeClass("alert alert-danger");
			$("#mensaje").text("");
		}
  });

 $('#password_clave').keyup(function(e){
    e.preventDefault();
    var $pas = $("#password_clave").val();
    var $pas2 = $("#clave2").val();

    if ($pas.length < 8){
    	$('#guardar').slideUp();
    	$("#mensaje").text("La contraseña debe tener al menos 8 caracteres. Recuerde incluir Mayúsculas, Minúsculas, Números y Caracteres especiales $  #  _  @");
    	$("#mensaje").addClass("alert alert-danger");
    } else {
    	$('#guardar').slideDown();
    	$("#mensaje").removeClass("alert alert-danger");
			$("#mensaje").text("");
    }

   }); 

//save
  $('#registrar_usuario').submit(function(e){
    e.preventDefault();

    $.ajax({
      url: '<?=$base_url?>/usuario/crear_user',
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
            $('#password_clave').val('');
            $('#clave2').val('');
            $('#guardar').slideUp();

            Swal.fire({
           	title: 'Se a registrado con éxito al nuevo usuario.',
					  icon: 'success',
					  confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',

					  }).then((result) => {
						  if (result.isConfirmed) {
						   	window.location.href='<?=$base_url?>/usuario/mostrar_insercion/'+inf+'';
						  } else {
						    window.location.href='<?=$base_url?>/usuario/mostrar_insercion/'+inf+'';
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
