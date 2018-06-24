@extends('layouts.adminApp')


@section('title')
	Ficha Educacion
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
	Ficha Educacion
</h1>

@endsection

@section('content')
<div class="row">

    <div class="col-md-12">
      <h3 class="box-title"><i class="icon fa fa-mortar-board fa-fw"></i> Ficha de Educación
      <span class="pull-right">
        <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
        <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button>
      </span>
      </h3>
    </div>

    <div class="col-md-10 col-md-offset-1">
      <div class="box-body">
      
      <div class="box-group">

        <div class="panel box">
      
          <div class="box-header with-border">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseEducacion" style="color: black;"> Educación </a>
            </h4>
          </div>
      
          <div id="collapseEducacion" class="panel-collapse collapse in">
            <div class="box-body ">
              @if(isset($educaciones))
                @foreach($educaciones as $educacion)
                  <div class="box-tools pull-right">
                    <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$educacion->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Educación">
                      <i class="fa fa-trash"></i>
                    </a>
                  </div>
                  <dl class="dl-horizontal preventoverflow" >
                    
                    @if(isset($educacion->tipo->descripcion))
                    <dt>Tipo de educación</dt>
                    <dd>{{$educacion->tipo->descripcion}}</dd>
                    @endif

                    @if(isset($educacion->institucion))
                    <dt>Institución</dt>
                    <dd>{{$educacion->institucion}}</dd>
                    @endif
                    @if(isset($educacion->nivelAlcanzado))
                      <dt>Nivel Alcanzado</dt>
                      <dd>{{$educacion->nivelAlcanzado}}</dd>
                    @endif
                    @if(isset($educacion->direccion->calle))
                    <dt>Calle</dt>
                    <dd>{{$educacion->direccion->calle}}</dd>
                    @endif
                    @if(isset($educacion->direccion->numero))
                    <dt>Número</dt>
                    <dd>{{$educacion->direccion->numero}}</dd>
                    @endif
                    @if(isset($educacion->direccion->piso))
                    <dt>Piso</dt>
                    <dd>{{$educacion->direccion->piso}}</dd>
                    @endif
                    @if(isset($educacion->direccion->departamento))
                    <dt>Departamento</dt>
                    <dd>{{$educacion->direccion->departamento}}</dd>
                    @endif
                    @if(isset($educacion->direccion->entreCalles))
                    <dt>Entre calles</dt>
                    <dd>{{$educacion->direccion->entreCalles}}</dd>
                    @endif
                    @if(isset($educacion->direccion->localidad))
                    <dt>Localidad</dt>
                    <dd>{{$educacion->direccion->localidad}}</dd>
                    @endif
                    @if(isset($educacion->direccion->provincia))
                    <dt>Provincia</dt>
                    <dd>{{$educacion->direccion->provincia}}</dd>
                    @endif

                    @if(isset($educacion->direccion->pais))
                    <dt>País</dt>
                    <dd>{{$educacion->direccion->pais}}</dd>
                    @endif
                    @if(isset($educacion->direccion->codigoPostal))
                    <dt>Código Postal</dt>
                    <dd>{{$educacion->direccion->codigoPostal}}</dd>
                    @endif
                    
                    @if(isset($educacion->inicio))
                    <dt>Inicio de los estudios</dt>
                    <dd>{{$educacion->inicio}}</dd>
                    @endif

                    @if(isset($educacion->fin))
                    <dt>Fin de los estudios</dt>
                    <dd>{{$educacion->fin}}</dd>
                    @endif

                    @if(isset($educacion->comentarios))
                    <dt>Comentarios</dt>
                    <dd>{{$educacion->comentarios}}</dd>
                    @endif
                  </dl>
                @endforeach
                @endif 
              <a href="#" data-toggle="modal" data-target="#modal-agregarEducacion"><i align="left" class="fa fa-plus fa-fw"></i>  Agregar Educación</a>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade" id="modal-agregarEducacion">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus fa-fw"></i> Agregar Educación <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button></h4>
            </div>
              




              <form id="nuevoContacto-form" method="POST" action="{{ route('fichaEducacion.storeEducacion',['asistido_id'=>$asistido->id]) }}">
                {{ csrf_field() }}
                




                <div class="box-body">
                   
                  <div class="form-group col-md-6">
                    {!! Form::Label('tipo', 'Tipo de estudios') !!}
                    
                    <select class="form-control" name="tipoEducacion" id="tipoEducacion" required>
                      @foreach($tipos as $tipo)
                        <option value="{{$tipo}}">{{$tipo}}</option>
                      @endforeach
                    </select>           
                
                  </div>
                              
                  <div class="form-group col-md-6">
                    {!! Form::Label('nivelAlcanzado', 'Nivel alcanzado') !!}
                    
                    <select class="form-control" name="nivelAlcanzado" id="nivelAlcanzado" required>
                      @foreach($niveles as $nivel)
                        <option value="{{$nivel}}">{{$nivel}}</option>
                      @endforeach
                    </select>
                  </div>
               
                  <!-- ESTO DE ACA ABAJO (ORIENTACION) SOLO DEBE MOSTRARSE CUANDO SELECCIONAN COMO TIPO DE EDUCACION LA SECUNDARIA!-->
                  <div class="form-group orientacion col-md-12" style="display: none;">
                    {!! Form::Label('orientacion', 'Orientacion') !!}
                    <select class="form-control" name="orientacion" id="orientacion" >
                      @foreach($orientaciones as $orientacion)
                        <option value="{{$orientacion}}">{{$orientacion}}</option>
                      @endforeach
                    </select>
                  </div>

                  <!-- ESTO DEBE MOSTRARSE SOLO CUANDO EL TIPO DE EDUCACION SELECCIONADO ES TERCIARIO O UNIVERSITARIO O CURSO!-->
                  <div class="form-group tituloObtenido col-md-12 {{ $errors->has('tituloObtenido') ? ' has-error' : '' }}" style="display: none;"> 
                    <label for="tituloObtenido">Título obtenido</label>
                    <input type="text" class="form-control" id="tituloObtenido" placeholder="Ingrese título obtenido" name="tituloObtenido" maxlength="250">
                    @if ($errors->has('tituloObtenido'))
                      <span class="help-block">
                          <strong>{{ $errors->first('tituloObtenido') }}</strong>
                      </span>
                    @endif
                  </div>

                  <div class="form-group col-md-12 {{ $errors->has('institucion') ? ' has-error' : '' }}">
                    <label for="institucion">Nombre de la institución</label>
                    <input type="text" class="form-control" id="institucion" placeholder="Ingrese nombre completo de la institución" name="institucion" required maxlength="250">
                    @if ($errors->has('institucion'))
                      <span class="help-block">
                          <strong>{{ $errors->first('institucion') }}</strong>
                      </span>
                    @endif
                  </div>
                   
                  <label class="col-md-12">Dirección de la institución</label>
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false" maxlength="250">
                    <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                  </div>

                  <div class="form-group col-md-6">
                    <label>Calle</label>
                    <input class="form-control" id="route" name="calle" required maxlength="250">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Número</label>
                    <input class="form-control" id="street_number" name="numero" maxlength="250">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Piso</label>
                    <input class="form-control" name="piso" maxlength="250">
                  </div>
                  <div class="form-group col-md-2">
                    <label>Dpto</label>
                    <input class="form-control" name="departamento" maxlength="250">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Localidad</label>
                    <input class="form-control" id="locality" name="localidad" maxlength="250">
                  </div>
                  <div class="form-group col-md-3">
                    <label>CP</label>
                    <input class="form-control" id="postal_code" name="codigoPostal" maxlength="250">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Provincia</label>
                    <input class="form-control" id="administrative_area_level_1" name="provincia" maxlength="250">
                  </div>
                  
                  <div class="form-group col-md-3">
                    <label>Pais</label>
                    <input class="form-control" id="country" name="pais" maxlength="250">
                  </div>

                  <input class="form-control" id="lat" name="lat" style="display: none;">
                  <input class="form-control" id="lng" name="lng" style="display: none;">

                  <div class="form-group col-md-12">
                    <label>Mas detalles (entre calles)</label>
                    <input class="form-control" name="entreCalles" maxlength="250">
                  </div>

                  <div class="form-group col-md-6 {{ $errors->has('inicio') ? ' has-error' : '' }}">
                    <label for="inicio">Inicio de los estudios</label>
                    <input type="date" class="form-control" id="inicio" placeholder="Inicio de los estudios" name="inicio">
                    @if ($errors->has('inicio'))
                      <span class="help-block">
                          <strong>{{ $errors->first('inicio') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="form-group col-md-6 {{ $errors->has('fin') ? ' has-error' : '' }}">
                      <label for="fin">Fin de los estudios</label>
                      <input type="date" class="form-control" id="fin" placeholder="Fin de los estudios" name="fin">
                      @if ($errors->has('fin'))
                        <span class="help-block">
                            <strong>{{ $errors->first('fin') }}</strong>
                        </span>
                      @endif
                    </div>
                    <div class="form-group col-md-12 {{ $errors->has('comentarios') ? ' has-error' : '' }}">
                        <label for="comentarios">Comentarios</label>
                        <input type="text" class="form-control" id="comentarios" placeholder="Comentarios adicionales" name="comentarios" maxlength="6000">
                        @if ($errors->has('comentarios'))
                          <span class="help-block">
                              <strong>{{ $errors->first('comentarios') }}</strong>
                          </span>
                        @endif
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-danger">Agregar Educación </button>
                      </div>
                    </div>
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
                        <form action="{{ route('fichaEducacion.destroyEducacion',['id','asistidoid'])}}" method="POST">
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

  @include('scripts.googleMaps')

  <script type="text/javascript">
    
    $('#tipoEducacion').change(function () {

      if ($(this).val() == 'Secundario') {

        $('.orientacion').show();
        $('.tituloObtenido').hide();
      
      } else if ($(this).val() == 'Terciario' || $(this).val() == 'Universitario' || $(this).val() == 'Curso') {

        $('.orientacion').hide();
        $('.tituloObtenido').show();

      } else {

        $('.orientacion').hide();
        $('.tituloObtenido').hide();
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

  </script>

@endsection