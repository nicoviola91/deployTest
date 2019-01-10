@extends('layouts.userApp')


@section('title')
	Bienvenido
@endsection


@section('head')

    <!-- Plugin CSS -->
    <link href="{{asset('/creative/vendor/magnific-popup/magnific-popup.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('/creative/css/creative.css')}}" rel="stylesheet">

	  <!-- Plugin JavaScript -->
    <script src="{{asset('/creative/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('/creative/vendor/scrollreveal/scrollreveal.min.js')}}"></script>
    <script src="{{asset('/creative/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('/creative/js/creative.js')}}"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/select2/select2.min.css') }}">
    <script src="{{ asset('/select2/select2.full.min.js') }}"></script>

    <style type="text/css">
    	
    	.btnCreative {
    		font-weight: 700;
		    text-transform: uppercase;
		    border: none;
		    border-radius: 300px;
		    font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif;
    	}
      
      .boton{
        cursor: pointer;
      }

      .boton:hover{
        /*background: #f0c7c7;*/
        /*border-radius: 8px;  */
        font-weight: bold;
      }
    </style>

@endsection


@section('pageHeader')


@endsection

@section('contentFullScreen')

    <section class="bg-primary" id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading text-white">Hola {{Auth::user()->name}}!</h2>
            <br>
            <h3 class="section-heading text-white">Bienvenido a la Red del Posadero</h3>
            <hr class="light my-4">

            <p class="text-faded mb-4">¿CONOCÉS A ALGUIEN EN SITUACIÓN DE VULNERABILIDAD? ¡Avisanos para poder ayudar!</p>
            <a class="btn btnCreative btn-light btn-xl js-scroll-trigger" href="{{url('/alert/new')}}" style="color: #eee !important; background-color: #0d0a0a99;"> <i class="icon fa fa-user-plus"></i> Generá una Alerta</a>
            <br>
            <p class="text-faded mb-4" style="margin-top: 10px;">¿QUERÉS HACER UNA DONACIÓN?</p>
            <a class="btn btnCreative btn-light btn-xl js-scroll-trigger" href="{{url('/necesidad/list')}}" style="color: #eee !important; background-color: #0d0a0a99;"> <i class="icon fa fa-handshake-o"></i> Mirá la lista de Necesidades</a>
          
          </div>
        </div>
      </div>
    </section>

    <section id="services">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading"><span class="logo-lg"><img src="{{ asset('/img/logoch.png') }}" class="" alt="Logo Image" style="max-height: 45px;"> Red del Posadero</h2>
            <hr class="my-4">
          </div>
        </div>
      </div>
      <div class="container">
        <div class="row">
        	
        	<div class="col-lg-3 col-md-6 text-center boton mapa" >
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-map-o text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Posaderos</h3>
	              <p class="text-muted mb-0">Mirá el mapa con nuestros Centros de Asistencia. Acercate a un Posadero para obtener mas información</p>
	            </div>
	        </div>
	          
	        <div class="col-lg-3 col-md-6 text-center boton">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-users text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Comunidades</h3>
	              <p class="text-muted mb-0">Podes unirte a una Comunidad para compartir la informacion de alertas con tus amigos</p>
	            </div>
	        </div>

	        <div class="col-lg-3 col-md-6 text-center boton alertas">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-exclamation-circle text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Mis Alertas!</h3>
	              <p class="text-muted mb-0">Hace un seguimiento de las alertas que generaste, para saber si tu Asistido se presento en un Posadero</p>
	            </div>
	        </div>
	        
	        <div class="col-lg-3 col-md-6 text-center boton seguimiento">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-user text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Asistidos</h3>
	              <p class="text-muted mb-0">Una vez que la persona sobre la cual nos Alertaste se presenta en el posadero, nuestro equipo se encarga de brindale la ayuda que necesite.</p>
	            </div>
	        </div>
          
        </div>
      </div>
    </section>

    <section class="bg-dark text-white">
      <div class="container text-center">
        <h3 class="mb-4" style="color: white;">¿Querés obtener mas información?</h3>
        <a class="btn btn-light btn-xl sr-button btnCreative" style="background-color: #fefefea6;" href="http://www.lumencor.org">QUIENES SOMOS</a>
      </div>
    </section>

    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <h2 class="section-heading"> <i class="icon fa fa-users"></i>
             <?php echo count($misComunidades) > 1 ? "Tus Comunidades" : "Tu Comunidad" ?>
           </h2>
            <h4> 
            	<?php foreach ($misComunidades as $com): ?>
	        		<span class="label label-default"><?php echo $com->nombre ?></span>	
	        	<?php endforeach ?>
            </h4>
            <hr class="my-4">
            <p class="mb-5"><?php echo count($misComunidades) < 1 ? "Todavía no perteneces a ninguna Comunidad? Hacé click a continuación para solicitar unirte!" : "" ?></p>
          </div>
        </div>
        <div class="row">
        	<br>
        	<div class="col-lg-12">
        		<a href="" data-toggle="modal" data-target="#modal-sumate">
        			<div class="col-lg-12 ml-auto text-center">
        				<i class="fa fa-3x mb-3 sr-contact icon fa-plus-square"></i>
        				<p>Sumate</p>
        			</div>
        		</a>
        	</div>
        </div>

      </div>
    </section>

    <section class="bg-dark text-white">
      <div class="container text-center boton botonUca">
        <img src="{{ asset('/img/logoucawhite.png') }}" class="" alt="Logo Image" style="max-height: 30px;">
        <h4 class="mb-4" style="color: #eee;">Desarrollado por la Facultad de Ingeniería y Ciencias Agrarias de la UCA</h4>
      </div>
    </section>

    {{-- Modal para sumarte --}}
    <div class="modal fade" id="modal-sumate">
      <div class="modal-dialog">
        <div class="modal-content">
          
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="icon fa fa-user-plus"></i> Sumate </h4>
          </div>
          
          <div class="modal-body">
            
            <h5>Pedile a un Coordinador que te agregue a la Comunidad.</h5>
            <h5>Una vez que se apruebe tu solicitud vas a poder compartir tu actividad con los miembros de tu Comunidad</h5>
            <hr>

            <select class="form-control editable selectComunidad select2" name="comunidad_id" style="width: 100%;">      
              <?php $institucion = 0; ?>
              <option disabled selected value> Seleccionar ... </option>
              <?php foreach ($comunidades as $comunidad): ?>  

                <?php if ($institucion != $comunidad->institucion_id): ?>
                  <optgroup label=" - {{$comunidad->institucion->nombre}}"></optgroup>
                  <?php $institucion = $comunidad->institucion_id ?>
                <?php endif ?>

                <option value="{{$comunidad->id}}"> <?php echo $comunidad->nombre ?></option>
              
              <?php endforeach ?>
            </select>
            <p class="help-block">Selecciona una Comunidad</p>
            
            <br>
            <button class="btn btn-light sr-button btnCreative btnSolicitud" style="background-color: #e5e5e5;">Enviar Solicitud</button>  

          </div>
          
        </div>
      </div>
    </div>
	
@endsection


@section('scripts')

<script type="text/javascript">
	
	$( document ).ready(function() {
	    $('#contenido').remove();
	});	
  
  $('.boton.mapa').click(function(){
    window.open('http://www.lumencor.org/mapa.html');
  });
  
  $('.boton.alertas').click(function(){
    window.open('https://www.posaderos.xyz/alert/my_list');
  });
  
  $('.boton.seguimiento').click(function(){
    window.open('http://www.lumencor.org/#red');
  });

  $('.boton.botonUca').click(function(){
    window.open("{{url('/uca')}}");
  });

  $('.btnSolicitud').click(function(){
    
    var comunidad = $(".select2 option:selected").val();

    $('#modal-sumate').modal('hide');
    
    if (jQuery.isNumeric(comunidad)) {
      
      console.log(comunidad); 
      
      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      $.post( "{{route('comunidad.enviarSolicitud')}}", { 'comunidad_id': comunidad, '_token': '{{csrf_token()}}' })    
      .done(function(datos) {

      if (datos.status) {

        console.log(datos.msg);
        loading.modal('hide');
        lanzarAlerta('exito', datos.msg);

      } else {

        console.log(datos.msg);
        loading.modal('hide');
        lanzarAlerta('peligro', datos.msg);
      }

      });

    } else {
      lanzarAlerta('peligro', 'Seleccioná una opción válida.')
    }

  });

</script>

@endsection
