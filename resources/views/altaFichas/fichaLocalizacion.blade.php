@extends('layouts.adminApp')
@extends('scripts.googleMaps')


@section('title')
	Ficha Localización
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
	Ficha Localización
</h1>

@endsection

@section('content')
<div class="row">
  <!-- left column -->
  <div class="col-md-10 col-md-offset-1">
    <div class="box-body">
      <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseOne">
                Localización
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(count($fichaLocalizacion)>0)
              
                @foreach($localizaciones as $localizacion)
                  <div class="box-tools pull-right">
                    <a href="{{ route('FichaLocalizacion.destroyLocalizacion',['localizacion_id'=>$localizacion->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$localizacion->id}}" data-toggle="tooltip" data-title="Descartar Localización habitual">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  <dl class="dl-horizontal" >
                    
                    @if(isset($localizacion->condicion))
                    <dt>Ubicación habitual</dt>
                    <dd>{{$localizacion->condicion}}</dd>
                    @endif

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
                    @if(isset($localizacion->nivelAlcanzado))
                      <dt>Nivel Alcanzado</dt>
                      <dd>{{$localizacion->nivelAlcanzado}}</dd>
                    @endif
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

                    @if(isset($localizacion->direccion->pais))
                    <dt>País</dt>
                    <dd>{{$localizacion->direccion->pais}}</dd>
                    @endif
                    @if(isset($localizacion->direccion->codigoPostal))
                    <dt>Código Postal</dt>
                    <dd>{{$localizacion->direccion->codigoPostal}}</dd>
                    @endif
                    
                    @if(isset($localizacion->vivienda))
                    <dt>Vivienda</dd>
                    <dd>{{$localizacion->vivienda}}</dd>
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
              <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Localización Habitual</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Agregar Localización Habitual </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('FichaLocalizacion.storeLocalizacion',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">
                   
              
                  <div class="form-group col-md-12">
                    {!! Form::Label('condicion', 'Condición') !!}
                    <select class="form-control" name="condicion" id="condicion" required>
                        <option value="Calle">Situación de calle</option>
                        <option value="Vivienda" selected="selected">Vivienda</option>
                    </select>
                  </div>

                  <!--  si selecciona vivienda, se desplega todo lo de direccion !-->
                  <div class="direccion">
                    <label class="col-md-12">Dirección de la vivienda</label>
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false">
                        <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Calle</label>
                        <input class="form-control" id="route" name="calle" required></input>
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

                    <input class="form-control" id="lat" name="lat" style="display: none;"></input>
                    <input class="form-control" id="lng" name="lng" style="display: none;"></input>

                    <div class="form-group col-md-12">
                        <label>Mas detalles (entre calles)</label>
                        <input class="form-control" name="entreCalles"></input>
                    </div>
                


                    <div class="form-group col-md-12">
                        {!! Form::Label('vivienda', 'Vivienda') !!}
                        <select class="form-control" name="vivienda" id="vivienda" >
                            <option value="Casa">Casa</option>
                            <option value="Departamento">Departamento</option>
                            <option value="Hotel">Hotel/Hostel</option>
                        </select>
                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::Label('tipo', 'Tipo') !!}
                        <select class="form-control" name="tipo" id="tipo" >
                            <option value="Propietario">Propietario</option>
                            <option value="Inquilino">Inquilino</option>
                            <option value="Familiar">Familiar</option>
                        </select>
                    </div>

                    <div class="referente">
                        <div class="form-group col-md-12 {{ $errors->has('referenteNombre') ? ' has-error' : '' }}">
                            <label for="referenteNombre">Nombre del encargado de la vivienda</label>
                            <input type="text" class="form-control" id="referenteNombre" placeholder="Ingrese nombre y apellido de un referente de la vivienda" name="referenteNombre">
                            @if ($errors->has('referenteNombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('referenteNombre') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('referenteTelefono') ? ' has-error' : '' }}">
                            <label for="referenteTelefono">Teléfono del encargado de la vivienda</label>
                            <input type="text" class="form-control" id="referenteTelefono" placeholder="Ingrese un teléfono del referente de la vivienda" name="referenteTelefono">
                            @if ($errors->has('referenteTelefono'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('referenteTelefono') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('referenteEmail') ? ' has-error' : '' }}">
                            <label for="referenteEmail">E-mail del encargado de la vivienda</label>
                            <input type="email" class="form-control" id="referenteEmail" placeholder="Ingrese un e-mail del referente de la vivienda" name="referenteEmail">
                            @if ($errors->has('referenteEmail'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('referenteEmail') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Agregar localización habitual </button>
                </div>
                </form>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
</div>
@endsection

@section('scripts') 

  @include('scripts.googleMaps')

  <script type="text/javascript">
    
    $('#condicion').change(function () {

      if ($(this).val() == 'Vivienda') {

        $('.direccion').show();

      } else {

        $('.direccion').hide();
    
      } 
    });

    $('#vivienda').change(function () {

    if ($(this).val() == 'Casa' || $(this).val() == 'Departamento') {

        $('.referente').show();

    } else {

        $('.referente').hide();

    } 
    });

  </script>

@endsection