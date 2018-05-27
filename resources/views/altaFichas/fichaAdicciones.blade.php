@extends('layouts.adminApp')


@section('title')
	Ficha de Adicciones
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
	Ficha de Adicciones
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-exclamation-triangle"></i> Asistidos</a></li>
	<li class="active">Listado</li>
</ol>
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
                      Adicciones
                    </a>
                  </h4>
                </div>

                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body ">
                           
                            @if(isset($fichaAdiccion))
                                @if ($fichaAdiccion->checklistAdicciones==1) 
                                @foreach($adicciones as $adiccion)
                                
                                    <div class="box-tools pull-right">
                                        <a href="{{ route('fichaAdicciones.destroyAdiccion',['adiccion_id'=>$adiccion->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$adiccion->id}}" data-toggle="tooltip" data-title="Descartar Solicitud">
                                          <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                    <dl class="dl-horizontal" >
                                        <dt>Sustancia de inicio</dt>
                                        <dd>{{$adiccion->sustanciaInicio}}</dd>

                                        <dt>Sustancia de fin</dt>
                                        <dd>{{$adiccion->sustanciaFin}}</dd>
                                        
                                        @if(isset($adiccion->frecuencia))
                                        <dt>Frecuencia</dd>
                                        <dd>{{$adiccion->frecuencia}}</dd>
                                        @endif
                                        @if(isset($adiccion->modalidad))
                                        <dt>Modalidad</dd>
                                        <dd>{{$adiccion->modalidad}}</dd>
                                        @endif
                                        @if(isset($adiccion->edadInicio))
                                        <dt>Edad de inicio</dd>
                                        <dd>{{$adiccion->edadInicio}}</dd>
                                        @endif
                                    </dl>
                                @endforeach
                                @endif
                            @endif
                     
                    <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Adicción</a>
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
                          <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Adicción </h4>
                        </div>
                  
                        <form id="nuevaAdiccion-form" method="POST" action="{{ url('/fichaAdicciones/storeAdiccion',['asistido_id'=>$asistido->id]) }}">
                              {{ csrf_field() }}
                               
                               <div class="box-body"><div class="form-group">
                                            
                                             {!! Form::Label('sustanciaInicio', 'Sustancia de inicio:') !!}
                                             <select class="form-control" name="sustanciaInicio" id="sustanciaInicio" required >
                                               @foreach($sustancias as $sustancia)
                                                 <option value="{{$sustancia->sustancia}}">{{$sustancia->sustancia}}</option>
                                               @endforeach
                                             </select>
                                           </div>
                                           
                                           <div class="form-group">
                                             {!! Form::Label('sustanciaFin', 'Sustancia de fin:') !!}
                                             <select class="form-control" name="sustanciaFin" id="sustanciaFin "required>
                                               @foreach($sustancias as $sustancia)
                                                 <option value="{{$sustancia->sustancia}}">{{$sustancia->sustancia}}</option>
                                               @endforeach
                                             </select>
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('frecuencia') ? ' has-error' : '' }}">
                                             <label for="frecuencia">Frecuencia</label>
                                             <input type="text" class="form-control" id="frecuencia" placeholder="Frecuencia" name="frecuencia">
                                             @if ($errors->has('frecuencia'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('frecuencia') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('modalidad') ? ' has-error' : '' }}">
                                             <label for="modalidad">Modalidad</label>
                                             <input type="text" class="form-control" id="modalidad" placeholder="Modalidad" name="modalidad">
                                             @if ($errors->has('modalidad'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('modalidad') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                                        
                                           <div class="form-group {{ $errors->has('edadInicio') ? ' has-error' : '' }}">
                                                <label for="edadInicio">Edad de inicio</label>
                                                <input type="number" class="form-control" id="edadInicio" placeholder="Edad de inicio" name="edadInicio">
                                                @if ($errors->has('edadInicio'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('edadInicio') }}</strong>
                                                  </span>
                                                @endif
                                              </div>
                                        </div>
                  
                            
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-danger">Agregar Adicción</button>
                                </div>
                        </form>
                  
                      </div>
                    </div>
                  </div>

            <div class="box-group">
              <div class="panel box box-danger">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" href="#collapseTwo">
                      Episodios Agresivos
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                  <div class="box-body">
                        <a href="#" data-toggle="modal" data-target="#modal-default3"><i align="left" class="fa fa-plus"></i>  Agregar Episodio Agresivo</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade in" id="modal-default3" style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Agregar Episodio Agresivo</h4>
                            </div>
                            <div class="modal-body">
                                <form id="adicciones-form" method="POST" action="" >
                                    {{ csrf_field() }}
                                        <div class="box-body">
                                        <div class="form-group">
                                            <input class="form-control" id="tipo" name="tipo" placeholder="Tipo" type="text" required >
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" id="lugar" name="lugar" placeholder="Lugar" type="text">
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" id="fecha" name="fecha" placeholder="Fecha" type="date">
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" id="estado" name="estado" placeholder="Estado" type="text" >
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" id="causaFin" name="causaFin" placeholder="Si el tratamiento finalizó indique la causa" type="text" >
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" id="comentarios" name="comentarios" placeholder="Comentarios" type="text" >
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Guardar</button>
                            </div>
                        </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
            <div class="box-group">
              <div class="panel box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <a data-toggle="collapse" href="#collapseThree">
                      Tratamientos
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse in">
                  <div class="box-body">
                        <a href="#" data-toggle="modal" data-target="#modal-default3"><i align="left" class="fa fa-plus"></i>  Agregar Tratamiento</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade in" id="modal-default2" style="display: none; padding-right: 17px;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">Agregar Tratamiento</h4>
                            </div>
                            <div class="modal-body">
                                <form id="adicciones-form" method="POST" action="" >
                                    {{ csrf_field() }}
                                        <div class="box-body">
                                        <div class="form-group">
                                            <input class="form-control" id="tipo" name="tipo" placeholder="Tipo" type="text" required >
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" id="inicio" name="inicio" placeholder="Inicio" type="date">
                                        </div>
                                        <div class="form-group">
                                                <input class="form-control" id="fin" name="fin" placeholder="Fin" type="date">
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Guardar</button>
                            </div>
                        </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>  
            </div>
          </div>
          <!-- /.box-body -->
@endsection