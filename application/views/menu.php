<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style media="screen">

  <?php
  if (isset($this->session->USUARIO)) { // Sesión iniciada
    $log = "<a class=\"nav-item nav-link active\" style=\"color: white;\" href=\"${base_url}/usuario/logout\">SALIR</a>";
  }?>
</style>
<nav class="navbar navbar-expand-lg sticky-top navbar-dark" style="background: linear-gradient(70deg, #34005A, #040009);">
  <div class="container">
    <a class="navbar-brand" href="<?=$base_url?>"><img src="<?=$base_url?>/recursos/img/HSS.ico" class="img-fluid" width="30"> Inicio</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div>
    <ul class="navbar-nav">
      <li class="nav-brand active">
        <a class="nav-link" href="<?=$base_url?>/inicio/docs">Docs</a>
      </li>
    </ul>
  </div>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav justify-content-center">
      <?php if ($this->session->ROL == 'Director') { ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?=$base_url?>/cargador"> INSCRIPCIÓN</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> COMISIÓN</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=$base_url?>/celador">Inscribir</a>
          <a class="dropdown-item" href="<?=$base_url?>/celador/comisiones">Listado de Comisiones</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Listados</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=$base_url?>/cargador/inscripcionviacrucis">Listado de Inscripción</a>
          <a class="dropdown-item" href="<?=$base_url?>/celador/inscripcionhonor">Listado de Inscripción Honor</a>
          <a class="dropdown-item" href="<?=$base_url?>/cargador/listado">Listado de Cargadores</a>
          <a class="dropdown-item" href="<?=$base_url?>/celador/listado">Listado de Celadores</a>
          <a class="dropdown-item" href="<?=$base_url?>/celador/listadoColaborador">Listado de Colaboradores</a>
          <a class="dropdown-item" href="<?=$base_url?>/celador/coordinador">Listado de Coordinadores</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Usuarios</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=$base_url?>/usuario/crear">Crear Usuario</a>
          <a class="dropdown-item" href="<?=$base_url?>/usuario/listado">Listado de Usuarios</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Finanza</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=$base_url?>/listados/ingreso">Ingreso</a>
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="<?=$base_url?>/listados/generalgeneral"> Listado G Hermanos</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Venta</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?=$base_url?>/usuario/crear">Nueva Venta</a>
          <a class="dropdown-item" href="<?=$base_url?>/usuario/listado">Listado de Ventas</a>
          <a class="dropdown-item" href="<?=$base_url?>/usuario/crear">LIngresar Productos</a>
          <a class="dropdown-item" href="<?=$base_url?>/usuario/listado">Listado de Productos</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav end">
      <li class="nav-item active">
        <a class="navbar-brand" href="<?=$base_url?>/usuario/logout">SALIR</a>
      </li>
    </ul>
    <?php } ?>
    <!--rol CELADOR-->
    <?php if ($this->session->ROL == 'Colaborador') { ?>
          <ul class="navbar-nav justify-content-center">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Cargadores</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="<?=$base_url?>/cargador">Crear Cargador</a>
              <a class="dropdown-item" href="<?=$base_url?>/cargador/inscripcionviacrucis">Listado de Inscripción</a>
              <a class="dropdown-item" href="<?=$base_url?>/cargador/listado">Listado de Cargadores</a>
            </div>
          </li>
        </ul>
        <ul class="navbar-nav end">  
        <li class="nav-item active">
          <a class="navbar-brand" href="<?=$base_url?>/usuario/logout">SALIR</a>
        </li>
      </ul><?php } ?>
    </div>
  </div>
  
</nav>
<script>
window.onload = function links(){
  setTimeout('funcioProgramada()',hora());
  setTimeout('funcionProgramada()',hora1());
}

function hora(){
  horaActual = new Date();
  horaProgra = new Date();
  horaProgra.setHours(5);
  horaProgra.setMinutes(0);
  horaProgra.setSeconds(0);
  return horaProgra.getTime() - horaActual.getTime();
}

function funcioProgramada(){
  $('#navs1').removeClass('disabled');
  $('#navs2').removeClass('disabled');
  $('#navs3').removeClass('disabled');
  $('#navs4').removeClass('disabled');
  $('#navs5').removeClass('disabled');
}


function hora1(){
  horaActual1 = new Date();
  horaProgram = new Date();
  horaProgram.setHours(23);
  horaProgram.setMinutes(0);
  horaProgram.setSeconds(0);
  return horaProgram.getTime() - horaActual1.getTime();
}

function funcionProgramada(){
  $('#navs1').addClass('disabled');
  $('#navs2').addClass('disabled');
  $('#navs3').addClass('disabled');
  $('#navs4').addClass('disabled');
  $('#navs5').addClass('disabled');
}
</script>
