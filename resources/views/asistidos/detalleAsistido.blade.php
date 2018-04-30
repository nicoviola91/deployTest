@extends('layouts.adminApp')


@section('title')
	Detalle Asistido
@endsection

@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<!-- <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->

@endsection

@section('pageHeader')
<h1>
	Detalle de asistido
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Asistidos</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">

	<!-- Profile Image -->
	<div class="box box-primary">
		<div class="box-body box-profile">
		<img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

		<h3 class="profile-username text-center">{{$asistido->nombre}}</h3>
		<h3 class="profile-username text-center">{{$asistido->apellido}}</h3>

		<ul class="list-group list-group-unbordered">
			<li class="list-group-item">
			<b>Fecha de nacimiento</b> <a class="pull-center">{{$asistido->fechaNacimiento}}</a>
			</li>
			@if(isset($asistido->dni))
			<li class="list-group-item">
			<b>DNI</b> <a class="pull-center">{{$asistido->dni}}</a>
			</li>
			@endif
			@if(isset($asistido->direccion))
			<li class="list-group-item">
			<b>Dirección</b> <a class="pull-right">{{$asistido->direccion}}</a>
			</li>
			@endif
		</ul>

		<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->
</div>
@endsection