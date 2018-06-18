@extends('layouts.adminApp')

@section('pageHeader')
<h1>
    Ficha de Datos Personales
    <small>{{isset($asistido->nombre) ? $asistido->nombre : ''}}</small>
    <small>{{isset($asistido->apellido) ? $asistido->apellido : ''}}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Test</li>
</ol>

<div>
    <ol class="breadcrumb">
        <li><a href="{{route('asistido.show',['id'=>$asistido->id])}}">Asistido</a></li>
        <li class="active">Ficha de Datos Personales</li>
    </ol>
</div>
@endsection
@section('content')
<div class="row">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Ficha de Datos Personales</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
    <form id="fichaDatosPersonales-form" method="POST" action="{{url('/fichaDatosPersonales/store', ['asistido_id'=>$asistido->id]) }}" >
        {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <label for="nombre">Nombre</label>
            <input class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre" type="text" required value="{{isset($fichaDatosPersonales->nombre) ? $fichaDatosPersonales->nombre : (isset($asistido->nombre) ? $asistido->nombre : '')}}" {{isset($fichaDatosPersonales) ? 'readonly':''}}>
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input class="form-control" id="apellido" name="apellido" placeholder="Ingrese apellido" type="text" value="{{isset($fichaDatosPersonales->apellido) ? $fichaDatosPersonales->apellido : (isset($asistido->apellido) ? $asistido->apellido: '')}}">
            </div>
            <div class="form-group">
                <label for="numeroDocumento">Numero de documento</label>
                <input class="form-control" id="numeroDocumento" name="numeroDocumento" placeholder="Ingrese numero de documento" type="text" maxlength="9" pattern="[0-9]*$" value="{{isset($fichaDatosPersonales->numeroDocumento) ? $fichaDatosPersonales->numeroDocumento : (isset($asistido->dni) ? $asistido->dni: '')}}">
                <small><p class='help-block'>El número de documento no debe contener guiones ni puntos.</p></small>
            </div>
            <div class="form-group">
                <label for="apellido">Fecha de nacimiento</label>
                <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Ingrese fecha de nacimiento" type="date" value="{{isset($fichaDatosPersonales->fechaNacimiento) ? $fichaDatosPersonales->fechaNacimiento : (isset($asistido->fechaNacimiento) ? $asistido->fechaNacimiento : '')}}">
            </div>
            <div class="checkbox">
              <label>
              <input type="checkbox" name="tienePartida" {{isset($fichaDatosPersonales->tienePartida) && ($fichaDatosPersonales->tienePartida=1) ? 'checked':''}}> Tiene partida 
              </label>
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Ingrese nacionalidad" type="text" value="{{isset($fichaDatosPersonales->nacionalidad) ? $fichaDatosPersonales->nacionalidad : ''}}">
            </div>
            <div class="form-group">
                <label for="fechaIngreso">Fecha de ingreso al país</label>
                <input class="form-control" id="fechaIngresoAlPais" name="fechaIngresoAlPais" placeholder="Ingrese fecha de ingreso al país" type="date" value="{{isset($fichaDatosPersonales->fechaIngresoAlPais) ? $fichaDatosPersonales->fechaIngresoAlPais : ''}}">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input class="form-control" id="celular" name="celular" maxlength="9" placeholder="Ingrese número de celular" pattern="[0-9]*$" type="text" value="{{isset($fichaDatosPersonales->celular) ? $fichaDatosPersonales->celular : ''}}">
            </div>
            <div class="form-group">
                <label for="celular">Teléfono</label>
                <input class="form-control" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" type="text" maxlength="20" pattern="[0-9]*$" value="{{isset($fichaDatosPersonales->telefono) ? $fichaDatosPersonales->telefono : ''}}">
                <small><p class='help-block'>El número de teléfono no debe contener guiones.</p></small>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" id="email" name="email" placeholder="Ingrese email" type="email" value="{{isset($fichaDatosPersonales->email) ? $fichaDatosPersonales->email : ''}}">
            </div>
            <div class="form-group">
                <label for="nombreContacto">Nombre Contacto</label>
                <input class="form-control" id="nombreContacto" name="nombreContacto" placeholder="Ingrese el nombre de un contacto del asistido" type="text" value="{{isset($fichaDatosPersonales->nombreContacto) ? $fichaDatosPersonales->nombreContacto : ''}}">
            </div>
            <div class="form-group">
                <label for="telefonoContacto">Teléfono Contacto</label>
                <input class="form-control" id="telefonoContacto" name="telefonoContacto"  pattern="[0-9]*$" placeholder="Ingrese teléfono del contacto del asistido" maxlength="20" type="text" pattern="[0-9]*$" value="{{isset($fichaDatosPersonales->telefonoContacto) ? $fichaDatosPersonales->telefonoContacto : ''}}">
                <small><p class='help-block'>El número de teléfono no debe contener guiones.</p></small>
            </div>
            <div class="form-group">
                <label for="mailContacto">E-mail Contacto</label>
                <input class="form-control" id="mailContacto" name="mailContacto" placeholder="Ingrese e-mail del contacto del asistido" type="email" value="{{isset($fichaDatosPersonales->mailContacto) ? $fichaDatosPersonales->mailContacto : ''}}">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-danger">Enviar</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
@endsection