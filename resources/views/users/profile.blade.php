@extends('layouts.adminApp')


@section('title')
	Usuario
@endsection


@section('head')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/select2/select2.min.css') }}">
<script src="{{ asset('/select2/select2.full.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-user-circle fa-fw"></i>Usuarios
	<small>Perfil</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{route('user.list')}}"><i class="fa fa-user-circle"></i> Usuarios</a></li>
	<li class="active">Perfil </li>
</ol>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-blue-active">
                @if(null !==$user)
	            <h5 class="widget-user-desc pull-right hidden-xs">{{ucwords($user->nombre)}}</h5>	
              	<h3 class="widget-user-username">{{ucwords($user->name)}} {{ucwords($user->apellido)}} <small style="color: white;">(DNI {{ucwords($user->dni)}})</small></h3>
                <h5 class="widget-user-desc hidden-xs">{{$user->email}}</h5>
                @endif
            </div>
            <div class="widget-user-image">

              <?php if (isset($user->imagen)) { ?>
                <img class="img-circle perfil" src="<?php echo asset("storage") . '/' . $user->imagen ?>" alt="User Avatar" data-toggle="tooltip" title="" style="max-height: 150px; max-width: 150px;">
              <?php } else { ?>
                <img class="img-circle perfil" src="{{ asset('/img/user160x160.png') }}" alt="User Avatar" data-toggle="tooltip" title="">
              <?php } ?>
            </div>
            
            <div class="box-footer">
              
              <!-- /.row -->
              <div class="row">
                  <div class="col-sm-6">
                    <div class="description-block">
                        @if($user!=null)
                    <h5 class="description-header">{{($user->chkFirmoAcuerdo==1) ? 'Sí':'No'}}</h5>
                      <span class="description-text">FIRMO ACUERDO DE CONFIDENCIALIDAD</span>
                      @endif
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <div class="col-sm-6">
                    <div class="description-block">
                      @if($user!=null)
                    <h5 class="description-header">{{$user->tipoUsuario->nombre}}</h5>
                    @endif
                      <span class="description-text">TIPO DE USUARIO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
              </div>
            </div>
          </div>
          <!-- /.widget-user -->
    </div>

    
  <div class="col-md-6">
	  <div class="box box-solid col-md-6">
        <div class="box-body">
          <h4><i class="fa icon fa-user-circle-o"></i> 
            Datos de la Cuenta
            <span class="pull-right btn btn-default btn-sm btn-editar"><i class="icon fa fa-edit"></i> EDITAR</span>
          </h4>
          
          <form class="form" method="POST" action="{{route('user.update', ['id' => $user->id])}}">
          <div class="box-body">
              {{ csrf_field() }}

              <strong class="col-md-12"><i class="fa fa-user-secret margin-r-5"></i> Permisos</strong>

              <div class="form-group col-md-6">
              	<select class="form-control editable" required name="tipoUsuario_id" id="tipoUsuario_id" disabled readonly>
              		  
                    <?php foreach ($tiposUsuario as $tipo): ?>
                      
                      <option <?php echo ($user->tipoUsuario_id == $tipo->id) ? ' selected ' : '' ?> value="{{$tipo->id}}" data-descripcion="{{$tipo->descripcion}}" data-slug="{{$tipo->slug}}"> <?php echo $tipo->nombre ?></option>                          
                    <?php endforeach ?>
              	
                </select>
              	<p class="help-block">Tipo de Usuario</p>
              </div>

              <div class="form-group col-md-6 text-center">
              	<label class="inline-checkbox"><input type="checkbox" class="checkbox editable" name="firmoAcuerdo" value="1" <?php echo $user->chkFirmoAcuerdo ? 'checked' : '' ?> disabled readonly></label>
              	<p class="help-block">Acuerdo de Confidencialidad</p>
              </div>

              <div class="col-md-12">
              	<!-- <i class="fa icon fa-chevron-right fa-fw"></i> --> <strong>Descripción:</strong><br>
                <span id="descripcionTipo"><?php echo $user->tipoUsuario->descripcion ?></span>
              </div>

              <hr class="col-md-12 administraComunidad" style="display: none;">

              <strong class="col-md-12 administraComunidad" style="display: none;"><i class="fa fa-users margin-r-5"></i> Comunidad que Administra</strong>
              <div class="col-md-12 administraComunidad" style="display: none;">
              <p>
                <div class="form-group">
                	<select class="form-control editable selectComunidad" name="comunidad_id" disabled readonly style="width: 100%;">
                		
                    <?php $institucion = 0; ?>
                    <option disabled selected value> Seleccionar ... </option>
                    <?php foreach ($comunidades as $comunidad): ?>  

                      <?php if ($institucion != $comunidad->institucion_id): ?>
                        <optgroup label=" - {{$comunidad->institucion->nombre}}"></optgroup>
                        <?php $institucion = $comunidad->institucion_id ?>
                      <?php endif ?>

                      <option <?php echo ($user->comunidad_id == $comunidad->id) ? ' selected ' : '' ?> value="{{$comunidad->id}}"> <?php echo $comunidad->nombre ?></option>
                    
                    <?php endforeach ?>
                	</select>
                </div>
              </p>
              </div>

              <hr class="col-md-12 administraInstitucion" style="display: none;">

              <strong class="col-md-12 administraInstitucion" style="display: none;"><i class="fa fa-bank margin-r-5"></i> Institución que Administra</strong>
              <div class="col-md-12 administraInstitucion" style="display: none;">
              <p>
                <div class="form-group">
                	<select class="form-control editable selectInstitucion" name="institucion_id" disabled readonly style="width: 100%;">
                		
                    <option disabled selected value> Seleccionar ... </option>
                    <?php foreach ($instituciones as $institucion): ?>  
                      <option <?php echo ($user->institucion_id == $institucion->id) ? ' selected ' : '' ?> value="{{$institucion->id}}"> <?php echo $institucion->nombre ?></option>
                    <?php endforeach ?>

                	</select>
                </div>
              </p>
              </div>

            </div>
            <div class="box-footer divActualizar" style="display: none;">
              <button type="submit" class="btn btn-primary pull-right actualizarBtn">Actualizar</button>
            </div>
            </form>

        </div>
  	  </div>
  	</div>

  	<div class=" col-md-6">
  	<div class="box box-solid">
        <div class="box-body">
          <h4><i class="fa icon fa-users"></i> 
            Comunidades 
            <span class="badge bg-teal btnAgregarComunidad pull-right" style="cursor: pointer;"> <i class="icon fa fa-plus"></i> Agregar</span> 
          </h4>
          <h5>
            <?php foreach ($user->comunidades as $comunidad): ?>
              <a style="margin: 10px;"><span class="label label-default"><?php echo strtoupper($comunidad->nombre) ?></span></a>
            <?php endforeach ?>
          </h5>
        </div>
  	</div>
  	</div>

  	<div class=" col-md-6">
  	<div class="box box-solid">
        <div class="box-body">
          <h4><i class="fa icon fa-envelope-o"></i> 
            Suscripciones 
          </h4>
          
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
          		<td>- Comunidad</td>
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
  	</div>
        
</div>




<div class="modal fade in" id="modal-comunidad">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa icon fa-users"></i> Agregar a Comunidad</h4>
      </div>
      
      <form class="form-horizontal" method="POST" action="{{ route('user.agregarComunidad') }}" id="formNuevoAsistido" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
    
          <div class="form-group">
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="col-sm-12">
              <select class="form-control" name="comunidad_id" required placeholder="Seleccionar ...">

                <?php $institucion = 0 ?>
                <option disabled selected value> Seleccionar ... </option>

                <?php foreach ($comunidades as $comunidad): ?>  

                  <?php if ($institucion != $comunidad->institucion_id): ?>
                    <optgroup label=" - {{$comunidad->institucion->nombre}}"></optgroup>
                    <?php $institucion = $comunidad->institucion_id ?>
                  <?php endif ?>

                  <option value="{{$comunidad->id}}"> <?php echo $comunidad->nombre ?></option>
                
                <?php endforeach ?>
              </select>
              <p class="help-block">Seleccioná una comunidad</p>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" type="submit">Agregar</button>
        </div>
      </form>

    </div>
  </div>
</div>

	
@endsection


@section('scripts')

<script type="text/javascript">
	
  $('.select2').select2();

  $(".btnAgregarComunidad").click(function () {

    $('#modal-comunidad').modal('show');

  });

  $("#tipoUsuario_id").change(function () {

    descripcion = $(this).find(':selected').data('descripcion');
    slugTipo = $(this).find(':selected').data('slug');
    $('#descripcionTipo').html(descripcion);

    if (slugTipo == 'coordinador') {

      $('.administraComunidad').show();
      $('.administraInstitucion').hide();

      $('.selectComunidad').attr('disabled', false);
      $('.selectInstitucion').attr('disabled', true);

      $('.selectComunidad').attr('required', true);
      $('.selectInstitucion').attr('required', false);

    } else if (slugTipo == 'posadero') {

      $('.administraInstitucion').show();
      $('.administraComunidad').hide();

      $('.selectComunidad').attr('disabled', true);
      $('.selectInstitucion').attr('disabled', false);

      $('.selectComunidad').attr('required', false);
      $('.selectInstitucion').attr('required', true);

    } else {

      $('.administraInstitucion').hide();
      $('.administraComunidad').hide();

      $('.selectComunidad').attr('disabled', true);
      $('.selectInstitucion').attr('disabled', true);

      $('.selectComunidad').attr('required', false);
      $('.selectInstitucion').attr('required', false);

    }

  });

  $(".btn-editar").click(function () {

    $('.editable').attr('readonly', false);
    $('.editable').attr('disabled', false);

    $(this).hide();
    $('.divActualizar').show();

  });

  $(".actualizarBtn").click(function () {


  });

  $(function() {
    
    slugTipo = '<?php echo $user->tipoUsuario->slug ?>';
    
    if (slugTipo == 'coordinador')  {
      $('.administraComunidad').show();
    } else if (slugTipo == 'posadero') {
      $('.administraInstitucion').show();
    }

  });
	
</script>

@endsection
