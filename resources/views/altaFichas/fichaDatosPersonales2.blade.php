<div class="row">
    
    <div class="col-md-12">
      <h3 class="box-title"><i class="icon fa fa-id-badge fa-fw"></i> Ficha Datos Personales
      <span class="pull-right">
        <a href="javascript:window.print()" class="btn btn-default btn-sm no-print imprimir" data-tipo="datosPersonales"><i class="fa fa-print"></i> Imprimir</a>
      </span>
      </h3>
    </div>

    <div class="col-md-10 col-md-offset-1">

        <div class="box box-solid">
           
            <form id="fichaDatosPersonales-form" method="POST" action="{{url('/fichaDatosPersonales/store', ['asistido_id'=>$asistido->id]) }}" >
                {{ csrf_field() }}
                <div class="box-body">
                    
                    <h3 class="col-md-12">Datos Básicos</h3>
                    <div class="form-group col-md-6">
                      <label for="nombre">Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre" type="text" required maxlength="250" value="{{isset($fichaDatosPersonales->nombre) ? $fichaDatosPersonales->nombre : (isset($asistido->nombre) ? $asistido->nombre : '')}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="apellido">Apellido</label>
                      <input class="form-control" id="apellido" name="apellido" placeholder="Ingrese apellido" type="text" maxlength="250" value="{{isset($fichaDatosPersonales->apellido) ? $fichaDatosPersonales->apellido : (isset($asistido->apellido) ? $asistido->apellido: '')}}">
                    </div>
                    
                    <!-- inicio nico intentando hacecr algo util -->
                    <div class="form-group col-md-6">
                        {!! Form::Label('sexo_id', 'Sexo') !!}
                        @if (isset($fichaDatosPersonales->sexo_id))
                            <select class="form-control" name="sexo_id" id="sexo_id">
                                @foreach($sexos as $sexo)
                                    <option <?php echo $fichaDatosPersonales->sexo_id == $sexo->id ? 'selected' : '' ?> value="{{$sexo->id}}">{{$sexo->descripcion}}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" name="sexo_id" id="sexo_id">
                                @foreach($sexos as $sexo)
                                    <option value="{{$sexo->id}}">{{$sexo->descripcion}}</option>
                                @endforeach
                            </select>    
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::Label('estadoCivil_id', 'Estado Civil') !!}
                        @if (isset($fichaDatosPersonales->estadoCivil_id))
                            <select class="form-control" name="estadoCivil_id" id="estadoCivil_id">
                                @foreach($estadosCiviles as $estadoCivil)
                                    <option <?php echo $fichaDatosPersonales->estadoCivil_id == $estadoCivil->id ? 'selected' : '' ?> value="{{$estadoCivil->id}}">{{$estadoCivil->descripcion}}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" name="estadoCivil_id" id="estadoCivil_id">
                                @foreach($estadosCiviles as $estadoCivil)
                                    <option value="{{$estadoCivil->id}}">{{$estadoCivil->descripcion}}</option>
                                @endforeach
                            </select>    
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        {!! Form::Label('estadoDocumento_id', 'Estado Documento') !!}
                        @if (isset($fichaDatosPersonales->estadoDocumento_id))
                            <select class="form-control" name="estadoDocumento_id" id="estadoDocumento_id">
                                @foreach($estadosDocumento as $estadoDocumento)
                                    <option value="{{$fichaDatosPersonales->estadoDocumento_id}}">{{$fichaDatosPersonales->estadoDocumento->descripcion}}</option>
                                @endforeach
                            </select>
                        @else
                            <select class="form-control" name="estadoDocumento_id" id="estadoDocumento_id">
                                @foreach($estadosDocumento as $estadoDocumento)
                                    <option value="{{$estadoDocumento->id}}">{{$estadoDocumento->descripcion}}</option>
                                @endforeach
                            </select>    
                        @endif
                    </div>
                    <!-- Fin nico intentando hacer algo util -->
                    <div class="form-group col-md-6">
                        <label for="numeroDocumento">Numero de documento <small class="text-muted">(sin guiones ni puntos)</small> </label>
                        <input class="form-control" id="numeroDocumento" name="numeroDocumento" placeholder="Ingrese numero de documento" type="text" maxlength="9" pattern="[0-9]*$" maxlength="250" value="{{isset($fichaDatosPersonales->numeroDocumento) ? $fichaDatosPersonales->numeroDocumento : (isset($asistido->dni) ? $asistido->dni: '')}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="fechaNacimiento">Fecha de nacimiento</label>
                        <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Ingrese fecha de nacimiento" type="date" value="{{isset($fichaDatosPersonales->fechaNacimiento) ? $fichaDatosPersonales->fechaNacimiento : (isset($asistido->fechaNacimiento) ? $asistido->fechaNacimiento : '')}}">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label for="partida">
                            <input type="checkbox" id="partida" name="tienePartida" {{isset($fichaDatosPersonales->tienePartida) && ($fichaDatosPersonales->tienePartida=1) ? 'checked':''}}> Tiene Partida?
                        </label>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="nacionalidad">Nacionalidad</label>
                        <input class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Ingrese nacionalidad" type="text" maxlength="250" value="{{isset($fichaDatosPersonales->nacionalidad) ? $fichaDatosPersonales->nacionalidad : ''}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="fechaIngreso">Fecha de Ingreso al país</label>
                        <input class="form-control" id="fechaIngresoAlPais" name="fechaIngresoAlPais" placeholder="Ingrese fecha de ingreso al país" type="date" value="{{isset($fichaDatosPersonales->fechaIngresoAlPais) ? $fichaDatosPersonales->fechaIngresoAlPais : ''}}">
                    </div>
                    
                    <h3 class="col-md-12">Datos de Contacto</h3>
                    <div class="form-group col-md-6">
                        <label for="celular">Celular</label>
                        <input class="form-control" id="celular" name="celular" maxlength="9" placeholder="Ingrese número de celular" pattern="[0-9]*$" type="text" maxlength="250" value="{{isset($fichaDatosPersonales->celular) ? $fichaDatosPersonales->celular : ''}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="celular">Teléfono <small class="text-muted">(sin guiones)</small></label>
                        <input class="form-control" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" type="text" maxlength="20" pattern="[0-9]*$" value="{{isset($fichaDatosPersonales->telefono) ? $fichaDatosPersonales->telefono : ''}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email">E-mail</label>
                        <input class="form-control" id="email" name="email" placeholder="Ingrese email" type="email" maxlength="250" value="{{isset($fichaDatosPersonales->email) ? $fichaDatosPersonales->email : ''}}">
                    </div>
                    
                    <h3 class="col-md-12">Contacto Alternativo</h3>
                    <div class="form-group col-md-12">
                        <label for="nombreContacto">Nombre Contacto</label>
                        <input class="form-control" id="nombreContacto" name="nombreContacto" placeholder="Ingrese el nombre de un contacto del asistido" maxlength="250" type="text" value="{{isset($fichaDatosPersonales->nombreContacto) ? $fichaDatosPersonales->nombreContacto : ''}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="telefonoContacto">Teléfono Contacto <small class="text-muted">(sin guiones)</small></label>
                        <input class="form-control" id="telefonoContacto" name="telefonoContacto"  pattern="[0-9]*$" placeholder="Ingrese teléfono del contacto del asistido" maxlength="20" type="text" pattern="[0-9]*$" value="{{isset($fichaDatosPersonales->telefonoContacto) ? $fichaDatosPersonales->telefonoContacto : ''}}">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="mailContacto">E-mail Contacto</label>
                        <input class="form-control" id="mailContacto" name="mailContacto" placeholder="Ingrese e-mail del contacto del asistido" type="email" maxlength="250" value="{{isset($fichaDatosPersonales->mailContacto) ? $fichaDatosPersonales->mailContacto : ''}}">
                    </div>
                    
                    <div class="box-footer">
                        <button type="submit" class="btn btn-danger pull-right guardarBtn"> Guardar Cambios</button>
                    </div>
                
                </div>    
            </form>
        </div> 
    </div>
</div>

<script type="text/javascript">
    
    $('.guardarBtn').click(function (e) {

        e.preventDefault();

        if ($('#fichaDatosPersonales-form')[0].checkValidity()) {

            formData = new FormData($('#fichaDatosPersonales-form')[0]);

            bootbox.dialog({
                message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía la consulta.</p>',
                closeButton: false
            });

            $.ajax({
                url: "{{url('/fichaDatosPersonales/store', ['asistido_id'=>$asistido->id]) }}",
                type: "POST",
                enctype: 'multipart/form-data',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(datos)
                {   
                    $('.bootbox.modal').modal('hide');

                    if (datos.status) {

                        lanzarAlerta('exito', 'Ficha actualizada correctamente.');
                    }
                    else {
                        lanzarAlerta('peligro', 'Ocurrió un error al actualizar los datos. Verificá la información y volvé a intentar.');
                    }

                },
                error: function(data) {                 
                    $('.bootbox..modal').modal('hide');
                    lanzarAlerta('peligro', 'Ocurrió un error al publicar el formulario. Vuelva a intentarlo.');
                }

            });

        } else {
            lanzarAlerta('peligro', 'Errores de Validacion');
        }


    });


</script>
