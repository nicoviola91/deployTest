
@extends('layouts.userApp')

@section('title')
	Institucion
@endsection

@section('head')
  
  <!-- Bootstrap WYSIHTML5 -->
  <link rel="stylesheet" href="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <!-- MeetSelva -->
  <script src="{{ asset('/letterAvatar/letterAvatar.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
  <i class="icon fa fa-users fa-fw"></i>Mi Posdaero
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-users"></i> Posadero</a></li>
  <li class="active">Muro</li>
</ol>
@endsection


@section('content')

<style type="text/css">
  
  .vert-aligned {

    vertical-align: middle !important;
  }

  .user-block-icon {
    width: 40px;
    height: 40px;
    float: left;
    font-size: 3em;
  }

}

</style>

<div class="row">
<div class="col-md-12">











<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box">
            <div class="box-body box-profile">


              @if(isset($institucion->imagen) && $institucion->imagen != '' && $institucion->imagen != 'default.jpg')

                <img class="profile-user-img img-responsive img-circle" src="<?php echo asset('storage' . '/' . $institucion->imagen) ?>" alt="Institucion">
                
              @else

                <img class="profile-user-img img-responsive img-circle" src="{{asset('img/institucion160x160.png')}}" alt="Default">

              @endif

              

              <h3 class="profile-username text-center"><?php echo $institucion->nombre ?></h3>

              <p class="text-muted text-center">
                <?php if ($institucion->tipo == 'posadero') { ?>
                  <img src="{{asset('/img/logoch.png')}}" alt="Logo Posadero" style="height: 17px;"> Posadero
                <?php } else { ?>
                  Institucion Externa   
                <?php } ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-users fa-fw"></i> Comunidades</b> <a class="pull-right"><?php echo $institucion->comunidades->count() ?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-exclamation-circle fa-fw"></i> Alertas Pendientes</b> <a class="pull-right"><?php echo count($alertas) ?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-user fa-fw"></i> Asistidos</b> <a class="pull-right"><?php echo count($asistidos) ?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-user-circle fa-fw"></i> Miembros</b> <a class="pull-right"><?php echo count($miembros) ?></a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            
              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>
              <p class="text-muted"><?php echo isset($institucion->direccion) ? $institucion->direccion->toString() : '' ?></p>

              <hr>

              <strong><i class="fa fa-clock-o margin-r-5"></i> Horario</strong>
              <p class="text-muted"><?php echo $institucion->descripcion ?></p>

              <hr>

              <strong><i class="fa fa-address-card margin-r-5"></i> Responsables</strong>

              <p class="text-muted" style="margin: 0 3px !important;"><?php echo $institucion->responsable ?></p>
              
              <?php foreach ($institucion->users as $user): ?>
                <p class="text-muted" style="margin: 0 3px !important;"><?php echo $user->name ?> <?php echo $user->apellido ?> <label class="label label-default">POSADERO</label></p>
              <?php endforeach ?>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#alertas" data-toggle="tab"><i class="fa icon fa-exclamation-circle fa-fw"></i> <span class="hidden-xs">Alertas</span></a></li>
              <li><a href="#asistidos" data-toggle="tab"><i class="fa icon fa-user fa-fw"></i> <span class="hidden-xs">Asistidos</span></a></li>
              <li><a href="#comunidades" data-toggle="tab"><i class="fa icon fa-users fa-fw"></i> <span class="hidden-xs">Comunidades</span></a></li>
              <li><a href="#miembros" data-toggle="tab"><i class="fa icon fa-user-circle fa-fw"></i> <span class="hidden-xs">Miembros</span></a></li>
            </ul>
            
            <div class="tab-content" style="min-height: 742px;">
              
              <div class="active tab-pane" id="alertas">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Alertas Pendientes
                      <br><small class="text-muted">Listado de Alertas <label class="label label-default"><i class="icon fa fa-clock-o"></i>PENDIENTES</label> que fueron derivadas a tu Institución</small>
                      <br><small class="text-muted">Si no encontrás lo que buscás, mirá el listado completo de Alertas. Hacé click <a href="{{url('/alert/list')}}" target="_blank">ACÁ</a></small> 
                    </h3>
                    <br>

                    <table class="table table-striped table-hover dataTables" id="tableAlertas" style="overflow-x: auto;">
                      <?php if (count($alertas) > 0): ?>
                        <thead>
                          <tr>
                            <th>Alerta</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($alertas as $alerta): ?>
                            <tr>
                              <td>
                                {{$alerta->nombre}} {{$alerta->apellido}}
                                <br>DNI {{$alerta->dni}}
                                <br>{{(new DateTime($alerta->fechaNacimiento))->format('d/m/Y')}}
                              </td>
                              <td class="vert-aligned">
                                <?php echo $alerta->authorNombre ?> <?php echo $alerta->authorApellido ?>
                                <br><span class="text-muted"><?php echo $alerta->authorTipo ?></span>
                              </td>
                              
                              <td class="text-center" style="vertical-align: middle;"> 
                                <a href="{{ route('asistido.newFromAlert',['id'=>$alerta->id]) }}" class="altaBtn" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
                                <a href="{{ route('alerta.destroy',['id'=>$alerta->id])}}" class="descartarBtn" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a>
                              </td>

                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      <?php endif ?>
                    </table>

                  </div>
                </div>

              </div>


              <div class="tab-pane" id="asistidos">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Asistidos
                      <br><small class="text-muted">Listado de Asistidos asociados a las Comunidades de tu Institución</small> 
                    </h3>
                    <br>

                    <?php foreach ($asistidos as $a): ?>
                      <?php echo var_dump($a) ?>
                    <?php endforeach ?>

                  </div>
                </div>

              </div>


              <div class="tab-pane" id="miembros">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Miembros
                      <br><small class="text-muted">Listado de Miembros asociados a las Comunidades de tu Institución</small> 
                    </h3>
                    <br>

                    <?php foreach ($miembros as $m): ?>
                      <?php echo var_dump($m) ?>
                    <?php endforeach ?>


                    <br>
                    <h3>
                      Solicitudes
                      <br><small class="text-muted">Solicitudes de adhesion pendientes para las Comunidades de tu Institución</small> 
                    </h3>
                    <br>

                    <?php foreach ($solicitudes as $s): ?>
                      <?php echo var_dump($s) ?>
                    <?php endforeach ?>

                  </div>
                </div>

              </div>

              <div class="tab-pane" id="comunidades">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Comunidades
                      <br><small class="text-muted">Listado de Comunidades de tu Institución</small> 
                    </h3>
                    <br>

                    <table class="table table-striped table-hover" id="tableComunidades" style="overflow-x: auto;">
                      <?php if ($institucion->comunidades()->count() > 0): ?>
                      <?php foreach ($institucion->comunidades as $comunidad): ?>
                        <tr>
                          <td>{{$comunidad->nombre}}</td>
                          <td><a href="{{url('/comunidad/muro/'.$comunidad->id)}}" target="_blank"><i class="icon fa fa-search fa-2x"></i></a></td>
                        </tr>
                      <?php endforeach ?>
                      <?php endif ?>
                    </table>

                  </div>
                </div>

              </div>



            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->














</div>
</div>



<div class="modal fade" id="modal-consulta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="icon fa fa-comments-o fa-fw"></i> Comunidad <small class="text-muted">NUEVO MENSAJE</small></h4>
      </div>

      <div class="modal-body">
      <form class="form-horizontal" method="POST" action="{{ url('/comunidad/storeMensaje') }}" id="formNuevaConsulta" enctype="multipart/form-data">
        {{ csrf_field() }}
        <textarea required class="textareaEditor" id="mensaje" name="mensaje" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        
        <label for="adjunto" id="agregarAdjunto">Imagen Adjunta</label>
        <input type="file" id="adjunto" name="adjunto">
        <input type="hidden" id="id" name="id" value="<?php echo $institucion->id ?>">
        
        <p class="help-block"><small>Admite jpg, jpeg, png</small></p>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary" id="submitConsultaBtn">Enviar Mensaje</button>
        </div>
      </form>
      </div>

    </div>
  </div>
</div>


@endsection


@section('scripts')

<script type="text/javascript">

  $(function () {

      $('.dataTables').DataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false,
        'pageLength'  : 25,

        "oLanguage": {
        "sEmptyTable": "No hay datos disponibles para la tabla.",
        "sLengthMenu": "Mostrar _MENU_ filas",
        "sSearch": "Buscar:",
        "sInfo": "Mostrando _START_ a _END_ de _TOTAL_ filas",
        "oPaginate": {
          "sPrevious": "Anterior",
          "sNext": "Siguiente"
        }
      },

      });
  });
    
  $(function () {

    $('.textareaEditor').wysihtml5({
      toolbar: {
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": false, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false, //Button to change color of font  
        "blockquote": false, //Blockquote  
        "size": 'sm', //default: none, other options are xs, sm, lg
      }
    });
  });


  $(function() {
    
    function actualizaciones (offset) {

      $.get("{{url('actividad/'.$institucion->id)}}"+"/"+offset, function(data){
        
        $('.divMore').remove();

        $("#actividadReciente").append(data);
        $("#loading").remove();
      })

    }

    actualizaciones(0);

    $(document).on( "click", ".moreUpdates", function() {

      offset = $(this).data('offset');
      $('.iconMore').addClass("fa-spin");
      actualizaciones(offset);

    })

  });

    
  
</script>


@endsection
