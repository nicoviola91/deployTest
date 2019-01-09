@extends('layouts.welcomeApp')

@section('title')
    UCA
@endsection

@section('head')
    <!-- Custom styles for this template -->
    <link href="{{asset('/creative/css/creative.css')}}" rel="stylesheet">

       <!-- Plugin JavaScript -->
    <script src="{{asset('/creative/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('/creative/vendor/scrollreveal/scrollreveal.min.js')}}"></script>
    <script src="{{asset('/creative/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>

    <!-- Custom scripts for this template -->
    <script src="{{asset('/creative/js/creative.js')}}"></script>
@endsection

@section('content')
    <section>
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading"><span class="logo-lg"><img src="{{ asset('/img/UCA-Logo-1.png') }}" class="" alt="Logo Image" style="max-height: 45px;"> Equipo</h2>
            <br>
            
          </div>
        </div>
      </div>

      <div class="container">
          <h2 class="section-heading text-center"><small>Autoridades</small></h2>
          <hr class="my-4">
      </div>
      
      <div class="container">
        <div class="row">
            
            <div class="col-lg-4 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/claudio.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Ing. Claudio Schicht</h3>
                  <p class="text-muted mb-0">Director de Carrera de Ingeniería Informática</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/hernan.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Ing. Hernán Mariño</h3>
                  <p class="text-muted mb-0">Secretario Académico</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/ricardo.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Ing. Ricardo Dipasquale</h3>
                  <p class="text-muted mb-0">Director de Proyecto</p>
                </div>
            </div>
        
        </div>
      </div>

      <div class="container">
          <br>
          <br>
          <h2 class="section-heading text-center"><small>Alumnos</small></h2>
          <hr class="my-4">
      </div>

      <div class="container">
            <div class="col-lg-3 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/nicolas.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Nicolás Viola</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/gabriel.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Gabriel Campagna</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <img src="{{ asset('/img/team/agustin.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Juan Agustín Gallo</h3>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <!-- <img src="{{ asset('/img/team/daniela.jpg') }}" class="img img-circle" style="max-height: 150px;">                   -->
                  <img src="{{ asset('/img/default.jpg') }}" class="img img-circle" style="max-height: 150px;">                  
                  <h3 class="mb-3">Daniela Garay</h3>
                </div>
            </div>

            <!-- javier bassi, luciano delorenzi, sofia iturrioz, nahuel perez catuogno, agustin puentes, enzo sagretti -->
      </div>

      <div class="container">
          <br>
          <br>
          <h2 class="section-heading text-center"><small>Agradecimiento especial</small></h2>
          <hr class="my-4">
          <br>
      </div>

      <div class="container">
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Javier Bassi</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Luciano Delorenzi</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Sofía Iturrioz</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Nahuel Perez Catuogno</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Agustín Puentes</h3>
                </div>
            </div>
            <div class="col-lg-2 col-md-2 text-center boton mapa" >
                <div class="service-box mt-5 mx-auto">
                  <h3 class="mb-3">Enzo Sagretti</h3>
                </div>
            </div>
      </div>

    </section>
@endsection
