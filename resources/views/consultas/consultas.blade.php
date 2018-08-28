
<div class="row">

  <div class="col-md-12">

    <div class="box-body">
      <h3 class="box-title" style="margin-bottom: 20px;">
        <i class="icon fa fa-comments fa-fw"></i> Consultas (<span id="cantidadConsultas"><?php echo isset($consultas) ? count($consultas) : '0' ?></span>)
        <span class="pull-right">
          <a type="button" class="btn btn-default btn-sm no-print agregarConsultaBtn" href="#formNuevaConsulta"><i class="fa fa-plus-square fa-fw"></i> &nbsp;Agregar&nbsp;&nbsp;</a>
        </span>
      </h3>
    </div>    

    <div class="col-md-10 col-md-offset-1">
      
      <div class="box box-widget" id="listadoConsultas">

        <?php if (isset($consultas)): ?>

          <?php foreach ($consultas as $consulta): ?>
            
            <div class="box-header with-border" style="background-color: #e5e5e5">
              <div class="user-block">
                <?php if (isset($consulta->user->imagen)) { ?>
                  <!-- <img class="img-circle" src="{{ asset('/img/'. $consulta->user->imagen) }}" alt="User Image">  -->
                  <img src="<?php echo asset("storage") . '/' . $consulta->user->imagen ?>" class="img-circle" alt="User Image">
                <?php } else { ?>
                  <canvas class="user-icon" data-name="<?php echo $consulta->user->name ?> <?php echo $consulta->user->apellido ?>" width="40" height="40" style="border-radius: 50%; float: left;" data-chars="2"></canvas>
                  <!-- <img src="{{ asset('/img/user160x160.png') }}" class="img-circle" alt="User Image"> -->
                <?php } ?>
                <small class="text-muted pull-right"><?php echo $consulta->updated_at->format('H:i d/m/Y') ?> </small>
                <span class="username"><a href="#"><?php echo $consulta->user->name ?> <?php echo $consulta->user->apellido ?></a></span>
                <span class="description"><?php echo $consulta->user->email ?> </span>
              </div>
            </div>
            
            <div class="box-body">
              
              <p><?php echo $consulta->mensaje ?></p>
              
              <?php if (isset($consulta->adjunto)): ?>

                <?php 

                  $extension = pathinfo($consulta->adjunto, PATHINFO_EXTENSION);
                  
                  switch ($extension) {
                    
                    case 'pdf':
                      $icono = "fa-file-pdf-o text-red";
                      break;

                    case 'docx':
                      $icono = "fa-file-word-o text-blue";
                      break;

                    case 'doc':
                      $icono = "fa-file-word-o text-blue";
                      break;

                    case 'xls':
                      $icono = "fa-file-excel-o text-green";
                      break;

                    case 'xlsx':
                      $icono = "fa-file-excel-o text-green";
                      break;

                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                      $icono = "fa-file-image-o text-orange";
                      break;
                    
                    default:
                      $icono = "fa-file-text-o text-black";
                      break;
                  }
                ?>

                <div class="attachment-block clearfix">
                  <a href="/download/{{$consulta->adjunto}}" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                  <ul class="mailbox-attachments">
                    <li style="border: none; width: 90px;"> 
                      <span class="mailbox-attachment-icon" style="padding: 0px; font-size: 13px; white-space: nowrap;">
                        <i class="fa <?php echo $icono ?>"></i> Archivo Adjunto
                      </span>
                    </li>
                  </ul>
                </div>              
              <?php endif ?>

            </div>

            <hr style="margin: 5px;">

          <?php endforeach ?>

        <?php endif ?>
     
    </div>

    <?php if (isset($ficha)): ?>
    <div class="box box-solid" id="">
      <form class="form-horizontal" method="POST" action="{{ url('/consultas/store') }}" id="formNuevaConsulta" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h3 class="box-title"><i class="icon fa fa-comments-o fa-fw"></i> Nueva Consulta</h3>
        <textarea required class="textareaEditor" id="mensaje" name="mensaje" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> <?php echo (isset($datosDocumentos->experiencia) ? $datosDocumentos->experiencia : '')  ?> </textarea>
        
        <label for="adjunto" id="agregarAdjunto">Archivo Adjunto</label>
        <input type="file" id="adjunto" name="adjunto">

        <input type="hidden" name="tipo" value="<?php echo $tipo ?>"> <!-- TIPO DE FICHA -->
        <input type="hidden" name="asistido_id" value="<?php echo $asistido_id ?>"> <!-- ID DE LA FICHA -->
        
        <p class="help-block"><small>Admite jpg, jpeg, png, pdf, doc, xls, txt</small></p>

        <div class="box-footer">
          <button type="button" class="btn btn-default">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="submitConsultaBtn">Enviar Solicitud</button>
        </div>
      </form>
    </div> <!-- FIN BOX NUEVA CONSULTA -->
    <?php endif ?>

  </div>
</div>

<script>

	$('#submitConsultaBtn').click(function(e) {

		e.preventDefault();

		if ($('#mensaje').val() == '') {

			lanzarAlerta('peligro', "Por favor, ingresá un mensaje en el campo de texto.");

		} else {

	    	formData = new FormData($('#formNuevaConsulta')[0]);

	    	bootbox.dialog({
		        message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía la consulta.</p>',
		        closeButton: false
		    });

	    	$.ajax({
	            url: "{{url('/consultas/store')}}",
	            type: "POST",
	            enctype: 'multipart/form-data',
	            data: formData,
	            cache: false,
	            contentType: false,
	            processData: false,
	            success: function(datos)
	            {	
	            	$('.modal').modal('hide');
	            	$('#formNuevaConsulta')[0].reset();

	            	if (datos.status) {
	            		lanzarAlerta('exito', datos.msg);

			            txt = '<div class="box-header with-border" style="background-color: #e5e5e5">';
			            txt+= '<div class="user-block">';
			            txt+= '<img class="img-circle" src="<?php echo isset(Auth::user()->imagen) ? asset("storage") . '/' . Auth::user()->imagen : asset("/img/user160x160.png") ?>" alt="User Image">'
			                txt+= '<small class="text-muted pull-right"> ahora </small>'
			                txt+= '<span class="username"><a href="#">{{ Auth::user()->name }} {{ Auth::user()->apellido }}</a></span>'
			                txt+= '<span class="description">{{ Auth::user()->email }} </span>';
			              txt+= '</div>';
			            txt+= '</div>';
			            txt+= '<div class="box-body">';

			              txt+= ('<p>' + datos.texto + '</p>');
			              	
			              	if (datos.adjunto) {
			                txt+= '<div class="attachment-block clearfix">';
			                  txt+= ('<a href="/download/'+datos.adjunto+'" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>');
			                  txt+= '<ul class="mailbox-attachments">';
			                    txt+= '<li style="border: none; width: 90px;">'; 
			                      txt+= '<span class="mailbox-attachment-icon" style="padding: 0px; font-size: 13px; white-space: nowrap;">';
			                        txt+= '<i class="fa fa-file-text-o text-black"></i> Archivo Adjunto';
			                      txt+= '</span>';
			                    txt+= '</li>';
			                  txt+= '</ul>';
			                txt+= '</div>';
			                }            

			            txt+= '</div>';

			            txt+= '<hr style="margin: 5px;">';

	            		$('#listadoConsultas').append(txt);
	            	}
	            	else {
	            		lanzarAlerta('peligro', datos.msg);
	            	}

	            },
	            error: function(data) {					
					$('.modal').modal('hide');
					lanzarAlerta('peligro', 'Ocurrió un error al publicar el formulario. Vuelva a intentarlo.');
				}

	    	});
	    }

	})

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
</script>

<script type="text/javascript">
    katweKibsAvatar.init({
        dataChars: 2,
        width:100,
        height:100
    });
</script>
