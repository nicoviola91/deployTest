@extends('layouts.adminApp')
@extends('scripts.googleMaps')


@section('title')
	Ficha Necesidades
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
	Ficha Necesidades
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
                Necesidades del asistido 
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in">
            <div class="box-body ">
                
              @if(($asistido->checkFichaNecesidad)==1)
            
                @foreach($necesidades as $necesidad)
                <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$necesidad->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Necesidad">
                        <i class="fa fa-trash"></i>
                    </a>
                </div>
                <dl class="dl-horizontal preventoverflow" >

                    @if(isset($necesidad->created_at))
                    <dt>Fecha de creación</dt>
                    <dd>{{$necesidad->created_at}}</dd>
                    @endif
                    @if(isset($necesidad->tipo->descripcion))
                    <dt>Tipo de necesidad</dt>
                    <dd>{{$necesidad->tipo->descripcion}}</dd>
                    @endif
                    @if(isset($necesidad->especificacion))
                    <dt>Descripción</dt>
                    <dd>{{$necesidad->especificacion}}</dd>
                    @endif

                </dl>
                @endforeach
                
                @endif 


              <a href="#" data-toggle="modal" data-target="#modal-agregar"><i align="left" class="fa fa-plus"></i>  Agregar Necesidad</a>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-agregar">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Agregar Necesidad</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            </div>
              <form id="nuevoContacto-form" method="POST" action="{{ route('fichaNecesidades.storeNecesidad',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                <div class="box-body">

                    <div class="box-body">
                        <div class="form-group">          
                        {!! Form::Label('tipoNecesidad_id', 'Tipo de Necesidad') !!}
                        <select class="form-control" name="tipoNecesidad_id" id="tipoNecesidad_id" required >
                            @foreach($tiposNecesidades as $tipoNecesidad)
                            <option value="{{$tipoNecesidad->id}}">{{$tipoNecesidad->descripcion}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>

                    <div class="form-group col-md-12 {{ $errors->has('especificacion') ? ' has-error' : '' }}">
                        <label for="especificacion">Descripción</label>
                        <input type="text" class="form-control" id="especificacion" placeholder="Ingrese una descripción de las necesidades específicas del asistido" name="especificacion" maxlength="250" required>
                        @if ($errors->has('especificacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('especificacion') }}</strong>
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
                <form action="{{ route('fichaNecesidades.destroyNecesidad',['id','asistidoid'])}}" method="POST">
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