<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="es">
<head>
	<title>HSS</title>
	<?php $this->load->view('header'); ?>
</head>
<body>
	<header>
		<?php $this->load->view('menu'); ?>
	</header>
	<div>
		<img src="<?=$base_url?>/recursos/img/sepultado.jpg" class="img-fluid">
	</div>
	<div>
		<center>
			</div>
			<div style="background-color: #030010;">
			<br><br>
			<div>
				<center>
				<?php
					if (isset($this->session->USUARIO)) { ;?>
					<a class="btn btn-lg botones" style="display: none;" href="<?=$base_url?>/Usuario"><i class="fa fa-user"></i> INGRESAR</a>	
				<?php }else{ ; ?>
				<a class="btn btn-lg botones" style="background-color: #260064; color: #fff;" href="<?=$base_url?>/usuario"><i class="fa fa-user"></i> INGRESAR</a>
				<?php	}; ?></center>
			</div>
			<br><br>
			</div>
		</center>
	
	<div>
		<img src="<?=$base_url?>/recursos/img/DSC_0936.jpg" class="img-fluid">
	</div>
	<footer><?php $this->load->view('footer') ?></footer>
</body>
</html>