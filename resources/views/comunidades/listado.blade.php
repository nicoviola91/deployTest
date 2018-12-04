@extends('layouts.adminApp')


@section('title')
	Comunidades
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<!-- DATATABLES EXPORT -->
  	<link href="{{ asset('/datatables/extensions/Export/buttons.dataTables.min.css') }}" rel="stylesheet"></link>

	<script src="{{ asset('/datatables/extensions/Export/dataTables.buttons.min.js') }}"></script>
  	<script src="{{ asset('/datatables/extensions/Export/jszip.min.js') }}"></script>
  	<script src="{{ asset('/datatables/extensions/Export/buttons.flash.min.js') }}"></script>
  	<script src="{{ asset('/datatables/extensions/Export/buttons.html5.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-users fa-fw"></i>Comunidades
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-users"></i> Comunidades</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-12">
		<a href="#" class="btn btn-app pull-right agregarBtn" data-toggle="tooltip" data-placement="bottom" data-original-title="Nueva Comunidad"><i class="fa fa-plus-square"></i> Agregar</a>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">

			<div class="box-body">

				<table class="table table-bordered table-hover" id="tabla-comunidades">
					
					<thead>
						
						<tr style="background-color: #f4f4f4;">
							<th class="text-center">#</th>
							<th class="text-center">Nombre</th>
							<th class="text-center">Tipo</th>
							<th class="text-center">Institución</th>
							<th class="text-center"><i class="icon fa fa-user-circle"></i> Miembros</th>
							<th class="text-center"><i class="icon fa fa-user"></i> Asisidos</th>
							<th class="text-center">Alta</th>
							<th class="text-center">Acciones</th>
						</tr>

					</thead>

					<tbody>

						@if (isset($comunidades) && count($comunidades))

							@foreach ($comunidades as $comunidad)
							    
							    <tr>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->id }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->nombre }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ strtoupper($comunidad->tipo) }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->institucion->nombre }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->users->count() }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->asistidos->count() }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $comunidad->created_at->diffForHumans() }}</td>
									<td class="text-center" style="vertical-align: middle;">
										<a href="{{route('comunidad.ficha',['id'=>$comunidad->id])}}" class="detalleBtn" data-id="{{ $comunidad->id }}" data-toggle="tooltip" data-title="Ver Detalle"> <i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a>
									</td> 
										
									</tr>

							@endforeach

					    @endif

					</tbody>

				</table>
			</div>

		</div>
	</div>
</div>

<div class="modal fade" id="modal-agregar">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="icon fa fa-users	 fa-fw"></i> Nueva Comunidad</h4>
      </div>

      <form id="nuevaComunidad-form" method="POST" action="{{ url('/comunidad/store') }}">
			
			{{ csrf_field() }}
	     	
	     	<div class="box-body">

	     		<div class="col-md-6 form-group {{ $errors->has('institucion_id') ? ' has-error' : '' }}">
	              <label for="nombre">Institución</label>
	              <select class="form-control" name="institucion_id" id="institucion_id" required>
	              	
	              	<?php foreach ($instituciones as $i): ?>
	              		<option value="{{$i->id}}"> {{strtoupper($i->tipo)}} - {{$i->nombre}}</option>
	              	<?php endforeach ?>
	              </select>
	              @if ($errors->has('institucion_id'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('institucion_id') }}</strong>
	                </span>
	              @endif
	            </div>

	            <div class="col-md-6 form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
	              <label for="nombre">Tipo</label>
	              <select class="form-control" name="tipo" id="tipo" required>
	              	<option value="nocheDeCaridad">Noche De Caridad</option>
	              	<option value="externa">Comunidad Externa</option>
	              </select>
	              @if ($errors->has('tipo'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('tipo') }}</strong>
	                </span>
	              @endif
	            </div>

		     	<div class="col-md-12 form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
	              <label for="nombre">Nombre</label>
	              <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required>
	              @if ($errors->has('nombre'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('nombre') }}</strong>
	                </span>
	              @endif
	            </div>
	          
	            <div class="col-md-12 form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
	              <label for="observaciones">Observaciones</label>
	              <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones">
	              @if ($errors->has('observaciones'))
	                <span class="help-block">
	                    <strong>{{ $errors->first('observaciones') }}</strong>
	                </span>
	              @endif
	            </div>
	     	</div>

	      
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
	        	<button type="submit" class="btn btn-danger">Agregar Comunidad</button>
	      	</div>
      </form>

    </div>
  </div>
</div>

	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$(function () {

	    $('#tabla-comunidades').DataTable({
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
			},

			"dom": "<'row'<'col-md-6'l><'col-md-6'f>>" +
					"<'row'<'col-md-6'><'col-md-6'>>" +
					"<'row'<'col-md-12't>><'row'<'col-md-12 no-print'iBp>>",

			buttons: [
            	{ 
            		extend: 'excel', 
            		text: '<i class="icon fa fa-file-excel-o fa-fw"></i>Exportar a Excel',
            		title: 'Listado de Comunidades',
            		exportOptions: 
            		{
                    	columns: [ 0, 1, 2, 3, 4, 5],
                    }
            	},
            ],
	    });
  	});

  	$('.agregarBtn').click(function () {

  		$('#modal-agregar').modal('show');

  	});

</script>

@endsection
