@extends('layouts.userApp')


@section('title')
  Mi Perfil
@endsection


@section('head')
  
  <style type="text/css">
    
    img.perfil:hover {

      background-color:#000;
      opacity:0.9;
      box-shadow: 0 0 3px #000;
      cursor: pointer;
    }

  </style>

@endsection


@section('pageHeader')
<h1>
  <i class="icon fa fa-user-circle fa-fw"></i>Usuarios
  <small>Perfil</small>
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-user-circle"></i> Usuarios</a></li>
  <li class="active">Perfil 1</li>
</ol>
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue-active">
                @if(null !==(Auth::user()))
              <h5 class="widget-user-desc pull-right hidden-xs">{{ucwords(Auth::user()->nombre)}}</h5> 
                <h3 class="widget-user-username">{{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}} <small style="color: white;">(DNI {{ucwords(Auth::user()->dni)}})</small></h3>
                <h5 class="widget-user-desc hidden-xs">{{Auth::user()->email}}</h5>
                @endif
            </div>
            <div class="widget-user-image">
              <?php if (isset(Auth::user()->imagen)) { ?>
                <img class="img-circle perfil" src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" alt="User Avatar" data-toggle="tooltip" title="Editar Imagen de Perfil" style="max-height: 150px; max-width: 150px;">
              <?php } else { ?>
                <img class="img-circle perfil" src="{{ asset('/img/user160x160.png') }}" alt="User Avatar" data-toggle="tooltip" title="Editar Imagen de Perfil">
              <?php } ?>
            </div>
            
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$alertas}}</h5>
                    <span class="description-text">ALERTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$asistidos}}</h5>
                    <span class="description-text">ASISTIDOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{$consultas}}</h5>
                    <span class="description-text">CONSULTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">{{Auth::user()->comunidades->count()}}</h5>
                    <span class="description-text">COMUNIDADES</span>
                  </div>
                  <!-- /.description-block -->
                </div>

              </div>
              <!-- /.row -->
              <div class="row">
                  <div class="col-sm-6">
                    <div class="description-block">
                    <h5 class="description-header">
                      <?php if ((Auth::user()->chkFirmoAcuerdo==1)) { ?>
                        Sí <i class="icon fa fa-check-circle text-green"></i>
                      <?php } else { ?>
                        No <i class="icon fa fa-times-circle text-red"></i>
                      <?php } ?>
                      
                    </h5>
                      <span class="description-text">FIRMO ACUERDO DE CONFIDENCIALIDAD</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <div class="col-sm-6">
                    <div class="description-block">
                    <h5 class="description-header">{{Auth::user()->tipoUsuario->nombre}}</h5>
                      <span class="description-text">TIPO DE USUARIO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
              </div>
            </div>
          </div>
          <!-- /.widget-user -->

          <div class="box box-solid">
            <div class="box-body col-md-6">
              <h4><i class="fa icon fa-envelope-o"></i> Mis Suscrpciones</h4>
              <p><small class="text-muted">Al suscribirte vas a recibir notificaciones por mail de los siguientes elementos:</small></p>
              <table class="table">
          		<tr>
	          		<td>- Alertas</td>
	          		<td><input type="checkbox" name=""></td>
	          	</tr>
	          	<tr>
	          		<td>- Asistidos</td>
	          		<td><input type="checkbox" name=""></td>
	          	</tr>

	          	<tr>
	          		<td>- Comunidades</td>
	          		<td><input type="checkbox" name=""></td>
	          	</tr>

	          	<tr>
	          		<td>- Solicitudes</td>
	          		<td><input type="checkbox" name=""></td>
	          	</tr>

	          	<tr>
	          		<td>- Donaciones</td>
	          		<td><input type="checkbox" name=""></td>
	          	</tr>

	          </table>
            
            </div>
          </div>

          <div class="box box-solid">
            <div class="box-body col-md-6">
              <h4><i class="fa icon fa-users"></i> Mis Comunidades <span><small class="text-muted"> ¿Querés formar parte de una comunidad?<a href="#" data-toggle="modal" data-target="#modal-sumate"> UNITE!</a></small></span></h4>
              <h5>
                <?php foreach ($misComunidades as $comunidad): ?>
                  <p><span class="label label-default"><?php echo strtoupper($comunidad->nombre) ?></span></p>
                <?php endforeach ?>
              </h5>
            </div>
          </div>


        </div>
</div>

<div class="modal fade in" id="modal-imagen">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa icon fa-edit"></i> Actualizar Imagen</h4>
      </div>
      
      <form class="form-horizontal" method="POST" action="{{ route('user.updateImage') }}" id="formNuevoAsistido" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          
          <p class="text-center">

          @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')

            <img class="img-thumbnail" id="nueva-imagen" src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" alt="User Image" data-toggle="tooltip" title="Editar Imagen de Perfil" style="max-height: 150px; max-width: 150px;">

          @else

            <img class="img-thumbnail" id="nueva-imagen" src="{{asset('img/user160x160.png')}}" alt="Default" style="max-height: 150px; max-width: 150px;">

          @endif
          </p>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="foto"></label>
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <div class="col-sm-10">
              <input type="file" accept="image/*" id="foto" name="foto" required>
              <p class="help-block">Seleccione un archivo para reemplazar la foto.<br> <small>Admite jpg, jpeg, png, gif (Max 1000px)</small></p>
            </div>
          </div>



        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" type="submit">Actualizar</button>
        </div>
      </form>

    </div>
  </div>
</div>
  

   {{-- Modal para sumarte --}}
    <div class="modal fade" id="modal-sumate">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="icon fa fa-user-plus"></i> Sumate </h4>
          </div>
          
          <div class="modal-body">
            
            <h5>Pedile a un Coordinador que te agregue a la Comunidad.</h5>
            <h5>Una vez que se apruebe tu solicitud vas a poder compartir tu actividad con los miembros de tu Comunidad</h5>
            <hr>

            <select class="form-control editable selectComunidad select2" name="comunidad_id" style="width: 100%;">      
              <?php $institucion = 0; ?>
              <option disabled selected value> Seleccionar ... </option>
              <?php foreach ($comunidades as $comunidad): ?>  

                <?php if ($institucion != $comunidad->institucion_id): ?>
                  <optgroup label=" - {{$comunidad->institucion->nombre}}"></optgroup>
                  <?php $institucion = $comunidad->institucion_id ?>
                <?php endif ?>

                <option value="{{$comunidad->id}}"> <?php echo $comunidad->nombre ?></option>
              
              <?php endforeach ?>
            </select>
            <p class="help-block">Selecciona una Comunidad</p>
            
            <br>
            <button class="btn btn-light sr-button btnCreative btnSolicitud" style="background-color: #e5e5e5;">Enviar Solicitud</button>  

          </div>
          
        </div>
      </div>
    </div>
  


@endsection


@section('scripts')

<script type="text/javascript">
  
  $('.perfil').click(function () {

    $('#modal-imagen').modal('show');
  });

  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {

        $('#nueva-imagen').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto").change(function() {
    readURL(this);
  });

  $('.btnSolicitud').click(function(){
    
    var comunidad = $(".select2 option:selected").val();

    $('#modal-sumate').modal('hide');
    
    if (jQuery.isNumeric(comunidad)) {
      
      console.log(comunidad); 
      
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
@endsection
