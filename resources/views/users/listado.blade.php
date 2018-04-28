@extends('layouts.adminApp')


@section('title')
	Usuarios
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-user-circle fa-fw"></i>Usuarios
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user-circle"></i> Usuarios</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-usuarios">
			
			<thead>
				
				<tr style="background-color: #f4f4f4;">
					<th class="text-center">#</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Documento</th>
					<th class="text-center" >E-mail</th>
					<th class="text-center">Fecha Registro</th>
					<th class="text-center">Tipo</th>
					<th class="text-center">Acciones</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($usuarios) && count($usuarios))

					@foreach ($usuarios as $usuario)
					    
					    <tr>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->id }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->name }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->apellido }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->dni }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->email }}</td>								
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->created_at }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->tipoUsuario_id }}</td>
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

	    $('#tabla-usuarios').DataTable({
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
