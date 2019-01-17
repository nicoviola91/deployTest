@extends('layouts.userApp')


@section('title')
	Mis Alertas
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-bullhorn fa-fw"></i>Alertas
	<small>Mis Alertas</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Alertas</a></li>
	<li class="active">Mis Alertas</li>
</ol>
@endsection

@section('content')

<style type="text/css">
	
	.vert-aligned {

		vertical-align: middle !important;
	}
</style>


<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="active"><a href="#reciente" data-toggle="tab" aria-expanded="true"><i class="fa icon fa-fw fa-history"></i> <span class="hidden-xs">Actualizaciones Recientes</span></a></li>
      <li class=""><a href="#personal" data-toggle="tab" aria-expanded="false"><i class="fa icon fa-fw fa-user-circle"></i> <span class="hidden-xs">Mis Alertas</span></a></li>
    </ul>
    
    <div class="tab-content">
      
      <div class="tab-pane active" id="reciente">
        
        <br>
      	<h4> <i class="icon fa fa-history"></i> Actividad Reciente <small><br>REVISÁ TU ACTIVIDAD</small></h4>

        <ul class="timeline timeline-inverse" id="actividadReciente">

        	<li class="liMore">
		        <i class="fa fa-clock-o bg-gray"></i>
		        <div class="timeline-item text-center" style="background-color: #fefefe !important; border: none;">
		        	<h3 class="timeline-header no-border" style="vertical-align: center;"><i class="icon fa fa-spinner fa-spin fa-2x"></i></h3>
		        </div>
		    </li>

        </ul>

      </div>



      <!-- TAB PERSONAL -->
      <div class="tab-pane" id="personal">

      	<br>
      	<h4> <i class="icon fa fa-user-circle"></i> Mis Alertas <small><br>A CONTINUACION PODES HACER UN SEGUIMIENTO DEL ESTADO DE LAS ALERTAS QUE GENERASTE</small></h4>

      	<table class="table table-bordered table-striped table-hover table-datatables" id="tabla-personal">
			
			<thead>

				<tr style="">
					<th class="text-center">#</th>
					<th class="text-center">Datos de la Alerta</th>
					<th class="text-center"><i class="icon fa fa-users"> Comunidad</i></th>
					<th class="text-center"><img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 15px;"> Posadero</th>
					<th class="text-center"><i class="icon fa fa-tag"></i> Estado</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($personales) && count($personales))

					@foreach ($personales as $alerta)


							<tr>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
								<td class="vert-aligned " style="vertical-align: middle;">
									<strong>Nombre:</strong> {{ $alerta->nombre }} {{ $alerta->apellido }}
									<br><strong>DNI:</strong> {{ $alerta->dni }}
									<br><strong>Fecha Nacimiento:</strong> {{ $alerta->fechaNacimiento }}
									<br><strong>Observaciones:</strong> 
									<br> {{ $alerta->observaciones }}

								</td>
								

								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->comunidad->nombre) ? $alerta->comunidad->nombre : '' }}</td>
								<td class="vert-aligned text-center" style="vertical-align: middle;">{{ isset($alerta->institucion->nombre) ? $alerta->institucion->nombre : '' }}</td>
								
								<td class="vert-aligned text-center">
									<?php if ($alerta->estado == 1) { ?>
										
										<span class="label label-success"><i class="fa icon fa-check-circle"></i> SE PRESENTÓ </span>

									<?php } elseif ($alerta->estado == 0) { ?>

										<span class="label label-default"><i class="fa icon fa-clock-o"></i> PENDIENTE </span>
									
									<?php } elseif ($alerta->estado == 2) { ?>

										<span class="label label-danger"><i class="fa icon fa-close"></i> DESCARTADA </span>

									<?php } ?>
								</td>	

							</tr>

					@endforeach

			    @endif

			</tbody>

		</table>

      </div>


    </div>

  </div>

	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$(function () {

	    $('.table-datatables').DataTable({
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
				"sSearch": "Buscar alerta:",
				"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ filas",
				"oPaginate": {
					"sPrevious": "Anterior",
					"sNext": "Siguiente"
				}
			}
	    });
  	});

	$(function() {
    
	    function actualizaciones (offset) {

	      $.get("{{url('alertas/misActualizaciones')}}"+"/"+offset, function(data){
	        
	        $('.liMore').remove();
	        $('.divMore').remove();

	        $("#actividadReciente").append(data);
	        $("#loading").remove();
	      })

	    }

	    actualizaciones(0);

	    $(document).on( "click", ".moreUpdates", function() {

	      offset = $(this).data('offset');
	      $('.iconMore').addClass("fa-spin");
	      actualizaciones(offset);

	    })

  });

    

</script>

@endsection
