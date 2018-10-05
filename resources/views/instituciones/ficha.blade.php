
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
	<i class="icon fa fa-bank fa-fw"></i> Detalle de Institución
	<small> {{ ucwords($institucion->nombre) }} </small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Instituciones</a></li>
	<li class="active"># {{ ucwords($institucion->id) }}</li>
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

    img.perfil:hover {

      background-color:#000;
      opacity:0.6;
      cursor: pointer;
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

              




              @if(isset($institucion->imagen) && $institucion->imagen != '' && $institucion->imagen != 'default.jpg')

                <img class="img-circle perfil" src="<?php echo asset("storage/$institucion->imagen")?>" alt="User Image" data-toggle="tooltip" title="Editar Imagen de Perfil">

              @else

                <img class="img-circle perfil" src="{{asset('img/institucion160x160.png')}}" alt="Default">

              @endif
        


            </div>
            <!-- /.widget-user-image -->
            <h3 class="widget-user-username">
              {{ ucwords($institucion->nombre) }} {{ ucwords($institucion->apellido) }} 
              <span class="pull-right">
                <small style="color: white !important;"> Creado {{ $institucion->created_at->format('M y') }}</small>
              </span>
            </h3>
            <h5 class="widget-user-desc">{{ strtoupper($institucion->tipo) }}</h5>
          </div>
          
          <div class="box-body">

            <h4>
              <i class="fa icon fa-users fa-fw"></i> Comunidades
              <span class="pull-right"><small class="text-muted">({{ $institucion->comunidades()->count() }})</small></span>           
            </h4>
            <p style="margin-top: 5px; margin-bottom: 30px;">
              <?php foreach ($institucion->comunidades as $comunidad): ?>
                <span class="label label-default">{{$comunidad->nombre}}</span>  
              <?php endforeach ?>   
            </p>
            
            <h4>
              <i class="fa icon fa-folder-open-o fa-fw"></i> Datos Básicos
              <span class="pull-right"><small class="text-muted">Actualizado {{ $institucion->updated_at->diffForHumans() }}</small></span>              
            </h4>
            <form id="nuevaInstitucion-form" method="POST" action="{{ url('/institucion/update') }}">
      
            {{ csrf_field() }}
              
              <div class="box-body">
                    <div class="form-group col-md-6 {{ $errors->has('nombre') ? ' has-error' : '' }}">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control" id="name" placeholder="Nombre" name="nombre" required value="{{$institucion->nombre}}">
                      <input type="hidden" class="form-control" id="id" placeholder="Nombre" name="id" required value="{{$institucion->id}}">
                      @if ($errors->has('nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre') }}</strong>
                        </span>
                      @endif
                    </div>
                    
                    <div class="form-group col-md-6 {{ $errors->has('cuit') ? ' has-error' : '' }}">
                      <label for="cuit">CUIT</label>
                      <input type="text" class="form-control" id="cuit" placeholder="CUIT" name="cuit" value="{{$institucion->cuit}}">
                      @if ($errors->has('cuit'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cuit') }}</strong>
                        </span>
                      @endif
                    </div>
        
                    <div class="form-group col-md-6 {{ $errors->has('telefono') ? ' has-error' : '' }}">
                      <label for="telefono">Telefono</label>
                      <input type="text" class="form-control" id="telefono" placeholder="Teléfono" name="telefono" value="{{$institucion->telefono}}">
                      @if ($errors->has('telefono'))
                        <span class="help-block">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                      @endif
                    </div>
        
                    <div class="form-group col-md-6 {{ $errors->has('responsable') ? ' has-error' : '' }}">
                      <label for="responsable">Responsable</label>
                      <input type="text" class="form-control" id="responsable" placeholder="Responsable" name="responsable" value="{{$institucion->responsable}}">
                      @if ($errors->has('responsable'))
                        <span class="help-block">
                            <strong>{{ $errors->first('responsable') }}</strong>
                        </span>
                      @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('tipo') ? ' has-error' : '' }}">
                      <label for="tipo">Tipo</label>
                      <select class="form-control" id="tipo" name="tipo">
                        <option value="iglesia" <?php echo $institucion->tipo == "iglesia" ? ' selected ' : '' ?>>Iglesia</option>
                        <option value="posadero" <?php echo $institucion->tipo == "posadero" ? ' selected ' : '' ?>>Posadero</option>
                        <option value="externa" <?php echo $institucion->tipo == "externa" ? ' selected ' : '' ?>>Institución Externa</option>
                      </select>
                      @if ($errors->has('tipo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('responsable') }}</strong>
                        </span>
                      @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                      <label for="descripcion">Horarios de Atencion</label>
                      <textarea class="form-control" rows="1" id="descripcion" name="descripcion" placeholder="OPCIONAL (EJ. Lu-Vi 08 a 18)"><?php echo $institucion->descripcion ?></textarea>
                      @if ($errors->has('descripcion'))
                        <span class="help-block">
                            <strong>{{ $errors->first('descripcion') }}</strong>
                        </span>
                      @endif
                    </div>
              </div>

              <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Actualizar Datos Basicos</button>
                </div>

              </form>
              <h4><i class="fa icon fa-location-arrow fa-fw"></i> Datos Dirección</h4>
              <form id="nuevaInstitucion-form" method="POST" action="{{ url('/institucion/updateDireccion') }}">

                {{ csrf_field() }}

                <div class="box-body">
                    <label>Dirección</label>
                    <div class="form-group col-md-12">
                      <input type="text" class="form-control col-md-6" id="autocomplete" placeholder="Comenzá a escribir una dirección para obtener sugerencias..." style="background-color: #eee;" autocomplete="false">
                      <input type="hidden" class="form-control" id="id" placeholder="" name="id" required value="{{$institucion->id}}">
                      <p class="help-block"><i class="icon fa fa-chevron-up"></i> Podés usar este campo para validar la dirección, sino ingresala manualmente</p>
                    </div>

                    <div class="form-group col-md-6">
                      <label>Calle</label>
                      <input class="form-control" id="route" name="calle" value="<?php echo isset($institucion->direccion) ? $institucion->direccion->calle : '' ?>"></input>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Número</label>
                      <input class="form-control" id="street_number" name="numero" value="<?php echo isset($institucion->direccion) ? $institucion->direccion->numero : '' ?>"></input>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Piso</label>
                      <input class="form-control" name="piso"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->piso : '' ?>"></input>
                    </div>
                    <div class="form-group col-md-2">
                      <label>Dpto</label>
                      <input class="form-control" name="departamento"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->departamento : '' ?>"></input>
                    </div>

                    <div class="form-group col-md-3">
                      <label>Localidad</label>
                      <input class="form-control" id="locality" name="localidad"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->localidad : '' ?>"></input>
                    </div>
                    <div class="form-group col-md-3">
                      <label>CP</label>
                      <input class="form-control" id="postal_code" name="codigoPostal"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->codigoPostal : '' ?>"></input>
                    </div>
                    <div class="form-group col-md-3">
                      <label>Provincia</label>
                      <input class="form-control" id="administrative_area_level_1" name="provincia"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->provincia : '' ?>"></input>
                    </div>
                    
                    <div class="form-group col-md-12">
                      <label>Pais</label>
                      <input class="form-control" id="country" name="pais"  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->pais : '' ?>"></input>
                    </div>

                    <div class="form-group col-md-12">
                      <label>Coordenadas</label><small> Se utilizan para mostrar en el mapa y calcular distancias.</small>
                    </div>              
                    <div class="form-group col-md-3">
                      <input class="form-control" id="lat" name="lat" readonly=""  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->lat : '' ?>"></input>
                      <p class="help-block">Latitud</p>
                    </div>
                    <div class="form-group col-md-3">
                      <input class="form-control" id="lng" name="lng" readonly=""  value="<?php echo isset($institucion->direccion) ? $institucion->direccion->long : '' ?>"></input>
                      <p class="help-block">Longitud</p>
                    </div>



              </div>

              
                <div class="modal-footer">
                  <button type="submit" class="btn btn-danger">Actualizar Dirección</button>
                </div>
            </form>

            
   
          </div>

        </div>





      </div>
	

</div>
</div>


<div class="modal fade in" id="modal-imagen">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><i class="fa icon fa-edit"></i> Actualizar Imagen</h4>
      </div>
      
      <form class="form-horizontal" method="POST" action="{{ route('institucion.updateImage') }}" id="formNuevoAsistido" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
            
          <p class="text-center">
          @if(isset($institucion->imagen) && $institucion->imagen != '' && $institucion->imagen != 'default.jpg')

            <img class="img-thumbnail" id="nueva-imagen" src="<?php echo asset("storage/$institucion->imagen")?>" alt="User Image" data-toggle="tooltip" title="Editar Imagen de Perfil" style="max-height: 150px; max-width: 150px;">

          @else

            <img class="img-thumbnail" id="nueva-imagen" src="{{asset('img/institucion160x160.png')}}" alt="Default" style="max-height: 150px; max-width: 150px;">

          @endif
          </p>

          <div class="form-group">
            <label class="col-sm-2 control-label" for="foto"></label>
            <input type="hidden" name="id" value="{{$institucion->id}}">
            <div class="col-sm-10">
              <input type="file" accept="image/*" id="foto" name="foto" required>
              <p class="help-block">Seleccione un archivo para reemplazar la foto.<br> <small>Admite jpg, jpeg, png, gif (Max 1000px)</small></p>
            </div>
          </div>



        </div>
        <div class="modal-footer">
          <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-primary" type="submit">Actualizar</button>
        </div>
      </form>

    </div>
  </div>
</div>



	
@endsection


@section('scripts')


<script type="text/javascript">
  
  $('.perfil').click(function () {

    $('#modal-imagen').modal('show');
  });

  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {

        $('#nueva-imagen').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  $("#foto").change(function() {
    readURL(this);
  });

</script>

<script>

      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('autocomplete')),
            {types: ['geocode']});

        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
        }

        document.getElementById('lat').value = place.geometry.location.lat();
        document.getElementById('lng').value = place.geometry.location.lng();

        console.log(place);
      }

      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC00PZ8LBCq2QWNAo9fcAHDAMN0z5-vIt0&libraries=places&callback=initAutocomplete" async defer></script>

@endsection
