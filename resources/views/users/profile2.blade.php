@extends('layouts.adminApp')


@section('title')
	Usuarios
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
              <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Avatar">
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
        </div>
</div>
	
@endsection


@section('scripts')

<script type="text/javascript">
	
	
</script>

@endsection
