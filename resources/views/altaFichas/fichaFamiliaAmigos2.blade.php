<div class="row">


  <div class="col-md-12">
    <h3 class="box-title"><i class="icon fa fa-users fa-fw"></i> Ficha Familia y Amigos
    <span class="pull-right">
      <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-print"></i> Imprimir</button>
      <button type="button" class="btn btn-default btn-sm no-print"><i class="fa fa-share"></i> Compartir</button>
    </span>
    </h3>
  </div>

  <!-- left column -->
  <div class="col-md-10 col-md-offset-1">
      <div class="box-body">


      <div class="box-group">
        <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
        <div class="panel box box-warning">
          <div class="box-header with-border black">
            <h4 class="box-title">
              <a data-toggle="collapse" href="#collapseOne" style="color: black;">
                Contactos
              </a>
            </h4>
          </div>

          <div id="collapseOne" class="panel-collapse collapse in">
              <div class="box-body">
                  @if(isset($fichaFamiliaAmigos))

                      @if (isset($fichaFamiliaAmigos->checklistContactos)) 
                      @foreach($contactos as $contacto)
                          <div class="box-tools pull-right">
                              <a href="#"  data-target="#delete" class="descartarBtn" data-id="{{$contacto->id}}" data-asistidoid="{{$asistido->id}}" data-toggle="modal" data-title="Descartar Contacto">
                                <i class="fa fa-trash"></i>
                              </a>
                          </div>
                          <dl class="dl-horizontal preventoverflow" >
                              <dt>Tipo</dt>
                              <dd>{{$contacto->tipo}}</dd>

                              @if(isset($contacto->nombre))
                              <dt>Nombre</dt>
                              <dd>{{$contacto->nombre}}</dd>
                              @endif
                              
                              @if(isset($contacto->apellido))
                              <dt>Apellido</dd>
                              <dd>{{$contacto->apellido}}</dd>
                              @endif

                              @if(isset($contacto->telefono))
                              <dt>Teléfono</dd>
                              <dd>{{$contacto->telefono}}</dd>
                              @endif

                              @if(isset($contacto->email))
                              <dt>E-mail</dd>
                              <dd>{{$contacto->email}}</dd>
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

              <div class="modal-dialog">

                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="icon fa fa-plus-square"></i> Agregar Contacto </h4>
                  </div>
            
                  <form id="nuevoContacto-form" method="POST" action="{{ route('fichaFamiliaAmigos.storeContacto',['asistido_id'=>$asistido->id]) }}">
                        {{ csrf_field() }}
                          
                          <div class="box-body"><div class="form-group">
                                      
                                      <div class="form-group col-md-12">
                                        {!! Form::Label('tipo', 'Tipo:') !!}
                                        <select class="form-control" name="tipo" id="tipo "required>
                                          @foreach($relaciones as $relacion)
                                            <option value="{{$relacion}}">{{$relacion}}</option>
                                          @endforeach
                                        </select>
                                      </div>
                          
                                      <div class="col-md-6 form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" maxlength="250">
                                        @if ($errors->has('nombre'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('nombre') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                          
                                      <div class="col-md-6 form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido" maxlength="250">
                                        @if ($errors->has('apellido'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('apellido') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                  
                                      <div class="col-md-6 form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" placeholder="Teléfono de contacto" name="telefono" maxlength="250">
                                        @if ($errors->has('telefono'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('telefono') }}</strong>
                                          </span>
                                        @endif
                                      </div>

                                      <div class="col-md-6 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" maxlength="250">
                                        @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                          @endif
                                        </div>
                                  </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-danger">Agregar Contacto</button>
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
                    <form action="{{ route('fichaFamiliaAmigos.destroyContacto',['id','asistidoid'])}}" method="POST">
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
