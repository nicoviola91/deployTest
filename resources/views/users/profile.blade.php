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
	            <h5 class="widget-user-desc pull-right hidden-xs">{{ucwords(Auth::user()->descripcion)}}</h5>	
              	<h3 class="widget-user-username">{{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}} <small style="color: white;">(DNI {{ucwords(Auth::user()->dni)}})</small></h3>
              	<h5 class="widget-user-desc hidden-xs">{{Auth::user()->email}}</h5>
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
                    <span class="description-text">INTERACCIONES</span>
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
