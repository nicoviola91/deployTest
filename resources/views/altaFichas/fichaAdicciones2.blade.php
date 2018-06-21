

<div class="row">

    <div class="col-md-12">
      <h3 class="box-title"><i class="icon fa fa-warning fa-fw"></i> Ficha de Adicciones
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
              <div class="panel box box-warning">
                <div class="box-header with-border black">
                  <h4 class="box-title">
                    <a data-toggle="collapse" href="#collapseOne" style="color: black;"> Adicciones </a>
                  </h4>
                </div>

                <div id="collapseOne" class="panel-collapse collapse">
                  <div class="box-body ">
                    @if(isset($fichaAdiccion))
                        @if (isset($fichaAdiccion->checklistAdicciones)) 
                        @foreach($adicciones as $adiccion)
                        
                            <div class="box-tools pull-right">
                              
                              <a href="{{ route('fichaAdicciones.destroyAdiccion',['adiccion_id'=>$adiccion->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$adiccion->id}}" data-toggle="tooltip" data-title="Descartar Adicción">
                                  <i class="fa fa-trash"></i>
                              </a>
                            </div>
                            <dl class="dl-horizontal" >
                                <dt>Sustancia de inicio</dt>
                                <dd>{{$adiccion->sustanciaInicio}}</dd>

                                <dt>Sustancia de fin</dt>
                                <dd>{{$adiccion->sustanciaFin}}</dd>
                                
                                @if(isset($adiccion->frecuencia))
                                <dt>Frecuencia</dt>
                                <dd>{{$adiccion->frecuencia}}</dd>
                                @endif
                                @if(isset($adiccion->modalidad))
                                <dt>Modalidad</dt>
                                <dd>{{$adiccion->modalidad}}</dd>
                                @endif
                                @if(isset($adiccion->edadInicio))
                                <dt>Edad de inicio</dt>
                                <dd>{{$adiccion->edadInicio}}</dd>
                                @endif
                                @if(isset($adiccion->observaciones))
                                <dt>Observaciones</dt>
                                <dd>{{$adiccion->observaciones}}</dd>
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
              <div class="modal-dialog">
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
                                      
                                      <div class="form-group {{ $errors->has('modalidad') ? ' has-error' : '' }}">
                                        <label for="observaciones">Observaciones</label>
                                        <input type="text" class="form-control" id="observaciones" placeholder="Observaciones" name="observaciones">
                                        @if ($errors->has('observaciones'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('observaciones') }}</strong>
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
                    <a data-toggle="collapse" href="#collapseTwo" style="color: black;"> Episodios Agresivos</a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                  <div class="box-body">
                    @if(isset($fichaAdiccion))
                    @if (isset($fichaAdiccion->checklistEpisodiosAgresivos))
                    @foreach($episodiosAgresivos as $episodioAgresivo)
                        <div class="box-tools pull-right">
                          
                          <a href="{{ route('fichaAdicciones.destroyEpisodioAgresivo',['episodioAgresivo_id'=>$episodioAgresivo->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$episodioAgresivo->id}}" data-toggle="tooltip" data-title="Descartar Episodio Agresivo">
                              <i class="fa fa-trash"></i>
                          </a>
                        </div>
                        <dl class="dl-horizontal" >
                            <dt>Tipo</dt>
                            <dd>{{$episodioAgresivo->tipo}}</dd>
                            
                            @if(isset($episodioAgresivo->lugar))
                            <dt>Lugar</dt>
                            <dd>{{$episodioAgresivo->lugar}}</dd>
                            @endif
                            @if(isset($episodioAgresivo->fecha))
                            <dt>Fecha</dt>
                            <dd>{{$episodioAgresivo->fecha}}</dd>
                            @endif
                        </dl>
                      @endforeach
                      @endif
                  @endif
                  </div>


                  <div class="box-body">
                    <a href={{route('fichaAdicciones.storeEpisodioAgresivo',['asistido_id'=>$asistido->id])}} data-toggle="modal" data-target="#modal-default3"><i align="left" class="fa fa-plus"></i>  Agregar Episodio Agresivo</a>
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
                        
                        <form id="episodiosAgresivos-form" method="POST" action="{{ url('/fichaAdicciones/storeEpisodioAgresivo',['asistido_id'=>$asistido->id]) }}" >
                            {{ csrf_field() }}
                            <div class="box-body">
                              <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                                <label for="tipo">Tipo</label>
                                <input type="text" class="form-control" id="tipo" placeholder="Tipo" name="tipo">
                                @if ($errors->has('tipo'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('tipo') }}</strong>
                                  </span>
                                @endif
                              </div>
                              <div class="form-group {{ $errors->has('lugar') ? ' has-error' : '' }}">
                                  <label for="lugar">Lugar</label>
                                  <input type="text" class="form-control" id="lugar" placeholder="Lugar" name="lugar">
                                  @if ($errors->has('lugar'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lugar') }}</strong>
                                    </span>
                                  @endif
                                </div>
                                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" placeholder="Fecha" name="fecha">
                                    @if ($errors->has('fecha'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('fecha') }}</strong>
                                      </span>
                                    @endif
                                  </div>
                              </div>
                          
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-danger">Agregar Episodio Agresivo</button>
                              </div>
                        </form>
                    </div>
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
                <div id="collapseThree" class="panel-collapse collapse">
                  <div class="box-body">
                    @if(isset($fichaAdiccion))
                    @if (isset($fichaAdiccion->checklistTratamiento))
                    @foreach($tratamientos as $tratamiento)
                        <div class="box-tools pull-right">
                          <a href="{{ route('fichaAdicciones.destroyTratamiento',['tratamiento_id'=>$tratamiento->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$tratamiento->id}}" data-toggle="tooltip" data-title="Descartar Tratamiento">
                              <i class="fa fa-trash"></i>
                          </a>
                        </div>
                        <dl class="dl-horizontal" >
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

