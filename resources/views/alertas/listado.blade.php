@extends('layouts.adminApp')


@section('title')
	Alertas
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	Alertas
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Alertas</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-alertas">
			
			<thead>
				<tr style="background-color: #f4f4f4;">
					<th rowspan="2" class="text-center" style="vertical-align: middle;">#</th>
					<th class="text-center" colspan="3">Asistido</th>
					<th class="text-center" colspan="2">Creada</th>
					<th rowspan="2" class="text-center" style="vertical-align: middle;"> Acciones</th>
				</tr>
				<tr style="background-color: #f4f4f4;">
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Documento</th>
					<th class="text-center" >Usuario</th>
					<th class="text-center">Fecha</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($alertas) && count($alertas))

					@foreach ($alertas as $alerta)
					    
					    <tr>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->nombre }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->apellido }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->dni }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->user_id }} 
								@if (isset($alerta->lat) && isset($alerta->lng))
								<span class="pull-right"> 
									<a href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}" target="_blank"><i class="icon fa fa-map-pin fa-fw"></i></a>
								</span>
								@endif
							</td>
							<td class="text-center" style="vertical-align: middle;">{{ $alerta->created_at }}</td>
							<td class="text-center" style="vertical-align: middle;"> 
								<a href="{{ route('asistido.new') }}" class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
								<a href="#" class="descartarBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a></td>
						</tr>

					@endforeach

			    @endif

			</tbody>

		</table>
		</div>

	</div>
</div>
</div>
	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$(function () {

	    console.log('hola');

	    $('#tabla-alertas').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false
	    });
  });

</script>

@endsection
