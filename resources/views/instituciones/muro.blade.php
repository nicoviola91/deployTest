
@extends('layouts.userApp')

@section('title')
	Institucion
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
  <i class="icon fa fa-users fa-fw"></i>Mi Posdaero
</h1>
<ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-users"></i> Posadero</a></li>
  <li class="active">Muro</li>
</ol>
@endsection


@section('content')

<style type="text/css">
  
  .vert-aligned {

    vertical-align: middle !important;
  }

  .user-block-icon {
    width: 40px;
    height: 40px;
    float: left;
    font-size: 3em;
  }

}

</style>

<div class="row">
<div class="col-md-12">











<div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box">
            <div class="box-body box-profile">


              @if(isset($institucion->imagen) && $institucion->imagen != '' && $institucion->imagen != 'default.jpg')

                <img class="profile-user-img img-responsive img-circle" src="<?php echo asset('storage' . '/' . $institucion->imagen) ?>" alt="Institucion">
                
              @else

                <img class="profile-user-img img-responsive img-circle" src="{{asset('img/institucion160x160.png')}}" alt="Default">

              @endif

              

              <h3 class="profile-username text-center"><?php echo $institucion->nombre ?></h3>

              <p class="text-muted text-center">
                <?php if ($institucion->tipo == 'posadero') { ?>
                  <img src="{{asset('/img/logoch.png')}}" alt="Logo Posadero" style="height: 17px;"> Posadero
                <?php } else { ?>
                  Institucion Externa   
                <?php } ?>
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b><i class="fa fa-users fa-fw"></i> Comunidades</b> <a class="pull-right"><?php echo $institucion->comunidades->count() ?></a>
                </li>
                <li class="list-group-item">
                  <b><i class="fa fa-exclamation-circle fa-fw"></i> Alertas</b> <a class="pull-right"><?php echo $institucion->alertas->count() ?></a>
                </li>
              </ul>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              
              <?php if ($institucion->tipo == 'posadero') { ?>
                <strong><img src="{{asset('/img/logoch.png')}}" alt="Logo Posadero" style="height: 17px;"> Posadero</strong>  
              <?php } else { ?>
                <strong><i class="fa fa-bank margin-r-5"></i> Institución</strong>
              <?php } ?>
              
              <p class="text-muted">
                {{ strtoupper($institucion->nombre) }}
              </p>

              <hr>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Ubicación</strong>

              <p class="text-muted"><?php echo $institucion->direccion->toString() ?></p>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li><a href="#alertas" data-toggle="tab"><i class="fa icon fa-exclamation-circle fa-fw"></i> <span class="hidden-xs">Alertas</span></a></li>
              <li><a href="#asistidos" data-toggle="tab"><i class="fa icon fa-user fa-fw"></i> <span class="hidden-xs">Asistidos</span></a></li>
              <li><a href="#comunidades" data-toggle="tab"><i class="fa icon fa-users fa-fw"></i> <span class="hidden-xs">Comunidades</span></a></li>
              <li><a href="#miembros" data-toggle="tab"><i class="fa icon fa-user-circle fa-fw"></i> <span class="hidden-xs">Miembros</span></a></li>
            </ul>
            
            <div class="tab-content" style="min-height: 742px;">
              
              <div class="active tab-pane" id="alertas">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Alertas Pendientes
                      <br><small class="text-muted">Listado de Alertas que fueron derivadas a tu Institución</small> 
                    </h3>
                    <br>
                  </div>
                </div>

              </div>


              <div class="tab-pane" id="asistidos">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Asistidos
                      <br><small class="text-muted">Listado de Asistidos asociados a las Comunidades de tu Institución</small> 
                    </h3>
                    <br>
                  </div>
                </div>

              </div>


              <div class="tab-pane" id="miembros">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Miembros
                      <br><small class="text-muted">Listado de Miembros asociados a las Comunidades de tu Institución</small> 
                    </h3>
                    <br>
                  </div>
                </div>

              </div>

              <div class="tab-pane" id="miembros">
                
                <div class="row">
                  <div class="col-md-12">
                    <h3>
                      Comunidades
                      <br><small class="text-muted">Listado de Comunidades de tu Institución</small> 
                    </h3>
                    <br>
                  </div>
                </div>

              </div>



            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->














</div>
</div>



<div class="modal fade" id="modal-consulta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="icon fa fa-comments-o fa-fw"></i> Comunidad <small class="text-muted">NUEVO MENSAJE</small></h4>
      </div>

      <div class="modal-body">
      <form class="form-horizontal" method="POST" action="{{ url('/comunidad/storeMensaje') }}" id="formNuevaConsulta" enctype="multipart/form-data">
        {{ csrf_field() }}
        <textarea required class="textareaEditor" id="mensaje" name="mensaje" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
        
        <label for="adjunto" id="agregarAdjunto">Imagen Adjunta</label>
        <input type="file" id="adjunto" name="adjunto">
        <input type="hidden" id="id" name="id" value="<?php echo $institucion->id ?>">
        
        <p class="help-block"><small>Admite jpg, jpeg, png</small></p>

        <div class="box-footer">
          <button type="submit" class="btn btn-primary" id="submitConsultaBtn">Enviar Mensaje</button>
        </div>
      </form>
      </div>

    </div>
  </div>
</div>


@endsection


@section('scripts')

<script type="text/javascript">
    
  $(function () {

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


  $(function() {
    
    function actualizaciones (offset) {

      $.get("{{url('actividad/'.$institucion->id)}}"+"/"+offset, function(data){
        
        $('.divMore').remove();

        $("#actividadReciente").append(data);
        $("#loading").remove();
      })

    }

    actualizaciones(0);

    $(document).on( "click", ".moreUpdates", function() {

      offset = $(this).data('offset');
      $('.iconMore').addClass("fa-spin");
      actualizaciones(offset);

    })

  });

    
  
</script>


@endsection
