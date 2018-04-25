@extends('layouts.userApp')


@section('title')
	Alerta
@endsection


@section('pageHeader')
<h1>
	Alertas
	<small>Nueva Alerta</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Alertas</a></li>
	<li class="active">Nueva</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-10 col-md-offset-1">
	<div class="box box-solid">
		
		<div class="box-body">
			
			<form role="form" id="nuevaAlerta-form">
              
              <div class="box-body">
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre</label>
                  <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Apellido</label>
                  <input type="text" class="form-control" id="apellido" placeholder="Apellido" name="apellido">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Documento</label>
                  <input type="text" class="form-control" id="documento" placeholder="Documento" name="documento">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha Nacimiento</label>
                  <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Observaciones</label>
                  <textarea class="form-control" id="observaciones" name="observaciones" rows="3"></textarea>
                </div>

                <input type="text" class="form-control" id="lat" placeholder="Latitud" name="lat" style="display: none;">
                <input type="text" class="form-control" id="lng" placeholder="Longitud" name="lng" style="display: none;">

                <div class="checkbox">
                  <label>
                    <input type="checkbox" checked="true"> Enviar Coordenadas
                  </label>
                </div>

              </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enviar</button>
                <button type="reset" class="btn btn-default">Cancelar</button>
              </div>
            </form>

		</div>

	</div>
</div>
</div>
	
@endsection
