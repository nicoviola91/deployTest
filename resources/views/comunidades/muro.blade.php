
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

                    <?php if ( ((Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id && $comunidad->solicitudes->count()) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || Auth::user()->tipoUsuario->slug == 'administrador') && count($comunidad->solicitudes) ): ?>
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

              <p class="text-muted"><?php echo isset($comunidad->institucion->direccion) ? $comunidad->institucion->direccion->toString() : '' ?></p>

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

              <a href="javascript:void(0)" data-target="#modal-consulta" data-toggle="modal" class="btn btn-default btn-block"><i class="fa icon fa-comments-o fa-fw"></i><b>Mensaje</b></a>
              
              <?php if (Auth::user()->comunidades->contains($comunidad->id)) { ?>
                <a href="javascript:void(0)" class="btn btn-danger btn-block btnAbandonar"><i class="fa icon fa-sign-out fa-fw"></i><b>Abandonar</b></a>
              <?php } else { ?>
                <a href="javascript:void(0)" class="btn btn-primary btn-block btnUnite"><i class="fa icon fa-sign-in fa-fw"></i><b>Uníte!</b></a>
              <?php } ?>

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

              <?php if (Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'administrador'): ?>
                <li><a href="#asistidos" data-toggle="tab"><i class="fa icon fa-user fa-fw"></i> <span class="hidden-xs">Asistidos</span></a></li>                
              <?php endif ?>
              
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
              
              <?php if (Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'profesional' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'administrador'): ?>
              <div class="tab-pane" id="asistidos">
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Asistidos
                      <br><small class="text-muted">Listado de Asistidos vinculados a tu Comunidad</small>
                    </h3>

                    <?php if ($comunidad->asistidos()->count() > 0): ?>
                    <table class="table table-striped table-hover dataTables" id="tableAsistidos" style="overflow-x: auto;">
                      
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
                      
                    </table>
                    <?php endif ?>

                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <?php endif ?>

              <div class="tab-pane" id="miembros">

                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Miembros
                      <br><small class="text-muted">Listado de miembros de la Comunidad</small>
                    </h3>

                  </div>
                </div>

                <?php if ($comunidad->users()->count() > 0): ?>
                <table class="table table-striped table-hover dataTables" id="tableMiembros" style="overflow-x: auto;">
                  
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
                        <tr id="miembro{{$usuario->id}}">
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
                              <a href="javascript:void(0)" class="eliminarMiembro" data-user="{{$usuario->id}}" data-comunidad="{{$comunidad->id}}" data-toggle="tooltip" data-title="Eliminar Miembro"> <i class="icon fa fa-remove fa-2x fa-fw text-red"></i></a>
                            </td>
                          <?php endif ?>

                        </tr>
                      <?php endforeach ?>
                    </tbody>
                  
                </table>
                <?php endif ?>

                <?php if ( $comunidad->solicitudes->count() && ((Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id) || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion_id ) || (Auth::user()->tipoUsuario->slug == 'administrador')) ): ?>
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Solicitudes
                      <br><small class="text-muted">Solicitudes de adhesión pendientes</small>
                    </h3>

                    <?php if ($comunidad->solicitudes()->count()): ?>
                    <table class="table table-striped table-hover" id="tableSolicitudes" style="overflow-x: auto;">
                      
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
                      
                    </table>
                    <?php endif ?>

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

                    <?php if ($comunidad->alertas()->count() > 0): ?>
                    <table class="table table-striped table-hover dataTables" id="tableAlertas" style="overflow-x: auto;">
                      
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
                      
                    </table>
                    <?php endif ?>

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
  
  $('#submitConsultaBtn').click(function(e) {

    e.preventDefault();

    console.log(1);

    if ($('#mensaje').val() == '') {

      lanzarAlerta('peligro', "Por favor, ingresá un mensaje en el campo de texto.");

    } else {

        formData = new FormData($('#formNuevaConsulta')[0]);

        bootbox.dialog({
            message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía la consulta.</p>',
            closeButton: false
        });

        $.ajax({
              url: "{{ url('/comunidad/storeMensaje') }}",
              type: "POST",
              enctype: 'multipart/form-data',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function(datos)
              { 
                $('.modal').modal('hide');
                $('#formNuevaConsulta')[0].reset();

                if (datos.status) {
                  lanzarAlerta('exito', datos.msg);

                  txt= '<div class="post">';
                    txt+= '<div class="user-block">';
                          txt+= '<img class="img-circle img-bordered-sm" src="<?php echo isset(Auth::user()->imagen) ? asset("storage") . '/' . Auth::user()->imagen : asset("/img/user160x160.png") ?>" alt="user image">';                       
                          txt+= '<span class="username">';
                            txt+= '<a href="#">{{ Auth::user()->name }} {{ Auth::user()->apellido }}</a>';
                            txt+= '<span href="#" class="pull-right btn-box-tool"> ahora </span>';
                          txt+= '</span>';
                          txt+= '<span class="description"></span>';
                    txt+= '</div>';
                    
                    txt+= '<p>';
                      txt+= datos.texto;
                      if (datos.adjunto) {
                        txt+= ('<a href="<?php echo asset("storage/")?>'+datos.adjunto+'" target="_blank"><img src="<?php echo asset("storage/" . "thumb_")?>'+datos.adjunto+'" class="margin img-thumbnail" style="max-height: 80px;"></a>');
                      }
                    txt+= '</p>';         
                  txt+= '</div>';

                  $('#actividadReciente').prepend(txt);
                }
                else {
                  lanzarAlerta('peligro', datos.msg);
                }

              },
              error: function(data) {         
          $('.modal').modal('hide');
          lanzarAlerta('peligro', 'Ocurrió un error al publicar el formulario. Vuelva a intentarlo.');
        }

        });
      }

  })

</script>

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

<?php if ((Auth::user()->tipoUsuario->slug == 'coordinador' && Auth::user()->comunidad_id == $comunidad->id) || (Auth::user()->tipoUsuario->slug == 'administrador') || (Auth::user()->tipoUsuario->slug == 'posadero' && Auth::user()->institucion_id == $comunidad->institucion->id)): ?>
  
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

    $('.btnAbandonar').click(function (e) {

      id = '{{$comunidad->id}}';

      bootbox.confirm({
          title: "Atención",
          message: "<p>Si abandonás la Comunidad ya no vas a poder compartir la actividad de todos los miembros. Podés volver a unirte más tarde.</p><p>¿Estás seguro que querés continuar?</p>",
          buttons: {
              cancel: {
                  label: '<i class="fa fa-times"></i> No',
                  className: 'btn-default'
              },
              confirm: {
                  label: '<i class="fa fa-check"></i> Si, abandonar',
                  className: 'btn-primary'
              }
          },
          callback: function (result) {

              if (result) {

                $.get( "{{url('/comunidad/abandonar')}}/"+id)    
                  .done(function(datos) {

                  if (datos.status) {
                    
                    window.location.href = "{{url('/home')}}";

                  } else {
                    lanzarAlerta('peligro', datos.msg);
                  }

                });

              }
          }
      });

    });

    $('.eliminarMiembro').click(function(){
    
      var comunidad = $(this).data('comunidad');
      var usuario = $(this).data('user');
    
      $.post( "{{route('comunidad.eliminarMiembro')}}", { 'comunidad_id': comunidad, 'user_id': usuario, '_token': '{{csrf_token()}}' })    
      .done(function(datos) {

      if (datos.status) {

        console.log(datos.msg);
        $('#miembro'+usuario).remove();
        $('.countMiembros').html(parseInt($('.countMiembros').html())-1.0);
        
      } else {

        console.log(datos.msg);
        lanzarAlerta('peligro', datos.msg);
      }

      });

    });


    $('.btnUnite').click(function(){
    
      var comunidad = '{{$comunidad->id}}';

      console.log(comunidad);
      
      if (jQuery.isNumeric(comunidad)) {
                
        var loading = bootbox.dialog({
          message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
          closeButton: false
        });

        $.post( "{{route('comunidad.enviarSolicitud')}}", { 'comunidad_id': comunidad, '_token': '{{csrf_token()}}' })    
        .done(function(datos) {

        if (datos.status) {

          console.log(datos.msg);
          loading.modal('hide');
          lanzarAlerta('exito', datos.msg);

          $('.countSolicitudes').html($('.countSolicitudes').html()+1);

        } else {

          console.log(datos.msg);
          loading.modal('hide');
          lanzarAlerta('peligro', datos.msg);
        }

        });

      } else {
        lanzarAlerta('peligro', 'Seleccioná una opción válida.')
      }

    });





  </script>



<?php endif ?>


@endsection
