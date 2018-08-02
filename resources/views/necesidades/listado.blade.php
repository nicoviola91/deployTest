@extends('layouts.adminApp')


@section('title')
	Necesidades
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-hotel fa-fw"></i>Necesidades
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-hotel"></i> Necesidades</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">

			<div class="box-body">

				<table class="table table-bordered table-hover" id="tabla-comunidades">
					
					<thead>
						
						<tr style="background-color: #f4f4f4;">
							<th class="text-center">Descripcion</th>
							<th class="text-center">Tipo</th>
							<th class="text-center">Satisfecha</th>
							<th class="text-center">Fecha Alta</th>
							<th class="text-center">Donar</th>
						</tr>

					</thead>

					<tbody>

						@if (isset($necesidades) && count($necesidades))

							@foreach ($necesidades as $necesidad)
							    
							    <tr>
									<td class="text-center" style="vertical-align: middle;">{{ $necesidad->especificacion }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $necesidad->tipo->descripcion }}</td>
									<td class="text-center" style="vertical-align: middle;"><span class="label label-danger">Insatisfecha</span></td>
									<td class="text-center" style="vertical-align: middle;">{{ Carbon\Carbon::parse($necesidad->created_at)->format('d/m/Y') }}</td>
									<td class="text-center" style="vertical-align: middle;">
										<a href="#modal-donar" data-id="{{$necesidad->id}}" data-toggle="modal" data-title="Donar"> <i class="icon fa fa-handshake-o fa-2x fa-fw text-blue"></i></a>
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

<div class="modal fade" id="modal-donar">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="icon fa fa-handshake-o fa-fw"></i> Donar <small class="text-muted">FORMULARIO DE CONTACTO</small></h4>
      </div>

    	<div class="col-md-12">
    	<div class="callout callout-success" style="background-color: #9da6a2 !important; border-color: #7f7f7f !important; margin-bottom: 10px; padding: 5px 20px 5px 20px !important;">
            <h5>Si querés ayudar, podés acercar tus donaciones a alguno de los siguientes puntos:</h5>
	            <ul>
	            	<li>Avenida blalbla 13343</li>
	            	<li>Avenida Del libertador ajkskja</li>
	            </ul>
	        <h5>O podés llenar el siguiente formulario para que nos pongamos en contacto con vos: </h5>  
        </div>
        </div>

      <form id="nuevaComunidad-form" method="POST" action="{{ url('/necesidades/donate') }}" autocomplete="off">
			
			{{ csrf_field() }}
	     	
	     	<div class="box-body">
	     		<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }} col-md-6">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required>
					@if ($errors->has('nombre'))
					<span class="help-block">
					    <strong>{{ $errors->first('nombre') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('cuit') ? ' has-error' : '' }} col-md-6">
					<label for="cuit">Apellido</label>
					<input type="text" class="form-control" id="cuit" placeholder="CUIT" name="cuit">
					@if ($errors->has('cuit'))
					<span class="help-block">
					    <strong>{{ $errors->first('cuit') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }} col-md-12">
					<label for="telefono">Telefono de Contacto</label>
					<input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono">
					@if ($errors->has('telefono'))
					<span class="help-block">
					    <strong>{{ $errors->first('telefono') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('responsable') ? ' has-error' : '' }} col-md-12">
					<label for="responsable">Email de Contacto</label>
					<input type="text" class="form-control" id="responsable" placeholder="Responsable" name="responsable">
					@if ($errors->has('responsable'))
					<span class="help-block">
					    <strong>{{ $errors->first('responsable') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('responsable') ? ' has-error' : '' }} col-md-12">
					<label for="responsable">Mensaje</label>
					<textarea class="form-control" rows="4"> ¡Hola! Estoy dispuesto a ayudar con esta Necesidad. Por favor pónganse en contacto conmigo para coordinar.</textarea>
				</div>
			</div>
	      
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
	        	<button type="submit" class="btn btn-danger">Enviar</button>
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
			}
	    });
  	});

  	$('.agregarBtn').click(function () {

  		$('#modal-agregar').modal('show');

  	});

</script>

@endsection
