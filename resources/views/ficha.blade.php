
@extends(true ? 'layouts.adminApp' : 'layouts.adminApp')

@section('title')
	Ficha
@endsection

@section('head')
  
  <!-- Bootstrap WYSIHTML5 -->
  <link rel="stylesheet" href="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('/wsyhtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <script src="{{ asset('/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

  <!-- MeetSelva -->
  <script src="{{ asset('/letterAvatar/letterAvatar.js') }}"></script>

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

    .pac-container {

      z-index: 99999;
    }
    
    .preventoverflow{
      
      white-space: normal;
      overflow: hidden;
      text-overflow: ellipsis
    }

</style>

<div class="row">
<div class="col-md-12">

      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
					 
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
              <li>
                @if(isset($asistido->sexo->descripcion))
                <a href="javascript:void(0)"><strong>Sexo: </strong> {{ $asistido->sexo->descripcion }} </a>
                @endif
              </li>
              <li><a href="javascript:void(0)"><strong>Observaciones: </strong> <br> {{ $asistido->observaciones }} </a></li>
            </ul>
          </div>
        </div>


        <ul class="nav nav-tabs no-print">
          
          <li class="liTab personal" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaDatosPersonales ? '' : 'style="display:none;"' ?>>
            <a href="#tab_personal" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Datos Personales">
              <i class="icon fa fa-id-badge fa-fw"></i> 
              <span style="display: none;"> Datos Personales</span>
            </a>
          </li>

          <li class="liTab legal" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaLegal ? '' : 'style="display:none;"' ?>>
            <a href="#tab_legal" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Legal">
              <i class="icon fa fa-legal fa-fw"></i> 
              <span style="display: none;"> Ficha Legal</span>
            </a>
          </li>
          <li class="liTab educacion" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaEducacion ? '' : 'style="display:none;"' ?>>
            <a href="#tab_educacion" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Educación">
              <i class="icon fa fa-mortar-board fa-fw"></i> 
              <span style="display: none;"> Educación</span>
            </a>
          </li>
          <li class="liTab empleo" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaEmpleo ? '' : 'style="display:none;"' ?>>
            <a href="#tab_empleo" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Empleo">
              <i class="icon fa fa-gears fa-fw"></i> 
              <span style="display: none;"> Ficha Empleo</span>
            </a>
          </li>

          <li class="liTab asistencia" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaAsistenciaSocial ? '' : 'style="display:none;"' ?>>
            <a href="#tab_asistencia" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Asistencia Social">
              <i class="icon fa fa-life-buoy fa-fw"></i> 
              <span style="display: none;"> Asistencia Social</span>
            </a>
          </li>

          <li class="liTab necesidades" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaNecesidad ? '' : 'style="display:none;"' ?>>
            <a href="#tab_necesidades" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Necesidades">
              <i class="icon fa fa-hotel fa-fw"></i> 
              <span style="display: none;"> Necesidades</span>
            </a>
          </li>

          <li class="liTab medica" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaMedica ? '' : 'style="display:none;"' ?>>
            <a href="#tab_medica" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Médica">
              <i class="icon fa fa-heartbeat fa-fw"></i> 
              <span style="display: none;"> Ficha Médica</span>
            </a>
          </li>
          <li class="liTab mental" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaSaludMental ? '' : 'style="display:none;"' ?>>
            <a href="#tab_mental" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Salud Mental">
              <i class="icon fa fa-user-md fa-fw"></i> 
              <span style="display: none;"> Salud Mental</span>
            </a>
          </li>
          <li class="liTab integral" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaDiagnosticoIntegral ? '' : 'style="display:none;"' ?>>
            <a href="#tab_integral" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Diagnóstico Integral">
              <i class="icon fa fa-stethoscope fa-fw"></i> 
              <span style="display: none;"> Diagnóstico Integral</span>
            </a>
          </li>
          <li class="liTab adicciones" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaAdicciones ? '' : 'style="display:none;"' ?>>
            <a href="#tab_adicciones" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Adicciones">
              <i class="icon fa fa-warning fa-fw"></i> 
              <span style="display: none;"> Adicciones </span>
            </a>
          </li>

          <li class="liTab familia" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaFamiliaAmigos ? '' : 'style="display:none;"' ?>>
            <a href="#tab_familia" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Familia y Amigos">
              <i class="icon fa fa-users fa-fw"></i> 
              <span style="display: none;"> Familia y Amigos</span>
            </a>
          </li>
          <li class="liTab localizacion" data-id="{{$asistido->id}}" <?php echo $asistido->checkFichaLocalizacion ? '' : 'style="display:none;"' ?>>
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
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="datosPersonales" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Datos Personales">
                      <i align="left" class="fa fa-id-badge"></i> <span class="hidden-xs">Añadir</span> Ficha de Datos Personales
                    </a>  
                  <?php endif ?>
                  
                  <?php if (!$asistido->checkFichaLegal): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="datosLegales" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Legal">
                      <i align="left" class="fa fa-legal"></i> <span class="hidden-xs">Añadir</span> Ficha de Datos Legales
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaEducacion): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="educacion" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Educación">
                      <i align="left" class="fa fa-mortar-board"></i> <span class="hidden-xs">Añadir</span> Ficha de Eduacación
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaEmpleo): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="empleo" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Empleo">
                      <i align="left" class="fa fa-gears"></i> <span class="hidden-xs">Añadir</span> Ficha de Empleo
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaAsistenciaSocial): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="asistenciaSocial" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Asistencia Social">
                      <i align="left" class="fa fa-life-buoy"></i> <span class="hidden-xs">Añadir</span> Ficha de Asistencia Social
                    </a>
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaNecesidad): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="necesidades" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Necesidades">
                      <i align="left" class="fa fa-hotel"></i> <span class="hidden-xs">Añadir</span> Ficha Necesidades
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaMedica): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="medica" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Médica">
                      <i align="left" class="fa fa-heartbeat"></i> <span class="hidden-xs">Añadir</span> Ficha Médica
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaSaludMental): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="saludMental" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Salud Mental">
                      <i align="left" class="fa fa-user-md"></i> <span class="hidden-xs">Añadir</span> Ficha de Salud Mental
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaDiagnosticoIntegral): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="diagnosticoIntegral" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Diagnóstico Integral">
                      <i align="left" class="fa fa-stethoscope"></i> <span class="hidden-xs">Añadir</span> Ficha de Diagnostico Integral
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaAdicciones): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="adicciones" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Adicciones">
                      <i align="left" class="fa fa-warning"></i> <span class="hidden-xs">Añadir</span> Ficha de Adicciones
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaFamiliaAmigos): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="familiaAmigos" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Familia y Amigos">
                      <i align="left" class="fa fa-users"></i> <span class="hidden-xs">Añadir</span> Ficha de Familia y Amigos
                    </a>  
                  <?php endif ?>

                  <?php if (!$asistido->checkFichaLocalizacion): ?>
                    <a href="#" class="btn btn-block btn-default btn-sm btnAgregarFicha" data-tipo="localizacion" data-id="{{$asistido->id}}" data-toggle="tooltip" data-title="Alta Ficha Localización">
                      <i align="left" class="fa fa-location-arrow"></i> <span class="hidden-xs">Añadir</span> Ficha de Localización
                    </a>  
                  <?php endif ?>
                </div>

              </div>
            </div>
            
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="tab_personal">
            <div class="divDatos" id="datosPersonal"></div>
            <div class="divConsultas" id="consultasPersonal"></div>
          </div>

          <div class="tab-pane" id="tab_legal">
            <div class="divDatos" id="datosLegal"></div>
            <div class="divConsultas" id="consultasLegal"></div>
          </div>

          <div class="tab-pane" id="tab_educacion">
            <div class="divDatos" id="datosEducacion"></div>
            <div class="divConsultas" id="consultasEducacion"></div>
          </div>

          <div class="tab-pane" id="tab_empleo">
            <div class="divDatos" id="datosEmpleo"></div>
            <div class="divConsultas" id="consultasEmpleo"></div>
          </div>

          <div class="tab-pane" id="tab_asistencia">
            <div class="divDatos" id="datosAsistencia"></div>
            <div class="divConsultas" id="consultasAsistencia"></div>
          </div>

          <div class="tab-pane" id="tab_necesidades">
            <div class="divDatos" id="datosNecesidades"></div>
            <div class="divConsultas" id="consultasNecesidades"></div>
          </div>

          <div class="tab-pane" id="tab_medica">
            <div class="divDatos" id="datosMedica"></div>
            <div class="divConsultas" id="consultasMedica"></div>
          </div>

          <div class="tab-pane" id="tab_mental">
            <div class="divDatos" id="datosMental"></div>
            <div class="divConsultas" id="consultasMental"></div>
          </div>

          <div class="tab-pane" id="tab_integral">
            <div class="divDatos" id="datosIntegral"></div>
            <div class="divConsultas" id="consultasIntegral"></div>
          </div>

          <div class="tab-pane" id="tab_adicciones">
            <div class="divDatos" id="datosAdicciones"></div>
            <div class="divConsultas" id="consultasAdicciones"></div>
          </div>

          <div class="tab-pane" id="tab_familia">
            <div class="divDatos" id="datosFamilia"></div>
            <div class="divConsultas" id="consultasFamilia"></div>
          </div>

          <div class="tab-pane" id="tab_localizacion">
            <div class="divDatos" id="datosLocalizacion"></div>
            <div class="divConsultas" id="consultasLocalizacion"></div>
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
      $('.divDatos').html('');  
      $('.divConsultas').html('');

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

    $(".btnAgregarFicha").click(function () {

      var id = $(this).data('id');
      var tipo = $(this).data('tipo');

      switch(tipo) {

        case 'datosPersonales':
            $(".liTab.personal").show();
            $(".liTab.personal a[href='#tab_personal']").trigger("click");
            break;
        
        case 'empleo':
            $(".liTab.empleo").show();
            $(".liTab.empleo a[href='#tab_empleo']").trigger("click");
            break;

        case 'datosLegales':
            $(".liTab.legal").show();
            $(".liTab.legal a[href='#tab_legal']").trigger("click");
            break;

        case 'educacion':
            $(".liTab.educacion").show();
            $(".liTab.educacion a[href='#tab_educacion']").trigger("click");
            break;

        case 'asistenciaSocial':
            $(".liTab.asistencia").show();
            $(".liTab.asistencia a[href='#tab_asistencia']").trigger("click");
            break;

        case 'necesidades':
            $(".liTab.necesidades").show();
            $(".liTab.necesidades a[href='#tab_necesidades']").trigger("click");
            break;

        case 'medica':
            $(".liTab.medica").show();
            $(".liTab.medica a[href='#tab_medica']").trigger("click");
            break;

        case 'saludMental':
            $(".liTab.mental").show();
            $(".liTab.mental a[href='#tab_mental']").trigger("click");
            break;

        case 'diagnosticoIntegral':
            $(".liTab.integral").show();
            $(".liTab.integral a[href='#tab_integral']").trigger("click");
            break;

        case 'adicciones':
            $(".liTab.adicciones").show();
            $(".liTab.adicciones a[href='#tab_adicciones']").trigger("click");
            break;

        case 'familiaAmigos':
            $(".liTab.familia").show();
            $(".liTab.familia a[href='#tab_familia']").trigger("click");
            break;

        case 'localizacion':
            $(".liTab.localizacion").show();
            $(".liTab.localizacion a[href='#tab_localizacion']").trigger("click");
            break;

        default:
            console.log('Tipo no valido.');
      } 

      $(this).hide();   

    });

</script>


<script type="text/javascript">
  
  $('.liTab.adicciones').click(function () {

    var id = $(this).data('id');
    obtenerFichaAdicciones(id);

  });

  $('.liTab.educacion').click(function () {

    var id = $(this).data('id');
    obtenerFichaEducacion(id);

  });

  $('.liTab.personal').click(function () {

    var id = $(this).data('id');
    obtenerFichaDatosPersonales(id);

  });

  $('.liTab.legal').click(function () {

    var id = $(this).data('id');
    obtenerFichaLegal(id);
 
  });

  $('.liTab.empleo').click(function () {

    var id = $(this).data('id');
    obtenerFichaEmpleo(id);
 
  });

  $('.liTab.asistencia').click(function () {

    var id = $(this).data('id');
    obtenerFichaAsistenciaSocial(id);
 
  });

  $('.liTab.necesidades').click(function () {

    var id = $(this).data('id');
    obtenerFichaNecesidades(id);
 
  });

  $('.liTab.medica').click(function () {

    var id = $(this).data('id');
    obtenerFichaMedica(id);
 
  });


</script>


<script type="text/javascript">
  
  //SCRIPTS PARA OBTENER FICHAS
  function obtenerFichaDatosPersonales (id) {

    if ($('#datosPersonal').html() == '' || $('#consultasPersonal').html() == '') {

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
  }

  function obtenerFichaEducacion (id) {

    if ($('#datosEducacion').html() == '' || $('#consultasEducacion').html() == '') {

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
  }

  function obtenerFichaLegal (id) {

    if ($('#datosLegal').html() == '' || $('#consultasLegal').html() == '') {

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
  }

  function obtenerFichaAdicciones (id) {

    if ($('#datosAdicciones').html() == '' || $('#consultasAdicciones').html() == '') {

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
  }

  function obtenerFichaEmpleo (id) {

    if ($('#datosEmpleo').html() == '' || $('#consultasEmpleo').html() == '') {

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaEmpleo.get',['asistido_id'=>$asistido->id])}}");

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasEmpleos'])}}");

      $.when(ficha, consultas).done(function () {

        if (ficha.responseJSON.status) {
          $('#datosEmpleo').html(ficha.responseJSON.view);
        }
        if (consultas.responseJSON.status) {
          $('#consultasEmpleo').html(consultas.responseJSON.view);
        }

        loading.modal('hide');
      });

    }
  }

  function obtenerFichaAsistenciaSocial (id) {

    if ($('#datosAsistencia').html() == '' || $('#consultasAsistencia').html() == '') {

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaAsistenciaSocial.get',['asistido_id'=>$asistido->id])}}");

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasAsistenciasSociales'])}}");

      $.when(ficha, consultas).done(function () {

        if (ficha.responseJSON.status) {
          $('#datosAsistencia').html(ficha.responseJSON.view);
        }
        if (consultas.responseJSON.status) {
          $('#consultasAsistencia').html(consultas.responseJSON.view);
        }

        loading.modal('hide');
      });

    }
  }

  function obtenerFichaNecesidades (id) {

    if ($('#datosNecesidades').html() == '' || $('#consultasNecesidades').html() == '') {

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaNecesidades.get',['asistido_id'=>$asistido->id])}}");

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasNecesidades'])}}");

      $.when(ficha, consultas).done(function () {

        if (ficha.responseJSON.status) {
          $('#datosNecesidades').html(ficha.responseJSON.view);
        }
        if (consultas.responseJSON.status) {
          $('#consultasNecesidades').html(consultas.responseJSON.view);
        }

        loading.modal('hide');
      });

    }
  }

  function obtenerFichaMedica (id) {

    if ($('#datosMedica').html() == '' || $('#consultasMedica').html() == '') {

      var loading = bootbox.dialog({
        message: '<p class="text-center"><i class="icon fa fa-spinner fa-spin"></i> Loading ...</p>',
        closeButton: false
      });

      //OBTENER DATOS DE LA FICHA
      var ficha = $.get("{{route('fichaMedica.get',['asistido_id'=>$asistido->id])}}");

      //OBTENER CONSULTAS DE LA FICHA
      var consultas = $.get("{{route('consultas.getView',['id'=>$asistido->id, 'type'=>'fichasMedicas'])}}");

      $.when(ficha, consultas).done(function () {

        if (ficha.responseJSON.status) {
          $('#datosMedica').html(ficha.responseJSON.view);
        }
        if (consultas.responseJSON.status) {
          $('#consultasMedica').html(consultas.responseJSON.view);
        }

        loading.modal('hide');
      });

    }
  }

</script>

@endsection
