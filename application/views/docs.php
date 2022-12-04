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
		<div class="video-responsive" style="margin: 20px;">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/SZ8w4fD2ep8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<div>
			<img src="<?=$base_url?>/recursos/img/portada.jpg" class=" img-fluid center">
		</div>
		<br>
		
		</center>
	</div>
	<br><br>
	<footer><?php $this->load->view('footer') ?></footer>
</body>
</html>