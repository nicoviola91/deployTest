@extends('layouts.adminApp')
@extends('scripts.googleMaps')


@section('title')
	Ficha Asistencia Social
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
        
        .preventoverflow{
            
            white-space: normal;
            overflow: hidden;
            text-overflow: ellipsis
        }

	</style>

@endsection

@section('pageHeader')
<h1>
	Ficha Diagnóstico Integral
</h1>

@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <h3 class="box-title"><i class="icon fa fa-universal-access fa-fw"></i> Ficha Diagnóstico Integral
        <span class="pull-right">
        <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
        {{-- <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button> --}}
        </span>
        </h3>
    </div>  
    
    <div class="col-md-10 col-md-offset-1">
        <div class="box-body">
            <div class="box-group">
                <div class="panel box box-danger">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                            Diagnóstico
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in">
                        <div class="box-body">
                            <form id="diagnostico-form" method="POST" action="{{ url('/fichaDiagnosticoIntegral/storeDiagnostico',['asistido_id'=>$asistido->id]) }}" >
                            {{ csrf_field() }}
                                <div class="form-group {{ $errors->has('diagnostico') ? ' has-error' : '' }}">
                                    <label for="diagnostico">Diagnóstico biopsicosocial</label>
                                    <input type="text" class="form-control" id="diagnostico" placeholder="Diagnóstico" name="diagnostico" required maxlength="250" value="{{isset($fichaDiagnosticoIntegral->diagnostico) ? $fichaDiagnosticoIntegral->diagnostico : ''}}">
                                    @if ($errors->has('diagnostico'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('diagnostico') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group {{ $errors->has('trabajoInterdisciplinario') ? ' has-error' : '' }}">
                                    <label for="trabajoInterdisciplinario">Trabajo Interdisciplinario</label>
                                    <input type="text" class="form-control" id="trabajoInterdisciplinario" placeholder="Seleccione los voluntarios con los cuales desea compartir el caso" name="trabajoInterdisciplinario" maxlength="250" value="{{isset($fichaDiagnosticoIntegral->trabajoInterdisciplinario) ? $fichaDiagnosticoIntegral->trabajoInterdisciplinario : ''}}">
                                    @if ($errors->has('trabajoInterdisciplinario'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('trabajoInterdisciplinario') }}</strong>
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
        <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box">
            <div class="box-header with-border">
            <h4 class="box-title">
                <a data-toggle="collapse" href="#collapseCurso" style="color: black;"> Cursos de acción </a>
            </h4>
            </div>
            <div id="collapseCurso" class="panel-collapse collapse in">
            <div class="box-body ">
                
                @if(($asistido->checkFichaDiagnosticoIntegral)==1)
                
                @foreach($cursos as $curso)
                    <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$curso->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Curso de Acción">
                        <i class="fa fa-trash"></i>
                    </a>
                    </div>
                    <dl class="dl-horizontal preventoverflow" >
                    @if(isset($curso->fechaDesde))
                    <dt>Fecha de inicio</dt>
                    <dd>{{$curso->fechaDesde}}</dd>
                    @endif
                    @if(isset($curso->fechaHasta))
                    <dt>Fecha de finalización</dt>
                    <dd>{{$curso->fechaHasta}}</dd>
                    @endif
                    @if(isset($curso->meta))
                    <dt>Meta</dt>
                    <dd>{{$curso->meta}}</dd>
                    @endif
                    @if(isset($curso->accion))
                    <dt>Acción</dt>
                    <dd>{!! $curso->accion  !!}</dd>
                    @endif
                    </dl>
                @endforeach
                @endif 

                <a href="#" data-toggle="modal" data-target="#modal-servicios"><i align="left" class="fa fa-plus"></i>  Agregar Curso de Acción</a>
            </div>
            </div>
        </div>
        </div>



          
          <div class="modal fade" id="modal-servicios">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> Agregar Curso de Acción </h4>
                </div>
                  <form id="nuevoContacto-form" method="POST" action="{{ route('fichaDiagnosticoIntegral.storeCurso',['asistido_id'=>$asistido->id]) }}">
                    {{ csrf_field() }}
                    <div class="box-body">
    
                       
                        <span>Plazo</span>
                        <div class="form-group col-md-12 {{ $errors->has('fechaDesde') ? ' has-error' : '' }}">
                            <label for="fechaDesde">Desde</label>
                            <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" >
                            @if ($errors->has('fechaDesde'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fechaDesde') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('fechaHasta') ? ' has-error' : '' }}">
                            <label for="fechaHasta">Hasta</label>
                            <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" >
                            @if ($errors->has('fechaHasta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('fechaHasta') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('meta') ? ' has-error' : '' }}">
                            <label for="meta">Meta</label>
                            <input type="text" class="form-control" id="meta" name="meta" maxlength="250" required>
                            @if ($errors->has('meta'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('meta') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-md-12 {{ $errors->has('accion') ? ' has-error' : '' }}">
                            <label for="accion">Acción</label>
                            <input type="text" class="form-control" id="accion" name="accion"  maxlength="250">
                            @if ($errors->has('accion'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('accion') }}</strong>
                                </span>
                            @endif
                        </div>
                        
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
                    <form action="{{ route('fichaDiagnosticoIntegral.destroyCurso',['id','asistidoid'])}}" method="POST">
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
</script>

@endsection