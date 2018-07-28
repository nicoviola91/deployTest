@extends('layouts.adminApp')


@section('title')
	Dashboard
@endsection


@section('head')

    <script>
      function initMap() {

      	var locations = 
      	[<?php 
			$lista = "";

			foreach ($alertas as $key => $alerta) {
				if (isset($alerta->lat) && isset($alerta->lng))
					$lista .= "new google.maps.LatLng(".$alerta->lat.", ".$alerta->lng."),";
			} 

			echo trim($lista, ",");
		?>];

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 11,
          center: {lat: -34.6084035, lng: -58.3808578},
          mapTypeId: google.maps.MapTypeId.ROADMAP,
	      mapTypeControl: true,
	      fullscreenControl: true,
	      streetViewControl: false,

        });

        var heatmap = new google.maps.visualization.HeatmapLayer({
          data: locations,
          map: map
        });

        // for (var i = locations.length - 1; i >= 0; i--) {        	
        // 	marker = new google.maps.Marker({
	        	
	       //  	position: locations[i],
	       //  	map: map,
	       //  	url: 'http://www.google.com.ar'
        // 	})
        // }

      }
      
    </script>
    
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC00PZ8LBCq2QWNAo9fcAHDAMN0z5-vIt0&callback=initMap&libraries=visualization"></script>

@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-dashboard fa-fw"></i>Dashboard
	<small></small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
	<li class="active">Dashboard</li>
</ol>
@endsection

@section('content')

<div class="row">
	
    <div class="col-md-3 col-sm-6">
      	<div class="info-box bg-teal">
			<span class="info-box-icon"><i class="icon fa fa-user"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Asistidos</span>
			<span class="info-box-number"><?php echo $asistidos ?></span>

			<span class="progress-description">
			      <?php echo $asistidosNuevos ?> esta semana
			    </span>
			</div>
		</div>	
    </div>

    <div class="col-md-3 col-sm-6">
      	<div class="info-box bg-orange">
			<span class="info-box-icon"><i class="icon fa fa-comments-o"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Interacciones</span>
			<span class="info-box-number"><?php echo $consultas ?></span>

			<span class="progress-description">
			      <?php echo $consultasNuevas ?> esta semana
			    </span>
			</div>
		</div>	
    </div>

    <div class="col-md-3 col-sm-6">
      	<div class="info-box bg-blue">
			<span class="info-box-icon"><i class="icon fa fa-bank"></i></span>

			<div class="info-box-content">
			<span class="info-box-text">Instituciones</span>
			<span class="info-box-number"><?php echo $instituciones ?></span>

			<span class="progress-description">
			    <?php echo $institucionesNuevas ?> esta semana
			</span>
			</div>
		</div>	
    </div>

    <div class="col-md-3 col-sm-6">
      	<div class="info-box bg-green">
			<span class="info-box-icon"><i class="icon fa fa-user-circle"></i></span>

			<div class="info-box-content">
				<span class="info-box-text">Usuarios</span>
				<span class="info-box-number"><?php echo $usuarios ?></span>

				<span class="progress-description">
				    <?php echo $usuariosNuevos ?> esta semana
				</span>
			</div>
		</div>	
    </div>

          
</div>

<div class="row">
	
	<div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="icon fa fa-bullhorn"></i> Alertas <small class="text-muted">HEATMAP</small></h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-10 col-sm-9 col-xs-8" style="padding-right: 0px;">
                  <div class="" id="map" style="height: 600px;"></div>
                </div>
                <!-- /.col -->
                <div class="col-md-2 col-sm-3 col-xs-4" style="padding-left: 0px;">
                  <div class="pad box-pane-right bg-navy" style="min-height: 600px;">
                   	<br><br><br> 
                    <br>
                    <div class="description-block margin-bottom">
                      <div><i class="fa icon fa-bullhorn"></i></div>
                      <h5 class="description-header"><?php echo $alertasTotal ?></h5>
                      <span class="description-text">TOTALES</span>
                    </div>
                    <br>
                    <div class="description-block margin-bottom">
                      <div><i class="fa icon fa-spinner"></i></div>
                      
                      <h5 class="description-header"><?php echo $alertasPendientes ?></h5>
                      <span class="description-text">PENDIENTES</span>
                    </div>
                    <br>
                    <div class="description-block margin-bottom">
                      <div><i class="fa icon fa-user-plus"></i></div>
                      
                      <h5 class="description-header"><?php echo $alertasPresentados ?></h5>
                      <span class="description-text">PRESENTADOS</span>
                    </div>
                    <br>
                    <div class="description-block">
                      <div><i class="fa icon fa-check-circle"></i></div>
                      <h5 class="description-header"><?php echo $alertasPendientes != 0 ? $alertasPresentados/$alertasPendientes : 'N/D' ?>%</h5>
                      <span class="description-text">PRESENTISMO</span>
                    </div>
                    <br>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

</div>


	
@endsection


@section('scripts')

<script type="text/javascript">
	


</script>

@endsection
