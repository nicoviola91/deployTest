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

<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="javascript:void(0)" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="{{ asset('/img/logoch.png') }}" class="" alt="Logo Image"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="{{ asset('/img/lumencor-white.png') }}" class="" alt="Logo Image" style="max-height: 40px;"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      @if(null !==(Auth::user()))
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      @endif

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          <!-- User Account: style can be found in dropdown.less -->
          @if(null !==(Auth::user()))
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')
                <img src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" class="user-image" alt="User Image">
              @else
                <img src="{{ asset('/img/user160x160.png') }}" class="user-image" alt="User Image">
              @endif

              <span class="hidden-xs">{{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}}</span>
            
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')
                  <img src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" class="img-circle" alt="User Image">
                @else
                  <img src="{{ asset('/img/user160x160.png') }}" class="img-circle" alt="User Image">
                @endif
                <p>
                  
                  {{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}} 
                  <small>{{Auth::user()->tipoUsuario->nombre}}</small>
                  <small>Miembro desde {{Auth::user()->created_at->format('M. y')}}</small>
                  
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{url('/user/my_profile')}}" class="btn btn-default btn-flat">Mi Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="{{route('logout')}}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">Cerrar Sesión</a>
                    <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                </div>
              </li>
              
            </ul>
          </li>
          @endif
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  @if(null !==(Auth::user()))
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      
      <div class="user-panel">
        <div class="pull-left image">
          @if(isset(Auth::user()->imagen) && Auth::user()->imagen != '' && Auth::user()->imagen != 'default.jpg')
            <img src="<?php echo asset("storage") . '/' . Auth::user()->imagen ?>" class="img-circle" alt="User Image">
          @else
            <img src="{{ asset('/img/user160x160.png') }}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
            @if(null !==(Auth::user()))
          <p>{{ucwords(Auth::user()->name)}} {{ucwords(Auth::user()->apellido)}}</p>
          @endif
          <a href="#"><i class="fa fa-circle text-success"></i> {{Auth::user()->tipoUsuario->nombre}}</a>
        </div>
      </div>
      <!-- search form -->
      @if(Auth::user()->tipoUsuario->slug!=='buenVecino')
      <form class="sidebar-form" autocomplete="off" method="get" action="{{ route('asistido.busqueda') }}" >
        {{ csrf_field() }}
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar Asistido...">
          <input type="hidden" name="tipo" class="form-control" value="asistido">
          <span class="input-group-btn">
            <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
        </div>
      </form>
      @endif
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        @switch(Auth::user()->tipoUsuario->slug)
         
          @case('administrador')
              @include('menu.administrador');
              @break

          @case('posadero')
              @include('menu.posadero');
              @break

          @case('coordinador')
              @include('menu.coordinador');
              @break

          @case('profesional')
              @include('menu.profesional');
              @break

          @default
              @include('menu.samaritano');
              @break
        @endswitch
      
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  @endif


  <div class="col-md-6 col-md-offset-3 divAlertas" id="notificaciones">    </div>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('pageHeader')
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer hidden-xs">
    <div class="container-fluid">

      <div class="col-md-4">
        <a href="http://www.lumencor.org" target="_blank"><img src="{{ asset('/img/lumencor.png') }}" style="max-height: 30px;"></a>
      </div>
      <div class="col-md-4">
        <p class="text-center"> 
          <a href="https://www.facebook.com/lumen.cor" target="_blank" class="text-black"><i class="fa fa-facebook-square fa-fw fa-2x"></i></a> 
          <a href="https://twitter.com/lumen_cor" target="_blank" class="text-black"><i class="fa fa-twitter-square fa-fw fa-2x"></i></a> 
          <a href="mailto:posaderos@lumencor.org" target="_blank" class="text-black"><i class="fa fa-envelope-square fa-fw fa-2x"></i></a>
        </p>
      </div>
      <div class="col-md-4">
        <!-- <p class="text-right"><strong>El corazón es la Luz.</strong> Al servicio de los más necesitados</p> -->
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
