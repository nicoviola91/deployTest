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
	<li><a href="#"><i class="fa fa-bank"></i> Instituciones</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')
	
<div class="row">
	<div class="col-md-12">
		<a href="#" class="btn btn-app pull-right agregarBtn" data-toggle="tooltip" data-placement="bottom" data-original-title="Nueva Institucion"><i class="fa fa-plus-square"></i> Agregar</a>
	</div>
</div>

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
										<a href="#" class="detalleBtn" data-id="{{ $institucion->id }}" data-toggle="tooltip" data-title="Ver Detalle"> <i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a>
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
        <h4 class="modal-title"><i class="icon fa fa-bank fa-fw"></i> Nueva Institución</h4>
      </div>

      <form id="nuevaInstitucion-form" method="POST" action="{{ url('/institucion/store') }}">
			
			{{ csrf_field() }}
	     	
	     	<div class="box-body"><div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
	     	              <label for="nombre">Nombre</label>
	     	              <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required>
	     	              @if ($errors->has('nombre'))
	     	                <span class="help-block">
	     	                    <strong>{{ $errors->first('nombre') }}</strong>
	     	                </span>
	     	              @endif
	     	            </div>
	     	            
	     	            <div class="form-group {{ $errors->has('cuit') ? ' has-error' : '' }}">
	     	              <label for="cuit">CUIT</label>
	     	              <input type="text" class="form-control" id="cuit" placeholder="CUIT" name="cuit">
	     	              @if ($errors->has('cuit'))
	     	                <span class="help-block">
	     	                    <strong>{{ $errors->first('cuit') }}</strong>
	     	                </span>
	     	              @endif
	     	            </div>
	     	
	     	            <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
	     	              <label for="telefono">Telefono</label>
	     	              <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono">
	     	              @if ($errors->has('telefono'))
	     	                <span class="help-block">
	     	                    <strong>{{ $errors->first('telefono') }}</strong>
	     	                </span>
	     	              @endif
	     	            </div>
	     	
	     	            <div class="form-group {{ $errors->has('responsable') ? ' has-error' : '' }}">
	     	              <label for="responsable">Responsable</label>
	     	              <input type="text" class="form-control" id="responsable" placeholder="Responsable" name="responsable">
	     	              @if ($errors->has('responsable'))
	     	                <span class="help-block">
	     	                    <strong>{{ $errors->first('responsable') }}</strong>
	     	                </span>
	     	              @endif
	     	            </div></div>

	      
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
	        	<button type="submit" class="btn btn-danger">Agregar Institución</button>
	      	</div>
      </form>

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

  	$('.agregarBtn').click(function () {

  		$('#modal-agregar').modal('show');

  	});

</script>

@endsection
