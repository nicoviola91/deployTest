@extends('layouts.adminApp')


@section('title')
	Asistidos
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

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/select2/select2.min.css') }}">
    <script src="{{ asset('/select2/select2.full.min.js') }}"></script>

@endsection


@section('pageHeader')
<h1>
	Asistidos
	<small>BUSQUEDA AVANZADA</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Asistidos</a></li>
	<li class="active">Buscar</li>
</ol>
@endsection

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="box box-solid">

			<div class="box-header with-border">
              <h3 class="box-title"><i class="icon fa fa-search"></i> Búsqueda Avanzada <small class="text-muted"> <?php echo isset($q) ? '"' . strtoupper($q) . '"' : '' ?></small></h3>
            </div>

			<div class="box-body">
				<form class="form-horizontal" autocomplete="off" method="post" action="{{ route('report.search') }}" autocomplete="off" id="formBusqueda">
			        {{ csrf_field() }}


			        <h4> 
                        <i class="icon fa fa-chevron-right"></i> Filtrar Datos Basicos
                        <small class="text-muted"> - Podes utilizar los filtros a continuacion para achicar el rango de busqueda</small>
                    </h4>

                    <h6 class="text-center">
                    <div class="btn-group text-center" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkNombre" id="checkNombre" value="1"> Nombre
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkApellido" id="checkApellido" value="1"> Apellido
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkSexo" id="checkSexo" value="1"> Sexo
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkEstadoCivil" id="checkEstadoCivil" value="1"> Estado Civil
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkEdad" id="checkEdad" value="1"> Edad
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkNacionalidad" id="checkNacionalidad" value="1"> Nacionalidad
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkComunidad" id="checkComunidad" value="1"> Comunidad
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkPosadero" id="checkPosadero" value="1"> Posadero
                        </label>
                        <label class="btn btn-primary">
                            <input type="checkbox" name="checkFechaAlta" id="checkFechaAlta" value="1"> Fecha Alta
                        </label>
                    </div>
                    </h6>

                    <div class="form-group divNombre" style="display: none;">
                      <label for="nombre" class="col-md-2 control-label">Nombre</label>
                      <div class="col-md-4">
                                <input type="text" name="nombre" class="form-control" id="nombre">
                        </div>   
                    </div>

                    <div class="form-group divApellido" style="display: none;">
                      <label for="apellido" class="col-md-2 control-label">Apellido</label>
                      <div class="col-md-4">
                                <input type="text" name="apellido" class="form-control" id="apellido">
                        </div>   
                    </div>

                    <div class="form-group divSexo" style="display: none;">
                        <label for="sexo" class="col-md-2 control-label">Sexo</label>
                        <div class="col-md-4">
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="sexo" id="gridSexo1" value="0" checked="">
                              <label class="form-check-label" for="gridSexo">
                                Indistinto
                              </label>
                            </div>

                            <?php foreach ($sexos as $sexo): ?>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="sexo" value="<?php echo $sexo->id ?>">
                                  <label class="form-check-label" for="gridSexo">
                                    <?php echo $sexo->descripcion ?>
                                  </label>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>

                    <div class="form-group divEstadoCivil" style="display: none;">
                        <label for="estadoCivil" class="col-md-2 control-label">Estado Civil</label>
                        <div class="col-md-4">

                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="estadoCivil" id="estadoCivil1" value="0" checked="">
                              <label class="form-check-label" for="gridSexo">
                                Indistinto
                              </label>
                            </div>

                            <?php foreach ($estadosCiviles as $estado): ?>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="estadoCivil" value="<?php echo $estado->id ?>">
                                  <label class="form-check-label" for="gridSexo">
                                    <?php echo $estado->descripcion ?>
                                  </label>
                                </div>
                            <?php endforeach ?>

                        </div>
                    </div>

                    <div class="form-group divEdad" style="display: none;">
                        <label for="edadDesde" class="col-md-2 control-label">Edad</label> 
                        <div class="col-md-4">
                            <div class="input-group">
                                <input name="edadDesde" class="form-control" id="edadDesde" style="width: 100%;" type="text" placeholder="Desde" value="" min="0">
                                <span class="input-group-addon fa-fw">-</span>
                                <input name="edadHasta" class="form-control" id="edadHasta" style="width: 100%;" type="text" placeholder="Hasta" value="" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="form-group divNacionalidad" style="display: none;">
                        <label for="nacionalidad" class="col-md-2 control-label">Nacionalidad</label>
                        <div class="col-md-4">
                            <select class="form-control select2" name="nacionalidad" data-placeholder="Nacionalidad" style="width: 100%;" id="nacionalidad">
                                <?php foreach ($nacionalidades as $nacionalidad): ?>  
                                  <option value="{{$nacionalidad->nacionalidad}}"> <?php echo $nacionalidad->nacionalidad ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group divComunidad" style="display: none;">
                        <label for="comunidad" class="col-md-2 control-label">Comunidad</label>
                        <div class="col-md-4">
                            <select class="form-control select2" multiple="multiple" data-placeholder="Comunidades" name="comunidad[]" style="width: 100%;" id="comunidad">
                                <?php $institucion = 0; ?>
                                <?php foreach ($comunidades as $comunidad): ?>  

                                  <?php if ($institucion != $comunidad->institucion_id): ?>
                                    <optgroup label=" - {{$comunidad->institucion->nombre}}"></optgroup>
                                    <?php $institucion = $comunidad->institucion_id ?>
                                  <?php endif ?>

                                  <option value="{{$comunidad->id}}"> <?php echo $comunidad->nombre ?></option>
                                
                                <?php endforeach ?>
                            </select>
                        </div>
                        <p class="help-block">Comunidades a las que pertenece el Asistido</p>
                    </div>

                    <div class="form-group divPosadero" style="display: none;">
                        <label for="comunidad" class="col-md-2 control-label">Posadero</label>
                        <div class="col-md-4">
                            <select class="form-control select2" name="posadero" data-placeholder="Posaderos" style="width: 100%;" id="posadero">
                                
                                <?php foreach ($posaderos as $posadero): ?>  
                                  <option value="{{$posadero->id}}"> <?php echo $posadero->nombre ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>
                        <p class="help-block">Posadero que dió de alta al Asistido</p>
                    </div>

                    <div class="form-group divAlta" style="display: none;">
                        <label for="edadDesde" class="col-md-2 control-label">Fecha de Alta</label> 
                        <div class="col-md-4">
                            <div class="input-group">
                                <input name="altaDesde" class="form-control" id="altaDesde" style="width: 100%;" type="date" placeholder="Desde" value="">
                                <span class="input-group-addon fa-fw">-</span>
                                <input name="altaHasta" class="form-control" id="altaHasta" style="width: 100%;" type="date" placeholder="Hasta" value="">
                            </div>
                        </div>
                    </div>

	                <h4><i class="icon fa fa-chevron-right"></i> Filtrar Fichas <small class="text-muted">Selecciona una ficha para obtener informacion adicional</small></h4>

                    <h6 class="text-center">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary active">
                                <input type="radio" name="filtroFicha" id="ninguna" value="ninguna" checked="true"> Ninguna
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="necesidades" value="necesidades"> Necesidades
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="tratamientos" value="tratamientos"> Tratamientos
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="adicciones" value="adicciones"> Adicciones
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="empleo" value="empleo"> Empleo
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="educacion" value="educacion"> Educacion
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="asistencia" value="asistencia"> Asistencia
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="medica" value="medica"> Medica
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="mental" value="mental"> Salud Mental
                            </label>
                            <label class="btn btn-primary">
                                <input type="radio" name="filtroFicha" id="integral" value="integral"> Diag. Integral
                            </label>
                        </div>
                    </h6>
                    
                    <br>
                    <div class="col-md-8 col-md-offset-2">
                        <button type="submit" value="submit" class="btn btn-lg btn-warning pull-right btnBuscar"><i class="icon fa fa-search"></i> BUSCAR</button>
                    </div>

			    </form>
			</div>

		</div>
	</div>
</div>

<div id="divResultados"></div>

	
@endsection


@section('scripts')

<script type="text/javascript">
	
    $('#checkNombre').change(function () {

        $(this).blur();

        if ($(this).is(':checked')) {

            $('.divNombre').show();
            $('#nombre').prop('required', true);
        } else {
            $('.divNombre').hide();
            $('#nombre').prop('required', false);
        }
    })

    $('#checkApellido').change(function () {

        $(this).blur();

        if ($(this).is(':checked')) {

            $('.divApellido').show();
            $('#apellido').prop('required', true);
        } else {
            $('.divApellido').hide();
            $('#apellido').prop('required', false);
        }
    })

    $('#checkSexo').change(function () {

        $(this).blur();

        if ($(this).is(':checked')) {

            $('.divSexo').show();
        } else {
            $('.divSexo').hide();
        }
    })

    $('#checkComunidad').change(function () {

        $(this).blur();

        if ($(this).is(':checked')) {

            $('.divComunidad').show();
            $('#comunidad').prop('required', true);
        } else {
            $('.divComunidad').hide();
            $('#comunidad').prop('required', false);
        }
    })

    $('#checkPosadero').change(function () {

        $(this).blur();

        if ($(this).is(':checked')) {

            $('.divPosadero').show();
            $('#posadero').prop('required', true);
        } else {
            $('.divPosadero').hide();
            $('#posadero').prop('required', false);
        }
    })

    $('#checkNacionalidad').change(function () {

        if ($(this).is(':checked')) {

            $('.divNacionalidad').show();
            $('#nacionalidad').prop('required', true);
        } else {
            $('.divNacionalidad').hide();
            $('#nacionalidad').prop('required', false);
        }
    })

    $('#checkEstadoCivil').change(function () {

        if ($(this).is(':checked')) {

            $('.divEstadoCivil').show();
        } else {
            $('.divEstadoCivil').hide();
        }
    })

    $('#checkEdad').change(function () {

        if ($(this).is(':checked')) {

            $('.divEdad').show();
            $('#edadDesde').prop('required', true);
            $('#edadHasta').prop('required', true);
        } else {
            $('.divEdad').hide();
            $('#edadDesde').prop('required', false);
            $('#edadHasta').prop('required', false);
        }
    })

    $('#checkFechaAlta').change(function () {

        if ($(this).is(':checked')) {

            $('.divAlta').show();
            $('#altaDesde').prop('required', true);
            $('#altaHasta').prop('required', true);
        } else {
            $('.divAlta').hide();
            $('#altaDesde').prop('required', false);
            $('#altaHasta').prop('required', false);
        }
    })

	
</script>

<script type="text/javascript">
    
    $('.btnBuscar').click(function(e) {

        e.preventDefault();

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
                url: "{{url('/report/search')}}",
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

                        $('#divResultados').html(datos.view);
                        $('#tableResultados').DataTable({
                            "responsive": false,
                            "paging": false,
                            "lengthChange": false,
                            "searching": true,
                            "ordering": true,
                            "info": false,
                            "autoWidth": false,

                            "dom": "<'row'<'col-md-6'l><'col-md-6'f>>" +
                                    "<'row'<'col-md-6'><'col-md-6'>>" +
                                    "<'row'<'col-md-12't>><'row'<'col-md-12 no-print'iBp>>",

                            buttons: [
                                { 
                                    extend: 'excel', 
                                    text: '<i class="icon fa fa-file-excel-o fa-fw"></i>Exportar a Excel',
                                    title: 'Resultados',
                                    // exportOptions: 
                                    // {
                                    //     columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ],
                                    // }
                                },
                            ],

                        });
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

    })

</script>

<script type="text/javascript">

    $(document).on( "click", ".btnExport", function(e) {       
        
        e.preventDefault();
        
        console.log('Exportar');
        $('.buttons-excel').trigger('click');
    
    });

    $(document).on( "click", ".rowAsistido", function(e) {       
        
        e.preventDefault();
        
        id = $(this).data('id');
        
        window.open("{{url('asistido/show2/')}}/"+id);
    });

    $('.select2').select2();

</script>

@endsection
