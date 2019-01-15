
@extends('layouts.userApp')

@section('title')
	Comunidad
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
  <i class="icon fa fa-users fa-fw"></i>Mi Comunidad
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-users"></i> Comunidad</a></li>
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


              @if(isset($comunidad->institucion->imagen) && $comunidad->institucion->imagen != '' && $comunidad->institucion->imagen != 'default.jpg')

                <img class="profile-user-img img-responsive img-circle" src="<?php echo asset('storage' . '/' . $comunidad->institucion->imagen) ?>" alt="Institucion">
                
              @else

                <img class="profile-user-img img-responsive img-circle" src="{{asset('img/institucion160x160.png')}}" alt="Default">

              @endif

              

              <h3 class="profile-username text-center"><?php echo $comunidad->nombre ?></h3>

              <p class="text-muted text-center"><?php echo strtoupper($comunidad->tipo) ?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-user-circle fa-fw"></i> Miembros</b> 
                  <a class="pull-right">
                    <span class="countMiembros">{{ $comunidad->users()->count() }}</span>

                    <?php if ( (Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id && $comunidad->solicitudes->count()) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || Auth::user()->tipoUsuario->slug == 'administrador' ): ?>
                      <span class="small">(<span class="countSolicitudes"> <?php echo $comunidad->solicitudes->count() ?></span> pendientes)</span>    
                    <?php endif ?>  
                  
                  </a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-user fa-fw"></i> Asistidos</b> <a class="pull-right"><span class="countAsistidos">{{ $comunidad->asistidos()->count() }}</span></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-exclamation-circle fa-fw"></i> Alertas</b> <a class="pull-right"><span class="countAlertas">{{ $comunidad->alertas()->count() }}</span></a>
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
              
              <?php if ($comunidad->institucion->tipo == 'posadero') { ?>
                <strong><img src="{{asset('/img/logoch.png')}}" alt="Logo Posadero" style="height: 17px;"> Posadero</strong>  
              <?php } else { ?>
                <strong><i class="fa fa-bank margin-r-5"></i> Institución</strong>
              <?php } ?>
              
              <p class="text-muted">
                {{ strtoupper($comunidad->institucion->nombre) }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>

              <p class="text-muted"><?php echo $comunidad->institucion->direccion->toString() ?></p>

              <hr>

              <strong><i class="fa fa-id-badge margin-r-5"></i> Coordinadores</strong>

                <?php if (isset($comunidad->coordinadores) && count($comunidad->coordinadores)) { ?>
                  
                  <?php foreach ($comunidad->coordinadores as $coordinador): ?>
                    <p style="margin: 0 3px !important;" class="text-muted"><?php echo $coordinador->name ?> <?php echo $coordinador->apellido ?></p>
                  <?php endforeach ?>
                
                <?php } else { ?>
                  <p class="text-muted">-</p>
                <?php } ?>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Observaciones</strong>

              <p><?php echo $comunidad->observaciones ?></p>

              <hr>

              <a href="javascript:void(0)" data-target="#modal-consulta" data-toggle="modal" class="btn btn-primary btn-block"><i class="fa icon fa-comments-o fa-fw"></i><b>Mensaje</b></a>
              <a href="#" class="btn btn-danger btn-block"><i class="fa icon fa-sign-out fa-fw"></i><b>Abandonar</b></a>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#actividad" data-toggle="tab"><i class="fa icon fa-history fa-fw"></i> <span class="hidden-xs">Actividad</span></a></li>
              <li><a href="#alertas" data-toggle="tab"><i class="fa icon fa-exclamation-circle fa-fw"></i> <span class="hidden-xs">Alertas</span></a></li>
              <li><a href="#asistidos" data-toggle="tab"><i class="fa icon fa-user fa-fw"></i> <span class="hidden-xs">Asistidos</span></a></li>
              <li><a href="#miembros" data-toggle="tab"><i class="fa icon fa-user-circle fa-fw"></i> <span class="hidden-xs">Miembros</span></a></li>
            </ul>
            
            <div class="tab-content" style="min-height: 742px;">
              
              <div class="active tab-pane" id="actividad">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Actividad Reciente
                      <br><small class="text-muted">Mira la actividad reciente de los miembros de tu comunidad</small> 
                        <a href="" data-target="#modal-consulta" data-toggle="modal" class="btn btn-default pull-right"><i class="icon fa fa-comments-o"></i> Nuevo Mensaje</a>
                    </h3>
                    <br>
                  </div>
                </div>

                <div class="post" id="loading" style="border-bottom: 0px !important;">
                  <div class="user-block" style="vertical-align: middle;">
                    <span class="description text-center" style="font-size: 3em;"><i class="icon fa fa-spinner fa-spin"></i></span>
                  </div>  
                </div>

                <div id="actividadReciente"></div>             
   
              </div>
              
              <div class="tab-pane" id="asistidos">
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Asistidos
                      <br><small class="text-muted">Listado de Asistidos vinculados a tu Comunidad</small>
                    </h3>

                    <table class="table table-striped table-hover dataTables" id="tableAsistidos" style="overflow-x: auto;">
                      <?php if ($comunidad->asistidos()->count() > 0): ?>
                        <thead>
                          <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <?php if (Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'administrador'): ?>
                              <th></th>
                            <?php endif ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($comunidad->asistidos as $asistido): ?>
                            <tr>
                              <td>{{$asistido->nombre}} {{$asistido->apellido}}</td>
                              <td>DNI {{$asistido->dni}}</td>
                              <td>{{(new DateTime($asistido->fechaNacimiento))->format('d/m/Y')}}</td>

                              <?php if (Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'administrador'): ?>
                                <td><a href="{{url('/asistido/show/'.$asistido->id)}}" target="_blank"><i class="icon fa fa-search fa-2x"></i></a></td>
                              <?php endif ?>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      <?php endif ?>
                    </table>

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="miembros">

                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Miembros
                      <br><small class="text-muted">Listado de miembros de la Comunidad</small>
                    </h3>

                  </div>
                </div>


                <table class="table table-striped table-hover dataTables" id="tableMiembros" style="overflow-x: auto;">
                  <?php if ($comunidad->users()->count() > 0): ?>
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <?php if ( (Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || Auth::user()->tipoUsuario->slug == 'administrador' ): ?>
                          <th></th>
                        <?php endif ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($comunidad->users as $usuario): ?>
                        <tr>
                          <td>
                            {{$usuario->name}} {{$usuario->apellido}} 
                            <br><small class="text-muted">{{$usuario->tipoUsuario->nombre}}</small>
                          </td>
                          <td class="text-center hidden-xs">
                            {{$usuario->email}}
                            <?php if ($usuario->comunidad_id == $comunidad->id): ?>
                              <span class="label label-default">COORDINADOR</span>
                            <?php endif ?>
                          </td>
                          
                          <?php if ( (Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || Auth::user()->tipoUsuario->slug == 'administrador' ): ?>
                            <td class="text-center">
                              <a href="javascript:void(0)" class="eliminarMiembro" data-id="{{ $usuario->id }}" data-toggle="tooltip" data-title="Eliminar Miembro"> <i class="icon fa fa-remove fa-2x fa-fw text-red"></i></a>
                            </td>
                          <?php endif ?>

                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  <?php endif ?>
                </table>

                <?php if ( (Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id && $comunidad->solicitudes->count()) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || (Auth::user()->tipoUsuario->slug == 'administrador') ): ?>
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Solicitudes
                      <br><small class="text-muted">Solicitudes de adhesión pendientes</small>
                    </h3>

                    <table class="table table-striped table-hover dataTables" style="overflow-x: auto;">
                      <?php if ($comunidad->solicitudes()->count()): ?>
                        <thead>
                          <tr>
                            <th></th><th></th><th></th><th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($comunidad->solicitudes as $solicitud): ?>
                            <tr id="solicitud{{$solicitud->id}}">
                              <td>{{$solicitud->user->name}} {{$solicitud->user->apellido}} <small class="text-muted">(DNI {{$solicitud->user->dni}})</small></td>
                              <td class="text-center hidden-xs">{{$solicitud->user->email}}</td>
                              <td class="text-center hidden-xs horario">{{$solicitud->created_at->diffForHumans()}}</td>
                              <td class="text-center acciones">
                                <a href="javascript:void(0)" class="descartarSolicitud" data-id="{{ $solicitud->id }}" data-toggle="tooltip" data-title="Descartar Solicitud"> <i class="icon fa fa-remove fa-2x fa-fw text-red"></i></a>
                                <a href="javascript:void(0)" class="aprobarSolicitud" data-id="{{ $solicitud->id }}" data-toggle="tooltip" data-title="Aprobar Solicitud"> <i class="icon fa fa-check fa-2x fa-fw text-green"></i></a>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      <?php endif ?>
                    </table>

                  </div>
                </div>
                <?php endif ?>

              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="alertas">
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Alertas
                      <br><small class="text-muted">Listado de alertas compartidas con la Comunidad</small>
                    </h3>

                    <table class="table table-striped table-hover dataTables" id="tableAlertas" style="overflow-x: auto;">
                      <?php if ($comunidad->alertas()->count() > 0): ?>
                        <thead>
                          <tr>
                            <th></th><th></th><th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($comunidad->alertas as $alerta): ?>
                            <tr>
                              <td>
                                {{$alerta->nombre}} {{$alerta->apellido}}
                                <br>DNI {{$alerta->dni}}
                                <br>{{(new DateTime($alerta->fechaNacimiento))->format('d/m/Y')}}
                              </td>
                              <td class="vert-aligned">
                                <?php echo $alerta->user->name ?> <?php echo $alerta->user->apellido ?>
                                <br><span class="text-muted"><?php echo $alerta->user->tipoUsuario->nombre ?></span>
                              </td>
                              <td class="vert-aligned text-center">
                                <?php if ($alerta->estado == 1) { ?>
                                  
                                  <span class="label label-success"><i class="fa icon fa-check-circle"></i> SE PRESENTÓ </span>

                                <?php } elseif ($alerta->estado == 0) { ?>

                                  <span class="label label-default"><i class="fa icon fa-clock-o"></i> PENDIENTE </span>
                                
                                <?php } elseif ($alerta->estado == 2) { ?>

                                  <span class="label label-danger"><i class="fa icon fa-close"></i> DESCARTADA </span>

                                <?php } ?>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                      <?php endif ?>
                    </table>

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->



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
        <h4 class="modal-title"><i class="icon fa fa-comments-o fa-fw"></i> Comunidad <small class="text-muted">COMPARTÍ UN MENSAJE CON LOS MIEMBROS DE TU COMUNIDAD</small></h4>
      </div>

      <div class="modal-body">
      <form class="form-horizontal" method="POST" action="{{ url('/comunidad/storeMensaje') }}" id="formNuevaConsulta" enctype="multipart/form-data">
        {{ csrf_field() }}
        <textarea required class="textareaEditor" id="mensaje" name="mensaje" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        
        <label for="adjunto" id="agregarAdjunto">Imagen Adjunta</label>
        <input type="file" id="adjunto" name="adjunto">
        <input type="hidden" id="id" name="id" value="<?php echo $comunidad->id ?>">
        
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

      $.get("{{url('actividad/'.$comunidad->id)}}"+"/"+offset, function(data){
        
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

<?php if ((Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id)): ?>
  
  <script type="text/javascript">
    
    $('.descartarSolicitud').click(function () {

      var id = $(this).data('id');
      
      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      $.post( "{{route('comunidad.descartarSolicitud')}}", { 'solicitud_id': id, '_token': '{{csrf_token()}}' })    
      .done(function(datos) {

      if (datos.status) {

        loading.modal('hide');
        lanzarAlerta('exito', datos.msg);

        $('#solicitud'+id).remove();
        $('.countSolicitudes').html($('.countSolicitudes').html()-1);

      } else {

        loading.modal('hide');
        lanzarAlerta('peligro', datos.msg);
      }

      });

    });

    $('.aprobarSolicitud').click(function () {

      var id = $(this).data('id');
      
      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      $.post( "{{route('comunidad.aprobarSolicitud')}}", { 'solicitud_id': id, '_token': '{{csrf_token()}}' })    
      .done(function(datos) {

      if (datos.status) {

        loading.modal('hide');
        lanzarAlerta('exito', datos.msg);

        tr = $('#solicitud'+id);

        tr.find('.horario').remove();
        tr.find('.acciones').html('<i class="icon fa fa-remove fa-2x fa-fw text-gray"></i>');

        $('#tableMiembros').append(tr);

        $('.countSolicitudes').html($('.countSolicitudes').html()-1);
        $('.countMiembros').html(parseInt($('.countMiembros').html())+1.0);

      } else {

        loading.modal('hide');
        lanzarAlerta('peligro', datos.msg);
      }

      });

    });

  </script>

<?php endif ?>


@endsection
