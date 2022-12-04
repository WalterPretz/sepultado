<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$mensaje = isset($mensaje) ? $mensaje : "";

if (count($arr) < 1) {
  $mensaje = "<script>
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'No hay ningun usuario registrado en el sistema!',
  }) 
  </script>";
}

?><!DOCTYPE html>
<html lang="es">
<head>
  <?php $this->load->view('header'); ?>
  <title>Usuarios</title>
</head>
<body>
  <?php $this->load->view('menu'); ?>
<div class="container-fluid">
<header>
  <div class="imprimir">
    <br>
  <center>
    <img src="<?=$base_url?>/recursos/img/HSS.ico" class="img-fluid" width="100">
  </center>
</div>
<br>
  <center>
  <h3 style="color: #03064A"><i class="fa fa-clipboard-list"></i> Listado de usuarios del sistema</h3></center>
</header>
<br>
<section >
  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead> 
        <tr>
          <th class="text-center">Cód</th>
          <th class="text-center">Nombres y Apellidos</th>
          <th class="text-center">DPI-CUI</th>
          <th class="text-center">Dirección</th>
          <th class="text-center">Teléfono</th>
          <th class="text-center oculalimprimir">Nombre de Usuario</th>
          <th class="text-center oculalimprimir">Rol en el sistema</th>
          <th class="text-center oculalimprimir">Email</th>
          <th class="text-center oculalimprimir">Detalle</th>
          <th class="text-center oculalimprimir">Resetear</th>
          <th class="text-center oculalimprimir">Acción</th>
        </tr>
      </thead>
      <tbody>
         <?php foreach ($arr as $a){ ?>
            <tr>
              <td class="text-center"><?php echo $a['id_usuario'] ;?></td>
              <td class="text-center"><?php echo $a['nombre'] ;?> <?php echo $a['apellido'] ;?></td>
              <td class="text-center"><?php echo $a['cui'] ;?></td>
              <td class="text-center"><?php echo $a['direccion'] ;?></td>
              <td class="text-center"><?php echo $a['numero1'] ;?></td>
              <td class="text-center oculalimprimir"><strong><?php echo $a['usuario'] ;?></td>
              <td class="text-center oculalimprimir"><?php echo $a['rol'] ;?></td>
              <td class="text-center oculalimprimir"><?php echo $a['email'] ;?></td>
              <td class="text-center oculalimprimir"><a class='btn btn-success btn-sm botones' onchange="return llenar("href='<?=$base_url?>/usuario/mostrar_insercion/<?php echo $a['cui']; ?>')><i class="fa fa-info-circle"></i></a></td>
              <td class="text-center oculalimprimir"><a class='btn btn-warning btn-sm botones' style="color: #fff;" data-toggle="modal" data-target="#cambiar" 
              onclick="obdatosId('<?php echo $a['id_usuario'] ;?>')"><i class="fa fa-key"></i></a></td>
              <td class="text-center oculalimprimir"><a class='btn btn-danger btn-sm botones' style="color: #fff;" data-toggle="modal" data-target="#eliminar" 
              onclick="obdatosIdUs('<?php echo $a['id_usuario'] ;?>')"><i class="fa fa-trash-alt"></i></a></td>
            </tr>
           <?php } ?>
      </tbody>
    </table>
  </div>
</section>
<br>
</div>
<!-- Modal -->
<div class="modal fade" id="cambiar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border: #40016E; border-style: solid;">
      <div class="modal-header" style="background-color: #40016E; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Renovación de Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <label for="nombre"><i class="fa fa-user-tie"></i> Usuario</label>
          <h4 value="" id="nombre"></h4>
          <br>
          <form name="updatepass" id="updatepass" method="POST">
            <input type="hidden" id="id" value="">
            <div class="form-row">
              <div class="col-md-6">
                <label for="pass"><i class="fa fa-key"></i> Contraseña</label>
                <input type="password" class="form-control text-center" name="pass" id="pass" autocomplete="false" required minlength="8">
              </div>
              <div class="col-md-6">
                <label for="pass2"><i class="fa fa-key"></i> Repita la Contraseña</label>
                <input type="password" class="form-control text-center" name="pass2" id="pass2" autocomplete="false" required minlength="8">
              </div>
            </div>
        </center>
        <br>
        <center><div id="mensaje"></div></center>
        <center><div><?php echo $mensaje; ?></div></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
        <button type="submit" id="update" class="btn btn-primary" ><i class="fa fa-sync-alt"></i> Renovar Clave</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="eliminar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border: #6E0101; border-style: solid;">
      <div class="modal-header" style="background-color: #6E0101; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Dar Baja a Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <label for="nombre"><i class="fa fa-user-tie"></i> Usuario</label>
          <h4 value="" id="nombreus"></h4>
          <br>
          <form name="deleteuss" id="deleteuss" method="POST">
            <input type="hidden" id="id_us" name="id_us" value="">
        </center>
        <br>
        <center><h4 style="color: red; font-weight: bold;">¿Está seguro de dar de baja al usuario?</h4></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
        <button type="submit" id="chang" class="btn btn-danger" ><i class="fa fa-trash-alt"></i> Dar Baja al Usuario</button>
        </form>
      </div>
    </div> 
  </div>
</div>
<footer class="oculalimprimir"><?php $this->load->view('footer') ?></footer>
<script type="text/javascript">
  function obdatosId(id_usuario) {
      datos = {
          "id_usuario": id_usuario
      }

      $.ajax({
          data: datos,
          url: '<?=$base_url?>/usuario/buscar_user',
          type: 'POST',
          beforeSend: function(){},
          success: function(response) {
              data = $.parseJSON(response);
              if(data.length > 0){
                $('#id').html(data[0]['id_usuario']); 
                $('#nombre').html(data[0]['nombre']); 
              }
          } 
      });
  };

  $('#pass2').keyup(function(e){
    e.preventDefault();

    var valor1 = $("#pass").val();
    var valor2 = $("#pass2").val();
    var botonEnviar = document.getElementById('update');

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


  $('#updatepass').submit(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/usuario/pasupdate',
            type: "POST",
            async: true,
            data: $('#updatepass').serialize(),

            success: function(response){
              if (response == 'true') {
                $('#nombre').html('');
                $('#pass').val('');
                $('#pass2').val('');
                $('#update').slideUp();
               
                Swal.fire({
                title: 'Se a actualizado con éxito la constraseña del Usuario.',
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

  function obdatosIdUs(id_usuario) {
      datos = {
          "id_usuario": id_usuario
      }

      $.ajax({
          data: datos,
          url: '<?=$base_url?>/usuario/buscar_user',
          type: 'POST',
          beforeSend: function(){},
          success: function(response) {
              data = $.parseJSON(response);
              if(data.length > 0){
                $('#id_us').val(data[0]['id_usuario']); 
                $('#nombreus').html(data[0]['nombre']); 
              }
          } 
      });
  };

  $('#deleteuss').submit(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/usuario/changeuss',
            type: "POST",
            async: true,
            data: $('#deleteuss').serialize(),

            success: function(response){
              console.log(response);
              if (response == 'true') {
                $('#nombreus').html('');
                $('#chang').slideUp();
               
                Swal.fire({
                title: 'Se a Eliminado con éxito al Usuario.',
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
</script>
</body>
</html>

