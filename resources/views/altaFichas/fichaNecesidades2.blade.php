
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

<div class="row">

    <div class="col-md-12">
    <h3 class="box-title"><i class="icon fa fa-hotel fa-fw"></i> Ficha Necesidades
    <span class="pull-right">
      <a href="javascript:window.print()" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</a>
    </span>
    </h3>
  </div>

  <!-- left column -->
  <div class="col-md-10 col-md-offset-1">
    <div class="box-body">
      <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-danger">
          <div class="box-header with-border no-print">
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
                    <a href="#"  data-target="#delete" class="descartarBtn no-print" data-id="{{$necesidad->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Necesidad">
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


              <a href="#" data-toggle="modal" data-target="#modal-agregar" class="no-print"><i align="left" class="fa fa-plus"></i>  Agregar Necesidad</a>
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
