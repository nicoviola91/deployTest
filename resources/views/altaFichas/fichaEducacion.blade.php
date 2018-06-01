@extends('layouts.adminApp')


@section('title')
	Ficha Educacion
@endsection

@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

	<!-- <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->

@endsection

@section('pageHeader')
<h1>
	Ficha Educacion
</h1>

@endsection

@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
        <div class="box-body">


            <div class="box-group">
              <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
              <div class="panel box box-warning">

                <div class="box-header with-border black">
                  <h4 class="box-title">
                    <a data-toggle="collapse" href="#collapseOne">
                      Educación Primaria
                    </a>
                  </h4>
                </div>

                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body ">
                        @if(isset($fichaeducacion))
                            @if (isset($fichaEducacion->checklistPrimaria)) 
                            @foreach($primarias as $primaria)
                                <div class="box-tools pull-right">
                                    <a href="{{ route('fichaEducacion.destroyEducacion',['educacion_id'=>$educacion->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$educacion->id}}" data-toggle="tooltip" data-title="Descartar Educacion">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <dl class="dl-horizontal" >
                                  @if(isset($primaria->nivelAlcanzado))
                                    <dt>Nivel Alcanzado</dt>
                                    <dd>{{$primaria->nivelAlcanzado}}</dd>
                                  @endif
                                  @if(isset($primaria->$direccion->calle))
                                  <dt>Calle</dt>
                                  <dd>{{$primaria->$direccion->calle}}</dd>
                                  @endif
                                  
                                  @if(isset($primaria->inicio))
                                  <dt>Inicio de los estudios</dd>
                                  <dd>{{$primaria->inicio}}</dd>
                                  @endif

                                  @if(isset($primaria->fin))
                                  <dt>Fin de los estudios</dd>
                                  <dd>{{$primaria->fin}}</dd>
                                  @endif

                                  @if(isset($primaria->comentarios))
                                  <dt>Comentarios</dd>
                                  <dd>{{$primaria->comentarios}}</dd>
                                  @endif
                                </dl>
                            @endforeach
                            @endif
                        @endif
                     
                    <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Contacto</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="modal-agregar">

                    <div class="modal-dialog modal-lg">

                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          </div>
                          <h4 class="modal-title"> Agregar Educación Primaria </h4>
                  
                        <form id="nuevoContacto-form" method="POST" action="{{ route('fichaEducacion.storeEducacion',['asistido_id'=>$asistido->id,'tipoEducacion_id'=>'1']) }}">
                              {{ csrf_field() }}
                               
                               <div class="box-body"><div class="form-group">
                                           
                                           <div class="form-group">
                                             {!! Form::Label('nivelAlcanzado', 'Nivel alcanzado') !!}
                                             <select class="form-control" name="nivelAlcanzado" id="nivelAlcanzado" required>
                                               @foreach($niveles as $nivel)
                                                 <option value="{{$nivel}}">{{$nivel}}</option>
                                               @endforeach
                                             </select>
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('institucion') ? ' has-error' : '' }}">
                                             <label for="institucion">Escuela (nombre completo)</label>
                                             <input type="text" class="form-control" id="institucion" placeholder="Escuela" name="institucion">
                                             @if ($errors->has('institucion'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('institucion') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('calle') ? ' has-error' : '' }}">
                                             <label for="calle">Calle</label>
                                             <input type="text" class="form-control" id="calle" placeholder="Calle" name="calle">
                                             @if ($errors->has('calle'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('calle') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                                        
                                           <div class="form-group {{ $errors->has('inicio') ? ' has-error' : '' }}">
                                              <label for="inicio">Inicio de los estudios</label>
                                              <input type="date" class="form-control" id="inicio" placeholder="Inicio de los estudios" name="inicio">
                                              @if ($errors->has('inicio'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('inicio') }}</strong>
                                                </span>
                                              @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('fin') ? ' has-error' : '' }}">
                                                <label for="fin">Fin de los estudios</label>
                                                <input type="date" class="form-control" id="fin" placeholder="Fin de los estudios" name="fin">
                                                @if ($errors->has('fin'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('fin') }}</strong>
                                                  </span>
                                                @endif
                                              </div>

                                              <div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                                                  <label for="comentarios">Comentarios</label>
                                                  <input type="text" class="form-control" id="comentarios" placeholder="Comentarios adicionales" name="comentarios">
                                                  @if ($errors->has('comentarios'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('comentarios') }}</strong>
                                                    </span>
                                                  @endif
                                                </div>
                                              
                                        </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-danger">Agregar Educación Primaria</button>
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