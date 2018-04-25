@extends('layouts.userApp')
@section('pageHeader')
<h1>
    Ficha de Datos Personales
    <small>*nombre asistido*</small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Test</li>
</ol>
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
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre" type="text" required>
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input class="form-control" id="apellido" name="apellido" placeholder="Ingrese apellido" type="text">
            </div>
            <div class="form-group">
                <label for="numeroDocumento">Numero de documento</label>
                <input class="form-control" id="numeroDocumento" name="numeroDocumento" placeholder="Ingrese numero de documento" type="text" pattern="[0-9]*$">
                <small><p class='help-block'>El número de documento no debe contener guiones ni puntos.</p></small>
            </div>
            <div class="form-group">
                <label for="apellido">Fecha de nacimiento</label>
                <input class="form-control" id="fechaNacimiento" name="fechaNacimiento" placeholder="Ingrese fecha de nacimiento" type="date">
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="tienePartida"> Tiene partida 
              </label>
            </div>
            <div class="form-group">
                <label for="nacionalidad">Nacionalidad</label>
                <input class="form-control" id="nacionalidad" name="nacionalidad" placeholder="Ingrese nacionalidad" type="text">
            </div>
            <div class="form-group">
                <label for="fechaIngreso">Fecha ingreso</label>
                <input class="form-control" id="fechaIngreso" name="fechaIngreso" placeholder="Ingrese fecha de ingreso al país" type="text">
            </div>
            <div class="form-group">
                <label for="celular">Celular</label>
                <input class="form-control" id="celular" name="celular" placeholder="Ingrese número de celular" type="text">
            </div>
            <div class="form-group">
                <label for="celular">Teléfono</label>
                <input class="form-control" id="telefono" name="telefono" placeholder="Ingrese número de teléfono" type="text" pattern="[0-9]*$">
                <small><p class='help-block'>El número de teléfono no debe contener guiones.</p></small>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input class="form-control" id="email" name="email" placeholder="Ingrese email" type="email">
            </div>
            <div class="form-group">
                <label for="nombreContacto">Nombre Contacto</label>
                <input class="form-control" id="nombreContacto" name="nombreContacto" placeholder="Ingrese el nombre de un contacto del asistido" type="text">
            </div>
            <div class="form-group">
                <label for="telefonoContacto">Teléfono Contacto</label>
                <input class="form-control" id="telefonoContacto" name="telefonoContacto" placeholder="Ingrese teléfono del contacto del asistido" type="text" pattern="[0-9]*$">
                <small><p class='help-block'>El número de teléfono no debe contener guiones.</p></small>
            </div>
            <div class="form-group">
                <label for="mailContacto">E-mail Contacto</label>
                <input class="form-control" id="emailContacto" name="emailContacto" placeholder="Ingrese e-mail del contacto del asistido" type="email">
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-danger">Enviar</button>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
@endsection