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
                          <a href=""  data-target="#delete2" class="descartarBtn" data-id="{{$medicacion->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Medicación">
                                <i class="fa fa-trash"></i></a>
                      </div>
                      <dl class="dl-horizontal preventoverflow" >
                          <dt>Tipo</dt>
                          <dd>{{$medicacion->recetada}}</dd>
                          
                          @if(isset($medicacion->profesional->nombre))
                          <dt>Nombre del profesional</dt>
                          <dd>{{$medicacion->profesional->nombre}}</dd>
                          @endif
                          @if(isset($medicacion->profesional->apellido))
                          <dt>Apellido del profesional</dt>
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
                @endif
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
                          <div class="box-body col-md-12">
                                <div class="form-group" >
                                    {!! Form::Label('tipo', 'Tipo') !!}
                                    <select class="form-control" name="recetada" id="recetada" >
                                        <option value="Indicada bajo receta">Indicada bajo receta</option>
                                        <option value="Automedicación">Automedicación</option>
                                    </select>
                                </div>
                                <div class="profesional">
                                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                        <label for="nombre">Nombre del profesional que recetó</label>
                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre del profesional" name="nombre" maxlength="250">
                                        @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                                        <label for="apellido">Apellido del profesional que recetó</label>
                                        <input type="text" class="form-control" id="apellido" placeholder="Apellido del profesional" name="apellido" maxlength="250" >
                                        @if ($errors->has('apellido'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('apellido') }}</strong>
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
                        
                  <form action="{{ route('fichaSaludMental.destroyMedicacion',['id','asistidoid'])}}" method="POST">
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
                      @if(isset($fichaSaludMental))
                      @if (isset($fichaSaludMental->checkTratamiento))
                      @foreach($tratamientos as $tratamiento)
                          <div class="box-tools pull-right">
                            <a href="#"  data-target="#delete3" class="descartarBtn" data-id="{{$tratamiento->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Tratamiento">
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
                              @if(isset($tratamiento->estado))
                              <dt>Estado</dt>
                              <dd>{{$tratamiento->estado}}</dd>
                              @endif
                              @if(isset($tratamiento->causaDeFin))
                              <dt>Causa de fin</dt>
                              <dd>{{$tratamiento->causaDeFin}}</dd>
                              @endif
                              @if(isset($tratamiento->medicaciones->droga))
                              <dt>Droga medicación</dt>
                              <dd>{{$tratamiento->medicaciones->droga}}</dd>
                              @endif
                              @if(isset($tratamiento->medicaciones->dosis))
                              <dt>Dosis</dt>
                              <dd>{{$tratamiento->medicaciones->dosis}}</dd>
                              @endif
                              @if(isset($tratamiento->medicaciones->frecuencia))
                              <dt>Frecuencia</dt>
                              <dd>{{$tratamiento->medicaciones->frecuencia}}</dd>
                              @endif
                              @if(isset($tratamiento->institucion->nombre))
                              <dt>Lugar tratamiento</dt>
                              <dd>{{$tratamiento->institucion->nombre}}</dd>
                              @endif
                              @if(isset($tratamiento->institucion->direccion))
                              <dt>Dirección</dt>
                              <dd>{{$tratamiento->institucion->direccion}}</dd>
                              @endif
                              @if(isset($tratamiento->institucion->telefono))
                              <dt>Teléfono</dt>
                              <dd>{{$tratamiento->institucion->telefono}}</dd>
                              @endif
                              @if(isset($tratamiento->institucion->email))
                              <dt>E-mail</dt>
                              <dd>{{$tratamiento->institucion->email}}</dd>
                              @endif

                              @if(isset($tratamiento->profesional->nombre))
                              <dt>Nombre profesional</dt>
                              <dd>{{$tratamiento->profesional->nombre}}</dd>
                              @endif
                              @if(isset($tratamiento->profesional->apellido))
                              <dt>Apellido profesional</dt>
                              <dd>{{$tratamiento->profesional->apellido}}</dd>
                              @endif
                              @if(isset($tratamiento->profesional->especialidad))
                              <dt>Especialidad</dt>
                              <dd>{{$tratamiento->profesional->especialidad}}</dd>
                              @endif
                              @if(isset($tratamiento->profesional->cargo))
                              <dt>Cargo</dt>
                              <dd>{{$tratamiento->profesional->cargo}}</dd>
                              @endif

                          </dl>
                        @endforeach
                        @endif
                      @endif
                      <a href="{{route('fichaSaludMental.storeTratamiento',['asistido_id'=>$asistido->id])}}" data-toggle="modal" data-target="#modal-default2"><i align="left" class="fa fa-plus"></i> Agregar Tratamiento</a>
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
                      <form id="tratamiento-form" method="POST" action="{{ route('fichaSaludMental.storeTratamiento',['asistido_id'=>$asistido->id]) }}" >
                        {{ csrf_field() }}
                        <div class="box-body  col-md-12">

                            <div class="form-group">
                                {!! Form::Label('tipo', 'Tipo') !!}
                                <select class="form-control" name="tipo" id="tipo" required>
                                    <option value="Ambulatorio">Ambulatorio</option>
                                    <option value="Internación">Internación</option>
                                </select>
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
                            <div class="form-group">
                                {!! Form::Label('estado', 'Estado del tratamiento') !!}
                                <select class="form-control" name="estado" id="estado" >
                                    <option value="Cumple con el tratamiento">Cumple con el tratamiento</option>
                                    <option value="No cumple con el tratamiento">No cumple con el tratamiento</option>
                                    <option value="Cumple parcialmente">Cumple parcialmente</option>
                                    <option value="Abandonó">Abandonó</option>
                                </select>
                            </div>
                          <div class="form-group {{ $errors->has('causaDeFin') ? ' has-error' : '' }}">
                            <label for="causaDeFin">Causa de finalización</label>
                            <input type="text" class="form-control" id="causaDeFin" placeholder="Si el tratamiento fue abandonado o no es cumplido, indique la causa" name="causaDeFin" maxlength="250">
                            @if ($errors->has('causaDeFin'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('causaDeFin') }}</strong>
                              </span>
                            @endif
                          </div>
                          <div class="form-group {{ $errors->has('medicacionEnTratamiento') ? ' has-error' : '' }}">
                                <input type="checkbox" id="medicacionEnTratamientoid" name="medicacionEnTratamiento" onclick="checkMedicacionEnTratamiento()">
                                @if ($errors->has('medicacionEnTratamiento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('medicacionEnTratamiento') }}</strong>
                                </span>
                                @endif
                                <label for="checkDerivacion">El tratamiento incluye medicación</label>
                            </div>
                          <div class="mostrarMedicacion">
                          <span>Medicación</span>
                            <div class="form-group {{ $errors->has('droga') ? ' has-error' : '' }}">
                                <label for="droga">Droga</label>
                                <input type="text" class="form-control" id="droga1" placeholder="Droga" name="droga" maxlength="250" >
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
                            </div>
                            <div class="form-group {{ $errors->has('institucionEnTratamientoid') ? ' has-error' : '' }}">
                                <input type="checkbox" id="institucionEnTratamientoid" name="institucionEnTratamiento" onclick="checkInstitucionEnTratamiento()" >
                                @if ($errors->has('institucionEnTratamiento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('institucionEnTratamiento') }}</strong>
                                </span>
                                @endif
                                <label for="institucionEnTratamiento">El tratamiento se realiza o realizó en un hospital, institución, particular o comunidad terapeutica</label>
                            </div>
                            <div class="mostrarInstitucion">
                                <div class="form-group {{ $errors->has('nombreInstitucion') ? ' has-error' : '' }}">
                                    <span></span>
                                    <label for="nombreInstitucion">Nombre</label>
                                    <input type="text" class="form-control" id="nombreInstitucion1" placeholder="Nombre" name="nombreInstitucion" maxlength="250" >
                                    @if ($errors->has('nombreInstitucion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombreInstitucion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('direccionInstitucion') ? ' has-error' : '' }}">
                                    <label for="direccionInstitucion">Dirección</label>
                                    <input type="text" class="form-control" id="direccionInstitucion" placeholder="Dirección" name="direccionInstitucion" maxlength="250">
                                    @if ($errors->has('direccionInstitucion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('direccionInstitucion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('emailInstitucion') ? ' has-error' : '' }}">
                                    <label for="emailInstitucion">E-mail</label>
                                    <input type="email" class="form-control" id="emailInstitucion" placeholder="E-mail " name="emailInstitucion" maxlength="250">
                                    @if ($errors->has('emailInstitucion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('emailInstitucion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('profesionalEnTratamiento') ? ' has-error' : '' }}">
                                <input type="checkbox" id="profesionalEnTratamientoid" name="profesionalEnTratamiento" onclick="checkProfesionalEnTratamiento()">
                                @if ($errors->has('profesionalEnTratamiento'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('profesionalEnTratamiento') }}</strong>
                                </span>
                                @endif
                                <label for="profesionalEnTratamiento">Hay un profesional a cargo del tratamiento</label>
                            </div>
                            <div class="mostrarProfesional">
                                <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                    <span>Profesional a cargo del tratamiento</span>
                                    <label for="nombre">Nombre del profesional</label>
                                    <input type="text" class="form-control" id="nombre1" placeholder="Nombre " name="nombre" maxlength="250" >
                                    @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                                    <label for="apellido">Apellido del profesional</label>
                                    <input type="text" class="form-control" id="apellido" placeholder="Apellido " name="apellido" maxlength="250">
                                    @if ($errors->has('apellido'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('especialidadProfesional') ? ' has-error' : '' }}">
                                    <label for="especialidadProfesional">Especialidad</label>
                                    <input type="text" class="form-control" id="especialidadProfesional" placeholder="Especialidad " name="especialidadProfesional" maxlength="250">
                                    @if ($errors->has('especialidadProfesional'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('especialidadProfesional') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('cargoProfesional') ? ' has-error' : '' }}">
                                    <label for="cargoProfesional">Cargo</label>
                                    <input type="text" class="form-control" id="cargoProfesional" placeholder="Cargo " name="cargoProfesional" maxlength="250">
                                    @if ($errors->has('cargoProfesional'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cargoProfesional') }}</strong>
                                        </span>
                                    @endif
                                </div>
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
                            
                      <form action="{{ route('fichaSaludMental.destroyTratamiento',['id','asistidoid'])}}" method="POST">
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
                        <a data-toggle="collapse" href="#collapseTwo" style="color: black;"> Episodios Agresivos</a>
                    </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in">
                    
                        @if(isset($fichaSaludMental))
                        <div class="box-body">
                        @if (isset($fichaSaludMental->checkAgresiones))
                        @foreach($episodiosAgresivos as $episodioAgresivo)
                            <div class="box-tools pull-right">
                            <a href="#"  data-target="#delete4" class="descartarBtn" data-id="{{$episodioAgresivo->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Adicción">
                                <i class="fa fa-trash"></i>
                            </a>
                            </div>
                            <dl class="dl-horizontal preventoverflow" >
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
                        <a href={{route('fichaSaludMental.storeEpisodioAgresivo',['asistido_id'=>$asistido->id])}} data-toggle="modal" data-target="#modal-default4"><i align="left" class="fa fa-plus"></i>  Agregar Episodio Agresivo</a>
                    </div>
                    </div>
                </div>
                </div>
    
    
    
                <div class="modal fade in" id="modal-default4" style="display: none; padding-right: 17px;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title">Agregar Episodio Agresivo</h4>
                        </div>
                        <div class="modal-body">
                            
                            <form id="episodiosAgresivos-form" method="POST" action="{{ route('fichaSaludMental.storeEpisodioAgresivo',['asistido_id'=>$asistido->id]) }}" >
                                {{ csrf_field() }}
                                <div class="box-body">
                                <div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }}">
                                    <label for="tipo">Tipo</label>
                                    <input type="text" class="form-control" id="tipo" placeholder="Tipo" name="tipo" maxlength="250">
                                    @if ($errors->has('tipo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tipo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('lugar') ? ' has-error' : '' }}">
                                    <label for="lugar">Lugar</label>
                                    <input type="text" class="form-control" id="lugar" placeholder="Lugar" name="lugar" maxlength="250">
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
    
                <div class="modal modal-danger fade" id="delete4" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title text-center">Atención!</h4>
                        </div>
                            
                        <form action="{{ route('fichaSaludMental.destroyEpisodioAgresivo',['id','asistidoid'])}}" method="POST">
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
                  <form id="consideracionesGenerales-form" method="POST" action="{{ route('fichaSaludMental.storeConsideraciones',['asistido_id'=>$asistido->id]) }}" >
                    {{ csrf_field() }}

                    <div class="form-group" >
                        {!! Form::Label('estadoMental', 'Estado mental') !!}
                        <select class="form-control" name="estadoMental" id="estadoMental" >
                            <option value="No presenta síntomas mentales" {{isset($fichaSaludMental->estadoMental) && ($fichaSaludMental->estadoMental=='No presenta síntomas mentales') ? 'selected':''}}>No presenta síntomas mentales</option>
                            <option value="Presenta síntomas mentales"  {{isset($fichaSaludMental->estadoMental) && ($fichaSaludMental->estadoMental=='Presenta síntomas mentales') ? 'selected':''}}>Presenta síntomas mentales</option>
                            <option value="No se puede determinar"  {{isset($fichaSaludMental->estadoMental) && ($fichaSaludMental->estadoMental=='No se puede determinar') ? 'selected':''}}>No se puede determinar</option>
                        </select>
                    </div>
                    <span>Signos observables</span>
                    
                    <div class="form-group {{ $errors->has('ansiedad') ? ' has-error' : '' }}">
                        <input type="checkbox" id="ansiedad" name="ansiedad" {{isset($fichaSaludMental->ansiedad) && ($fichaSaludMental->ansiedad==1) ? 'checked':''}}>
                        @if ($errors->has('ansiedad'))
                        <span class="help-block">
                            <strong>{{ $errors->first('ansiedad') }}</strong>
                        </span>
                        @endif
                        <label for="ansiedad">Ansiedad</label>
                    </div>
                    <div class="form-group {{ $errors->has('depresivo') ? ' has-error' : '' }}">
                        <input type="checkbox" id="depresivo" name="depresivo" {{isset($fichaSaludMental->depresivo) && ($fichaSaludMental->depresivo==1) ? 'checked':''}}>
                        @if ($errors->has('depresivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('depresivo') }}</strong>
                        </span>
                        @endif
                        <label for="depresivo">Estado depresivo</label>
                    </div>
                    <div class="form-group {{ $errors->has('delirios') ? ' has-error' : '' }}">
                        <input type="checkbox" id="delirios" name="delirios" {{isset($fichaSaludMental->orientado) && ($fichaSaludMental->orientado==1) ? 'checked':''}}>
                        @if ($errors->has('delirios'))
                        <span class="help-block">
                            <strong>{{ $errors->first('delirios') }}</strong>
                        </span>
                        @endif
                        <label for="delirios">Delirios</label>
                    </div>
                    <div class="form-group {{ $errors->has('trastornoCognitivo') ? ' has-error' : '' }}">
                        <input type="checkbox" id="trastornoCognitivo" name="trastornoCognitivo" {{isset($fichaSaludMental->trastornoCognitivo) && ($fichaSaludMental->trastornoCognitivo==1) ? 'checked':''}}>
                        @if ($errors->has('trastornoCognitivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('trastornoCognitivo') }}</strong>
                        </span>
                        @endif
                        <label for="trastornoCognitivo">Trastorno cognitivo</label>
                    </div>

                    <div class="form-group {{ $errors->has('checkDerivacion') ? ' has-error' : '' }}">
                        <input type="checkbox" id="checkDerivacion" name="checkDerivacion" {{isset($fichaSaludMental->checkDerivacion) && ($fichaSaludMental->checkDerivacion==1) ? 'checked':''}}>
                        @if ($errors->has('checkDerivacion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('checkDerivacion') }}</strong>
                        </span>
                        @endif
                        <label for="checkDerivacion">Requiere derivación</label>
                    </div>


                    <div class="form-group {{ $errors->has('checkInternacion') ? ' has-error' : '' }}">
                        
                        <input type="checkbox" id="checkInternacion2" name="checkInternacion" {{isset($fichaSaludMental->checkInternacion) && ($fichaSaludMental->checkInternacion==1) ? 'checked':''}} onclick="checkRequiereInternacion()">
                        @if ($errors->has('checkInternacion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('checkInternacion') }}</strong>
                        </span>
                        @endif
                        <label for="checkInternacion">Requiere internación</label>
                    </div>
                    <div class="mostrarInstitucion2">
                        <div class="form-group {{ $errors->has('nombreInstitucion2') ? ' has-error' : '' }}">
                            <label for="nombreInstitucion2">Nombre</label>
                            <input type="text" class="form-control" id="nombreInstitucion2" placeholder="Nombre" name="nombreInstitucion2" maxlength="250" value="{{isset($fichaSaludMental->institucion->nombre) ? $fichaSaludMental->institucion->nombre : ''}}" >
                            @if ($errors->has('nombreInstitucion2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombreInstitucion2') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('direccionInstitucion2') ? ' has-error' : '' }}">
                            <label for="direccionInstitucion2">Dirección</label>
                            <input type="text" class="form-control" id="direccionInstitucion2" placeholder="Dirección" name="direccionInstitucion2" maxlength="250" value="{{isset($fichaSaludMental->institucion->direccion) ? $fichaSaludMental->institucion->direccion : ''}}">
                            @if ($errors->has('direccionInstitucion2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('direccionInstitucion2') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('telefonoInstitucion2') ? ' has-error' : '' }}">
                            <label for="telefonoInstitucion2">Teléfono</label>
                            <input type="text" class="form-control" id="telefonoInstitucion2" placeholder="Teléfono" name="telefonoInstitucion2" maxlength="250" value="{{isset($fichaSaludMental->institucion->telefono) ? $fichaSaludMental->institucion->telefono : ''}}" >

                            @if ($errors->has('telefonoInstitucion2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('telefonoInstitucion2') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('referenteInstitucion2') ? ' has-error' : '' }}">
                            <label for="referenteInstitucion2">E-mail</label>
                            <input type="text" class="form-control" id="referenteInstitucion2" placeholder="E-mail " name="referenteInstitucion2" maxlength="250" value="{{isset($fichaSaludMental->institucion->email) ? $fichaSaludMental->institucion->email : ''}}">
                            @if ($errors->has('referenteInstitucion2'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('referenteInstitucion2') }}</strong>
                                </span>
                            @endif
                        </div>
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

@section('scripts')
<script type="text/javascript">

    window.onload=function(){
        $('#recetada').val('Indicada bajo receta')
        document.getElementById("nombre").required = true
        $('.profesional').show()
        $('.automedicacion').show()
        $('.institucionEnTratamiento').show()
        $('.mostrarInstitucion').hide()
        $('.mostrarMedicacion').hide()
        $('.mostrarProfesional').hide()

        var requiereInternacion=document.getElementById("checkInternacion2")
        if (requiereInternacion.checked == true){
            $('.mostrarInstitucion2').show() 
        }else{
            $('.mostrarInstitucion2').hide() 
        }
        

    }
    
    
    $('#checkInternacion').change(function(){
        if ($(this).checked){

            $('.mostrarInstitucion2').show()

        }else{

            $('.mostrarInstitucion2').hide()

        }
    })

    function checkMedicacionEnTratamiento(){
        var chkMed = document.getElementById("medicacionEnTratamientoid")

        if (chkMed.checked == true){
            $('.mostrarMedicacion').show()
            document.getElementById("droga1").required = true
            
        }else{
            $('.mostrarMedicacion').hide()   
            document.getElementById("droga1").required = false
        }
    }
   
    function checkInstitucionEnTratamiento(){
        var chkInst = document.getElementById("institucionEnTratamientoid")

        if (chkInst.checked == true){
            document.getElementById("nombreInstitucion1").required = true
            $('.mostrarInstitucion').show()
        }else{
            $('.mostrarInstitucion').hide()   
            document.getElementById("nombreInstitucion1").required = false
        }
    }

    function checkProfesionalEnTratamiento(){
        var chkProf = document.getElementById("profesionalEnTratamientoid")

        if (chkProf.checked == true){
            $('.mostrarProfesional').show()
            document.getElementById("nombre1").required = true
            
        }else{
            $('.mostrarProfesional').hide()   
            document.getElementById("nombre1").required = false
        }
    }

    function checkRequiereInternacion(){
        var chkInternacion = document.getElementById("checkInternacion2")

        if (chkInternacion.checked == true){
            $('.mostrarInstitucion2').show()
            document.getElementById("nombreInstitucion2").required = true
            
        }else{
            $('.mostrarInstitucion2').hide()   
            document.getElementById("nombreInstitucion2").required = false
        }
    }

   



    $('#recetada').change(function () {

    if ($(this).val() == 'Indicada bajo receta') {
        $('.profesional').show();
        $('.automedicacion').show();
        document.getElementById("nombre").required = true
        document.getElementById("droga").required = true


    } else {

        $('.automedicacion').show();
        $('.profesional').hide();
        document.getElementById("nombre").required = false
        document.getElementById("droga").required = true

    } 
    });

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

    $('#delete4').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })
</script>

@endsection