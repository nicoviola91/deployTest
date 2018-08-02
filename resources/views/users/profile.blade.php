@extends('layouts.adminApp')


@section('title')
	Usuarios
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
	            <h5 class="widget-user-desc pull-right hidden-xs">{{ucwords(Auth::user()->descripcion)}}</h5>	
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
                    <h5 class="description-header">200</h5>
                    <span class="description-text">ALERTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">110</h5>
                    <span class="description-text">ASISTIDOS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3 border-right">
                  <div class="description-block">
                    <h5 class="description-header">35</h5>
                    <span class="description-text">CONSULTAS</span>
                  </div>
                  <!-- /.description-block -->
                </div>

                <div class="col-sm-3">
                  <div class="description-block">
                    <h5 class="description-header">3</h5>
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
                    <h5 class="description-header">{{Auth::user()->tipoUsuario->descripcion}}</h5>
                      <span class="description-text">TIPO DE USUARIO</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
              </div>
            </div>
          </div>
          <!-- /.widget-user -->
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

</script>
@endsection
