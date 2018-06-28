<style type="text/css">
  .preventoverflow{
      
      white-space: normal;
      overflow: hidden;
      text-overflow: ellipsis
  }
</style>

<div class="row">

  <div class="col-md-12">

    <div class="box-body">
      <h3 class="box-title" style="margin-bottom: 20px;">
        <i class="icon fa fa-comments fa-fw"></i> Consultas (<span id="cantidadConsultas">5</span>)
        <span class="pull-right">
          <a type="button" class="btn btn-default btn-sm no-print agregarConsultaBtn" href="#formNuevaConsulta"><i class="fa fa-plus-square fa-fw"></i> &nbsp;Agregar&nbsp;&nbsp;</a>
        </span>
      </h3>
    </div>    

    <div class="col-md-10 col-md-offset-1">
      
      <div class="box box-widget">

        <?php if (isset($consultas) && count($consultas)): ?>

          <?php foreach ($consultas as $consultas): ?>
          
            <div class="box-header with-border" style="background-color: #e5e5e5">
              <div class="user-block">
                <img class="img-circle" src="{{ asset('/img/Perez.jpg') }}" alt="User Image">
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

          <?php endforeach ?>

        <?php endif ?>
     
    </div>

    <div class="box box-solid" id="boxNuevaConsulta">
      <form class="form-horizontal" method="POST" action="{{ url('/consultas/store') }}" id="formNuevaConsulta" enctype="multipart/form-data">
        {{ csrf_field() }}
        <h3 class="box-title"><i class="icon fa fa-comments-o fa-fw"></i> Nueva Consulta</h3>
        <textarea class="textareaEditor" id="mensaje" name="mensaje" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> <?php echo (isset($datosDocumentos->experiencia) ? $datosDocumentos->experiencia : '')  ?> </textarea>
        
        <label for="adjunto" id="agregarAdjunto">Archivo Adjunto</label>
        <input type="file" id="adjunto" name="adjunto">

        <input type="hidden" name="consultable_type" value=""> <!-- TIPO DE FICHA -->
        <input type="hidden" name="consultable_id" value=""> <!-- ID DE LA FICHA -->
        
        <p class="help-block"><small>Admite jpg, jpeg, png, pdf, doc, xls, txt</small></p>

        <div class="box-footer">
          <button type="button" class="btn btn-default">Cancelar</button>
          <button type="submit" class="btn btn-primary" id="consultaSubmitBtn">Enviar Solicitud</button>
        </div>
      </form>
    </div> <!-- FIN BOX NUEVA CONSULTA -->

  </div>
</div>

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
