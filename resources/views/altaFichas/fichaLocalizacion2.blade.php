<div class="row">


    <div class="col-md-12">
        <h3 class="box-title"><i class="icon fa fa-location-arrow fa-fw"></i> Ficha Localización
        <span class="pull-right">
        <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
        <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button>
        </span>
        </h3>
    </div>  

  <div class="col-md-10 col-md-offset-1">
    <div class="box-body">
      <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseOne" style="color: black;">
                Localización o Zona de Permanencia
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(isset($fichaLocalizacion))
              
                @foreach($localizaciones as $localizacion)
                  <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$localizacion->id}}" data-asistidoid="{{$asistido->id}}" data-localizacionozona="{{$localizacion->localizacionOZona}}" data-toggle="modal" data-title="Descartar Localizacion">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  
                  <span>Localización Habitual</span>
                  <dl class="dl-horizontal preventoverflow" >
                    @if(isset($localizacion->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$localizacion->direccion->calle}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$localizacion->direccion->numero}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$localizacion->direccion->piso}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$localizacion->direccion->departamento}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$localizacion->direccion->entreCalles}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->localidad))
                    <dt>Localidad</dt>
                    <dd>{{$localizacion->direccion->localidad}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$localizacion->direccion->provincia}}</dd>
                    @endif
                    
                    @if(isset($localizacion->condicion))
                    <dt>Condición</dd>
                    <dd>{{$localizacion->condicion}}</dd>
                    @endif

                    @if(isset($localizacion->vivienda))
                    <dt>Vivienda</dd>
                    <dd>{{$localizacion->vivienda}}</dd>
                    @endif

                    @if(isset($localizacion->tipo))
                    <dt>Tipo</dd>
                    <dd>{{$localizacion->tipo}}</dd>
                    @endif

                    @if(isset($localizacion->referenteNombre))
                    <dt>Referente de vivienda</dd>
                    <dd>{{$localizacion->referenteNombre}}</dd>
                    @endif

                    @if(isset($localizacion->referenteTelefono))
                    <dt>Teléfono referente</dd>
                    <dd>{{$localizacion->referenteTelefono}}</dd>
                    @endif

                    @if(isset($localizacion->referenteEmail))
                    <dt>E-mail referente</dd>
                    <dd>{{$localizacion->referenteEmail}}</dd>
                    @endif

                  </dl>
                @endforeach
                @endif 


                @if(isset($fichaLocalizacion))
              
                @foreach($zonas as $zona)
                  <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$zona->id}}" data-asistidoid="{{$asistido->id}}" data-localizacionozona="{{$zona->localizacionOZona}}" data-toggle="modal" data-title="Descartar Zona">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  <span>Zona de permanencia</span>
                  <br>
                  <dl class="dl-horizontal preventoverflow" >

                    @if(isset($zona->zona))
                    <dt>Zona habitual</dt>
                    <dd>{{$zona->zona}}</dd>
                    @endif

                    @if(isset($zona->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$zona->direccion->calle}}</dd>
                    @endif
                    @if(isset($zona->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$zona->direccion->numero}}</dd>
                    @endif
                    @if(isset($zona->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$zona->direccion->piso}}</dd>
                    @endif
                    @if(isset($zona->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$zona->direccion->departamento}}</dd>
                    @endif
                    @if(isset($zona->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$zona->direccion->entreCalles}}</dd>
                    @endif
                    @if(isset($zona->direccion->localidad))
                    <dt>Localidad</dt>
                    <dd>{{$zona->direccion->localidad}}</dd>
                    @endif
                    @if(isset($zona->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$zona->direccion->provincia}}</dd>
                    @endif

           
                    @if(isset($zona->puntosDeReferencia))
                    <dt>Puntos de referencia</dd>
                    <dd>{{$zona->puntosDeReferencia}}</dd>
                    @endif

                    @if(isset($zona->dias))
                    <dt>Días</dd>
                    <dd>{{$zona->dias}}</dd>
                    @endif

                    @if(isset($zona->de))
                    <dt>Desde</dd>
                    <dd>{{$zona->de}}</dd>
                    @endif

                    @if(isset($zona->hasta))
                    <dt>Hasta</dd>
                    <dd>{{$zona->hasta}}</dd>
                    @endif

                    @if(isset($zona->observaciones))
                    <dt>Observaciones</dd>
                    <dd>{{$zona->observaciones}}</dd>
                    @endif

                  </dl>
                @endforeach
                @endif 
              <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Localización Habitual o Zona de permanencia</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"> Agregar Localización Habitual o Zona de Permanencia </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('FichaLocalizacion.storeLocalizacion',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">


                    <div class="form-group col-md-12 localizacionOZona">
                        {!! Form::Label('localizacionOZona', 'Agregar localización habitual o zona de permanencia') !!}
                        <select class="form-control" name="localizacionOZona" id="localizacionOZona" required>
                            <option selected="selected" value="Localizacion" >Localización</option>
                            <option value="Zona" >Zona de permanecia</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label class="col-md-12">Ubicación</label>
                        <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false" maxlength="250">
                        <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Calle</label>
                        <input class="form-control" id="route" name="calle" maxlength="250" required ></input>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Número</label>
                        <input class="form-control" id="street_number"  maxlength="250" name="numero"></input>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Piso</label>
                        <input class="form-control" maxlength="250" name="piso"></input>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Dpto</label>
                        <input class="form-control" maxlength="250" name="departamento"></input>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Localidad</label>
                        <input class="form-control" id="locality" maxlength="250" name="localidad"></input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>CP</label>
                        <input class="form-control" id="postal_code" maxlength="250" name="codigoPostal"></input>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Provincia</label>
                        <input class="form-control" id="administrative_area_level_1" maxlength="250" name="provincia"></input>
                    </div>
                    
                    <div class="form-group col-md-3">
                        <label>Pais</label>
                        <input class="form-control" id="country" maxlength="250" name="pais"></input>
                    </div>

                    <input class="form-control" id="lat" name="lat" style="display: none;"></input>
                    <input class="form-control" id="lng" name="lng" style="display: none;"></input>

                    <div class="form-group col-md-12">
                        <label>Mas detalles (entre calles o puntos de referencia)</label>
                        <input class="form-control" name="entreCalles" maxlength="250"></input>
                    </div>
                            
                   
              
                    <div class="localizacion">
                        <div class="form-group col-md-12">
                            {!! Form::Label('condicion', 'Condición') !!}
                            <select class="form-control" name="condicion" id="condicion" required>
                                <option value="Calle">Situación de calle</option>
                                <option selected="selected" value="Vivienda" >Vivienda</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12 vivienda">
                            {!! Form::Label('vivienda', 'Vivienda') !!}
                            <select class="form-control" name="vivienda" id="vivienda" >
                                <option value="Casa" selected="selected">Casa</option>
                                <option value="Departamento">Departamento</option>
                                <option value="Hotel">Hotel/Hostel</option>
                            </select>
                        </div>

                        <div class="referente">

                            <div class="form-group col-md-12 tipo">
                                {!! Form::Label('tipo', 'Tipo') !!}
                                <select class="form-control" name="tipo" id="tipo" >
                                    <option value="Propietario">Propietario</option>
                                    <option value="Inquilino">Inquilino</option>
                                    <option value="Familiar">Familiar</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 {{ $errors->has('referenteNombre') ? ' has-error' : '' }}">
                                <label for="referenteNombre">Nombre del encargado de la vivienda</label>
                                <input type="text" class="form-control" id="referenteNombre" maxlength="250" placeholder="Ingrese nombre y apellido de un referente de la vivienda" name="referenteNombre">
                                @if ($errors->has('referenteNombre'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteNombre') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('referenteTelefono') ? ' has-error' : '' }}">
                                <label for="referenteTelefono">Teléfono del encargado de la vivienda</label>
                                <input type="text" class="form-control" id="referenteTelefono" maxlength="250" placeholder="Ingrese un teléfono del referente de la vivienda" name="referenteTelefono">
                                @if ($errors->has('referenteTelefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteTelefono') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group col-md-12 {{ $errors->has('referenteEmail') ? ' has-error' : '' }}">
                                <label for="referenteEmail">E-mail del encargado de la vivienda</label>
                                <input type="email" class="form-control" id="referenteEmail" maxlength="250" placeholder="Ingrese un e-mail del referente de la vivienda" name="referenteEmail">
                                @if ($errors->has('referenteEmail'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('referenteEmail') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div> <!--cierra referente -->
                    </div> <!--cierra la localizacion para ajax-->

                    <div class="zona">
                        <span class="col-md-12">Ingrese días y horarios en que el asistido se encuentra en la zona de permanencia</span>
                        <br>
                        <div class="form-group col-md-12 {{ $errors->has('dias') ? ' has-error' : '' }}">
                            <label for="dias">Días</label>
                            <input type="text" class="form-control" id="dia" maxlength="250" placeholder="Ingrese días" name="dias">
                            @if ($errors->has('dias'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('dias') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('de') ? ' has-error' : '' }}">
                            <label for="de">Desde</label>
                            <input type="text" class="form-control" id="de" maxlength="250" placeholder="Ingrese desde que horario se encuentra" name="de">
                            @if ($errors->has('de'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('de') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group col-md-12 {{ $errors->has('hasta') ? ' has-error' : '' }}">
                            <label for="hasta">Hasta</label>
                            <input type="text" class="form-control" id="hasta" maxlength="250" placeholder="Ingrese hasta que horario se encuentra" name="hasta">
                            @if ($errors->has('hasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('hasta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div> <!--cierra la zona de permanencia para ajax-->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Agregar </button>
                </div>
                </form>
            </div>
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
                <form action="{{ route('FichaLocalizacion.destroyLocalizacion',['id','asistidoid','localizacionozona'])}}" method="POST">
                    {{method_field('get')}}
                    {{csrf_field()}}
                    <div class="modal-body">
                        <p class="text-center">¿Está seguro que desea eliminar? Esta acción es irreversible</p>
                        <input type="hidden" name='id' id='id' value="">
                        <input type="hidden" name='asistidoid' id='asistidoid' value="">
                        <input type="hidden" name='localizacionozona' id='localizacionozona' value="">
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

    window.onload=function(){

        $('#localizacionOZona').val('Localizacion');
        $('.localizacion').show();
        $('.zona').hide();
        //select condicion tiene q ser vivienda
        $('#condicion').val('Vivienda');
        //vivienda por defecto casa vivienda  Casa
        $('#vivienda').val('Casa');
        //referente mostrar
        $('.referente').show();
    }

  $('#localizacionOZona').change(function () {

    if ($(this).val() == 'Localizacion') {
        $('.localizacion').show();
        $('.zona').hide();

    } else {

        $('.zona').show();
        $('.localizacion').hide();

    } 
    });
    
    $('#condicion').change(function () {

      if ($(this).val() == 'Vivienda') {

        $('.vivienda').show();
        $('.referente').show();
        $('.tipo').show();

      } else {

        $('.vivienda').hide();
        $('.referente').hide();
        $('.tipo').hide();
    
      } 
    });

    $('#vivienda').change(function () {

    if ($(this).val() == 'Casa' || $(this).val() == 'Departamento') {

        $('.referente').show();

    } else {

        $('.referente').hide();

    } 
    });

    $('#delete').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var localizacionozona=a.data('localizacionozona')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
        modal.find('.modal-body #localizacionozona').val(localizacionozona)
    })

  </script>
