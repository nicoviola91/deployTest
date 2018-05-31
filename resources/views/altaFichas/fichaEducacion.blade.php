@extends('layouts.adminApp')


@section('title')
	Ficha Educacion
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
	Ficha Educacion
</h1>

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
                      Educación Primaria
                    </a>
                  </h4>
                </div>

                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="box-body ">
                        @if(isset($fichaeducacion))

                            @if (isset($fichaEducacion->checklistPrimaria)) 
                            @foreach($primarias as $primaria)
                                <div class="box-tools pull-right">
                                    
                                    <a href="{{ route('fichaEducacion.destroyEducacion',['contacto_id'=>$contacto->id,'asistido_id'=>$asistido->id])}}" class="descartarBtn" data-id="{{$contacto->id}}" data-toggle="tooltip" data-title="Descartar Contacto">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                                <dl class="dl-horizontal" >
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

                    <div class="modal-dialog modal-lg">

                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                          <h4 class="modal-title"> Agregar Contacto </h4>
                        </div>
                  
                        <form id="nuevoContacto-form" method="POST" action="{{ route('fichaFamiliaAmigos.storeContacto',['asistido_id'=>$asistido->id]) }}">
                              {{ csrf_field() }}
                               
                               <div class="box-body"><div class="form-group">
                                           
                                           <div class="form-group">
                                             {!! Form::Label('tipo', 'Tipo:') !!}
                                             <select class="form-control" name="tipo" id="tipo "required>
                                               @foreach($relaciones as $relacion)
                                                 <option value="{{$relacion}}">{{$relacion}}</option>
                                               @endforeach
                                             </select>
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                             <label for="nombre">Nombre</label>
                                             <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
                                             @if ($errors->has('nombre'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('nombre') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                               
                                           <div class="form-group {{ $errors->has('apellido') ? ' has-error' : '' }}">
                                             <label for="apellido">Apellido</label>
                                             <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido">
                                             @if ($errors->has('apellido'))
                                               <span class="help-block">
                                                   <strong>{{ $errors->first('apellido') }}</strong>
                                               </span>
                                             @endif
                                           </div>
                                        
                                           <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                              <label for="telefono">Teléfono</label>
                                              <input type="text" class="form-control" id="telefono" placeholder="Teléfono de contacto" name="telefono">
                                              @if ($errors->has('telefono'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                              @endif
                                            </div>

                                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                              <label for="email">E-mail</label>
                                              <input type="email" class="form-control" id="email" placeholder="E-mail" name="email">
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
                </div>
            </div>
        </div>
    </div>
@endsection