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

  <div class="col-md-12">
    @if ($errors->any())
        <div class="alert alert-danger col-md-8 col-md-offset-2">
          Errores de Validación
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  </div>

  <div class="col-md-10 col-md-offset-1">

    <h3><i class="icon fa fa-bullhorn"></i> Datos de la Alerta <small>Verificá que los datos sean correctos antes de continuar</small></h3>

  	<div class="box box-solid">
        
  		<div class="box-body">

        <form id="nuevoAsistido-form" method="POST" action="{{ url('/asistido/store',['alerta_id'=>$alerta->id]) }}">
          {{ csrf_field() }}

          <h4>
            <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                <span class="fa fa-circle fa-stack-2x" style="color: black"></span>
                <strong class="fa-stack-1x" style="color: white">
                    1    
                </strong>
            </span>
            Datos del Asistido
          </h4>

          <div class="box-body">  
            <div class="form-group col-md-6">
              <label for="exampleInputEmail1">Nombre</label>
              <input type="text" class="form-control" id="name" value="{{ $alerta->nombre }}" name="nombre" maxlength="250" required >
            </div>
            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Apellido</label>
              <input type="text" class="form-control" id="apellido" value="{{ $alerta->apellido }}" name="apellido"  maxlength="250" required>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Documento</label>
              <input type="text" class="form-control" id="dni" value="{{ $alerta->dni }}" name="dni" maxlength="10" required>
            </div>
            <div class="form-group col-md-6">
              <label for="exampleInputPassword1">Fecha Nacimiento</label>
              <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" value="{{ $alerta->fechaNacimiento }}">
            </div>
            <div class="form-group col-md-12">
              <label for="exampleInputPassword1">Observaciones</label>
              <textarea class="form-control" id="observaciones" name="observaciones"  maxlength="250" rows="3">{{ $alerta->observaciones }}</textarea>
            </div>
          </div>

          <h4>
            <span class="fa-stack" style="text-shadow: 3px 3px 16px #272634;">
                <span class="fa fa-circle fa-stack-2x" style="color: black"></span>
                <strong class="fa-stack-1x" style="color: white">
                    2    
                </strong>
            </span>
            Posadero <small>Posadero al que fue derivado. Si se presentó en otro Posadero actualizalo acá.</small>
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

                <option <?php echo $institucion->id == $alerta->institucion_id? ' selected ' : '' ?> value="<?=$institucion->id?>" data-direccion="<?=$l?>" data-telefono="<?=$institucion->telefono?>" data-horarios="<?=$institucion->descripcion?>" data-nombre="<?=$institucion->nombre?>"><?=$institucion->nombre?> <?php echo ' - ' . $l ?></option>
              
              <?php endforeach ?>
            
            </select>
            </div>



          <div class="box-footer">
            <button type="submit" class="btn btn-primary submitBtn" style="display: none;">Enviar</button>
            <button type="button" class="btn btn-primary altaBtn">Enviar</button>
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

	$('.altaBtn').click(function (e) {

    e.preventDefault();

    dni = $('#dni').val();

    $.post("{{route('asistido.verificarDocumentoExistente')}}", { '_token' : '{{csrf_token()}}', 'dni' : dni}, function(data) {

      if (data.status) {

        bootbox.confirm({
            title: "Atención!",
            message: "Ya existe un Asistido con el DNI especificado. <br><br><strong><i class='icon fa fa-user'></i> Asistido:</strong> " + data.asistido_nombre + " <br><strong><i class='icon fa fa-bank'></i> Institución:</strong> " + data.posadero + " <br><br> Hace <a target='_blank' href='{{url('/asistido/show/')}}/"+data.asistido_id+"'>click acá</a> para ver la Ficha del Asistido existente. <br><br>Estás seguro que querés continuar? Hace <a target='_blank' href='{{url('/asistido/list')}}'>click acá</a> para ir al listado completo." ,
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancelar'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Continuar'
                }
            },
            callback: function (result) {
                
                if (result) {
                  $('.submitBtn').trigger('click');
                }
            }
        });

      } else {
        $('.submitBtn').trigger('click');
      }

    })

  });
</script>

@endsection
