
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
                  <b><i class="fa fa-user-circle fa-fw"></i> Miembros</b> <a class="pull-right">{{ $comunidad->users()->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-user fa-fw"></i> Asistidos</b> <a class="pull-right">{{ $comunidad->asistidos()->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-exclamation-circle fa-fw"></i> Alertas</b> <a class="pull-right">{{ $comunidad->alertas()->count() }}</a>
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
              <strong><i class="fa fa-bank margin-r-5"></i> Institución</strong>

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

                <?php if (isset($comunidad->mensajes)): ?>
                  <?php foreach ($comunidad->mensajes as $m): ?>
                    
                    <div class="post">
                      <div class="user-block">

                            <?php if (isset($m->author->imagen) && $m->author->imagen != '' && $m->author->imagen != 'default.jpg') { ?>
                              <img class="img-circle img-bordered-sm" src="<?php echo asset("storage") . '/' . $m->author->imagen ?>" alt="user image">                          
                            <?php } else { ?>
                              <img class="img-circle img-bordered-sm" src="{{ asset('/img/user160x160.png') }}" alt="user image">
                            <?php } ?>

                            <span class="username">
                              <a href="#"><?php echo $m->author->name ?> <?php echo $m->author->apellido ?></a>
                              <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                              <span href="#" class="pull-right btn-box-tool"><?php echo $m->created_at->diffForHumans() ?></span>
                            </span>
                        <span class="description"> <?php echo $m->author->tipoUsuario->nombre ?></span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?php echo $m->mensaje ?>
                        <?php if (isset($m->adjunto)): ?>
                          <a href="<?php echo asset('storage/' . $m->adjunto) ?>" target="_blank"><img src="<?php echo asset('storage/' . 'thumb_' . $m->adjunto) ?>" class="margin img-thumbnail" style="max-height: 80px;"></a>
                        <?php endif ?>
                      </p>    
                      
                    </div>


                  <?php endforeach ?>
                <?php endif ?>

                <div class="post">
                  <div class="user-block">
                    <i class="fa-fw icon fa fa-exclamation-circle user-block-icon text-red"></i>
                    <span class="username">
                      <a href="#">Nueva Alerta</a>
                      <span href="#" class="pull-right btn-box-tool"><?php echo $m->created_at->diffForHumans() ?></span>
                    </span>
                    <span class="description"> Pepe Gomez Genero una nueva Alerta</span>
                  </div>  
                </div>

                <div class="post">
                  <div class="user-block">
                    <i class="fa-fw icon fa fa-user user-block-icon text-primary"></i>
                    <span class="username">
                      <a href="#">Nuevo Miembro</a>
                      <span href="#" class="pull-right btn-box-tool"><?php echo $m->created_at->diffForHumans() ?></span>
                    </span>
                    <span class="description"> Se agrego un nuevo miembro a la Comunidad. Dale la bienvenida a Juan Agustin Gallo</span>
                  </div>  
                </div>

                <div class="post">
                  <div class="user-block">
                    <i class="fa-fw icon fa fa-check-circle user-block-icon text-success"></i>
                    <span class="username">
                      <a href="#">Nuevo Asistido</a>
                      <span href="#" class="pull-right btn-box-tool"><?php echo $m->created_at->diffForHumans() ?></span>
                    </span>
                    <span class="description"> Pepe Gomez Genero una nueva Alerta</span>
                  </div>  
                </div>

               
              </div>
              

              <div class="tab-pane" id="asistidos">
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Asistidos
                      <br><small class="text-muted">Listado de Asistidos vinculados a tu Comunidad</small>
                    </h3>

                    <table class="table table-striped table-hover" id="tableAsistidos" style="overflow-x: auto;">
                      <?php if ($comunidad->asistidos()->count() > 0): ?>
                      <?php foreach ($comunidad->asistidos as $asistido): ?>
                        <tr>
                          <td>{{$asistido->nombre}} {{$asistido->apellido}}</td>
                          <td>DNI {{$asistido->dni}}</td>
                          <td>{{(new DateTime($asistido->fechaNacimiento))->format('d/m/Y')}}</td>
                        </tr>
                      <?php endforeach ?>
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


                <table class="table table-striped table-hover" id="tableMiembros" style="overflow-x: auto;">
                  <?php if ($comunidad->users()->count() > 0): ?>
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
                      <!-- <td class="text-center">
                        <a href="javascript:void(0)" class="eliminarMiembro" data-id="{{ $usuario->id }}" data-toggle="tooltip" data-title="Eliminar Miembro"> <i class="icon fa fa-remove fa-2x fa-fw text-red"></i></a>
                      </td> -->
                    </tr>
                  <?php endforeach ?>
                  <?php endif ?>
                </table>

                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Solicitudes
                      <br><small class="text-muted">Solicitudes de adhesion pendientes</small>
                    </h3>

                  </div>
                </div>


              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="alertas">
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Alertas
                      <br><small class="text-muted">Listado de alertas compartidas con la Comunidad</small>
                    </h3>

                    <table class="table table-striped table-hover" id="tableAlertas" style="overflow-x: auto;">
                      <?php if ($comunidad->alertas()->count() > 0): ?>
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
        <h4 class="modal-title"><i class="icon fa fa-comments-o fa-fw"></i> Comunidad <small class="text-muted">NUEVO MENSAJE</small></h4>
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

</script>


@endsection
