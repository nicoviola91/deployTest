@extends('layouts.adminApp')


@section('title')
	Asistidos
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	Asistidos
	<small>RESULTADOS DE BÚSQUEDA</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Asistidos</a></li>
	<li class="active">Buscar</li>
</ol>
@endsection

@section('content')

<!-- <div class="row">
	<div class="col-md-12">
		<div class="box box-solid">

			<div class="box-header with-border">
              <h3 class="box-title"><i class="icon fa fa-search"></i> Búsqueda Avanzada <small class="text-muted"> <?php echo isset($q) ? '"' . strtoupper($q) . '"' : '' ?></small></h3>
            </div>

			<div class="box-body">
				<form class="form-horizontal" autocomplete="off" method="post" action="{{ route('asistido.busqueda') }}" >
			        {{ csrf_field() }}


			        <div class="panel-body">
	                    <div class="input-group">
	                        <div class="input-group-btn search-panel" role="search">
	                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
	                                <span id="search_concept">Interacciones</span>
	                                <span class="caret"></span>
	                            </button>
	                            <ul class="dropdown-menu" role="menu">
	                                <li><a href="#person">Asistidos</a></li>
	                                <li><a href="#interaction">Interacciones</a></li>
	                            </ul>
	                        </div>
	                        <input type="hidden" name="search_param" id="search_param">
	                        <input type="text" id="keyWord" class="form-control" name="q" placeholder="Buscar..." autofocus="true" onkeypress="enterPressAction(event, 'Asistidos')">
	                        
	                        <span class="input-group-btn">
	                            <button id="search" class="btn btn-default" type="button" onclick="buscar('Asistidos')"><span class="icon fa fa-search"></span></button>
	                        </span>
	                    </div>
	                </div>
			    </form>
			</div>



		</div>
	</div>
</div> -->

<?php if (isset($asistidos)): ?>

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
<?php endif ?>
	
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
