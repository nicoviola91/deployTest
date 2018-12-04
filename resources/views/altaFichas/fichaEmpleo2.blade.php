
<div class="row">

    <div class="col-md-12">
      <h3 class="box-title"><i class="icon fa fa-briefcase fa-fw"></i> Ficha Empleo
      <span class="pull-right">
        <a href="javascript:window.print()" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</a>
      </span>
      </h3>
    </div>

    <div class="col-md-10 col-md-offset-1">
    <div class="box-body">
        
        <div class="box-group">

        <div class="panel box box-danger">
          

          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseOne">Empleos</a>
            </h4>
          </div>
          
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(isset($fichaEmpleo))
              
                @foreach($empleos as $empleo)
                  <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$empleo->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Empleo" class="no-print">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  
                  <dl class="dl-horizontal preventoverflow" >

                    @if(isset($empleo->puesto))
                    <dt>Puesto</dt>
                    <dd>{{$empleo->puesto}}</dd>
                    @endif
                    @if(isset($empleo->empleador))
                    <dt>Empleador</dt>
                    <dd>{{$empleo->empleador}}</dd>
                    @endif
                    @if(isset($empleo->descripcion))
                    <dt>Descripción</dt>
                    <dd>{{$empleo->descripcion}}</dd>
                    @endif
                    @if(isset($empleo->inicio))
                    <dt>Fecha de inicio</dt>
                    <dd>{{$empleo->inicio}}</dd>
                    @endif
                    @if(isset($empleo->fin))
                    <dt>Fecha de finalización</dt>
                    <dd>{{$empleo->fin}}</dd>
                    @endif
                    @if(isset($empleo->nombreReferente))
                    <dt>Nombre de referente</dt>
                    <dd>{{$empleo->nombreReferente}}</dd>
                    @endif
                    @if(isset($empleo->telefonoReferente))
                    <dt>Teléfono referente</dt>
                    <dd>{{$empleo->telefonoReferente}}</dd>
                    @endif
                    
                    @if(isset($empleo->puestoReferente))
                    <dt>Puesto del referente</dt>
                    <dd>{{$empleo->puestoReferente}}</dd>
                    @endif

                    @if(isset($empleo->mailReferente))
                    <dt>E mail del referente</dt>
                    <dd>{{$empleo->mailReferente}}</dd>
                    @endif

                    @if(isset($empleo->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$empleo->direccion->calle}}</dd>
                    @endif

                    @if(isset($empleo->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$empleo->direccion->numero}}</dd>
                    @endif

                    @if(isset($empleo->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$empleo->direccion->piso}}</dd>
                    @endif

                    @if(isset($empleo->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$empleo->direccion->departamento}}</dd>
                    @endif

                    @if(isset($empleo->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$empleo->direccion->entreCalles}}</dd>
                    @endif

                    @if(isset($empleo->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$empleo->direccion->provincia}}</dd>
                    @endif

                    @if(isset($empleo->direccion->codigoPostal))
                    <dt>Código Postal</dt>
                    <dd>{{$empleo->direccion->codigoPostal}}</dd>
                    @endif

                    @if(isset($empleo->direccion->pais))
                    <dt>País</dt>
                    <dd>{{$empleo->direccion->pais}}</dd>
                    @endif

                  </dl>
                @endforeach
                @endif 


              <a href="#" data-toggle="modal" data-target="#modal-agregar" class="no-print"><i align="left" class="fa fa-plus"></i>  Agregar Empleo</a>
            </div>
          </div>
            <div class="box-body">
                <form id="consideracionesGenerales-form" method="POST" action="{{ url('/fichaEmpleo/storeConsideraciones',['asistido_id'=>$asistido->id]) }}" >
                    {{ csrf_field() }}

                    <div class="form-group {{ $errors->has('checklistTieneEmpleo') ? ' has-error' : '' }}">
                        <label for="checklistTieneEmpleo">El asistido actualmente tiene empleo</label>
                        <input type="checkbox" id="checklistTieneEmpleo" name="checklistTieneEmpleo" {{(isset($fichaEmpleo->checklistTieneEmpleo) && $fichaEmpleo->checklistTieneEmpleo==1)  ? 'checked':''}}>
                        @if ($errors->has('checklistTieneEmpleo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checklistTieneEmpleo') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div align="center">
                        <button  type="submit" class="btn btn-danger guardarBtn">Guardar Ficha de Empleo</button>
                    </div>  

                </form>  
            </div>
        </div>
      </div>

      <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title"> Agregar Empleo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('fichaEmpleo.storeEmpleo',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group col-md-12 {{ $errors->has('empleador') ? ' has-error' : '' }}">
                        <label for="empleador">Ingrese nombre de la empresa</label>
                        <input type="text" class="form-control" id="empleador" placeholder="Ingrese el nombre del empleador" name="empleador" maxlength="250" required>
                        @if ($errors->has('empleador'))
                            <span class="help-block">
                                <strong>{{ $errors->first('empleador') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('puesto') ? ' has-error' : '' }}">
                        <label for="puesto">Puesto</label>
                        <input type="text" class="form-control" id="puesto" placeholder="Ingrese el puesto" name="puesto" maxlength="250" required>
                        @if ($errors->has('puesto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('puesto') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" placeholder="Ingrese una descripción" name="descripcion" maxlength="250">
                        @if ($errors->has('descripcion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('descripcion') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('inicio') ? ' has-error' : '' }}">
                        <label for="inicio">Inicio de la relación laboral</label>
                        <input type="date" class="form-control" id="inicio" placeholder="Ingrese cuando inició el empleo" name="inicio">
                        @if ($errors->has('inicio'))
                            <span class="help-block">
                                <strong>{{ $errors->first('inicio') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('fin') ? ' has-error' : '' }}">
                        <label for="fin">Fin de la relación laboral</label>
                        <input type="date" class="form-control" id="fin" placeholder="Ingrese finalizó el empleo" name="fin">
                        @if ($errors->has('fin'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fin') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12">
                        <label class="col-md-12">Ubicación</label>
                        <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false" maxlength="250" >
                        <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Calle</label>
                        <input class="form-control" id="route" name="calle" maxlength="250" required>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Número</label>
                        <input class="form-control" id="street_number" name="numero" maxlength="250">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Piso</label>
                        <input class="form-control" name="piso" maxlength="250">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Dpto</label>
                        <input class="form-control" name="departamento" maxlength="250">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Localidad</label>
                        <input class="form-control" id="locality" name="localidad" maxlength="250">
                    </div>
                    <div class="form-group col-md-3">
                        <label>CP</label>
                        <input class="form-control" id="postal_code" name="codigoPostal" maxlength="250">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Provincia</label>
                        <input class="form-control" id="administrative_area_level_1" name="provincia" maxlength="250">
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Pais</label>
                        <input class="form-control" id="country" name="pais" maxlength="250">
                    </div>

                    <input class="form-control" id="lat" name="lat" style="display: none;">
                    <input class="form-control" id="lng" name="lng" style="display: none;">

                    <div class="form-group col-md-12">
                        <label>Entre calles</label>
                        <input class="form-control" name="entreCalles" maxlength="250">
                    </div>
                            
                    <div class="referente">
                
                        <div class="form-group col-md-12 {{ $errors->has('nombreReferente') ? ' has-error' : '' }}">
                            <label for="nombreReferente">Nombre del referente</label>
                            <input type="text" class="form-control" id="nombreReferente" placeholder="Ingrese nombre y apellido de un referente " name="nombreReferente" maxlength="250">
                            @if ($errors->has('nombreReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombreReferente') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('telefonoReferente') ? ' has-error' : '' }}">
                            <label for="telefonoReferente">Teléfono del referente</label>
                            <input type="text" class="form-control" id="telefonoReferente" placeholder="Ingrese un teléfono del referente " name="telefonoReferente" maxlength="250">
                            @if ($errors->has('telefonoReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefonoReferente') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group col-md-12 {{ $errors->has('puestoReferente') ? ' has-error' : '' }}">
                            <label for="puestoReferente">Puesto del referente</label>
                            <input type="text" class="form-control" id="puestoReferente" placeholder="Ingrese el puesto del referente" name="puestoReferente"maxlength="250">
                            @if ($errors->has('puestoReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('puestoReferente') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('mailReferente') ? ' has-error' : '' }}">
                            <label for="mailReferente">E-mail del referente</label>
                            <input type="email" class="form-control" id="mailReferente" placeholder="Ingrese un e-mail del referente " name="mailReferente" maxlength="250">
                            @if ($errors->has('mailReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mailReferente') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> <!--cierra referente -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Agregar </button>
                </div>
                </form>
            </div>
            </div>
        </div>

        <div class="modal modal-danger fade" id="delete" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title text-center">Atención!</h4>
                </div>
                <form action="{{ route('fichaEmpleo.destroyEmpleo',['id','asistidoid'])}}" method="POST">
                    {{method_field('get')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">¿Está seguro que desea eliminar? Esta acción es irreversible</p>
                        <input type="hidden" name='id' id='id' value="">
                        <input type="hidden" name='asistidoid' id='asistidoid' value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">No, cancelar</button>
                        <button type="submit" class="btn btn-outline">Si, eliminar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
        
        </div>

    </div>
</div>

@include('scripts.googleMaps')

<script type="text/javascript">

    $('#delete').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })
</script>

<script type="text/javascript">
    
    $('.guardarBtn').click(function (e) {

        e.preventDefault();

        if ($('#consideracionesGenerales-form')[0].checkValidity()) {

            formData = new FormData($('#consideracionesGenerales-form')[0]);

            bootbox.dialog({
                message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía la consulta.</p>',
                closeButton: false
            });

            $.ajax({
                url: "{{ url('/fichaEmpleo/storeConsideraciones',['asistido_id'=>$asistido->id]) }}",
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
