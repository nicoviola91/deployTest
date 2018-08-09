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
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-bell"></i> Asistidos</a></li>
	<li class="active">Nuevo</li>
</ol>
@endsection

@section('content')

<div class="row">


@if ($errors->any())
<div class="alert alert-info alert-dismissible col-md-8 col-md-offset-2" style="margin-bottom: 8px;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-ban"></i> Errores de Validación
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
</div>
@endif

<div class="alert alert-info alert-dismissible col-md-8 col-md-offset-2 ocultar" style="margin-bottom: 8px;">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  <h4><i class="icon fa fa-info"></i> Atención!</h4>
   Si el asistido tiene alertas generadas es conveniente dar de alta el asistido desde de su alerta, para un mejor seguimiento del caso.
   <br>Hacé <a href="{{url('alert/list')}}">CLICK ACÁ</a> para ver las Alertas pendientes
</div>

<div class="col-md-10 col-md-offset-1">
	
  <h3><i class="icon fa fa-user-plus"></i> Datos <small>INGRESÁ LOS DATOS DE LA PERSONA</small></h3>
  <div class="box box-solid">
		
		<div class="box-body">
			
			<form role="form" id="nuevoAsistido-form" method="POST" action="{{ url('/asistido/storeNew') }}">
        {{ csrf_field() }}
        <div class="box-body">

          <h4>
            <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                <span class="fa fa-circle fa-stack-2x" style="color: black"></span>
                <strong class="fa-stack-1x" style="color: white">
                    1    
                </strong>
            </span>
            Datos del Asistido
          </h4>
            
          <div class="form-group col-md-6">
            <label for="exampleInputEmail1">Nombre</label>
            <input type="text" class="form-control" id="name" placeholder='Nombre' name="nombre"  maxlength="250" required >
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Apellido</label>
            <input type="text" class="form-control" id="apellido"  placeholder='Apellido' name="apellido"  maxlength="250" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Documento</label>
            <input type="text" class="form-control" id="dni"  placeholder='DNI' name="dni"  maxlength="10" required>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" >
          </div>
          <div class="form-group col-md-12">
            <label for="exampleInputPassword1">Observaciones</label>
            <textarea class="form-control" id="observaciones" name="observaciones"  maxlength="250" rows="3"></textarea>
          </div>

          <h4>
            <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                <span class="fa fa-circle fa-stack-2x" style="color: black"></span>
                <strong class="fa-stack-1x" style="color: white">
                    2    
                </strong>
            </span>
            Posadero <small>Seleccioná en qué Posadero lo vas a dar de alta.</small>
          </h4>

          <div class="form-group col-md-12">
              <br>
              <select class="form-control select2 selectPosadero" name="institucion_id" style="width: 100%;" required>

                <option selected disabled>Seleccionar...</option>
              <?php foreach ($posaderos as $institucion): ?>

                <?php
                  $l = '';

                  if (isset($institucion->direccion->calle))
                    $l .= $institucion->direccion->calle;
                  if (isset($institucion->direccion->numero))
                    $l .= ' '.$institucion->direccion->numero;

                  if (isset($institucion->direccion->piso))
                    $l .= ' Piso '.$institucion->direccion->piso;
                  if (isset($institucion->direccion->departamento))
                    $l .= ' '.$institucion->direccion->departamento;

                  if (isset($institucion->direccion->localidad))
                    $l .= ', '.$institucion->direccion->localidad;
                  if (isset($institucion->direccion->provincia))
                    $l .= ', '.$institucion->direccion->provincia;
                ?>

                <option value="<?=$institucion->id?>" data-direccion="<?=$l?>" data-telefono="<?=$institucion->telefono?>" data-horarios="<?=$institucion->descripcion?>" data-nombre="<?=$institucion->nombre?>"><?=$institucion->nombre?> <?php echo ' - ' . $l ?></option>
              
              <?php endforeach ?>
            
            </select>
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
  
  $( document ).ready(function() {
      
      console.log( "ready!" );
      $('.ocultar').delay(7000).fadeOut();
  });

</script>
  
@endsection
