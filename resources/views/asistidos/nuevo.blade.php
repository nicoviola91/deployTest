@extends('layouts.adminApp')


@section('title')
	Asistido
@endsection


@section('pageHeader')
<h1>
	Asistido
	<small>Nuevo Asistido</small>
</h1>
<br>
<p>Atención! Si el asistido tiene alertas generadas, es conveniente dar de alta el asistido partiendo de su alerta, para un mejor seguimiento del caso </p>
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
			
			<form role="form" id="nuevoAsistido-form" method="POST" action="{{ url('/asistido/storeNew') }}">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
              @if(isset($comunidades))
              <label for="comunidad">Comunidad al que pertenece como usuario</label>
              <select class="form-control" name="comunidad" id="comunidad" >
                  @foreach($comunidades as $comunidad)
                    <option value="{{$comunidad->id}}">{{$comunidad->nombre}}</option>
                  @endforeach
              </select>
          </div>
            @endif
          <div class="form-group">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder='Nombre' name="nombre"  maxlength="250" required >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Apellido</label>
            <input type="text" class="form-control" id="apellido"  placeholder='Apellido' name="apellido"  maxlength="250" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Documento</label>
            <input type="text" class="form-control" id="dni"  placeholder='DNI' name="dni"  maxlength="10" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" >
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"  maxlength="250" rows="3"></textarea>
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


@endsection
