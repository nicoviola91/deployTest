@extends('layouts.adminApp')


@section('title')
	Necesidades
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
										<a href="javascript:void(0)" data-id="{{$necesidad->id}}" data-toggle="modal" data-title="Donar" class="botonDonar"> <i class="icon fa fa-handshake-o fa-2x fa-fw text-blue"></i></a>
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
	            	<li ><a href="http://www.lumencor.org/mapa.html">Posaderos Asociados</a></li>
	            	<li ><a href="https://www.caritas.org.ar/sumate/">Caritas</a></li>
	            </ul>
	        <h5>O podés llenar el siguiente formulario para que nos pongamos en contacto con vos: </h5>  
        </div>
        </div>

      <form id="nueva_donacion" method="POST" action="{{ url('/necesidad/donate') }}" autocomplete="off">
			
			{{ csrf_field() }}
	     	
	     	<div class="box-body">
	     		<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }} col-md-6">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" required>
					<input type="text" class="form-control hidden" id="necesidad_id" name="necesidad_id" required readonly>
					@if ($errors->has('nombre'))
					<span class="help-block">
					    <strong>{{ $errors->first('nombre') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }} col-md-6">
					<label for="apellido">Apellido</label>
					<input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido">
					@if ($errors->has('apellido'))
					<span class="help-block">
					    <strong>{{ $errors->first('apellido') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('tel_contacto') ? ' has-error' : '' }} col-md-12">
					<label for="tel_contacto">Telefono de Contacto</label>
					<input type="text" class="form-control" id="tel_contacto" placeholder="Teléfono" name="tel_contacto">
					@if ($errors->has('tel_contacto'))
					<span class="help-block">
					    <strong>{{ $errors->first('tel_contacto') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('mail_contacto') ? ' has-error' : '' }} col-md-12">
					<label for="responsable">Email de Contacto</label>
					<input type="text" class="form-control" id="mail_contacto" placeholder="Mail" name="mail_contacto">
					@if ($errors->has('mail_contacto'))
					<span class="help-block">
					    <strong>{{ $errors->first('mail_contacto') }}</strong>
					</span>
					@endif
				</div>

				<div class="form-group {{ $errors->has('mensaje') ? ' has-error' : '' }} col-md-12">
					<label for="mensaje">Mensaje</label>
					<textarea class="form-control" rows="4" name="mensaje"> ¡Hola! Estoy dispuesto a ayudar con esta Necesidad. Por favor pónganse en contacto conmigo para coordinar.</textarea>
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

	$('.botonDonar').click(function () {

		id = $(this).data('id');

		$('#necesidad_id').val(id);

		$('#modal-donar').modal('show');


	})
	
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
            		title: 'Listado de Necesidades',
            		exportOptions: 
            		{
                    	columns: [ 0, 1, 2, 3],
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
