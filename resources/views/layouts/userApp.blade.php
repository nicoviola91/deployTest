<!DOCTYPE html>
<html>

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Posaderos | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/css/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('/css/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/css/AdminLTE.css') }}">
  <!-- AdminLTE Skins. -->
  <link rel="stylesheet" href="{{ asset('/css/skin-red.css') }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- jQuery 3 -->
  <script src="{{ asset('/jquery/dist/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="{{ asset('/bootstrap/dist/js/bootstrap.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('/js/adminlte.min.js') }}"></script>
  <!-- Bootbox -->
  <script src="{{ asset('/bootbox/bootbox.min.js') }}"></script>

  @yield('head')

  <style type="text/css">

    .divAlertas {
      position: fixed;
      z-index: 1030;
      /*bottom: 50px;*/
      top: 25px;
    }

    .alert-advertencia {
        color: #856404;
        background-color: #fff3cd;
        border-color: #ffeeba;
    }

      .alert-exito {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
    }

    .alert-peligro {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
    }

    .alert-informacion {
        color: #0c5460;
        background-color: #d1ecf1;
        border-color: #bee5eb;
    }

    .alert2 {
      position: relative;
      z-index: 999999;
      width: 100%;
      left: 0;
      right: 0;
      margin-left: auto;
      margin-right: auto;
      padding: 8px 35px 8px 14px;
      margin-bottom:10px;
      text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      border-radius: 4px;
    }
  </style>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav" id="page-top">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">

          <!-- <a href="index2.html" class="navbar-brand"><b>POSADEROS</b></a> -->
          <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><img src="{{ asset('/img/logoch.png') }}" class="" alt="Logo Image"></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><img src="{{ asset('/img/lumencor-white.png') }}" class="" alt="Logo Image" style="max-height: 40px;"></span>
          </a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            @if(Auth::user()->tipoUsuario->descripcion=='Samaritano')
          <li><a href="{{route('asistido.list')}}"> <i class="fa fa-user fa-fw"></i> Mis Asistidos</a></li>
            @endif
            <li><a href="{{route('alerta.list')}}"> <i class="fa fa-exclamation fa-fw"></i> Mis Alertas</a></li>
            <!--<li><a href="#"> <i class="fa fa-pencil-square-o fa-fw"></i> Consultas</a></li>-->
            <li><a href="{{url('/alert/new')}}"> <i class="fa fa-user-plus fa-fw"></i> Generar Alerta</a></li>
          </ul>

          <form class="navbar-form navbar-left" role="search" autocomplete="off" method="get" action="{{ route('asistido.busqueda') }}" >
            {{ csrf_field() }}
            <div class="form-group">
              <input type="text" name="q" class="form-control" placeholder="Buscar Alertas...">
              <input type="hidden" name="tipo" class="form-control" value="asistido">
            </div>
          </form>

        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            
            <li>
              <a href="#" title="Ir a menu de Administrador"><i class="fa fa-gears"></i></a>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')
                  <img src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" class="user-image" alt="User Image">
                @else
                  <img src="{{ asset('/img/user160x160.png') }}" class="user-image" alt="User Image">
                @endif

                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                @if(null !==(Auth::user()))
                <span class="hidden-xs">{{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}}</span>
                @endif
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')
                    <img src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" class="img-circle" alt="User Image">
                  @else
                    <img src="{{ asset('/img/user160x160.png') }}" class="img-circle" alt="User Image">
                  @endif

                  <p>
                    @if(null !==(Auth::user()))
                    {{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}}
                    <small>{{ucwords(Auth::user()->tipoUsuario->descripcion)}}</small>
                    <small>Miembro desde {{Auth::user()->created_at->format('M. y')}}</small>
                    @endif
                  </p>
                </li>
                <!-- Menu Body -->

                
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{url('/user/profile')}}" class="btn btn-default btn-flat">Mi Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{route('logout')}}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Sign out</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </div>
                </li>
              </ul>
            </li>
          </ul>











        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>

  <div class="col-md-6 col-md-offset-3 divAlertas" id="notificaciones">    </div>

  <div class="content-wrapper">
    @yield('contentFullScreen')
    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        
        @yield('pageHeader')

      </section>

      <!-- Main content -->
      <section class="content" id="contenido">

          <div class="col-md-10 col-md-offset-1">
            @yield('content')
          </div>

      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
  

  <footer class="main-footer hidden-xs">
    <div class="container-fluid">

      <div class="col-md-4">
        <a href="http://www.lumencor.com.ar" target="_blank"><img src="{{ asset('/img/lumencor.png') }}" style="max-height: 30px;"></a> 
        <!-- <br><strong>El corazón es la Luz.</strong> Al servicio de los más necesitados -->
      </div>
      <div class="col-md-4">
        <p class="text-center"> 
          <a href="https://www.facebook.com/lumen.cor" target="_blank" class="text-black"><i class="fa fa-facebook-square fa-fw fa-2x"></i></a> 
          <a href="https://twitter.com/lumen_cor" target="_blank" class="text-black"><i class="fa fa-twitter-square fa-fw fa-2x"></i></a> 
          <a href="mailto:posaderos@lumencor.com.ar" target="_blank" class="text-black"><i class="fa fa-envelope-square fa-fw fa-2x"></i></a>
        </p>
      </div>
      <div class="col-md-4">
        <!-- <p class="text-right" style="margin-bottom: 0px;"><strong>El corazón es la Luz.</strong> Al servicio de los más necesitados</p> -->
        <p class="text-right" style="margin-bottom: 0px;"><img src="{{ asset('/img/UCA_logo_ch.png') }}" style="max-height: 30px;"></p>
      </div>

    </div>
    <!-- /.container -->
  </footer>


</div>
<!-- ./wrapper -->

@yield('scripts')

<script type="text/javascript">
  function lanzarAlerta (tipo, mensaje) {

        switch (tipo) {

          case 'exito':
            var icono = 'fa-check';
            var titulo = 'Información';
            break;

          case 'advertencia': 
            var icono = 'fa-warning';
            var titulo = 'Atención';
            break;

          case 'peligro':
            var icono = 'fa-ban';
            var titulo = 'Error';
            break;

          case 'informacion':
          default:
            var icono = 'fa-info-circle';
            var titulo = 'Información';
            var tipo = 'informacion';
            break;

        }

        var text = '<div class="alert alert2 alert-' + tipo + ' alert-dismissible alertaBorrable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa ' + icono + '"></i> ' + titulo + ' </h4>' + mensaje + '</div>';

        var elem = $(document.createElement('div'));

        elem.append(text);
        $('#notificaciones').append(elem);

        elem.fadeTo(14000, 100).slideUp(500, function(){
          elem.remove();
        });

      }
</script>

</body>
</html>
