
@extends(true ? 'layouts.adminApp' : 'layouts.adminApp')

@section('title')
	Ficha
@endsection


@section('pageHeader')
<h1>
	<i class="icon fa fa-address-card fa-fw"></i> 100 - Juan Agustin Gallo (35169335)
	<small> Asistido </small>
</h1>
<ol class="breadcrumb">
	<li><a href="#"><i class="fa fa-user"></i> Asistidos</a></li>
	<li class="active">#100</li>
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

</style>

<div class="row">
<div class="col-md-12">
					 
      <div class="nav-tabs-custom">
            
        <ul class="nav nav-tabs">
          
          <li class="liTab active basicos">
            <a href="#tab_1" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Datos Personales">
              <i class="icon fa fa-address-card-o fa-fw"></i> 
              <span style="display: none;"> Datos Personales</span>
            </a>
          </li>

          <li class="liTab legal">
            <a href="#tab_3" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Legal">
              <i class="icon fa fa-legal fa-fw"></i> 
              <span style="display: none;"> Ficha Legal</span>
            </a>
          </li>
          <li class="liTab educacion">
            <a href="#tab_4" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Educación">
              <i class="icon fa fa-mortar-board fa-fw"></i> 
              <span style="display: none;"> Educación</span>
            </a>
          </li>
          <li class="liTab empleo">
            <a href="#tab_2" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Empleo">
              <i class="icon fa fa-gears fa-fw"></i> 
              <span style="display: none;"> FIcha Empleo</span>
            </a>
          </li>

          <li class="liTab asistencia">
            <a href="#tab_5" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Asistencia Social">
              <i class="icon fa fa-life-buoy fa-fw"></i> 
              <span style="display: none;"> Asistencia Social</span>
            </a>
          </li>

          <li class="liTab necesidades">
            <a href="#tab_6" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Necesidades">
              <i class="icon fa fa-hotel fa-fw"></i> 
              <span style="display: none;"> Necesidades</span>
            </a>
          </li>

          <li class="liTab medica">
            <a href="#tab_7" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Ficha Médica">
              <i class="icon fa fa-heartbeat fa-fw"></i> 
              <span style="display: none;"> Ficha Médica</span>
            </a>
          </li>
          <li class="liTab mental">
            <a href="#tab_8" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Salud Mental">
              <i class="icon fa fa-user-md fa-fw"></i> 
              <span style="display: none;"> Salud Mental</span>
            </a>
          </li>
          <li class="liTab adicciones">
            <a href="#tab_9" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Adicciones">
              <i class="icon fa fa-warning fa-fw"></i> 
              <span style="display: none;"> Adicciones</span>
            </a>
          </li>
          <li class="liTab integral">
            <a href="#tab_10" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Diagnóstico Integral">
              <i class="icon fa fa-stethoscope fa-fw"></i> 
              <span style="display: none;"> Diagnóstico Integral</span>
            </a>
          </li>

          <li class="liTab familia">
            <a href="#tab_11" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Familia y Amigos">
              <i class="icon fa fa-users fa-fw"></i> 
              <span style="display: none;"> Familia y Amigos</span>
            </a>
          </li>
          <li class="liTab localizacion">
            <a href="#tab_12" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Localización">
              <i class="icon fa fa-location-arrow fa-fw"></i> 
              <span style="display: none;"> Localización</span>
            </a>
          </li>

          <li class="liTab nueva">
            <a href="#tab_13" data-toggle="tab" aria-expanded="false" data-toggle="tooltip" title="Agregar Ficha">
              <i class="icon fa fa-plus-square fa-fw"></i> 
              <span style="display: none;"> Agregar Ficha</span>
            </a>
          </li>

        </ul>

        <div class="tab-content">
         
          <div class="tab-pane active" id="tab_1">
            
            <!-- DATOS DE LA FICHA -->
            <div class="box box-solid" id="boxFicha">

              <div class="box-body">
                <h3 class="box-title"><i class="icon fa fa-address-card-o fa-fw"></i> Datos Básicos</h3>
                asjkdajkdjkasdsakjdsajkdkjakjdsasjkdkajsdkjakdja
              </div>

            </div>

            <!-- CONSULTAS -->
            <div class="box box-solid" id="boxConsultas">

              <div class="box-body">
                <h3 class="box-title"><i class="icon fa fa-comments fa-fw"></i> Interacciones</h3>
                asjkdajkdjkasdsakjdsajkdkjakjdsasjkdkajsdkjakdja
              </div>

            </div>
          </div>
          <!-- /.tab-pane -->
          
          <div class="tab-pane" id="tab_3">
            
            <!-- DATOS DE LA FICHA -->
            <div class="box box-solid" id="boxFicha">

              <div class="box-body" id="boxFicha">
                <h3 class="box-title">
                  <i class="icon fa fa-legal fa-fw"></i> Ficha Legal
                  <span class="pull-right">
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-print"></i> Imprimir</button>
                  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-share"></i> Compartir</button>
                </span>
                </h3>
                
                




              </div>

            </div>

            <!-- CONSULTAS -->
            <div class="box box-solid" id="boxConsultas" style="margin-bottom: 5px;">

              <div class="box-body">
                <h3 class="box-title"><i class="icon fa fa-comments fa-fw"></i> Interacciones (5)</h3>
                







                <div class="box box-widget">
                  

                  <div class="box-header with-border" style="background-color: #e5e5e5">
                    <div class="user-block">
                      <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Image">
                      <small class="text-muted pull-right">7:30 PM Today</small>
                      <span class="username"><a href="#">Manuela Santos</a></span>
                      <span class="description">Abogada</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Far far away, behind the word mountains, far from the
                      countries Vokalia and Consonantia, there live the blind
                      texts. Separated they live in Bookmarksgrove right at</p>
                  </div>

                  <hr style="margin: 5px;">

                  <div class="box-header with-border" style="background-color: #e5e5e5">
                    <div class="user-block">
                      <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Image">
                      <small class="text-muted pull-right">7:30 PM Today</small>
                      <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                      <span class="description">Abogado Penalista</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>the coast of the Semantics, a large language ocean.
                      A small river named Duden flows by their place and supplies
                      it with the necessary regelialia. It is a paradisematic
                      country, in which roasted parts of sentences fly into
                      your mouth.</p>
                    <div class="attachment-block clearfix">
                      <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      <img class="attachment-img" src="{{ asset('/img/user160x160.png') }}" alt="Attachment Image">
                    </div>
                  </div>

                  <hr style="margin: 5px;">

                  <div class="box-header with-border" style="background-color: #e5e5e5">
                    <div class="user-block">
                      <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Image">
                      <small class="text-muted pull-right">7:30 PM Today</small>
                      <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
                      <span class="description">Shared publicly - 7:30 PM Today</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Far far away, behind the word mountains, far from the
                      countries Vokalia and Consonantia, there live the blind
                      texts. Separated they live in Bookmarksgrove right at</p>

                    <p>the coast of the Semantics, a large language ocean.
                      A small river named Duden flows by their place and supplies
                      it with the necessary regelialia. It is a paradisematic
                      country, in which roasted parts of sentences fly into
                      your mouth.</p>
                    <div class="attachment-block clearfix">
                      <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      <ul class="mailbox-attachments">
                        <li style="border: none; width: 90px;"> 
                          <span class="mailbox-attachment-icon" style="padding: 0px;">
                            <i class="fa fa-file-pdf-o text-red"></i>
                          </span>
                        </li>
                      </ul>
                    </div>
                  </div>

                  <hr style="margin: 5px;">

                  <div class="box-header with-border" style="background-color: #e5e5e5">
                    <div class="user-block">
                      <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Image">
                      <small class="text-muted pull-right">7:30 PM Today</small>
                      <span class="username"><a href="#">Pepe Gomez</a></span>
                      <span class="description">Arquitecto</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>Far far away, behind the word mountains, far from the
                      countries Vokalia and Consonantia, there live the blind
                      texts. Separated they live in Bookmarksgrove right at</p>

                    <p>the coast of the Semantics, a large language ocean.
                      A small river named Duden flows by their place and supplies
                      it with the necessary regelialia. It is a paradisematic
                      country, in which roasted parts of sentences fly into
                      your mouth.</p>
                    <div class="attachment-block clearfix">
                      <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      <ul class="mailbox-attachments">
                        <li style="border: none; width: 90px;"> 
                          <span class="mailbox-attachment-icon" style="padding: 0px;">
                            <i class="fa fa-file-word-o text-blue"></i>
                          </span>
                        </li>
                      </ul>
                    </div>                    
                  </div>

                  <hr style="margin: 5px;">

                  <div class="box-header with-border" style="background-color: #e5e5e5">
                    <div class="user-block">
                      <img class="img-circle" src="{{ asset('/img/user160x160.png') }}" alt="User Image">
                      <small class="text-muted pull-right">7:30 PM Today</small>
                      <span class="username"><a href="#">Pepe Gomez</a></span>
                      <span class="description">Arquitecto</span>
                    </div>
                  </div>
                  <div class="box-body">
                    <p>the coast of the Semantics, a large language ocean.
                      A small river named Duden flows by their place and supplies
                      it with the necessary regelialia. It is a paradisematic
                      country, in which roasted parts of sentences fly into
                      your mouth.</p>
                    <div class="attachment-block clearfix">
                      <a href="#" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                      <ul class="mailbox-attachments">
                        <li style="border: none; width: 90px;"> 
                          <span class="mailbox-attachment-icon" style="padding: 0px;">
                            <i class="fa fa-file-word-o text-blue"></i>
                          </span>
                        </li>
                      </ul>
                    </div>                    
                  </div>
            


                </div>

              </div>                

            </div> <!-- FIN BOX CONSULTAS -->

            <div class="box box-solid" id="boxNuevaConsulta">

              <div class="box-body" id="boxFicha">
                <h3 class="box-title"><i class="icon fa fa-comments-o fa-fw"></i> Nueva Interacción</h3>
                <textarea class="textareaEditor" id="editor1" name="consulta" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> <?php echo (isset($datosDocumentos->experiencia) ? $datosDocumentos->experiencia : '')  ?> </textarea>
                <label for="adjunto">Archivo Adjunto</label>
                <input type="file" id="adjunto" name="adjunto">
              <p class="help-block"><small>Admite jpg, jpeg, png, pdf, doc, xls, txt</small></p>

              </div>

            </div>

          
          </div> <!-- END TAB PANE -->

        

        </div> <!-- END TAB CONTENT -->


      </div>
	

</div>
</div>

	
@endsection


@section('scripts')

<script type="text/javascript">

    $(".liTab").click(function () {

      $(this).siblings().find('span').hide();
    })

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
