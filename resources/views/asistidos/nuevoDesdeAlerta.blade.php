@extends('layouts.adminApp')


@section('title')
	Asistido
@endsection


@section('pageHeader')
<h1>
	Asistidos
	<small>Nuevo Asistido</small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Asistidos</a></li>
	<li class="active">Nuevo</li>
</ol>
@endsection

@section('content')

<div class="row">
<div class="col-md-10 col-md-offset-1">
	<div class="box box-solid">
		
		<div class="box-body">
    <form id="nuevoAsistido-form" method="POST" action="{{ url('/asistido/store',['alerta_id'=>$alerta->id]) }}">
      {{ csrf_field() }}
        <div class="box-body">  
          <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" id="name" value={{ $alerta->nombre }} name="nombre" maxlength="250" required >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Apellido</label>
            <input type="text" class="form-control" id="apellido" value={{ $alerta->apellido }} name="apellido"  maxlength="250" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Documento</label>
            <input type="text" class="form-control" id="dni" value={{ $alerta->dni }} name="dni"  maxlength="10" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value={{ $alerta->fechaNacimiento }}>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"  maxlength="250" value={{ $alerta->observaciones }} rows="3"></textarea>
          </div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary submitBtn">Enviar</button>
          <button type="reset" class="btn btn-default">Cancelar</button>
        </div>
      </form>
		</div>
	</div>
</div>
</div>
	
@endsection


@section('scripts')

<script type="text/javascript">

	$('#submitBtn').click(function() {

	});

</script>

@endsection
