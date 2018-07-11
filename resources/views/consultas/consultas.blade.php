
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
      
      <div class="box box-widget">

        <?php if (isset($consultas)): ?>

          <?php foreach ($consultas as $consulta): ?>
            
            <div class="box-header with-border" style="background-color: #e5e5e5">
              <div class="user-block">
                <?php if (isset($consulta->user->imagen)) { ?>
                  <img class="img-circle" src="{{ asset('/img/Perez.jpg') }}" alt="User Image">  
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
              <?php endif ?>

            </div>

            <hr style="margin: 5px;">

          <?php endforeach ?>

        <?php endif ?>
     
    </div>

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

  </div>
</div>

<script>
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
