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

<!-- <div class="row">
	<div class="col-md-12">
		<a href="http://localhost/index.php/horas/diagrama/2018-04" class="btn btn-app loadingLink" data-toggle="tooltip" data-placement="bottom" data-original-title="Ir a Mes Anterior"><i class="fa fa-angle-left"></i> Mes Ant.</a>
	</div>
</div> -->

<div class="row">
<div class="col-md-12">
	<div class="box box-solid">

		<div class="box-body">
		<table class="table table-bordered table-hover" id="tabla-usuarios">
			
			<thead>
				
				<tr style="background-color: #f4f4f4;">
					
					<th class="text-center">Nombre</th>
					<th class="text-center">Apellido</th>
					<th class="text-center">Documento</th>
					<th class="text-center" >E-mail</th>
					<th class="text-center">Fecha Registro</th>
					<th class="text-center">Acuerdo</th>
					<th class="text-center">Tipo Usuario</th>
					<th class="text-center">Comunidad</th>
					<th class="text-center">Acciones</th>
				</tr>

			</thead>

			<tbody>

				@if (isset($usuarios) && count($usuarios))

					@foreach ($usuarios as $usuario)
					    
					    <tr>
							
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->name }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->apellido }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->dni }}</td>
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->email }}</td>								
							<td class="text-center" style="vertical-align: middle;">{{ $usuario->created_at }}</td>
							<td class="text-center no-print" style="vertical-align: middle;">
								<input name="checkbox" type="checkbox" class="check acuerdo" value="1" data-id="{{ $usuario->id }}" <?php echo $usuario->chkFirmoAcuerdo ? 'checked' : '' ?> >
							</td>
							<td class="text-center" style="vertical-align: middle;">
								<span style="display: none;">{{$usuario->tipoUsuario->nombre}}</span>
								<div class="form-group">
					                <select class="form-control userType" style="width: 100%;">
					                  
					                	<?php foreach ($tipos as $tipo) { ?>
					                		<option <?php echo ($usuario->tipoUsuario_id == $tipo->id) ? 'selected' : '' ?> value="{{$tipo->id}}" data-id="{{ $usuario->id }}" data-tipo="{{$tipo->id}}">{{$tipo->nombre}}</option>
										<?php } ?>
					                </select>
					            </div>
										
							</td>
						
							<td class="text-center" style="vertical-align: middle;">
								<?php foreach ($usuario->comunidades as $comunidad): ?>
									<br><span class="label label-default"><?php echo $comunidad->nombre ?></span>
								<?php endforeach ?>
							</td>

							<td class="text-center" style="vertical-align: middle;">
							<a href="{{ route('user.profile',['id'=>$usuario->id]) }}" class="detalleBtn" data-id="{{ $usuario->id }}" data-toggle="tooltip" data-title="Ver Detalle"> <i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a>
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

<script type="text/javascript">
	
	$('.acuerdo').change(function () {

		var check = $(this);
		var asistido = $(this).data('id');

		if ($(this).is(':checked'))
			valor = 1;
		else
			valor = 0;

		var loading = bootbox.dialog({
	        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
	        closeButton: false
	    });

		$.post( "{{route('user.acuerdo')}}", { 'id': asistido, 'valor': valor, '_token': '{{csrf_token()}}' })    
	    .done(function(datos) {

	      if (datos.status) {

	        loading.modal('hide');
	        lanzarAlerta('exito', datos.msg);

	      } else {

	        loading.modal('hide');
	        
	        if (check.is(':checked'))
	        	check.prop('checked', false);
	       	else
	       		check.prop('checked', true);
	        
	        lanzarAlerta('peligro', datos.msg);
	      }

	    });


	});

	$('.userType').change(function () {

		var asistido = $(this).find(':selected').data('id');
		var tipo = $(this).find(':selected').data('tipo');
		var select = $(this);
		
		var loading = bootbox.dialog({
	        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
	        closeButton: false
	    });

		$.post( "{{route('user.updateType')}}", { 'id': asistido, 'tipo': tipo, '_token': '{{csrf_token()}}' })    
	    .done(function(datos) {

	      if (datos.status) {

	        loading.modal('hide');
	        lanzarAlerta('exito', datos.msg);

	      } else {

	        loading.modal('hide');
	        select.val(datos.id);
	        lanzarAlerta('peligro', datos.msg);
	      }

	    });

	});

	$('.institucionNombre').change(function () {

		var asistido = $(this).find(':selected').data('id');
		var institucion = $(this).find(':selected').data('institucion');
		var select = $(this);

		var loading = bootbox.dialog({
			message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
			closeButton: false
		});

		$.post( "{{route('user.updateInstitucion')}}", { 'id': asistido, 'institucion': institucion, '_token': '{{csrf_token()}}' })    
		.done(function(datos) {

		if (datos.status) {

			loading.modal('hide');
			lanzarAlerta('exito', datos.msg);

		} else {

			loading.modal('hide');
			select.val(datos.id);
			lanzarAlerta('peligro', datos.msg);
		}

		});

	});

	$('.comunidadNombre').change(function () {

		var asistido = $(this).find(':selected').data('id');
		var comunidad = $(this).find(':selected').data('comunidad');
		var select = $(this);

		var loading = bootbox.dialog({
			message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
			closeButton: false
		});

		$.post( "{{route('user.updateComunidad')}}", { 'id': asistido, 'comunidad': comunidad, '_token': '{{csrf_token()}}' })    
		.done(function(datos) {

		if (datos.status) {

			loading.modal('hide');
			lanzarAlerta('exito', datos.msg);

		} else {

			loading.modal('hide');
			select.val(datos.id);
			lanzarAlerta('peligro', datos.msg);
		}

		});

		});

</script>

@endsection
