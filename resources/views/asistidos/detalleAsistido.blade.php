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
				<img class="profile-user-img img-responsive img-circle" src="{{asset('img/user160x160.png')}}" alt="User profile picture">
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
					@if((($asistido->checkFichaSaludMental)==0) && (($asistido->checkFichaNecesidad)==0) && (($asistido->checkFichaMedica)==0) 
					&& (($asistido->checkFichaLocalizacion)==0) && (($asistido->checkFichaFamiliaAmigos)==0) && (($asistido->checkFichaEmpleo)==0)
					&& (($asistido->checkFichaEducacion)==0) && (($asistido->checkFichaDiagnosticoIntegral)==0) && (($asistido->checkFichaDatosPersonales)==0)
					&& (($asistido->checkFichaAsistenciaSocial)==0) && (($asistido->fichaAdiccion)==0))
					<dd>El asistido aún no tiene fichas vinculadas.</dd>
					<br>
					@endif
					@if(($asistido->checkFichaAdicciones)==1)
					<dd><a href="{{route('fichaAdicciones.create',['asistido_id'=>$asistido->id])}}">Ficha de Adicciones</a></dd>
					@else
					<dd>
						<div class="col-md-4">
						<a href="{{route('fichaAdicciones.create',['asistido_id'=>$asistido->id]) }}" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
									<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Adicciones
						</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaAsistenciaSocial)==1)
					<dd><a href="{{route('fichaAsistenciaSocial.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue'>Ficha de Asistencia Social</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<a href="{{route('fichaAsistenciaSocial.create',['id'=>$asistido->id])}}" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha Asistencia Social
								</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaDatosPersonales)==1)
				<dd href="{{route('fichaDatosPersonales.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue'>Ficha de Datos Personales</dd>
					@else
					<dd>
						<div class="col-md-4">
								<a href="{{route('fichaDatosPersonales.create',['id'=>$asistido->id])}}" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Datos Personales
								</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaDiagnosticoIntegral)==1)
					@else
					<dd><a href="#" class='text-light-blue'>Ficha de Diagnóstico Integral</a></dd>
					<dd>
						<div class="col-md-4">
								<button type="button" class="btn btn-block btn-default btn-sm">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Diagnóstico Integral
								</button>
						</div>
					<dd>
					@endif
					<br>
					@if(($asistido->checkFichaEducacion)==1)
					<dd><a href="{{route('fichaEducacion.create',['asistido_id'=>$asistido->id]) }}" class='text-light-blue' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title=" Ficha de Educación">Ficha de Educación</a></dd>
					@else
					<dd>
						<div class="col-md-4">
							<a href="{{route('fichaEducacion.create',['asistido_id'=>$asistido->id]) }}" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha de Educación">
								<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Educación
							</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaEmpleo)==1)
					<dd><a href="{{route('fichaEmpleo.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue'>Ficha de Empleo</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								<a href="{{route('fichaEmpleo.create',['asistido_id'=>$asistido->id])}}" class='btn btn-block btn-default btn-sm' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Empleo">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Empleo
								</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaFamiliaAmigos)==1)
				<dd><a href="{{route('fichaFamiliaAmigos.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Familia Amigos">Familia Amigos</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								
								<a href="{{route('fichaFamiliaAmigos.create',['asistido_id'=>$asistido->id])}}" class='btn btn-block btn-default btn-sm' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Familia Amigos">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Familia y Amigos
								</a>
							
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaLegal)==1)
					<dd><a href="{{route('fichaLegal.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Legal">Ficha Legal</a></dd>
					@else
					<dd>
						<div class="col-md-4">
								
								<a href="{{route('fichaLegal.create',['asistido_id'=>$asistido->id])}}" class='btn btn-block btn-default btn-sm' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Legal">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha Legal
								</a>
							
						</div>
					</dd>
					@endif
					<br>

					@if(($asistido->checkFichaLocalizacion)==1)
					<dd><a href="#" class='text-light-blue'>Ficha de Localización</a></dd>
					@else

					<dd>
						<div class="col-md-4">
								<a href="{{route('FichaLocalizacion.create',['asistido_id'=>$asistido->id])}}" class='btn btn-block btn-default btn-sm' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Localización">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Localización
								</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaMedica)==1)
					<dd><a href="#" class='text-light-blue'>Ficha Médica</a></dd>
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
					@if(($asistido->checkFichaNecesidad)==1)
					<dd>
							<a href="{{route('fichaNecesidades.create',['asistido_id'=>$asistido->id])}}" class='text-light-blue'>Ficha Necesidades</a>
					</dd>
					@else
					<dd>
						<div class="col-md-4">
								<a href="{{route('fichaNecesidades.create',['asistido_id'=>$asistido->id])}}" class='btn btn-block btn-default btn-sm' data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Necesidad">
										<i align="left" class="fa fa-plus-square"></i> Añadir Ficha de Necesidades
								</a>
						</div>
					</dd>
					@endif
					<br>
					@if(($asistido->checkFichaSaludMental)==1)
					<dd><a href="#" class='text-light-blue'>Ficha de Salud Mental</a></dd>
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