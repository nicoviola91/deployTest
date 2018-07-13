@extends('layouts.adminApp')


@section('title')
	Asistidos
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
	Asistidos
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Asistidos</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">
		
		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-asistidos">
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
				@if (isset($asistidos) && count($asistidos))
					@foreach($asistidos as $asistido)
					<tr>
						
					<td class="text-center" style="vertical-align: middle;">{{$asistido->id}}</td>
						<td class="text-center" style="vertical-align: middle;">{{$asistido->nombre}}</td>
						<td class="text-center" style="vertical-align: middle;">{{$asistido->apellido}}</td>
						<td class="text-center" style="vertical-align: middle;">{{$asistido->dni}}</td>
						<td class="text-center" style="vertical-align: middle;">{{$asistido->createdBy}}</td>
						<td class="text-center" style="vertical-align: middle;">{{$asistido->created_at}}</td>
						<td class="text-center" style="vertical-align: middle;"> 
						<a href="{{route('asistido.show2',['id'=>$asistido->id])}}" class="altaBtn" data-id="100" title="Ver detalles del asistido." data-toggle="tooltip" data-title="Ver Perfil"><i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a> 
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

	    $('#tabla-asistidos').DataTable({
	      'paging'      : true,
	      'lengthChange': true,
	      'searching'   : true,
	      'ordering'    : true,
	      'info'        : true,
	      'autoWidth'   : false,
	      'pageLength'	: 50,

	      	"oLanguage": {
				"sEmptyTable": "No hay datos disponibles para la tabla.",
				"sLengthMenu": "Mostrar _MENU_ filas",
				"sSearch": "Buscar:",
				"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ filas",
				"oPaginate": {
					"sPrevious": "Anterior",
					"sNext": "Siguiente"
				}
			}
	    });
  });

</script>

@endsection
