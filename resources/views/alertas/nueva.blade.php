@extends('layouts.userApp')


@section('title')
	Alerta
@endsection


@section('pageHeader')
<h1>
	Alertas
	<small>Nueva Alerta</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Alertas</a></li>
	<li class="active">Nueva</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-10 col-md-offset-1">
	<div class="box box-solid">
		
		<div class="box-body">
			
			<form role="form" id="nuevaAlerta-form">
              
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Apellido</label>
                  <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Documento</label>
                  <input type="text" class="form-control" id="documento" placeholder="Documento" name="documento" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Observaciones</label>
                  <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="(OPCIONAL)"></textarea>
                </div>

                <input type="text" class="form-control" id="lat" placeholder="Latitud" name="lat" value="" style="display: none;">
                <input type="text" class="form-control" id="lng" placeholder="Longitud" name="lng" value="" style="display: none;">

                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="checkCoordenadas"> Enviar Coordenadas 
                    <span class="text-blue" id="locLoad" style="display: none;"><i class="fa fa-refresh fa-spin fa-fw"></i> Obteniendo Ubicación</span>
                    <span class="text-green" id="locOk" style="display: none;"><i class="fa fa-check-circle fa-fw"></i></span>
                    <span class="text-red" id="locErr" style="display: none;"><i class="fa fa-exclamation-circle fa-fw"></i><span id="msgErr"></span></span>
                  </label>
                </div>

              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary submitBtn">Enviar</button>
                <button type="reset" class="btn btn-default">Cancelar</button>
              </div>
            </form>

		</div>

	</div>
</div>
</div>
	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$('#checkCoordenadas').change(function () {

		if ($('#checkCoordenadas').is(':checked')) {

			$(this).prop('disabled', true);
			
			if ($('#lat').val() == "" && $('#lng').val() == "") {

				$('#locLoad').show();
				$('#locErr').hide();
				$('#locOk').hide();
				navigator.geolocation.getCurrentPosition(position, error);

			}
			else {

				$('#locOk').show();
				$('#locErr').hide();
				$('#locLoad').hide();
				$('#checkCoordenadas').prop('disabled', false);
			}

		} else {
			
			$('#lat').val('');
	        $('#lng').val('');
	        $('#locOk').hide();
	        $('#locLoad').hide();
	        $('#locErr').hide();
	        $('#checkCoordenadas').prop('disabled', false);
		}
	});

	$('#submitBtn').click(function() {

	});

	function position(position) {

        var latitud = position.coords.latitude;
        var longitud = position.coords.longitude;

        $('#lat').val(latitud);
        $('#lng').val(longitud);

        $('#locLoad').hide();
        $('#locErr').hide();
        $('#locOk').show();
        $('#checkCoordenadas').prop('disabled', false);

    }

    function error(error) {

      	switch(error.code) {
	        case error.PERMISSION_DENIED:
	            x = "Ha denegado el permiso para acceder a su ubicación. Revise las opciones de configuración de su navegador."
	            break;
	        case error.POSITION_UNAVAILABLE:
	            x = "Información de Geolocalización no disponible"
	            break;
	        case error.TIMEOUT:
	            x = "El tiempo de espera fue agotado."
	            break;
	        case error.UNKNOWN_ERROR:
	            x = "Error desconocido. Por favor vuelva a intentarlo."
	            break;
      	}

      	$('#locLoad').hide();
	    $('#locErr').show();
	    $('#locOk').hide();
	    $('#msgErr').html(x);
	    $('#checkCoordenadas').prop('disabled', false);

    }

</script>

@endsection
