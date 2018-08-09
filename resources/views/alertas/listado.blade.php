@extends('layouts.adminApp')


@section('title')
	Alertas
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
	<small>Listado</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Alertas</a></li>
	<li class="active">Listado</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-alertas">
			
			<thead>
				
				<tr style="background-color: #f4f4f4;">
					<th></th>
					<th class="text-center" colspan="3">Datos del Asistido</th>
					<th class="text-center" colspan="4">Datos de la Alerta</th>
					<th></th>
				</tr>


				<tr style="background-color: #f4f4f4;">
					<th class="text-center">#</th>
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Documento</th>
					<th class="text-center">Usuario</th>
					<th class="text-center">Comunidad</th>
					<th class="text-center"><img src="{{asset('/img/logoch.png')}}" alt="Logo Posadero" style="height: 17px;"> Posadero</th>
					<th class="text-center">Fecha</th>
					<th class="text-center">Acciones</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($alertas) && count($alertas))

					@foreach ($alertas as $alerta)
					    @if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->slug=='buenVecino') || (Auth::user()->tipoUsuario->slug=='samaritano') ))
							@if(Auth::user()->id == $alerta->user_id)
							<tr>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->nombre }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->apellido }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ $alerta->dni }}</td>
								<td class="text-center" style="vertical-align: middle;">
									{{ $alerta->user->name }} 
									<br><span class="text-muted"><small>{{strtoupper($alerta->user->tipoUsuario->nombre)}}</small></span> 

									@if (isset($alerta->lat) && isset($alerta->lng))
									<span class="pull-right"> 
										<a href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}" target="_blank"><i class="icon fa fa-map-pin fa-fw"></i></a>
									</span>
									@endif
								</td>
								
								<td class="text-center" style="vertical-align: middle;">{{ isset($alerta->comunidad) ? $alerta->comunidad->nombre : '' }}</td>
								<td class="text-center" style="vertical-align: middle;">{{ isset($alerta->institucion) ? $alerta->institucion->nombre : '' }}</td>

								<td class="text-center" style="vertical-align: middle;">{{ $alerta->created_at->diffForHumans() }}</td>
								
								@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->slug=='administrador') || (Auth::user()->tipoUsuario->slug=='posadero') ))

								<td class="text-center" style="vertical-align: middle;"> 
									
									@if(empty($alerta->asistido_id))
										<a href="{{ route('asistido.newFromAlert',['id'=>$alerta->id]) }}" class="altaBtn" data-id="{{$alerta->id}}" data-dni="{{$alerta->dni}}" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
									@else
										<a class="" data-toggle="tooltip" data-title="Alta Asistido"><i title="Esta alerta ya tiene un asistido vinculado." class="icon fa fa-check-circle fa-2x fa-fw text-gray"></i></a>
									@endif
									<a href="{{ route('alerta.destroy',['id'=>$alerta->id])}}" class="descartarBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a>
								</td>
								
								@endif	
							</tr>
							@endif
						@else 
							@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->slug=='administrador') || (Auth::user()->tipoUsuario->slug=='posadero') ))
							<tr>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->id }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->nombre }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->apellido }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ $alerta->dni }}</td>
									<td class="" style="vertical-align: middle;">
										{{$alerta->user->name}} {{$alerta->user->apellido}}
										<br><span class="text-muted"><small>{{strtoupper($alerta->user->tipoUsuario->nombre)}}</small></span> 
										
										@if (isset($alerta->lat) && isset($alerta->lng))
											<span class="pull-right"> 
												<a href="https://www.google.com/maps/search/?api=1&query={{$alerta->lat}},{{$alerta->lng}}" target="_blank"><i class="icon fa fa-map-pin fa-fw"></i></a>
											</span>
										@endif
									</td>
									<td class="text-center" style="vertical-align: middle;">{{ isset($alerta->comunidad) ? $alerta->comunidad->nombre : '' }}</td>
									<td class="text-center" style="vertical-align: middle;">{{ isset($alerta->institucion) ? $alerta->institucion->nombre : '' }}</td>

									<td class="text-center" style="vertical-align: middle;">{{ $alerta->created_at->diffForHumans() }}</td>

									
									@if(null !==(Auth::user()) && ((Auth::user()->tipoUsuario->slug=='administrador') || (Auth::user()->tipoUsuario->slug=='posadero') ))
		
										<td class="text-center" style="vertical-align: middle;"> 
											@if(empty($alerta->asistido_id))
												<a href="{{ route('asistido.newFromAlert',['id'=>$alerta->id]) }}" class="altaBtn" data-id="{{$alerta->id}}" data-dni="{{$alerta->dni}}" data-toggle="tooltip" data-title="Alta Asistido"><i class="icon fa fa-check-circle fa-2x fa-fw text-green"></i></a> 
											@else
												<a class="altaBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Alta Asistido"><i title="Esta alerta ya tiene un asistido vinculado." class="icon fa fa-check-circle fa-2x fa-fw text-gray"></i></a>
											@endif
											<a href="{{ route('alerta.destroy',['id'=>$alerta->id])}}" class="descartarBtn" data-id="{{$alerta->id}}" data-toggle="tooltip" data-title="Descartar Solicitud"><i class="icon fa fa-times-circle fa-2x fa-fw text-red"></i></a>
										</td>

									@endif	
								</tr>
								@endif
							@endif


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

	$('.altaBtn').click(function (e) {

		e.preventDefault();

		alerta_id = $(this).data('id');
		dni = $(this).data('dni');

		$.post("{{route('asistido.verificarDocumentoExistente')}}", { '_token' : '{{csrf_token()}}', 'dni' : dni}, function(data) {

			if (data.status) {

				//Ya existe

				bootbox.confirm({
				    title: "Atención!",
				    message: "Ya existe un Asistido con el DNI especificado. <br><br><strong><i class='icon fa fa-user'></i> Asistido:</strong> " + data.asistido_nombre + " <br><strong><i class='icon fa fa-bank'></i> Institución:</strong> " + data.posadero + " <br><br> Estás seguro que querés continuar? Hace <a href='{{url('/asistido/list')}}'>click acá</a> para ir al listado de Asistidos existentes." ,
				    buttons: {
				        cancel: {
				            label: '<i class="fa fa-times"></i> Cancelar'
				        },
				        confirm: {
				            label: '<i class="fa fa-check"></i> Continuar'
				        }
				    },
				    callback: function (result) {
				        
				        if (result) {
				        	window.location.href = "{{url('/asistido/newFromAlert')}}/"+alerta_id;
				        }
				    }
				});

			} else {
				window.location.href = "{{url('/asistido/newFromAlert')}}/"+alerta_id;
			}

		})

	});
	
	$(function () {

	    $('#tabla-alertas').DataTable({
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

</script>

@endsection
