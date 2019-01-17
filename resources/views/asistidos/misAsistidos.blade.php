@extends('layouts.userApp')


@section('title')
	Mis Asistidos
@endsection


@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-user fa-fw"></i>Asistidos
	<small>Mis Asistidos</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bullhorn"></i> Asistidos</a></li>
	<li class="active">Mis Asistidos</li>
</ol>
@endsection

@section('content')

<style type="text/css">
	
	.vert-aligned {

		vertical-align: middle !important;
	}
</style>


<div class="box box-solid" id="box-favoritos">
 	
  	<div class="box-body">

    	<h3> 
    		
    		<div class="col-md-6 col-xs-12">
	    		<i class="icon fa fa-star text-yellow"></i> Favoritos 
	    		<small><br>A CONTINUACION PODES VER EL LISTADO DE TUS ASISTIDOS FAVORITOS</small>
    		</div>
    		
    		<div class="col-md-6 col-xs-12" style="">

    			<hr class="visible-xs">

	    		<form id="formBusqueda" class="form col-md-6 col-xs-12 pull-right" style="padding: 0px !important;" autocomplete="off" method="POST" action="{{ route('asistido.buscar') }}" >
	    			
	    			{{ csrf_field() }}

	    			<div class="input-group">
	    				<small>SI NO ENCONTRAS LO QUE BUSCAS, BUSCALO ACA</small>
	    			</div>
			        
			        <div class="input-group">
			          <input type="text" name="q" class="form-control input" placeholder="Buscar Asistido...">
			          <span class="input-group-btn">
			            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
			          </span>
			        </div>
			    </form>

    		</div>
    	</h3>

    	<h3>
    		
		</h3>

		<div class="row">
			<div class="col-md-12">

				<table class="table table-striped table-hover" style="overflow-x: auto;">
					<thead>
						<tr>
							<th>Nombre</th>
	                        <th>Apellido</th>
	                        <th>Documento</th>
	                        <th>Fecha Alta</th>
	                        <th>Posadero</th>
	                        <th></th>
						</tr>
					</thead>
					<tbody id="tbodyFavoritos">

						<?php if (isset(Auth::user()->favoritos) && count(Auth::user()->favoritos)): ?>
							<?php foreach (Auth::user()->favoritos as $asistido): ?>
								<tr>
									<td><?php echo $asistido->nombre ?></td>
	                                <td><?php echo $asistido->apellido ?></td>
	                                <td><?php echo $asistido->dni ?></td>
	                                <td><?php echo isset($asistido->created_at) ? (new DateTime($asistido->created_at))->format('d/m/Y') : '' ?> </td>
	                                <td><?php echo isset($asistido->institucion) ? $asistido->institucion->nombre : '' ?></td>
	                                <td class="text-center" style="vertical-align: middle;"> 
	                                    <a href="{{route('asistido.show',['id'=>$asistido->id])}}" target="_blank" class="" data-id="" title="Ver detalles del asistido." data-toggle="tooltip" data-title="Ver Perfil"><i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a>
	                                </td>
								</tr>
							<?php endforeach ?>
						<?php endif ?>
					
					</tbody>
				</table>
			</div>
		</div>
  	</div>

</div>

<div class="box box-solid" id="box-resultados" style="display: none;">
 	
</div>

	
@endsection


@section('scripts')

<script type="text/javascript">

	$('.eliminarFavorito').click(function (e) {

		id = $(this).data('id');

		console.log('eliminar');

		$.get( "{{url('/favoritos/eliminar')}}/"+id)    
	      .done(function(datos) {

	      if (datos.status) {
	        console.log('eliminado');
	        $('.eliminarFavorito').hide();
	        $('.agregarFavorito').show();

	      } else {
	        lanzarAlerta('peligro', datos.msg);
	      }

	      });
	});

	$('.agregarFavorito').click(function (e) {

		id = $(this).data('id');

		console.log('agregar');

		$.get( "{{url('/favoritos/agregar')}}/"+id)    
	      .done(function(datos) {

	      if (datos.status) {
	        console.log('agregado');
	        $('.eliminarFavorito').show();
	        $('.agregarFavorito').hide();
	      } else {
	        lanzarAlerta('peligro', datos.msg);
	      }

	      });
	});

	
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

	$('.input').keypress(function (e) {

        if (e.which == 13) {

	        formData = new FormData($('#formBusqueda')[0]);

	        if (!$('#formBusqueda')[0].checkValidity()) {

	            //VALIDACION
	            lanzarAlerta('peligro', 'Error en el formulario. Completa todos los datos requeridos.');
	        } else {

	            bootbox.dialog({
	                message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se realiza la búsqueda.</p>',
	                closeButton: false
	            });

	            $.ajax({
	                url: "{{url('/asistido/buscar')}}",
	                type: "POST",
	                enctype: 'multipart/form-data',
	                data: formData,
	                cache: false,
	                contentType: false,
	                processData: false,
	                success: function(datos)
	                {   
	                    $('.modal').modal('hide');
	                    
	                    if (datos.status) {

	                        $('#box-resultados').html(datos.view);
	                        

	                        $('#tableResultados').DataTable({
	                            "responsive": false,
	                            "paging": false,
	                            "lengthChange": false,
	                            "searching": true,
	                            "ordering": true,
	                            "info": false,
	                            "autoWidth": false,
	                        });

	                        $('#box-resultados').show();
	                    }
	                    else {
	                        lanzarAlerta('peligro', datos.msg);
	                    }

	                },
	                error: function(data) {                 
	                    $('.modal').modal('hide');
	                    lanzarAlerta('peligro', 'Ocurrió un error al publicar el formulario. Vuelva a intentarlo.');
	                }

	            });
	        }

	        return false;
	    }
    })

</script>


@endsection
