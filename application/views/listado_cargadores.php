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
  <h3 style="color: #03064A"><i class="fa fa-clipboard-list"></i> Listado de Cargadores</h3></center>
</header>
<br>
<section>
  <div class="table-responsive">
    <table class="table-striped table-bordered" width="100%" cellspacing="0" id="cargadoress">
    <thead> 
      <tr>
        <th class="text-center">No.</th>
        <th class="text-center">Nombres y Apellidos</th>
        <th class="text-center">Dirección</th>
        <th class="text-center">Teléfono</th>
        <th class="text-center">Municipio</th>
        <th class="text-center">Depto</th>
        <th class="text-center oculalimprimir">Det</th>
        <?php if ($this->session->ROL == 'Director') { ?> 
        <th class="text-center oculalimprimir"><i class="fa fa-user-edit"></i></th>
        <th class="text-center oculalimprimir"><i class="fa fa-file-alt"></i></th>
        <th class="text-center oculalimprimir"><i class="fa fa-trash-alt"></i></th>
        <?php  } ?>
      </tr>
    </thead>
    <tbody>
       <?php foreach ($arr as $a){ ?>
          <tr>
            <td class="text-center"><?php echo $a['id_cargador'] ;?></td>
            <td class="text-center"><?php echo $a['nombre'] ;?> <?php echo $a['apellido'] ;?></td>
            <td class="text-center"><?php echo $a['direccion'] ;?></td>
            <td class="text-center"><?php echo $a['telefono'] ;?></td>
            <td class="text-center"><?php echo $a['municipio'] ;?></td>
            <td class="text-center"><?php echo $a['departamento'] ;?></td>
            <td class="text-center oculalimprimir"><a class='btn btn-success btn-sm botones' onchange="return llenar("href='<?=$base_url?>/cargador/detalle_cargador/<?php echo $a['id_cargador']; ?>') id="id_colaborador"><i class="fa fa-info-circle"></i></a></td>
              <?php if ($this->session->ROL == 'Director') { ?>
            <td class="text-center oculalimprimir"><a class='btn btn-warning btn-sm botones' data-toggle="modal" data-target="#editarDatosCargador" 
              onclick="obdatosIdPersoEditar('<?php echo $a['id_cargador'] ;?>')"><i class="fa fa-user-edit"></i></a></td>
            <td class="text-center oculalimprimir"><a class='btn btn-primary btn-sm botones' href='<?=$base_url?>/cargador/generacion/<?php echo $a['ins']; ?>'><i class="fa fa-file-alt"></i></a></td>
            <td class="text-center oculalimprimir"><a class='btn btn-danger btn-sm botones' style="color: #fff;" data-toggle="modal" data-target="#eliminar" 
              onclick="obdatosIdPerso('<?php echo $a['id_cargador'] ;?>')"><i class="fa fa-trash-alt"></i></a></td>
              <?php  } ?>
          </tr>
         <?php } ?>
    </tbody>
    </table>
  </div>
</section>
</div>
<br><br>
<footer class="oculalimprimir"><?php $this->load->view('footer') ?></footer>
<!-- Modal -->
<div class="modal fade" id="eliminar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border: #6E0101; border-style: solid;">
      <div class="modal-header" style="background-color: #6E0101; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Dar Baja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
          <label for="nombre"><i class="fa fa-user-tie"></i> Persona</label>
          <h4 value="" id="nombre"></h4>
          <br>
          <form name="deleteuss" id="deleteuss" method="POST">
            <input type="hidden" id="persona" name="persona" value="">
        </center>
        <br>
        <center><h4 style="color: red; font-weight: bold;">¿Está seguro de dar de baja?</h4></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
        <button type="submit" id="chang" class="btn btn-danger" ><i class="fa fa-trash-alt"></i> Dar Baja</button>
        </form>
      </div>
    </div> 
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="editarDatosCargador" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content" style="border: #010B6E; border-style: solid;">
      <div class="modal-header" style="background-color: #010B6E; color: #fff;">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-key"></i> Editar Datos del Cargador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name="updateusercarga" id="updateusercarga">
        <div class="form-row">
            <input type="hidden" id="cargador" name="cargador" required>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-signature"></i> Nombre</label>
            <input type="text" class="ford text-center" id="nombres" name="nombre" required>
          </div>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-signature"></i> Apellido</label>
            <input type="text" class="ford text-center" id="apellidos" name="apellido" required>
          </div>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-id-card"></i> CUI</label>
            <input type="text" class="ford text-center positive" id="cui" name="cui" maxlength="13" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-6">
            <label class="arr"><i class="fa fa-map-signs"></i> Dirección</label>
            <input type="text" class="ford text-center" id="direccion" name="direccion" required>
          </div>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-calendar-week"></i> Fecha</label>
            <input type="date" class="ford text-center" id="fecha" name="fecha" required>
          </div>
          <div class="col-sm-2">
            <label class="arr"><i class="fa fa-heartbeat"></i> Edad</label>
            <input type="text" class="ford text-center" id="edad" name="edad" required readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-venus-mars"></i> Género</label>
            <select id="genero" name="genero" required class="ford text-center">
              <option selected value="" disabled>Elegir Sexo</option>
              <option value="Masculino"> Hombre</option>
              <option value="Femenino"> Mujer</option>
            </select>
          </div>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-mobile-alt"></i> Teléfono 1</label>
            <input type="text" class="ford text-center positive" id="num1" name="numero1" maxlength="8" required>
          </div>
          <div class="col-sm-4">
            <label class="arr"><i class="fa fa-mobile-alt"></i> Teléfono 2</label>
            <input type="text" class="ford text-center positive" id="num2" name="numero2" maxlength="8" required>
          </div>
        </div>
        <br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-sign-out-alt"></i> Salir</button>
        <button type="submit" id="updateData" class="btn btn-danger" ><i class="fa fa-sync-alt"></i> Actualizar</button>
        </form>
      </div>
    </div> 
  </div>
</div>
<script type="text/javascript">
  function obdatosIdPerso(id_colaborador) {
      datos = {
          "colaborador": id_colaborador
      }

      $.ajax({
          data: datos,
          url: '<?=$base_url?>/celador/buscarpersona',
          type: 'POST',
          beforeSend: function(){},
          success: function(response) {
              data = $.parseJSON(response);
              if(data.length > 0){
                $('#persona').val(data[0]['persona']); 
                $('#nombre').html(data[0]['nombre']); 
              }
          } 
      });
  };

  $('#deleteuss').submit(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/celador/changepersona',
            type: "POST",
            async: true,
            data: $('#deleteuss').serialize(),

            success: function(response){
              if (response == 'true') {
                $('#persona').val('');
                $('#nombre').html('');
                $('#chang').slideUp();
               
                Swal.fire({
                title: 'Se a Eliminado con éxito a la persona.',
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

  $(document).ready(function () {
    $('#cargadoress').DataTable({
        order: [ 0, "desc" ],
        language: {
            processing: "Proceso en curso...",
            search: "Buscar&nbsp;:",
            lengthMenu: "Agrupar por _MENU_ items",
            info: "Mostrando del item _START_ al _END_ de un total de _TOTAL_ items",
            infoEmpty: "No existen datos.",
            infoFiltered: "(filtrado de _MAX_ elementos en total)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron datos con tu búsqueda",
            emptyTable: "No hay datos disponibles en la tabla.",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": active para ordenar la columna en orden ascendente",
                sortDescending: ": active para ordenar la columna en orden descendente"
            }
        },
        scrollY: 2500,
        scrollCollapse: true,
        lengthMenu: [ [20, 30, 40, 50, 60, -1], [20, 30, 40, 50, 60, "All"] ],
    });
  });

  function obdatosIdPersoEditar(id_colaborador) {
      datos = {
          "id": id_colaborador
      }

      $.ajax({
          data: datos,
          url: '<?=$base_url?>/cargador/detalle_cargadorEditar',
          type: 'POST',
          beforeSend: function(){},
          success: function(response) {
              data = $.parseJSON(response);
              if(data.length > 0){
                $('#cargador').val(data[0]['id_cargador']);
                $('#nombres').val(data[0]['nombre']);
                $('#apellidos').val(data[0]['apellido']);
                $('#cui').val(data[0]['cui']);
                $('#direccion').val(data[0]['direccion']);
                $('#fecha').val(data[0]['fecha']);
                $('#edad').val(data[0]['edad']);
                $('#genero').val(data[0]['genero']);
                $('#num1').val(data[0]['numero1']);
                $('#num2').val(data[0]['numero2']);
              }
          } 
      });
  };

  $('#updateusercarga').submit(function(e){
    e.preventDefault();
        $.ajax({
            url: '<?=$base_url?>/cargador/updateCargadorData',
            type: "POST",
            async: true,
            data: $('#updateusercarga').serialize(),

            success: function(response){
              //console.log(response);
              if (response == 'true') {
                $('#persona').val('');
                $('#nombre').html('');
                $('#chang').slideUp();
               
                Swal.fire({
                title: 'Se a actualizado con éxito al cargador.',
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

  $(document).ready(function(){
      validarCualquierNumero();
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

    $('#fecha').on('change', function(){
      var fecha_seleccionada = $('#fecha').val();
      var fecha_nacimiento = new Date(fecha_seleccionada);
      var fecha_Actual = new Date();
      var edad = (parseInt((fecha_Actual - fecha_nacimiento) / (1000*60*60*24*365.25)));
      $('#edad').val(edad);
      if (edad > 100 || edad < 8) {
        $('#inscripcion').slideUp();
      }else{
        $('#inscripcion').slideDown();
      }
    });
</script>
</body>
</html>