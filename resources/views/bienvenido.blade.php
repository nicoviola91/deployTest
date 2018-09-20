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


    <style type="text/css">
    	
    	.btnCreative {
    		font-weight: 700;
		    text-transform: uppercase;
		    border: none;
		    border-radius: 300px;
		    font-family: 'Open Sans','Helvetica Neue',Arial,sans-serif;
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
        	
        	<div class="col-lg-3 col-md-6 text-center">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-map-o text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Posaderos</h3>
	              <p class="text-muted mb-0">Mirá el mapa con nuestros Centros de Asistencia. Acercate a un Posadero para obtener mas información</p>
	            </div>
	        </div>
	          
	        <div class="col-lg-3 col-md-6 text-center">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-users text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Comunidades</h3>
	              <p class="text-muted mb-0">Podes unirte a una Comunidad para compartir la informacion de alertas con tus amigos</p>
	            </div>
	        </div>

	        <div class="col-lg-3 col-md-6 text-center">
	            <div class="service-box mt-5 mx-auto">
	              <i class="fa fa-4x fa-exclamation-circle text-primary mb-3 sr-icons"></i>
	              <h3 class="mb-3">Mis Alertas!</h3>
	              <p class="text-muted mb-0">Hace un seguimiento de las alertas que generaste, para saber si tu Asistido se presento en un Posadero</p>
	            </div>
	        </div>
	        
	        <div class="col-lg-3 col-md-6 text-center">
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
            <h2 class="section-heading"> <i class="icon fa fa-users"></i> Tu Comunidad</h2>
            <h4> 
            	<?php foreach ($misComunidades as $com): ?>
	        		<span class="label label-default"><?php echo $com->nombre ?></span>	
	        	<?php endforeach ?>
            	<!-- <span class="label label-default">Noche de Caridad Blablabla</span> 
            	<span class="label label-default">Noche de Caridad Santa Maria</span> 
            	<span class="label label-default">Noche de Caridad Victorias</span> -->
            </h4>
            <hr class="my-4">
            <p class="mb-5">Todavía no perteneces a ninguna Comunidad? Hacé click a continuación para solicitar unirte!</p>
          </div>
        </div>
        <div class="row">
        	<br>
        	<div class="col-lg-12">
        		<a href="javascript:void(0)" id="btnSumate" data-toggle="modal" data-target="#modal-sumate">
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
      <div class="container text-center">
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
            <h4 class="modal-title"><i class="icon fa fa-exclamation-triangle"></i> Sumate </h4>
          </div>
          <div class="callout callout-success" style="background-color: #9da6a2 !important; border-color: #7f7f7f !important; margin-bottom: 10px; padding: 5px 20px 5px 20px !important;">
            <h5>Pedile al coordinador de tu Noche de Caridad que te agregue a la Comunidad</h5>
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

</script>

@endsection
