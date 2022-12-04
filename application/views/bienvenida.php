<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<title>Vía Crucis</title>
	<?php $this->load->view('header'); ?>
</head>
<body>
	<header>
		<?php $this->load->view('menu'); ?>
	</header>
	<div class="container">
		<br>
		<center>
			<img src="<?=$base_url?>/recursos/img/HSS.png" class="img-fluid" width="250">
			<br><br>
			<div>
				<h3>Bienvenido al Sistema de Registro</h3>
			</div>
			<br>
		<div>
			<h2><?php echo $this->session->NOMBRE ?> <?php echo $this->session->APELLIDO ?></h2>
		</div>
		</center>
	</div>
	<br><br>
	<footer><?php $this->load->view('footer') ?></footer>
</body>
</html>