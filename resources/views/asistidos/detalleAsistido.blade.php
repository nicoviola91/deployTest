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
				<dl class="dl-horizontal" >
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
					@if((count($asistido->fichaSaludMental)==0) && (count($asistido->fichaNecesidad)==0) && (count($asistido->fichaMedica)==0) 
					&& (count($asistido->fichaLocalizacion)==0) && (count($asistido->fichaFamiliaAmigos)==0) && (count($asistido->fichaEmpleo)==0)
					&& (count($asistido->fichaEducacion)==0) && (count($asistido->fichaDiagnosticoIntegral)==0) && (count($asistido->fichaDatosPersonales)==0)
					&& (count($asistido->fichaAsistenciaSocial)==0) && (count($asistido->fichaAdiccion)==0))
					<dd>El asistido aún no tiene fichas vinculadas.</dd>
					<br>
					@endif
					@if(count($asistido->fichaAdiccion))
					<dd href="#">Adiccion</dd>
					@else
					<dd>
						<div class="col-md-4">
							<button type="button" class="btn btn-block btn-default btn-sm">
									<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Adicciones
							</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaAsistenciaSocial))
					<dd><a href="#" class='text-light-blue'>Asistencia Social</a></dd>
					@else
					<dd>
						<div class="col-md-4">
							<button type="button" class="btn btn-block btn-default btn-sm">
									<i align="left" class="fa fa-plus-square"></i> Añadir Ficha Asistencia Social
							</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaDatosPersonales))
					<dd href="#" class='text-light-blue'>Datos Personales</dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Datos Personales
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaDiagnosticoIntegral))
					<dd><a href="#" class='text-light-blue'>Diagnostico Integral</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Diagnóstico Integral
								</button>
						</div>
					<dd>
					@endif
					<br>
					@if(count($asistido->fichaEducacion))
					<dd><a href="#" class='text-light-blue'>Educación</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Educación
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaEmpleo))
					<dd><a href="#" class='text-light-blue'>Empleo</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Empleo
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaFamiliaAmigos))
					<dd><a href="#" class='text-light-blue'>Familia Amigos</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Familia y Amigos
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaLocalizacion))
					<dd><a href="#" class='text-light-blue'>Localizacion</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Localización
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaMedica))
					<dd><a href="#" class='text-light-blue'>Médica</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha Médica
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaNecesidad))
					<dd><a href="#" class='text-light-blue'>Necesidades</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Necesidades
								</button>
						</div>
					</dd>
					@endif
					<br>
					@if(count($asistido->fichaSaludMental))
					<dd><a href="#" class='text-light-blue'>Salud Mental</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Salud Mental
								</button>
						</div>
					</dd>
					@endif
					<br>
				</dl>
			</div>
		</div>
	</div>
</div>	
@endsection