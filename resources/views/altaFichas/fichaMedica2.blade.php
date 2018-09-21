  
  <style type="text/css">
    .preventoverflow{
        
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis
    }
	</style>

<div class="row">

  <div class="col-md-12">
    <h3 class="box-title"><i class="icon fa fa-heartbeat fa-fw"></i> Ficha Médica
    <span class="pull-right">
      <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
      {{-- <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button> --}}
    </span>
    </h3>
  </div>

  <div class="col-md-10 col-md-offset-1">
      <div class="box-body">
        <div class="box-group">
            <div class="panel box box-gray">
              <div class="box-header with-border">
                <h4 class="box-title">
                  Estado General de Salud
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse in"><!-- tienen que cerrar al final de todo-->
                <div class="box-body"><!-- tienen que cerrar al final de todo-->

                    <h4>Síntomas visibles</h4>
                  @if(isset($fichaMedica))
                  
                    @if(isset($fichaMedica->checkSintomas)) 
                    
                      @foreach($sintomasDelAsistido as $sintoma)
                        <div class="box-tools pull-right">    
                          <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$sintoma->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Síntoma">
                          <i class="fa fa-trash"></i></a>
                        </div>
                        <ul class="dl-horizontal preventoverflow" >
                            @if(isset($sintoma->nombre))
                            <li>{{$sintoma->nombre}}</li>
                            @endif
                        </ul>

                      @endforeach
                    
                    @endif
                  @endif
                        
                  <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>Agregar Síntoma</a>
                  <div class="modal fade" id="modal-agregar">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                              <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Síntoma </h4>
                            </div>
                      
                            <form id="nuevoSintoma-form" method="POST" action="{{ route('fichaMedica.storeSintoma',['asistido_id'=>$asistido->id]) }}">
                              {{ csrf_field() }}
                               
                              <div class="box-body">
                                  <div class="form-group">   
                                    {!! Form::Label('descripcion', 'Síntoma') !!}
                                    <select class="form-control" name="sintoma" id="sintoma" >
                                        @foreach($sintomasGenericos as $sintoma)
                                            <option value="{{$sintoma->id}}">{{$sintoma->nombre}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                              <div class="modal-footer">
                               
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Agregar Síntoma</button>
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
                            <form action="{{ route('fichaMedica.destroySintoma',['id','asistidoid'])}}" method="POST">
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
                    
                   
                        
                        <h4>Consultas médicas previas</h4>
                        @if(isset($fichaMedica))
                            @if (isset($fichaMedica->consultasMedicas)) 
                            
                            @foreach($fichaMedica->consultasMedicas as $consultaMedica)
                                <div class="box-tools pull-right">    
                                <a href="#"  data-target="#delete2" class="descartarBtn" data-id="{{$consultaMedica->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Consulta Médica">
                                <i class="fa fa-trash"></i></a>
                                </div>
                                <dl class="dl-horizontal preventoverflow" >
                                    @if(isset($consultaMedica->fecha))
                                    <dt>Fecha</dt>
                                    <dd>{{$consultaMedica->fecha}}</dd>
                                    @endif
                                    @if(isset($consultaMedica->institucion->nombre))
                                    <dt>Nombre de la institución</dt>
                                    <dd>{{$consultaMedica->institucion->nombre}}</dd>
                                    @endif
                                    @if(isset($consultaMedica->profesional->nombre))
                                    <dt>Nombre profesional</dt>
                                    <dd>{{$consultaMedica->profesional->nombre}}</dd>
                                    @endif
                                    @if(isset($consultaMedica->profesional->apellido))
                                    <dt>Apellido profesional</dt>
                                    <dd>{{$consultaMedica->profesional->apellido}}</dd>
                                    @endif
                                    @if(isset($consultaMedica->profesional->especialidad))
                                    <dt>Especialidad</dt>
                                    <dd>{{$consultaMedica->profesional->especialidad}}</dd>
                                    @endif
                                    @if(isset($consultaMedica->diagnostico))
                                    <dt>Diagnóstico</dt>
                                    <dd>{{$consultaMedica->diagnostico}}</dd>
                                    @endif
                                </dl>
                            @endforeach
                            @endif
                        @endif
                        <a href="#" data-toggle="modal" data-target="#modal-agregar2"><i align="left" class="fa fa-plus"></i>  Agregar Consulta médica</a>
                        
                        <div class="modal fade" id="modal-agregar2">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Consulta médica </h4>
                            </div>
                            
                            <form id="nuevaConsulta-form" method="POST" action="{{ route('fichaMedica.storeConsulta',['asistido_id'=>$asistido->id]) }}">
                                {{ csrf_field() }}
                                <div class="box-body">
                                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('nombreInstitucion') ? ' has-error' : '' }}">
                                    <label for="nombreInstitucion">Institución</label>
                                    <input type="text" class="form-control" id="fecha" name="nombreInstitucion" maxlength="250" required>
                                    @if ($errors->has('nombreInstitucion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombreInstitucion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('nombreProfesional') ? ' has-error' : '' }}">
                                    <label for="nombreProfesional">Nombre profesional</label>
                                    <input type="text" class="form-control" id="fecha" name="nombreProfesional" maxlength="250" required>
                                    @if ($errors->has('nombreProfesional'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('nombreProfesional') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('apellidoProfesional') ? ' has-error' : '' }}">
                                    <label for="apellidoProfesional">Apellido profesional</label>
                                    <input type="text" class="form-control" id="fecha" name="apellidoProfesional" maxlength="250" >
                                    @if ($errors->has('apellidoProfesional'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellidoProfesional') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('especialidad') ? ' has-error' : '' }}">
                                    <label for="especialidad">Especialidad</label>
                                    <input type="text" class="form-control" id="fecha" name="especialidad" maxlength="250" >
                                    @if ($errors->has('especialidad'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('especialidad') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
                                    <label for="diagnostico">Diagnóstico</label>
                                    <input type="text" class="form-control" placeholder="Diagnóstico indicado por el profesional o institución" id="fecha" name="diagnostico" maxlength="250" >
                                    @if ($errors->has('diagnostico'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diagnostico') }}</strong>
                                    </span>
                                    @endif
                                </div>
                    
                                <div class="modal-footer">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-danger">Agregar Consulta médica</button>
                                </div>
                            </div>
                            </form>
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
                                <form action="{{ route('fichaMedica.destroyConsulta',['id','asistidoid'])}}" method="POST">
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

                        <h4>Médico de cabecera</h4>
                 
                        @if(isset($fichaMedica))
                            @if (isset($fichaMedica->checkMedicoDeCabecera)) 
                            
                            @foreach($profesionales as $profesional)
                                <div class="box-tools pull-right">    
                                <a href="#"  data-target="#delete3" class="descartarBtn" data-id="{{$profesional->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Profesional">
                                <i class="fa fa-trash"></i></a>
                                </div>
                                <dl class="dl-horizontal preventoverflow" >
                                    @if(isset($profesional->nombre))
                                    <dt>Nombre</dt>
                                    <dd>{{$profesional->nombre}}</dd>
                                    @endif
                                    @if(isset($profesional->apellido))
                                    <dt>Apellido</dt>
                                    <dd>{{$profesional->apellido}}</dd>
                                    @endif
                                    @if(isset($profesional->especialidad))
                                    <dt>Especialidad</dt>
                                    <dd>{{$profesional->especialidad}}</dd>
                                    @endif
                                </dl>
                            </div>
                            @endforeach
                            @endif
                        @endif
                        @if($fichaMedica->checkMedicoDeCabecera==0)
                        <a href="#" data-toggle="modal" data-target="#modal-agregar3"}}><i align="left" class="fa fa-plus"></i>Agregar Médico de cabecera</a>
                        @endif
                        <div class="modal fade" id="modal-agregar3">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Médico de cabecera </h4>
                                </div>
                            
                                <form id="nuevoProfesional-form" method="POST" action="{{ route('fichaMedica.storeProfesional',['asistido_id'=>$asistido->id]) }}">
                                {{ csrf_field() }}
                                
                                <div class="box-body">
                                    <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                        <label for="nombre">Nombre profesional</label>
                                        <input type="text" class="form-control" id="fecha" name="nombre" maxlength="250" required>
                                        @if ($errors->has('nombre'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nombre') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                                        <label for="apellido">Apellido profesional</label>
                                        <input type="text" class="form-control" id="fecha" name="apellido" maxlength="250" >
                                        @if ($errors->has('apellido'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('apellido') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group {{ $errors->has('especialidad') ? ' has-error' : '' }}">
                                        <label for="especialidad">Especialidad</label>
                                        <input type="text" class="form-control" id="fecha" name="especialidad" maxlength="250" >
                                        @if ($errors->has('especialidad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('especialidad') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Agregar Médico de cabecera</button>
                                </div>
                                </div>
                                </form>
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
                                <form action="{{ route('fichaMedica.destroyProfesional',['id','asistidoid'])}}" method="POST">
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
                    
                        <br>
                        <form id="estadoGeneral-form" method="POST" action="{{ route('fichaMedica.storeEstadoGeneral',['asistido_id'=>$asistido->id]) }}" >
                        {{ csrf_field() }}

                        <br>
                        <div class="col-md-6 form-group  {{ $errors->has('altura') ? ' has-error' : '' }}">
                            <label for="altura">Altura</label>
                        <input type="number" min=0 max=999 class="form-control" id="altura" placeholder="Ingrese altura en centímetros" name="altura" maxlength="250" value={{isset($fichaMedica->altura) ? ($fichaMedica->altura) : '' }}>
                            @if ($errors->has('altura'))
                            <span class="help-block">
                                <strong>{{ $errors->first('altura') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-6 form-group  {{ $errors->has('peso') ? ' has-error' : '' }}">
                            <label for="peso">Peso</label>
                        <input type="number" min=0 step="0.01" max=999 class="form-control" id="peso" placeholder="Ingrese peso en kilogramos. Para especificar decimales utilice una coma" name="peso" maxlength="250" value={{isset($fichaMedica->peso) ? ($fichaMedica->peso) : '' }}>
                            @if ($errors->has('peso'))
                            <span class="help-block">
                                <strong>{{ $errors->first('peso') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{-- Discapacidades --}}
                        <div class="col-md-12 form-group {{ $errors->has('discapacidadVisual') ? ' has-error' : '' }}">
                            <input type="checkbox" id="discapacidadVisual" name="discapacidadVisual" onclick="discapacidadesFunction()" {{isset($fichaMedica->discapacidadVisual) && ($fichaMedica->discapacidadVisual==1) ? 'checked':''}}>
                            @if ($errors->has('discapacidadVisual'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discapacidadVisual') }}</strong>
                            </span>
                            @endif
                            <label for="discapacidadVisual">Discapacidad Visual</label>
                        </div>
                        <div class="col-md-12 form-group {{ $errors->has('discapacidadAuditiva') ? ' has-error' : '' }}">
                            <input type="checkbox" id="discapacidadAuditiva" name="discapacidadAuditiva" onclick="discapacidadesFunction()" {{isset($fichaMedica->discapacidadAuditiva) && ($fichaMedica->discapacidadAuditiva==1) ? 'checked':''}}>
                            @if ($errors->has('discapacidadAuditiva'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discapacidadAuditiva') }}</strong>
                            </span>
                            @endif
                            <label for="discapacidadAuditiva">Discapacidad Auditiva</label>
                        </div>
                        <div class="col-md-12 form-group {{ $errors->has('discapacidadMotriz') ? ' has-error' : '' }}">
                            <input type="checkbox" id="discapacidadMotriz" name="discapacidadMotriz" onclick="discapacidadesFunction()" {{isset($fichaMedica->discapacidadMotriz) && ($fichaMedica->discapacidadMotriz==1) ? 'checked':''}}>
                            @if ($errors->has('discapacidadMotriz'))
                            <span class="help-block">
                                <strong>{{ $errors->first('discapacidadMotriz') }}</strong>
                            </span>
                            @endif
                            <label for="discapacidadAuditiva">Discapacidad Motriz</label>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="alergicoA">Observacion Discapacidad</label>
                        <input type="text" class="form-control" id="observacionDiscapacidad" placeholder="Detalle sobre discapacidad" name="observacionDiscapacidad" maxlength="250" value={{isset($fichaMedica->observacionDiscapacidad) ? ($fichaMedica->observacionDiscapacidad) : '' }}>
                            @if ($errors->has('observacionDiscapacidad'))
                            <span class="help-block">
                                <strong>{{ $errors->first('observacionDiscapacidad') }}</strong>
                            </span>
                            @endif
                        </div>
                        {{-- Fin Discapacidades --}}
                        <div class="col-md-12 form-group {{ $errors->has('checkAlergico') ? ' has-error' : '' }}">
                            <input type="checkbox" id="checkAlergico" name="checkAlergico" onclick="alergiaFunction()" {{isset($fichaMedica->checkAlergico) && ($fichaMedica->checkAlergico==1) ? 'checked':''}}>
                            @if ($errors->has('checkAlergico'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checkAlergico') }}</strong>
                            </span>
                            @endif
                            <label for="checkAlergico">El asistido tiene alguna alergia</label>
                        </div>

                        <div class="col-md-6 form-group checkAlergico {{ $errors->has('alergicoA') ? ' has-error' : '' }}">
                            <label for="alergicoA">Alergias</label>
                        <input type="text" class="form-control" id="alergicoA" placeholder="Ingrese a qué es alérgico el asistido" name="alergicoA" maxlength="250" value={{isset($fichaMedica->alergicoA) ? ($fichaMedica->alergicoA) : '' }}>
                            @if ($errors->has('alergicoA'))
                            <span class="help-block">
                                <strong>{{ $errors->first('alergicoA') }}</strong>
                            </span>
                            @endif
                        </div>


                        <div class="col-md-12 form-group {{ $errors->has('checkObraSocial') ? ' has-error' : '' }}">
                            <input type="checkbox" id="checkObraSocial" name="checkObraSocial" onclick="obraSocialFunction()" {{isset($fichaMedica->checkObraSocial) && ($fichaMedica->checkObraSocial==1) ? 'checked':''}}>
                            @if ($errors->has('checkObraSocial'))
                            <span class="help-block">
                                <strong>{{ $errors->first('checkObraSocial') }}</strong>
                            </span>
                            @endif
                            <label for="checkObraSocial">El asistido tiene Obra Social</label>
                        </div>

                        <div class="col-md-12 form-group checkObraSocial {{ $errors->has('obraSocial') ? ' has-error' : '' }}">
                            <label for="obraSocial">Obra Social</label>
                        <input type="text" class="form-control" id="obraSocial" placeholder="Ingrese Obra Social del asistido" name="obraSocial" maxlength="250" value={{isset($fichaMedica->obraSocial) ? ($fichaMedica->obraSocial) : '' }}>
                            @if ($errors->has('obraSocial'))
                            <span class="help-block">
                                <strong>{{ $errors->first('obraSocial') }}</strong>
                            </span>
                            @endif
                        </div>
                        
                        <div class="col-md-12 form-group  {{ $errors->has('antecedentes') ? ' has-error' : '' }}">
                            <label for="antecedentes">Antecedentes</label>
                        <input type="text" class="form-control" id="antecedentes" placeholder="Ingrese antecedentes familiares, inmunizaciones o hábitos" name="antecedentes" maxlength="250" value={{isset($fichaMedica->antecedentes) ? ($fichaMedica->antecedentes) : '' }}>
                            @if ($errors->has('antecedentes'))
                            <span class="help-block">
                                <strong>{{ $errors->first('antecedentes') }}</strong>
                            </span>
                            @endif
                        </div>

                    <div align="center" class="col-md-12">
                        <button  type="submit" class="btn btn-danger guardarBtn">Guardar Cambios</button>
                    </div>  
                    </form> 



                   
                 

                  
                </div>
              </div> <!--aca cerraria el primer div marcado-->

            </div>
          </div>


          <div class="box-group">

            <div class="panel box box-warning">
              <div class="box-header with-border black">
                <h4 class="box-title">
                  <a data-toggle="collapse" href="#collapseTwo" style="color: black;"> Patologías o afecciones</a>
                </h4>
              </div>

              <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="box-body ">
                  @if(isset($fichaMedica))
                    @if (isset($fichaMedica->checkEnfermedades)) 
                      @foreach($enfermedadesDelAsistido as $enfermedad)
                      
                        <div class="box-tools pull-right">    
                          <a href="#"  data-target="#delete4" class="descartarBtn" data-id="{{$enfermedad->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Patologia">
                          <i class="fa fa-trash"></i></a>
                        </div>
                        <dl class="dl-horizontal preventoverflow" >
                        @if(isset($enfermedad->afeccion->tipo))
                          <dt>Tipo</dt>
                          <dd>{{$enfermedad->afeccion->tipo}}</dd>
                        @endif
                        @if(isset($enfermedad->descripcion))
                          <dt>Descripción</dt>
                          <dd>{{$enfermedad->descripcion}}</dd>
                        @endif
                        @if(isset($enfermedad->comentarios))
                            <dt>Comentarios</dt>
                            <dd>{{$enfermedad->comentarios}}</dd>
                        @endif
                        </dl>
                      @endforeach
                    @endif
                  @endif
                   
                  <a href="#" data-toggle="modal" data-target="#modal-agregar4"><i align="left" class="fa fa-plus"></i>  Agregar Patología o afección</a>
                
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="modal-agregar4">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Agregar Patología o afección </h4>
                </div>
          
                <form id="nuevaPatologia-form" method="POST" action="{{ route('fichaMedica.storeEnfermedad',['asistido_id'=>$asistido->id]) }}">
                  {{ csrf_field() }}
                   
                  <div class="box-body">
                      <div class="form-group">  
                        {!! Form::Label('afeccion', 'Tipo de afección') !!}
                            <select class="form-control" name="afeccion" id="afeccion" required>
                                @foreach($afecciones as $afeccion)
                                    <option value="$afeccion->id">{{$afeccion->tipo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">  
                        {!! Form::Label('enfermedad', 'Patología') !!}
                            <select class="form-control" name="enfermedad" id="enfermedad" required>
                                @foreach($enfermedadesGenericas as $enfermedad)
                                    <option value="{{$enfermedad->id}}">{{$enfermedad->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                   
      
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger">Agregar Patología</button>
                  </div>
                </div>

                </form>
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
                  <form action="{{ route('fichaMedica.destroyEnfermedad',['id','asistidoid'])}}" method="POST">
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
                    @if(isset($fichaMedica))
                    @if (isset($fichaMedica->checkTratamiento))
                    @foreach($tratamientos as $tratamiento)
                        <div class="box-tools pull-right">
                        <a href="#"  data-target="#delete5" class="descartarBtn" data-id="{{$tratamiento->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Tratamiento">
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
                    <a href="{{route('fichaMedica.storeTratamiento',['asistido_id'=>$asistido->id])}}" data-toggle="modal" data-target="#modal-default2"><i align="left" class="fa fa-plus"></i> Agregar Tratamiento</a>
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
                    <form id="tratamiento-form" method="POST" action="{{ route('fichaMedica.storeTratamiento',['asistido_id'=>$asistido->id]) }}" >
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
                            <label for="medicacionEnTratamiento">El tratamiento incluye medicación</label>
                        </div>
                        <div class="mostrarMedicacion">
                        
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
                                <input type="text" class="form-control" id="nombreInstitucion1" placeholder="Nombre de la institución" name="nombreInstitucion" maxlength="250" >
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

            <div class="modal modal-danger fade" id="delete5" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title text-center">Atención!</h4>
                    </div>
                        
                    <form action="{{ route('fichaMedica.destroyTratamiento',['id','asistidoid'])}}" method="POST">
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
                  <a data-toggle="collapse" href="#collapseFour" style="color: black;">Medicaciones</a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse in">
                
                  @if(isset($fichaMedica))
                  <div class="box-body">
                  @if (isset($fichaMedica->checkMedicacion))
                  @foreach($medicaciones as $medicacion)
                      <div class="box-tools pull-right">
                          <a href=""  data-target="#delete6" class="descartarBtn" data-id="{{$medicacion->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Medicación">
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
                  <a href={{route('fichaMedica.storeMedicacion',['asistido_id'=>$asistido->id])}} data-toggle="modal" data-target="#modal-default3"><i align="left" class="fa fa-plus"></i>  Agregar Medicación</a>
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
                      
                      <form id="medicaciones-form" method="POST" action="{{ route('fichaMedica.storeMedicacion',['asistido_id'=>$asistido->id]) }}" >
                          {{ csrf_field() }}
                          <div class="box-body col-md-12">
                              <span>Solo complete esta Sección si el paciente no posee ninguna patología diagnosticada, caso contrario complete la Sección “Medicación” del Menú: “Tratamientos”
                                </span>
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

          <div class="modal modal-danger fade" id="delete6" style="display: none;">
              <div class="modal-dialog">
                  <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title text-center">Atención!</h4>
                  </div>
                        
                  <form action="{{ route('fichaMedica.destroyMedicacion',['id','asistidoid'])}}" method="POST">
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
                        <a data-toggle="collapse" href="#collapseFive" style="color: black;"> Intervenciones quirúrgicas</a>
                    </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse in">
                    
                        @if(isset($fichaMedica))
                        <div class="box-body">
                        @if (isset($fichaMedica->checkIntervencion))
                        @foreach($intervenciones as $intervencion)
                            <div class="box-tools pull-right">
                            <a href="#"  data-target="#delete7" class="descartarBtn" data-id="{{$intervencion->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Intervención">
                                <i class="fa fa-trash"></i>
                            </a>
                            </div>
                            <dl class="dl-horizontal preventoverflow" >
                                @if(isset($intervencion->diagnostico))
                                <dt>Diagnóstico</dt>
                                <dd>{{$intervencion->diagnostico}}</dd>
                                @endif
                                @if(isset($intervencion->tipoOperacion))
                                <dt>Tipo de operación</dt>
                                <dd>{{$intervencion->tipoOperacion}}</dd>
                                @endif
                                @if(isset($intervencion->institucion->nombre))
                                <dt>Hospital o institución</dt>
                                <dd>{{$intervencion->institucion->nombre}}</dd>
                                @endif
                                @if(isset($intervencion->profesional->nombre))
                                <dt>Nombre médico</dt>
                                <dd>{{$intervencion->profesional->nombre}}</dd>
                                @endif
                                @if(isset($intervencion->profesional->apellido))
                                <dt>Apellido médico</dt>
                                <dd>{{$intervencion->profesional->apellido}}</dd>
                                @endif
                                @if(isset($intervencion->fecha))
                                <dt>Fecha intervención</dt>
                                <dd>{{$intervencion->fecha}}</dd>
                                @endif
                                @if(isset($intervencion->tratamientoIndicado))
                                <dt>Tratamiento indicado</dt>
                                <dd>{{$intervencion->tratamientoIndicado}}</dd>
                                @endif
                                @if(isset($intervencion->medicacion))
                                <dt>Medicación</dt>
                                <dd>{{$intervencion->medicacion}}</dd>
                                @endif
                            </dl>
                        @endforeach
                        @endif
                        @endif 
                        <a href={{route('fichaMedica.storeIntervencion',['asistido_id'=>$asistido->id])}} data-toggle="modal" data-target="#modal-default4"><i align="left" class="fa fa-plus"></i>  Agregar Intervención quirúrgica</a>
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
                            <h4 class="modal-title">Agregar Intervención quirúrgica</h4>
                        </div>
                        <div class="modal-body">
                            
                            <form id="intervenciones-form" method="POST" action="{{ route('fichaMedica.storeIntervencion',['asistido_id'=>$asistido->id]) }}" >
                                {{ csrf_field() }}
                                <div class="box-body">
                                <div class="form-group {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
                                    <label for="diagnostico">Diagnóstico</label>
                                    <input type="text" class="form-control" id="diagnostico" placeholder="Diagnóstico" name="diagnostico" maxlength="250" required>
                                    @if ($errors->has('diagnostico'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diagnostico') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('tipoOperacion') ? ' has-error' : '' }}">
                                    <label for="tipoOperacion">Tipo de operación</label>
                                    <input type="text" class="form-control" id="tipoOperacion" placeholder="Tipo de operación quirúrgica" name="tipoOperacion" maxlength="250" required>
                                    @if ($errors->has('tipoOperacion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tipoOperacion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('institucion') ? ' has-error' : '' }}">
                                    <label for="institucion">Institución</label>
                                    <input type="text" class="form-control" id="institucion" placeholder="Institución de salud donde se realizó la intervención" name="institucion" maxlength="250" >
                                    @if ($errors->has('institucion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('institucion') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('medico') ? ' has-error' : '' }}">
                                    <label for="medico">Médico</label>
                                    <input type="text" class="form-control" id="medico" placeholder="Médico responsable de la intervención" name="medico" maxlength="250" >
                                    @if ($errors->has('medico'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('medico') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                                    <label for="fecha">Fecha de la intervención</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                    @if ($errors->has('fecha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('fecha') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('tratamientoIndicado') ? ' has-error' : '' }}">
                                    <label for="tratamientoIndicado">Tratamiento indicado</label>
                                    <input type="text" class="form-control" id="tratamientoIndicado" placeholder="Indique tratamiento indicado o rehabilitación" name="tratamientoIndicado" maxlength="250" required>
                                    @if ($errors->has('tratamientoIndicado'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tratamientoIndicado') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('medicacion') ? ' has-error' : '' }}">
                                    <label for="medicacion">Medicación</label>
                                    <input type="text" class="form-control" id="medicacion" name="medicacion" placeholder="Medicación" maxlength="250" required>
                                    @if ($errors->has('medicacion'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('medicacion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>
                            
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Agregar Intervención quirúrgica</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
    
                <div class="modal modal-danger fade" id="delete7" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                            <h4 class="modal-title text-center">Atención!</h4>
                        </div>
                            
                        <form action="{{ route('fichaMedica.destroyIntervencion',['id','asistidoid'])}}" method="POST">
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

<script type="text/javascript">

    window.onload=function(){
        $('#recetada').val('Indicada bajo receta')
        //document.getElementById("nombre").required = true
        $('.automedicacion').show()
        $('.institucionEnTratamiento').show()
        $('.mostrarInstitucion').hide()
        $('.mostrarMedicacion').hide()
        $('.mostrarProfesional').hide()

   

        var esAlergico=document.getElementById("checkAlergico")
        if (esAlergico.checked == true){
            $('.checkAlergico').show() 
        }else{
            $('.checkAlergico').hide() 
        }

        var tieneObraSocial=document.getElementById("checkObraSocial")
        if (tieneObraSocial.checked == true){
            $('.checkObraSocial').show() 
        }else{
            $('.checkObraSocial').hide() 
        }


    }

    function alergiaFunction(){
        var chkAlergia = document.getElementById("checkAlergico")

        if (chkAlergia.checked == true){
            $('.checkAlergico').show()
            document.getElementById("alergicoA").required = true
            
        }else{
            $('.checkAlergico').hide()   
            document.getElementById("alergicoA").required = false
        }
    }

    function discapacidadesFunction(){
        var chkVisual = document.getElementById("discapacidadVisual")
        var chkMotriz = document.getElementById("discapacidadMotriz")   
        var chkAuditiva = document.getElementById("discapacidadAuditiva")
        if (chkVisual.checked == true || chkAuditiva.checked == true || chkMotriz.checked == true){
            $('.observacionDiscapacidad').show()
            // document.getElementById("observacionDiscapacidad").required = true
            
        }else{
            $('.observacionDiscapacidad').hide()   
            // document.getElementById("observacionDiscapacidad").required = false
        }
    }

    function obraSocialFunction(){
        var chkObraSocial = document.getElementById("checkObraSocial")

        if (chkObraSocial.checked == true){
            $('.checkObraSocial').show()
            document.getElementById("obraSocial").required = true
            
        }else{
            $('.checkObraSocial').hide()  
            document.getElementById("obraSocial").required = false 
        }
    }
    
    function checkMedicacionEnTratamiento(){
        var chkMed = document.getElementById("medicacionEnTratamientoid")

        if (chkMed.checked == true){
            document.getElementById("droga1").required = true
            $('.mostrarMedicacion').show()
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

    $('#delete5').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })

    $('#delete6').on('show.bs.modal',function(event){
        var a = $(event.relatedTarget)
        var id= a.data('id')
        var asistidoid= a.data('asistidoid')
        var modal=$(this)
        modal.find('.modal-body #id').val(id)
        modal.find('.modal-body #asistidoid').val(asistidoid)
    })
    $('#delete7').on('show.bs.modal',function(event){
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

        if ($('#estadoGeneral-form')[0].checkValidity()) {

            formData = new FormData($('#estadoGeneral-form')[0]);

            bootbox.dialog({
                message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía la consulta.</p>',
                closeButton: false
            });

            $.ajax({
                url: "{{ route('fichaMedica.storeEstadoGeneral',['asistido_id'=>$asistido->id]) }}",
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