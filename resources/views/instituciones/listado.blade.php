@extends('layouts.adminApp')


@section('title')
	Instituciones
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<style type="text/css">
		
		.pac-container {

			z-index: 99999;
		}

	</style>

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
	     	
	     	<div class="box-body">
	     		<div class="form-group col-md-6 {{ $errors->has('nombre') ? ' has-error' : '' }}">
 	              <label for="nombre">Nombre</label>
 	              <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required>
 	              @if ($errors->has('nombre'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('nombre') }}</strong>
 	                </span>
 	              @endif
 	            </div>
 	            
 	            <div class="form-group col-md-6 {{ $errors->has('cuit') ? ' has-error' : '' }}">
 	              <label for="cuit">CUIT</label>
 	              <input type="text" class="form-control" id="cuit" placeholder="CUIT" name="cuit">
 	              @if ($errors->has('cuit'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('cuit') }}</strong>
 	                </span>
 	              @endif
 	            </div>
 	
 	            <div class="form-group col-md-6 {{ $errors->has('telefono') ? ' has-error' : '' }}">
 	              <label for="telefono">Telefono</label>
 	              <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono">
 	              @if ($errors->has('telefono'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('telefono') }}</strong>
 	                </span>
 	              @endif
 	            </div>
 	
 	            <div class="form-group col-md-6 {{ $errors->has('responsable') ? ' has-error' : '' }}">
 	              <label for="responsable">Responsable</label>
 	              <input type="text" class="form-control" id="responsable" placeholder="Responsable" name="responsable">
 	              @if ($errors->has('responsable'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('responsable') }}</strong>
 	                </span>
 	              @endif
 	            </div>

 	            <div class="form-group col-md-6 {{ $errors->has('tipo') ? ' has-error' : '' }}">
 	              <label for="tipo">Tipo</label>
 	              <select class="form-control" id="tipo" name="tipo">
 	              	<option value="posadero">Posadero</option>
 	              	<option value="externa">Institución Externa</option>
 	              </select>
 	              @if ($errors->has('tipo'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('responsable') }}</strong>
 	                </span>
 	              @endif
 	            </div>

 	            <div class="form-group col-md-6 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
 	              <label for="descripcion">Descripción Adicional</label>
 	              <textarea class="form-control" rows="1" id="descripcion" name="descripcion" placeholder="OPCIONAL (ej. horarios de atención)"></textarea>
 	              @if ($errors->has('descripcion'))
 	                <span class="help-block">
 	                    <strong>{{ $errors->first('descripcion') }}</strong>
 	                </span>
 	              @endif
 	            </div>

 	            <label>Dirección</label>
 	            <div class="form-group col-md-12">
 	            	<input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false">
 	            	<p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
 	            </div>

 	            <div class="form-group col-md-6">
            		<label>Calle</label>
	            	<input class="form-control" id="route" name="calle"></input>
 	            </div>
 	            <div class="form-group col-md-2">
 	            	<label>Número</label>
	 	            <input class="form-control" id="street_number" name="numero"></input>
 	            </div>
 	            <div class="form-group col-md-2">
 	            	<label>Piso</label>
	 	            <input class="form-control" name="piso"></input>
 	            </div>
 	            <div class="form-group col-md-2">
 	            	<label>Dpto</label>
	 	            <input class="form-control" name="departamento"></input>
 	            </div>

 	            <div class="form-group col-md-3">
 	            	<label>Localidad</label>
	 	            <input class="form-control" id="locality" name="localidad"></input>
 	            </div>
 	            <div class="form-group col-md-3">
 	            	<label>CP</label>
	 	            <input class="form-control" id="postal_code" name="codigoPostal"></input>
 	            </div>
 	            <div class="form-group col-md-3">
 	            	<label>Provincia</label>
 	            	<input class="form-control" id="administrative_area_level_1" name="provincia"></input>
 	            </div>
 	            
 	            <div class="form-group col-md-3">
 	            	<label>Pais</label>
 	            	<input class="form-control" id="country" name="pais"></input>
 	            </div>

 	            <div class="form-group"> 	            	
 	            	<input class="form-control hidden" id="lat" name="lat"></input>
 	            	<input class="form-control hidden" id="lng" name="lng"></input>
 	            </div>


	     	</div>

	      
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

<script>

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')),
            {types: ['geocode']});

        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();

        console.log(place);
      }

      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC00PZ8LBCq2QWNAo9fcAHDAMN0z5-vIt0&libraries=places&callback=initAutocomplete" async defer></script>


@endsection
