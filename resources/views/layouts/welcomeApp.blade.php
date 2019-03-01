<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="Description" content="Green Armor Sistema de Gestion">
  
  <title> Posaderos | @yield('title')</title>
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

  <!-- PWA -->
  <link rel="apple-touch-icon" sizes="120x120" href="/a/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="/a/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="/a/favicon-16x16.png">
  <link rel="manifest" href="/site.webmanifest">
  <link rel="mask-icon" href="/a/safari-pinned-tab.svg" color="#000000">
  <meta name="msapplication-TileColor" content="#000000">
  <meta name="theme-color" content="#000000">

  <meta name="apple-mobile-web-app-capable" content="yes" />
  <link href="/a/iphone5_splash.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/iphone6_splash.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/iphoneplus_splash.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
  <link href="/a/iphonex_splash.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
  <link href="/a/iphonexr_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/iphonexsmax_splash.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
  <link href="/a/ipad_splash.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/ipadpro1_splash.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/ipadpro3_splash.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
  <link href="/a/ipadpro2_splash.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

  @yield('head')

  	<!-- PWA -->
	<script src="/upup.min.js"></script>
	<script>
	  UpUp.start({
	    'content-url': '/offline.html',
	    'assets': ['/bg-contacto.jpg', '/offline.png']
	  });
	</script>

</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-red layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">

          <!-- <a href="index2.html" class="navbar-brand"><b>POSADEROS</b></a> -->
          <a href="http://www.lumencor.org" target="_blank" class="logo">
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
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse">
          <ul class="nav navbar-nav">

            <?php if (Auth::check()) { ?>
            
              <li><a href="{{url('/home')}}">&nbsp;&nbsp;&nbsp;<i class="icon fa fa-home"></i> &nbsp;Inicio&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
            
            <?php } else { ?>
            
              <li><a href="{{url('/login')}}">&nbsp;&nbsp;&nbsp;&nbsp;Ingresar&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
              <li><a href="{{url('/register')}}">Registrarme</a></li>
            
            <?php } ?>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    @yield('contentFullScreen')

    <div class="container-fluid">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        @yield('pageHeader')
      </section>

      <!-- Main content -->
      <section class="content">

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
        <p class="text-right" style="margin-bottom: 0px;"><a href="{{url('/uca')}}" target="_blank"><img src="{{ asset('/img/UCA_logo_ch.png') }}" style="max-height: 30px;"></a></p>
      </div>

    </div>
    <!-- /.container -->
  </footer>
</div>
<!-- ./wrapper -->

@yield('scripts')

</body>
</html>
