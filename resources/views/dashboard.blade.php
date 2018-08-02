@extends('layouts.adminApp')


@section('title')
	Dashboard
@endsection


@section('head')

    <script>
      function initMap() {

        //DATOS HEATMAP
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

        //DATOS INSTITUCIONES
        var instituciones = 
        [<?php 
          $listaI = "";

          foreach ($institucionesMapa as $key => $institucion) {
            if (isset($institucion->direccion->lat) && isset($institucion->direccion->long))

              $listaI .= (" {id: '". $institucion->id ."' , lat: '". $institucion->direccion->lat . "', lng: '" . $institucion->direccion->long . "', nombre: '" . $institucion->nombre . "', tipo: '" . $institucion->tipo . "'},");
          } 

          echo trim($listaI, ",");
        ?>];

        //console.log(instituciones);
        for (var i = instituciones.length - 1; i >= 0; i--) {

          var marker = new google.maps.Marker({
            position: new google.maps.LatLng(instituciones[i].lat, instituciones[i].lng),
            map: map,
            icon: '<?php echo asset('/img/map/') ?>/'+instituciones[i].tipo+'.png',
            title: instituciones[i].nombre
          });


          google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {

              var infowindow = new google.maps.InfoWindow({
                content: '<div class="box-institucion"><div style="min-height:150px;"><br><br><img class="img-responsive" src="{{ asset("/img/loading200.gif") }}")"></div></div>'
              });

              infowindow.open(map, marker);

              $.get("{{url('institucion/box')}}/"+instituciones[i].id, function(data){

                if (data.status) {
                  
                  console.log(data.view);
                  
                  infowindow.setContent(data.view);
                  
                }
                else {
                  lanzarAlerta('peligro', "Ocurrió un error al obtener los datos.")
                }
              
              })
              



            }
          })(marker, i));
        
        }
        
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
			<span class="info-box-text">Consultas</span>
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
              <div class="box-tools pull-right">
                <input type="checkbox" id="checkInstituciones"> 
                <span class="text-muted"> Mostrar Instituciones</span>               
              </div>

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
                      <h5 class="description-header"><?php echo $alertasPendientes != 0 ? round(($alertasPresentados/$alertasTotal)*100) : 'N/D' ?>%</h5>
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
	
  function obtenerInfoInstitucion (id) {

    console.log('holaaaaaaaaaaaaaaaaaaaaaaaaa' + id);

    $.get("{{url('institucion/box')}}/"+id, function(data){

      if (data.status) {
        
        console.log(data.view);
        return data.view
        //infoWindow.setContent(data.view);
        
      }
      else {
        return false,
        lanzarAlerta('peligro', "Ocurrió un error al obtener los datos.")
      }
    
    })
  }

  function zoomIn (lat, lng) {

    console.log('lat ' + lat);
    console.log('lng ' + lng);

    var myLatlng = new google.maps.LatLng(lat, lng);
    map.setCenter(myLatlng);
    map.setZoom(17);

  }

</script>

@endsection
