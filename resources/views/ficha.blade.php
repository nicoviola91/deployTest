
@extends(true ? 'layouts.adminApp' : 'layouts.adminApp')

@section('title')
	Ficha
@endsection

@section('head')
  
  <!-- Bootstrap WYSIHTML5 -->
  <link rel="stylesheet" href="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

@endsection

@section('pageHeader')
<h1>
	<i class="icon fa fa-address-card fa-fw"></i> Detalle de Asistido
	<small> {{ ucwords($asistido->nombre) }} {{ ucwords($asistido->apellido) }} </small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Asistidos</a></li>
	<li class="active"># {{ ucwords($asistido->id) }}</li>
</ol>
@endsection

@section('content')

<style type="text/css">
  
    a:hover + span {
      display: block;
    }

    .liTab {

      min-width: 80px !important;
      text-align: center !important;
    }

    .tab-pane {

      min-height: 300px !important;
    }

</style>

<div class="row">
<div class="col-md-12">
					 
      <div class="nav-tabs-custom">
        

        <div class="box box-widget widget-user-2" style="margin-bottom: 5px;">
          <!-- Add the bg color to the header using any of the bg-* classes -->
          <div class="widget-user-header bg-primary">
            <div class="widget-user-image">

              @if(isset($asistido->foto) && $asistido->foto != '' && $asistido->foto != 'default.jpg')

                <img class="img-circle" src="{{asset('img/user160x160.png')}}" alt="Default">

              @else

                <img class="img-circle" src="{{asset('img/user160x160.png')}}" alt="User Image">

              @endif
              
            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">{{ ucwords($asistido->nombre) }} {{ ucwords($asistido->apellido) }} <span class="pull-right"><small style="color: white !important;"> Creado {{ $asistido->created_at->format('M y') }}</small></span></h3>
            <h5 class="widget-user-desc">DNI {{ $asistido->dni }}</h5>
          </div>
          <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
              <li><a href="javascript:void(0)"><strong>Fecha de Nacimiento: </strong> {{ (new DateTime($asistido->fechaNacimiento))->format('d/m/Y') }} ({{ ((new DateTime($asistido->fechaNacimiento))->diff((new DateTime())))->format('%Y años') }})</a></li>
              <li><a href="javascript:void(0)"><strong>Dirección: </strong> {{ $asistido->direccion }} </a></li>
              <li><a href="javascript:void(0)"><strong>Sexo: </strong> {{ $asistido->sexo->descripcion }} </a></li>
              <li><a href="javascript:void(0)"><strong>Observaciones: </strong> <br> {{ $asistido->observaciones }} </a></li>
            </ul>
          </div>
        </div>


        <ul class="nav nav-tabs no-print">
          
          <li class="liTab personal" data-id="{{$asistido->id}}">
            <a href="#tab_personal" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Datos Personales">
              <i class="icon fa fa-id-badge fa-fw"></i> 
              <span style="display: none;"> Datos Personales</span>
            </a>
          </li>

          <li class="liTab legal" data-id="{{$asistido->id}}">
            <a href="#tab_legal" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Legal">
              <i class="icon fa fa-legal fa-fw"></i> 
              <span style="display: none;"> Ficha Legal</span>
            </a>
          </li>
          <li class="liTab educacion" data-id="{{$asistido->id}}">
            <a href="#tab_educacion" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Educación">
              <i class="icon fa fa-mortar-board fa-fw"></i> 
              <span style="display: none;"> Educación</span>
            </a>
          </li>
          <li class="liTab empleo" data-id="{{$asistido->id}}">
            <a href="#tab_empleo" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Empleo">
              <i class="icon fa fa-gears fa-fw"></i> 
              <span style="display: none;"> Ficha Empleo</span>
            </a>
          </li>

          <li class="liTab asistencia" data-id="{{$asistido->id}}">
            <a href="#tab_asistencia" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Asistencia Social">
              <i class="icon fa fa-life-buoy fa-fw"></i> 
              <span style="display: none;"> Asistencia Social</span>
            </a>
          </li>

          <li class="liTab necesidades" data-id="{{$asistido->id}}">
            <a href="#tab_necesidades" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Necesidades">
              <i class="icon fa fa-hotel fa-fw"></i> 
              <span style="display: none;"> Necesidades</span>
            </a>
          </li>

          <li class="liTab medica" data-id="{{$asistido->id}}">
            <a href="#tab_medica" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Médica">
              <i class="icon fa fa-heartbeat fa-fw"></i> 
              <span style="display: none;"> Ficha Médica</span>
            </a>
          </li>
          <li class="liTab mental" data-id="{{$asistido->id}}">
            <a href="#tab_mental" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Salud Mental">
              <i class="icon fa fa-user-md fa-fw"></i> 
              <span style="display: none;"> Salud Mental</span>
            </a>
          </li>
          <li class="liTab integral" data-id="{{$asistido->id}}">
            <a href="#tab_integral" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Diagnóstico Integral">
              <i class="icon fa fa-stethoscope fa-fw"></i> 
              <span style="display: none;"> Diagnóstico Integral</span>
            </a>
          </li>
          <li class="liTab adicciones" data-id="{{$asistido->id}}">
            <a href="#tab_adicciones" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Adicciones">
              <i class="icon fa fa-warning fa-fw"></i> 
              <span style="display: none;"> Adicciones </span>
            </a>
          </li>

          <li class="liTab familia" data-id="{{$asistido->id}}">
            <a href="#tab_familia" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Familia y Amigos">
              <i class="icon fa fa-users fa-fw"></i> 
              <span style="display: none;"> Familia y Amigos</span>
            </a>
          </li>
          <li class="liTab localizacion" data-id="{{$asistido->id}}">
            <a href="#tab_localizacion" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Localización">
              <i class="icon fa fa-location-arrow fa-fw"></i> 
              <span style="display: none;"> Localización</span>
            </a>
          </li>

          <li class="liTab nueva">
            <a href="#tab_nueva" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Agregar Ficha">
              <i class="icon fa fa-plus-square fa-fw"></i> 
              <span style="display: none;"> Agregar Ficha</span>
            </a>
          </li>

        </ul>

        

        <div class="tab-content" style="min-height: 400px;">
          

          <div class="tab-pane" id="tab_nueva">
            <!-- DATOS DE LA FICHA -->
            <div class="box box-solid" id="boxFicha">
              <div class="box-body">
                <h3 class="box-title">
                  <i class="icon fa fa-plus-square fa-fw"></i> Agregar Ficha
                </h3>

                <div class="col-md-4 col-md-offset-4" >

                  <h4>Fichas Disponibles</h4>

                  <?php if (!$asistido->checkFichaDatosPersonales): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-id-badge"></i> <span class="hidden-xs">Añadir</span> Ficha de Datos Personales
                    </a>  
                  <?php endif ?>
                  
                  <?php if (!$asistido->checkFichaDatosPersonales): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-legal"></i> <span class="hidden-xs">Añadir</span> Ficha de Datos Legales
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaDatosPersonales): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-mortar-board"></i> <span class="hidden-xs">Añadir</span> Ficha de Eduacaion
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaAdicciones): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-gears"></i> <span class="hidden-xs">Añadir</span> Ficha de Empleo
                    </a>
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaAsistenciaSocial): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-life-buoy"></i> <span class="hidden-xs">Añadir</span> Ficha de Asistencia Social
                    </a>
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaDatosPersonales): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-hotel"></i> <span class="hidden-xs">Añadir</span> Ficha Necesidades
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaMedica): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-heartbeat"></i> <span class="hidden-xs">Añadir</span> Ficha Medica
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaSaludMental): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-user-md"></i> <span class="hidden-xs">Añadir</span> Ficha de Salud Mental
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaDiagnosticoIntegral): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-stethoscope"></i> <span class="hidden-xs">Añadir</span> Ficha de Diagnostico Integral
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaAdicciones): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-warning"></i> <span class="hidden-xs">Añadir</span> Ficha de Adicciones
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaFamilia): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-users"></i> <span class="hidden-xs">Añadir</span> Ficha de Familia y Amigos
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaLocalizacion): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-location-arrow"></i> <span class="hidden-xs">Añadir</span> Ficha de Localizacion
                    </a>  
                  <?php endif ?>
                </div>

              </div>
            </div>
            
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="tab_personal">
            <div id="datosPersonal"></div>
            <div id="consultasPersonal"></div>
          </div>

          <div class="tab-pane" id="tab_legal">
            <div id="datosLegal"></div>
            <div id="consultasLegal"></div>
          </div>

          <div class="tab-pane" id="tab_educacion">
            <div id="datosEducacion"></div>
            <div id="consultasEducacion"></div>
          </div>

          <div class="tab-pane" id="tab_empleo">
            <div id="datosEmpleo"></div>
            <div id="consultasEmpleo"></div>
          </div>

          <div class="tab-pane" id="tab_asistencia">
            <div id="datosAsistencia"></div>
            <div id="consultasAsistencia"></div>
          </div>

          <div class="tab-pane" id="tab_necesidades">
            <div id="datosNecesidades"></div>
            <div id="consultasNecesidades"></div>
          </div>

          <div class="tab-pane" id="tab_medica">
            <div id="datosMedica"></div>
            <div id="consultasMedica"></div>
          </div>

          <div class="tab-pane" id="tab_mental">
            <div id="datosMental"></div>
            <div id="consultasMental"></div>
          </div>

          <div class="tab-pane" id="tab_integral">
            <div id="datosIntegral"></div>
            <div id="consultasIntegral"></div>
          </div>

          <div class="tab-pane" id="tab_adicciones">
            <div id="datosAdicciones"></div>
            <div id="consultasAdicciones"></div>
          </div>

          <div class="tab-pane" id="tab_familia">
            <div id="datosFamilia"></div>
            <div id="consultasFamilia"></div>
          </div>

          <div class="tab-pane" id="tab_localizacion">
            <div id="datosLocalizacion"></div>
            <div id="consultasLocalizacion"></div>
          </div>

        </div> <!-- END TAB CONTENT -->


      </div>
	

</div>
</div>

	
@endsection


@section('scripts')


<script type="text/javascript">

    $(".liTab").click(function () {

      $(this).siblings().find('span').hide();

    });

    $( ".liTab" ).hover(
      
      function() {

          if (!$(this).hasClass('active'))

            $(this).find('span').show();
      
      }, function() {
      
          if (!$(this).hasClass('active'))
            $(this).find('span').hide();
        
      }

    );

</script>


<script type="text/javascript">
  
  $('.liTab.adicciones').click(function () {

    if ($('#datosAdicciones').html() == '' || $('#consultasAdicciones').html() == '') {

      var id = $(this).data('id');

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaAdicciones.get',['asistido_id'=>$asistido->id])}}", function(data){

        if (data.status) {

          $('#datosAdicciones').html(data.view);
        } 

      });

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasAdicciones'])}}", function(data){

        if (data.status) {

          $('#consultasAdicciones').html(data.view);
        }

      });

      $.when(ficha, consultas).done(function () {

        loading.modal('hide');
      });

    }

  });

  $('.liTab.educacion').click(function () {

    if ($('#datosEducacion').html() == '' || $('#consultasEducacion').html() == '') {

      var id = $(this).data('id');

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaEducacion.get',['asistido_id'=>$asistido->id])}}", function(data){

        if (data.status) {

          $('#datosEducacion').html(data.view);
        } 

      });

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasEducaciones'])}}", function(data){

        if (data.status) {

          $('#consultasEducacion').html(data.view);
        }

      });

      $.when(ficha, consultas).done(function () {

        loading.modal('hide');
      });

    }

  });

  $('.liTab.personal').click(function () {

    if ($('#datosPersonal').html() == '' || $('#consultasPersonal').html() == '') {

      var id = $(this).data('id');

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaDatosPersonales.get',['asistido_id'=>$asistido->id])}}", function(data){

        if (data.status) {

          $('#datosPersonal').html(data.view);
        } 

      });

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasDatosPersonales'])}}", function(data){

        if (data.status) {

          $('#consultasPersonal').html(data.view);
        }

      });

      $.when(ficha, consultas).done(function () {

        loading.modal('hide');
      });

    }

  });

    $('.liTab.legal').click(function () {

    if ($('#datosLegal').html() == '' || $('#consultasLegal').html() == '') {

      var id = $(this).data('id');

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaLegal.get',['asistido_id'=>$asistido->id])}}", function(data){

        if (data.status) {

          $('#datosLegal').html(data.view);
        } 

      });

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasLegales'])}}", function(data){

        if (data.status) {

          $('#consultasLegal').html(data.view);
        }

      });

      $.when(ficha, consultas).done(function () {

        loading.modal('hide');
      });

    }

  });

  // $('.liTab.legal').click(function () {

  //   if ($('#datosLegal').html() == '') {

  //     var id = $(this).data('id');

  //     var loading = bootbox.dialog({
  //       message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
  //       closeButton: false
  //     });

  //     $.get("{{route('fichaLegal.get',['asistido_id'=>$asistido->id])}}", function(data){

  //       console.log(data);
  //       if (data.status) {

  //         $('#datosLegal').html(data.view);
  //         loading.modal('hide');
  //       }

  //     })
  //   }

  // });


</script>

<script>
  $(function () {

    //bootstrap WYSIHTML5 - text editor
    $('.textareaEditor').wysihtml5({
      toolbar: {
        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
        "emphasis": true, //Italics, bold, etc. Default true
        "lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
        "html": true, //Button which allows you to edit the generated HTML. Default false
        "link": false, //Button to insert a link. Default true
        "image": false, //Button to insert an image. Default true,
        "color": false, //Button to change color of font  
        "blockquote": false, //Blockquote  
        "size": 'sm', //default: none, other options are xs, sm, lg
      }
    });
  });
</script>

@endsection
