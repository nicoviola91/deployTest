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
	<div class="col-md-10 col-md-offset-1">
		<div class="box box-primary">
			<div class="box-body box-profile">
				<img class="profile-user-img img-responsive img-circle" src="http://www.styletextile.com/wp-content/uploads/2017/10/profile.jpg" alt="User profile picture">
				<h3 class="profile-username text-center">{{$asistido->nombre}}</h3>
				<h3 class="profile-username text-center">{{$asistido->apellido}}</h3>
				<dl class="dl-horizontal">
					@if(isset($asistido->fechaNacimiento))
					<dt>Fecha de nacimiento</dt>
					<dd>{{$asistido->fechaNacimiento}}</dd>
					@endif
					@if(isset($asistido->dni))
					<dt>DNI</dt>
					<dd>{{$asistido->dni}}</dd>
					@endif
					@if(isset($asistido->direccion))
					<dt>Dirección</dd>
					<dd>{{$asistido->direccion}}</dd>
					@endif
					@if(isset($asistido->direccion))
					<dt>Observaciones</dd>
					<dd>{{$asistido->observaciones}}</dd>
					@endif
					<dt>Fichas disponibles</dd>
					@if(count($asistido->fichaAdiccion))
					<dd href="#">Adiccion</dd>
					@endif
					@if(count($asistido->fichaAsistenciaSocial))
					<dd href="#">Asistencia Social</dd>
					@endif
					@if(count($asistido->fichaDatosPersonales))
					<dd href="#">Datos Personales</dd>
					@endif
					@if(count($asistido->fichaDiagnosticoIntegral))
					<dd href="#">Diagnostico Integral</dd>
					@endif
					@if(count($asistido->fichaEducacion))
					<dd href="#">Educación</dd>
					@endif
					@if(count($asistido->fichaEmpleo))
					<dd href="#">Empleo</dd>
					@endif
					@if(count($asistido->fichaFamiliaAmigos))
					<dd href="#">Familia Amigos</dd>
					@endif
					@if(count($asistido->fichaLocalizacion))
					<dd href="#">Localizacion</dd>
					@endif
					@if(count($asistido->fichaMedica))
					<dd href="#">Médica</dd>
					@endif
					@if(count($asistido->fichaNecesidad))
					<dd href="#">Necesidades</dd>
					@endif
					@if(count($asistido->fichaSaludMental))
					<dd href="#">Salud Mental</dd>
					@endif


					@if((count($asistido->fichaSaludMental)==0) && (count($asistido->fichaNecesidad)==0) && (count($asistido->fichaMedica)==0) 
					&& (count($asistido->fichaLocalizacion)==0) && (count($asistido->fichaFamiliaAmigos)==0) && (count($asistido->fichaEmpleo)==0)
					&& (count($asistido->fichaEducacion)==0) && (count($asistido->fichaDiagnosticoIntegral)==0) && (count($asistido->fichaDatosPersonales)==0)
					&& (count($asistido->fichaAsistenciaSocial)==0) && (count($asistido->fichaAdiccion)==0))
					<dd>El asistido aún no tiene fichas vinculadas.</dd>
					@endif
				</dl>
			
			</div>
		</div>
	</div>
</div>	
@endsection