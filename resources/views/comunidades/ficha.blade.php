
@extends(true ? 'layouts.adminApp' : 'layouts.adminApp')

@section('title')
	Ficha
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
	<i class="icon fa fa-users fa-fw"></i> Detalle de Comunidad
	<small> {{ ucwords($comunidad->nombre) }} </small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Instituciones</a></li>
	<li class="active"># {{ ucwords($comunidad->id) }}</li>
</ol>
@endsection

@section('content')

<style type="text/css">
  
    a:hover + span {
      display: block;
    }

    .liTab {

      min-width: 80px !important;
      text-align: center !important;
    }

    .tab-pane {

      min-height: 300px !important;
    }

    .pac-container {

      z-index: 99999;
    }
    
    .preventoverflow{
      
      white-space: normal;
      overflow: hidden;
      text-overflow: ellipsis
    }

    img.perfil:hover {

      background-color:#000;
      opacity:0.6;
      cursor: pointer;
    }

</style>

<div class="row">
<div class="col-md-12">

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
					 
      <div class="nav-tabs-custom">
        

        <div class="box box-widget widget-user-2" style="margin-bottom: 5px;">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-primary">
            
            <h3 class="widget-user-username" style="margin-left: 10px !important;">
              {{ ucwords($comunidad->nombre) }}
              <span class="pull-right">
                <small style="color: white !important;"> Creado {{ $comunidad->created_at->format('M y') }}</small>
              </span>
            </h3>
            <h5 class="widget-user-desc" style="margin-left: 10px !important;">{{ strtoupper($comunidad->tipo) }}</h5>
          </div>
          
          <div class="box-body">

            <h4>
              <i class="fa icon fa-bank fa-fw"></i> Institución
              <span class="">
                <small class="text-muted">
                  {{ strtoupper($comunidad->institucion->nombre) }}
                </small>
              </span>           
            </h4>
            <br>
            
            <h4>
              <i class="fa icon fa-user-circle fa-fw"></i> Miembros
              <span class=""><small class="text-muted">(<span id="countMiembros">{{ $comunidad->users()->count() }}</span>)</small></span>
            </h4>
            <table class="table table-striped table-hover" id="tableMiembros" style="overflow-x: auto;">
              <?php if ($comunidad->users()->count() > 0): ?>
              <?php foreach ($comunidad->users as $usuario): ?>
                <tr id="miembro{{$usuario->id}}">
                  <td>{{$usuario->name}} {{$usuario->apellido}} <small class="text-muted">(DNI {{$usuario->dni}})</small></td>
                  <td class="text-center hidden-xs">{{$usuario->email}}</td>
                  <td class="text-center">
                    <a href="javascript:void(0)" class="eliminarMiembro" data-user="{{$usuario->id}}" data-comunidad="{{$comunidad->id}}" data-toggle="tooltip" data-title="Eliminar Miembro"> <i class="icon fa fa-remove fa-2x fa-fw text-red"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
              <?php endif ?>
            </table>
            <br>
            
            <h4>
              <i class="fa icon fa-user-plus fa-fw"></i> Solicitudes Pendientes
              <span class=""><small class="text-muted">(<span id="countSolicitudes">{{ $comunidad->solicitudes()->count() }}</span>)</small></span>
            </h4>
            <table class="table table-striped table-hover" style="overflow-x: auto;">
              <?php if ($comunidad->solicitudes()->count()): ?>
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
              <?php endif ?>
            </table>
            <br>

            <h4>
              <i class="fa icon fa-user fa-fw"></i> Asistidos
              <span class=""><small class="text-muted">({{ $comunidad->asistidos()->count() }})</small></span>           
            </h4>
            
            <br>
            <h4>
              <i class="fa icon fa-folder-open-o fa-fw"></i> Datos Básicos
              <span class="pull-right"><small class="text-muted">Actualizado {{ $comunidad->updated_at->diffForHumans() }}</small></span>              
            </h4>
            <form id="nuevaInstitucion-form" method="POST" action="{{ url('/comunidad/update') }}">
      
           {{ csrf_field() }}
        
        <div class="box-body">

          <div class="col-md-6 form-group {{ $errors->has('institucion_id') ? ' has-error' : '' }}">
                <label for="nombre">Institución</label>
                <select class="form-control" name="institucion_id" id="institucion_id">
                  
                  <?php foreach ($instituciones as $i): ?>
                    <option value="{{$i->id}}" <?php echo $i->id == $comunidad->institucion_id ? ' selected ' : '' ?>> {{strtoupper($i->tipo)}} - {{$i->nombre}}</option>
                  <?php endforeach ?>
                </select>
                @if ($errors->has('institucion_id'))
                  <span class="help-block">
                      <strong>{{ $errors->first('institucion_id') }}</strong>
                  </span>
                @endif
              </div>

              <div class="col-md-6 form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                <label for="nombre">Tipo</label>
                <select class="form-control" name="tipo" id="tipo">
                  <option value="nocheDeCaridad" <?php echo 'nocheDeCaridad' == $comunidad->tipo ? ' selected ' : '' ?>>Noche De Caridad</option>
                  <option value="institucion" <?php echo 'institucion' == $comunidad->tipo ? ' selected ' : '' ?>>Comunidad Externa</option>
                </select>
                @if ($errors->has('tipo'))
                  <span class="help-block">
                      <strong>{{ $errors->first('tipo') }}</strong>
                  </span>
                @endif
              </div>

          <div class="col-md-12 form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required value="{{$comunidad->nombre}}">
                <input type="hidden" required value="{{$comunidad->id}}" name="id" id="id">
                @if ($errors->has('nombre'))
                  <span class="help-block">
                      <strong>{{ $errors->first('nombre') }}</strong>
                  </span>
                @endif
              </div>
            
              <div class="col-md-12 form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
                <label for="observaciones">Observaciones</label>
                <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones" value="{{$comunidad->observaciones}}">
                @if ($errors->has('observaciones'))
                  <span class="help-block">
                      <strong>{{ $errors->first('observaciones') }}</strong>
                  </span>
                @endif
              </div>
        </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Actualizar Datos Basicos</button>
                </div>

              </form>

          </div>

        </div>





      </div>
	

</div>
</div>


	
@endsection


@section('scripts')

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
        $('#countSolicitudes').html($('#countSolicitudes').html()-1);

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

        //tr.remove();

        $('#countSolicitudes').html($('#countSolicitudes').html()-1);
        $('#countMiembros').html(parseInt($('#countMiembros').html())+1.0);

      } else {

        loading.modal('hide');
        lanzarAlerta('peligro', datos.msg);
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
        $('#countMiembros').html(parseInt($('#countMiembros').html())-1.0);
        
      } else {

        console.log(datos.msg);
        lanzarAlerta('peligro', datos.msg);
      }

      });

    });


  </script>


@endsection
