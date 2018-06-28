@extends('layouts.adminApp')


@section('title')
	Ficha de Salud Mental
@endsection

@section('head')

	<!-- DATATABLES -->
	<link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
	<script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  
  <style type="text/css">
    .preventoverflow{
        
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis
    }
	</style>

	<!-- <script src="../../bower_components/datatables.net/js/jquery.dataTables.min.js"></script> -->

@endsection

@section('pageHeader')
<h1>
	Ficha de Salud Mental
</h1>
<div>
  <ol class="breadcrumb">
    <li><a href="{{route('asistido.show',['id'=>$asistido->id])}}"><i class="fa fa-exclamation-triangle"></i> Asistido</a></li>
    <li class="active">Ficha de Salud Mental</li>
  </ol>
</div>
@endsection

@section('content')


<div class="row">

  <div class="col-md-12">
    <h3 class="box-title"><i class="icon fa fa-user-md fa-fw"></i> Ficha de Salud Mental
    <span class="pull-right">
      <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
      <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button>
    </span>
    </h3>
  </div>

  <div class="col-md-10 col-md-offset-1">
      <div class="box-body">

          <div class="box-group">

            <div class="panel box box-warning">
              <div class="box-header with-border black">
                <h4 class="box-title">
                  <a data-toggle="collapse" href="#collapseOne" style="color: black;"> Patologías </a>
                </h4>
              </div>

              <div id="collapseOne" class="panel-collapse collapse in">
                <div class="box-body ">
                  @if(isset($fichaSaludMental))
                    @if (isset($fichaSaludMental->checkPatologias)) 
                      @foreach($patologias as $patologia)
                      
                        <div class="box-tools pull-right">    
                          <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$patologia->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Patologia">
                          <i class="fa fa-trash"></i></a>
                        </div>
                        <dl class="dl-horizontal preventoverflow" >
                        @if(isset($patologia->descripcion))
                          <dt>Patología</dt>
                          <dd>{{$patologia->descripcion}}</dd>
                        @endif
                        @if(isset($patologia->tipo))
                          <dt>Afección</dt>
                          <dd>{{$patologia->tipo}}</dd>
                        @endif
                          
                        @if(isset($patologia->comentarios))
                            <dt>Comentarios</dt>
                            <dd>{{$patologia->comentarios}}</dd>
                        @endif
                        </dl>
                      @endforeach
                    @endif
                  @endif
                   
                  <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Patología</a>
                
                </div>
              </div>
            </div>
          </div>







          <div class="modal fade" id="modal-agregar">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Patología </h4>
                </div>
          
                <form id="nuevaPatologia-form" method="POST" action="{{ route('fichaSaludMental.storePatologia',['asistido_id'=>$asistido->id]) }}">
                  {{ csrf_field() }}
                   
                  <div class="box-body"><div class="form-group">
                                
                    {!! Form::Label('descripcion', 'Patología') !!}
                    <select class="form-control" name="descripcion" id="descripcion" required>
                        @foreach($descripciones as $descripcion)
                            <option value="{{$descripcion}}">{{$descripcion}}</option>
                        @endforeach
                    </select>
                    </div>
                   
                    <div class="form-group">
                     {!! Form::Label('tipo', 'Afección') !!}
                     <select class="form-control" name="tipo" id="tipo ">
                         <option value="Crónica">Crónica</option>
                         <option value="Transitoria">Transitoria</option>
                     </select>
                    </div>
       
                    
                    <div class="form-group {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                     <label for="comentarios">Comentarios</label>
                     <input type="text" class="form-control" id="comentarios" placeholder="Comentarios adicionales" name="comentarios" maxlength="250">
                     @if ($errors->has('comentarios'))
                        <span class="help-block">
                          <strong>{{ $errors->first('comentarios') }}</strong>
                        </span>
                     @endif
                    </div>
      
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Agregar Patología</button>
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
                  <form action="{{ route('fichaSaludMental.destroyPatologia',['id','asistidoid'])}}" method="POST">
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














          <div class="box-group">
            <div class="panel box box-danger">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" href="#collapseTwo" style="color: black;">Medicaciones</a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse in">
                
                  @if(isset($fichaSaludMental))
                  <div class="box-body">
                  @if (isset($fichaSaludMental->checkMedicacion))
                  @foreach($medicaciones as $medicacion)
                      <div class="box-tools pull-right">
                          <i class="fa fa-trash"></i>
                          <a href="#"  data-target="#delete2" class="descartarBtn" data-id="{{$medicacion->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Medicación">
                        </a>
                      </div>
                      <dl class="dl-horizontal preventoverflow" >
                          <dt>Tipo</dt>
                          <dd>{{$medicacion->recetada}}</dd>
                          
                          @if(isset($medicacion->profesional->nombre))
                          <dt>Nombre del profesional que recetó</dt>
                          <dd>{{$medicacion->profesional->nombre}}</dd>
                          @endif
                          @if(isset($medicacion->profesional->apellido))
                          <dt>Apellido del profesional que recetó</dt>
                          <dd>{{$medicacion->profesional->apellido}}</dd>
                          @endif
                          @if(isset($medicacion->receta))
                          <dt>Receta</dt>
                          <dd>{{$medicacion->receta}}</dd>
                          @endif
                          @if(isset($medicacion->droga))
                          <dt>Droga</dt>
                          <dd>{{$medicacion->droga}}</dd>
                          @endif
                          @if(isset($medicacion->dosis))
                          <dt>Dosis</dt>
                          <dd>{{$medicacion->dosis}}</dd>
                          @endif
                          @if(isset($medicacion->frecuencia))
                          <dt>Frecuencia</dt>
                          <dd>{{$medicacion->frecuencia}}</dd>
                          @endif
                          @if(isset($medicacion->inicio))
                          <dt>Inicio</dt>
                          <dd>{{$medicacion->inicio}}</dd>
                          @endif
                          @if(isset($medicacion->fin))
                          <dt>Fin</dt>
                          <dd>{{$medicacion->fin}}</dd>
                          @endif
                      </dl>
                    @endforeach
                    @endif
                <div class="box-body">
                @endif
                  

                <div class="box-body">
                  <a href={{route('fichaSaludMental.storeMedicacion',['asistido_id'=>$asistido->id])}} data-toggle="modal" data-target="#modal-default3"><i align="left" class="fa fa-plus"></i>  Agregar Medicación</a>
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
                        <h4 class="modal-title">Agregar Medicación</h4>
                    </div>
                    <div class="modal-body">
                      
                      <form id="medicaciones-form" method="POST" action="{{ route('fichaSaludMental.storeMedicacion',['asistido_id'=>$asistido->id]) }}" >
                          {{ csrf_field() }}
                          <div class="box-body">
                                <div class="form-group recetada col-md-12" style="display: none;">
                                    {!! Form::Label('recetada', 'Tipo') !!}
                                    <select class="form-control" name="recetada" id="recetada" >
                                        <option value="Indicada bajo receta">Indicada bajo receta</option>
                                        <option value="Automedicación">Automedicación</option>
                                    </select>
                                </div>
                                <div class="profesional">
                                    <div class="form-group {{ $errors->has('nombreProfesional') ? ' has-error' : '' }}">
                                        <label for="nombreProfesional">Nombre del profesional que recetó</label>
                                        <input type="text" class="form-control" id="nombreProfesional" placeholder="Nombre del profesional" name="nombreProfesional" maxlength="250">
                                        @if ($errors->has('nombreProfesional'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombreProfesional') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('apellidoProfesional') ? ' has-error' : '' }}">
                                        <label for="apellidoProfesional">Apellido del profesional que recetó</label>
                                        <input type="text" class="form-control" id="apellidoProfesional" placeholder="Apellido del profesional" name="apellidoProfesional" maxlength="250">
                                        @if ($errors->has('apellidoProfesional'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apellidoProfesional') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('receta') ? ' has-error' : '' }}">
                                        <label for="receta">Receta</label>
                                        <input type="text" class="form-control" id="receta" placeholder="Transcripción de la receta" name="receta" maxlength="250">
                                        @if ($errors->has('receta'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('receta') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="automedicacion">
                                    <div class="form-group {{ $errors->has('droga') ? ' has-error' : '' }}">
                                        <label for="droga">Droga</label>
                                        <input type="text" class="form-control" id="droga" placeholder="Droga" name="droga" maxlength="250">
                                        @if ($errors->has('droga'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('droga') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('dosis') ? ' has-error' : '' }}">
                                        <label for="dosis">Dosis</label>
                                        <input type="text" class="form-control" id="dosis" placeholder="Dosis" name="dosis" maxlength="250">
                                        @if ($errors->has('dosis'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('dosis') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('frecuencia') ? ' has-error' : '' }}">
                                        <label for="frecuencia">Frecuencia</label>
                                        <input type="text" class="form-control" id="frecuencia" placeholder="Frecuencia" name="frecuencia" maxlength="250">
                                        @if ($errors->has('frecuencia'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('frecuencia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('inicio') ? ' has-error' : '' }}">
                                        <label for="inicio">Inicio</label>
                                        <input type="date" class="form-control" id="inicio" placeholder="Inicio" name="inicio">
                                        @if ($errors->has('inicio'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('inicio') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('fin') ? ' has-error' : '' }}">
                                        <label for="fin">Fin</label>
                                        <input type="date" class="form-control" id="fin" placeholder="Fin" name="fin">
                                        @if ($errors->has('fin'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fin') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Agregar Medicación</button>
                            </div>
                      </form>
                  </div>
                </div>
              </div>
          </div>

          <div class="modal modal-danger fade" id="delete2" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title text-center">Atención!</h4>
                  </div>
                        
                  <form action="{{ route('fichaAdicciones.destroyEpisodioAgresivo',['id','asistidoid'])}}" method="POST">
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




          <div class="box-group">
            <div class="panel box box-success">
              <div class="box-header with-border">
                <h4 class="box-title">
                  <a data-toggle="collapse" href="#collapseThree" style="color: black;">Tratamientos</a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in">
                <div class="box-body">
                  @if(isset($fichaAdiccion))
                  @if (isset($fichaAdiccion->checklistTratamiento))
                  @foreach($tratamientos as $tratamiento)
                      <div class="box-tools pull-right">
                        <a href="#"  data-target="#delete3" class="descartarBtn" data-id="{{$tratamiento->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Adicción">
                            <i class="fa fa-trash"></i>
                        </a>
                      </div>
                      <dl class="dl-horizontal preventoverflow" >
                          <dt>Tipo</dt>
                          <dd>{{$tratamiento->tipo}}</dd>
                          
                          @if(isset($tratamiento->inicio))
                          <dt>Fecha de inicio</dt>
                          <dd>{{$tratamiento->inicio}}</dd>
                          @endif
                          @if(isset($tratamiento->fin))
                          <dt>Fecha de finalización</dt>
                          <dd>{{$tratamiento->fin}}</dd>
                          @endif
                          @if(isset($tratamiento->fin))
                          <dt>Fecha de finalización</dt>
                          <dd>{{$tratamiento->fin}}</dd>
                          @endif
                          @if(isset($tratamiento->estado))
                          <dt>Estado</dt>
                          <dd>{{$tratamiento->estado}}</dd>
                          @endif
                          @if(isset($tratamiento->causaDeFin))
                          <dt>Causa de finalización</dt>
                          <dd>{{$tratamiento->causaDeFin}}</dd>
                          @endif
                          @if(isset($tratamiento->comentarios))
                          <dt>Comentarios</dt>
                          <dd>{{$tratamiento->comentarios}}</dd>
                          @endif
                      </dl>
                    @endforeach
                    @endif
                  @endif
                  <a href="{{route('fichaAdicciones.storeTratamiento',['asistido_id'=>$asistido->id])}}" data-toggle="modal" data-target="#modal-default2"><i align="left" class="fa fa-plus"></i> Agregar Tratamiento</a>
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
                  <form id="tratamiento-form" method="POST" action="{{ url('/fichaAdicciones/storeTratamiento',['asistido_id'=>$asistido->id]) }}" >
                    {{ csrf_field() }}
                    <div class="box-body">
                      <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label for="tipo">Tipo</label>
                        <input type="text" class="form-control" id="tipo" placeholder="Tipo" name="tipo" required>
                        @if ($errors->has('tipo'))
                          <span class="help-block">
                              <strong>{{ $errors->first('tipo') }}</strong>
                          </span>
                        @endif
                      </div>
                      <div class="form-group {{ $errors->has('inicio') ? ' has-error' : '' }}">
                        <label for="lugar">Fecha de inicio</label>
                        <input type="date" class="form-control" id="inicio" placeholder="Indique fecha de inicio del tratamiento" name="inicio">
                        @if ($errors->has('inicio'))
                          <span class="help-block">
                              <strong>{{ $errors->first('inicio') }}</strong>
                          </span>
                        @endif
                      </div>
                      <div class="form-group {{ $errors->has('fin') ? ' has-error' : '' }}">
                        <label for="fin">Fecha de finalización</label>
                        <input type="date" class="form-control" id="fin" placeholder="Indique fecha de finalización del tratamiento, si la hay" name="fin">
                        @if ($errors->has('fin'))
                          <span class="help-block">
                              <strong>{{ $errors->first('fin') }}</strong>
                          </span>
                        @endif
                      </div>
                      <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control" id="estado" placeholder="Indique estado del tratamiento" name="estado">
                        @if ($errors->has('estado'))
                          <span class="help-block">
                              <strong>{{ $errors->first('estado') }}</strong>
                          </span>
                        @endif
                      </div>
                      <div class="form-group {{ $errors->has('causaDeFin') ? ' has-error' : '' }}">
                        <label for="causaDeFin">Causa de finalización</label>
                        <input type="text" class="form-control" id="causaDeFin" placeholder="Si el tratamiento fue finalizado, indique la causa" name="causaDeFin">
                        @if ($errors->has('causaDeFin'))
                          <span class="help-block">
                              <strong>{{ $errors->first('causaDeFin') }}</strong>
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
                        <button type="submit" class="btn btn-danger">Agregar Tratamiento</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>  

          <div class="modal modal-danger fade" id="delete3" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title text-center">Atención!</h4>
                  </div>
                        
                  <form action="{{ route('fichaAdicciones.destroyTratamiento',['id','asistidoid'])}}" method="POST">
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









          <div class="box-group">
            <div class="panel box box-gray">
              <div class="box-header with-border">
                <h4 class="box-title">
                  Consideraciones Generales
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse in">
                <div class="box-body">
                  <form id="consideracionesGenerales-form" method="POST" action="{{ url('/fichaAdicciones/storeConsideraciones',['asistido_id'=>$asistido->id]) }}" >
                    {{ csrf_field() }}

                      <div class="form-group {{ $errors->has('checklistRequiereDerivacion') ? ' has-error' : '' }}">
                          
                          <input type="checkbox" id="checklistRequiereDerivacion" name="checklistRequiereDerivacion" {{isset($fichaAdiccion->checklistRequiereDerivacion) && ($fichaAdiccion->checklistRequiereDerivacion==1) ? 'checked':''}}>
                          @if ($errors->has('checklistRequiereDerivacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checklistRequiereDerivacion') }}</strong>
                            </span>
                          @endif
                          <label for="checklistRequiereDerivacion">Requiere derivación     </label>
                        </div>


                      <div class="form-group {{ $errors->has('checklistRequiereInternacion') ? ' has-error' : '' }}">
                          
                          <input type="checkbox" id="checklistRequiereInternacion" name="checklistRequiereInternacion" {{isset($fichaAdiccion->checklistRequiereInternacion) && ($fichaAdiccion->checklistRequiereInternacion==1) ? 'checked':''}}>
                          @if ($errors->has('checklistRequiereInternacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checklistRequiereInternacion') }}</strong>
                            </span>
                          @endif
                          <label for="checklistRequiereInternacion">Requiere internación      </label>
                        </div>

                      <div class="form-group {{ $errors->has('checklistEmbarazo') ? ' has-error' : '' }}">
                          
                          <input type="checkbox" id="checklistEmbarazo" name="checklistEmbarazo" {{isset($fichaAdiccion->checklistEmbarazo) && ($fichaAdiccion->checklistEmbarazo==1) ? 'checked':''}}>
                          @if ($errors->has('checklistEmbarazo'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checklistEmbarazo') }}</strong>
                            </span>
                          @endif
                          <label for="checklistEmbarazo">Está embarazada      </label>
                        </div>
                        <br>
                      <div class="form-group {{ $errors->has('observaciones') ? ' has-error' : '' }}">
                          <label for="estado">Observaciones</label>
                      <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones" value="{{isset($fichaAdiccion->observaciones) ? $fichaAdiccion->observaciones : ''}}">
                          @if ($errors->has('observaciones'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observaciones') }}</strong>
                            </span>
                          @endif
                        </div>
                    <div align="right">
                      <button  type="submit" class="btn btn-danger">Guardar Cambios</button>
                    </div>  
                  </form> 
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
  </div>
</div>
</div>


@endsection

@section('scripts')
<script type="text/javascript">

    

    $('#delete').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })

    $('#delete2').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })

    $('#delete3').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })
</script>

@endsection