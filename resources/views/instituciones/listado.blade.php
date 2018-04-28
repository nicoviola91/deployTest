@extends('layouts.adminApp')


@section('title')
	Instituciones
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-bank fa-fw"></i>Instituciones
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user-circle"></i> Instituciones</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-instituciones">
			
			<thead>
				
				<tr style="background-color: #f4f4f4;">
					<th class="text-center">#</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Telefono</th>
					<th class="text-center">CUIT</th>
					<th class="text-center" >Responsable</th>
					<th class="text-center">Fecha Alta</th>
					<th class="text-center">Acciones</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($instituciones) && count($instituciones))

					@foreach ($instituciones as $institucion)
					    
					    <tr>
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->id }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->nombre }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->telefono }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->cuit }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->responsable }}</td>								
							<td class="text-center" style="vertical-align: middle;">{{ $institucion->created_at }}</td>
							<td class="text-center" style="vertical-align: middle;"> 
								
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

	    $('#tabla-instituciones').DataTable({
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
