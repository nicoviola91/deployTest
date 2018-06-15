@extends('layouts.adminApp')
@extends('scripts.googleMaps')


@section('title')
	Ficha Epleo
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
	Ficha Empleo
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
                Empleos
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(isset($fichaEmpleo))
              
                @foreach($empleos as $empleo)
                  <div class="box-tools pull-right">
                    <a href="{{ route('fichaEmpleo.destroyEmpleo',['id'=>$empleo->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$empleo->id}}" data-toggle="tooltip" data-title="Descartar Empleo">
                        <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  
                  <dl class="dl-horizontal" >
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
                    <dt>Puesto del referente</dd>
                    <dd>{{$empleo->puestoReferente}}</dd>
                    @endif

                    @if(isset($empleo->mailReferente))
                    <dt>E mail del referente</dd>
                    <dd>{{$empleo->mailReferente}}</dd>
                    @endif

                    @if(isset($empleo->direccion->calle))
                    <dt>Calle</dd>
                    <dd>{{$empleo->direccion->calle}}</dd>
                    @endif

                    @if(isset($empleo->direccion->numero))
                    <dt>Número</dd>
                    <dd>{{$empleo->direccion->numero}}</dd>
                    @endif

                    @if(isset($empleo->direccion->piso))
                    <dt>Piso</dd>
                    <dd>{{$empleo->direccion->piso}}</dd>
                    @endif

                    @if(isset($empleo->direccion->departamento))
                    <dt>Departamento</dd>
                    <dd>{{$empleo->direccion->departamento}}</dd>
                    @endif

                    @if(isset($empleo->direccion->entreCalles))
                    <dt>Entre calles</dd>
                    <dd>{{$empleo->direccion->entreCalles}}</dd>
                    @endif

                    @if(isset($empleo->direccion->provincia))
                    <dt>Provincia</dd>
                    <dd>{{$empleo->direccion->provincia}}</dd>
                    @endif

                    @if(isset($empleo->direccion->codigoPostal))
                    <dt>Código Postal</dd>
                    <dd>{{$empleo->direccion->codigoPostal}}</dd>
                    @endif

                    @if(isset($empleo->direccion->pais))
                    <dt>País</dd>
                    <dd>{{$empleo->direccion->pais}}</dd>
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

                <h4 class="modal-title"> Agregar Empleo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('fichaEmpleo.storeEmpleo',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group col-md-12 {{ $errors->has('empleador') ? ' has-error' : '' }}">
                        <label for="empleador">Ingrese nombre de la empresa</label>
                        <input type="text" class="form-control" id="empleador" placeholder="Ingrese el nombre del empleador" name="empleador" required>
                        @if ($errors->has('empleador'))
                            <span class="help-block">
                                <strong>{{ $errors->first('empleador') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('puesto') ? ' has-error' : '' }}">
                        <label for="puesto">Puesto</label>
                        <input type="text" class="form-control" id="puesto" placeholder="Ingrese el puesto" name="puesto" required>
                        @if ($errors->has('puesto'))
                            <span class="help-block">
                                <strong>{{ $errors->first('puesto') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" placeholder="Ingrese una descripción" name="descripcion">
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
                        <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false" >
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
                        <label>Entre calles</label>
                        <input class="form-control" name="entreCalles"></input>
                    </div>
                            
                    <div class="referente">
                
                        <div class="form-group col-md-12 {{ $errors->has('nombreReferente') ? ' has-error' : '' }}">
                            <label for="nombreReferente">Nombre del referente</label>
                            <input type="text" class="form-control" id="nombreReferente" placeholder="Ingrese nombre y apellido de un referente " name="nombreReferente">
                            @if ($errors->has('nombreReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombreReferente') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('telefonoReferente') ? ' has-error' : '' }}">
                            <label for="telefonoReferente">Teléfono del referente</label>
                            <input type="text" class="form-control" id="telefonoReferente" placeholder="Ingrese un teléfono del referente " name="telefonoReferente">
                            @if ($errors->has('telefonoReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefonoReferente') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group col-md-12 {{ $errors->has('puestoReferente') ? ' has-error' : '' }}">
                            <label for="puestoReferente">Puesto del referente</label>
                            <input type="text" class="form-control" id="puestoReferente" placeholder="Ingrese el puesto del referente" name="puestoReferente">
                            @if ($errors->has('puestoReferente'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('puestoReferente') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('mailReferente') ? ' has-error' : '' }}">
                            <label for="mailReferente">E-mail del referente</label>
                            <input type="email" class="form-control" id="mailReferente" placeholder="Ingrese un e-mail del referente " name="mailReferente">
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
        
        </div>




        
    </div>
    </div>
</div>
@endsection

@section('scripts') 

  @include('scripts.googleMaps')

@endsection