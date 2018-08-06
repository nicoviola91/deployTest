@extends('layouts.adminApp')


@section('title')
	Perfil
@endsection


@section('head')


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
	            <h5 class="widget-user-desc pull-right hidden-xs">{{ucwords($user->descripcion)}}</h5>	
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
                    <h5 class="description-header">{{($user->firmoAcuerdo==1) ? 'Sí':'No'}}</h5>
                      <span class="description-text">FIRMO ACUERDO DE CONFIDENCIALIDAD</span>
                      @endif
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <div class="col-sm-6">
                    <div class="description-block">
                      @if($user!=null)
                    <h5 class="description-header">{{$user->tipoUsuario->descripcion}}</h5>
                    @endif
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
              <h4><i class="fa icon fa-users"></i> 
                Comunidades 
                <span class="badge bg-teal btnAgregarComunidad" style="cursor: pointer;"> <i class="icon fa fa-plus"></i> Agregar</span> 
              </h4>
              <h5>
                <?php foreach ($user->comunidades as $comunidad): ?>
                  <span class="label label-default"><?php echo strtoupper($comunidad->nombre) ?></span>
                <?php endforeach ?>
              </h5>
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
              <select class="form-control" name="comunidad_id" id="comunidad_id" required placeholder="Seleccionar ...">

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
	
  $(".btnAgregarComunidad").click(function () {

      console.log('agregarComunidad');
      $('#modal-comunidad').modal('show');

    });
	
</script>

@endsection
