
<?php if (isset($actualizaciones) && count($actualizaciones)): ?>

  <?php foreach ($actualizaciones as $m): ?>
    
    <?php if ($m->type == 'mensajes') { ?>
    
      <div class="post">
        <div class="user-block">

              <?php if (isset($m->content3)) { ?>
                <img class="img-circle img-bordered-sm" src="<?php echo asset("storage") . '/' . $m->content3 ?>" alt="user image">                          
              <?php } else { ?>
                <img class="img-circle img-bordered-sm" src="{{ asset('/img/user160x160.png') }}" alt="user image">
              <?php } ?>

              <span class="username">
                <a href="#"><?php echo $m->author1 ?> <?php echo $m->author2 ?></a>
                <!-- <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a> -->
                <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
              </span>
          <span class="description"> <?php echo $m->author3 ?></span>
        </div>
        <p>
          <?php echo $m->content1 ?>
          <?php if (isset($m->content2)): ?>
            <a href="<?php echo asset('storage/' . $m->content2) ?>" target="_blank"><img src="<?php echo asset('storage/' . 'thumb_' . $m->content2) ?>" class="margin img-thumbnail" style="max-height: 80px;"></a>
          <?php endif ?>
        </p>          
      </div>

    <?php } else if ($m->type == 'miembros') { ?>

      <div class="post">
        <div class="user-block">
          <i class="fa-fw icon fa fa-user-circle user-block-icon text-primary"></i>
          <span class="username">
            <a href="#">Nuevo Miembro</a>
            <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
          </span>
          <span class="description" style="font-size: 15px !important;"> 
            Se agregó un nuevo miembro a la Comunidad. Dale la bienvenida a <b><?php echo ($m->content1) ?> <?php echo ($m->content2) ?></b>
          </span>
        </div>  
      </div>

    <?php } else if ($m->type == 'alertas') { ?>

      <div class="post">
        <div class="user-block">
          <i class="fa-fw icon fa fa-exclamation-circle user-block-icon text-red"></i>
          <span class="username">
            <a href="#">Nueva Alerta</a>
            <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
          </span>
          <span class="description" style="font-size: 15px !important;"> 
            <b><?php echo $m->author1 ?> <?php echo $m->author2 ?></b> generó una nueva Alerta
            <br>
            Asistido: <b><?php echo $m->content1 ?> <?php echo $m->content2 ?></b>
            <?php if (isset($m->content3)): ?>
              <br><b>Observaciones:</b> <?php echo $m->content3 ?>
            <?php endif ?>
          </span>
        </div>  
      </div>

    <?php } else if ($m->type == 'asistidos') { ?>

      <div class="post">
        <div class="user-block">
          <i class="fa-fw icon fa fa-check-circle user-block-icon text-success"></i>
          <span class="username">
            <a href="#">Nuevo Asistido</a>
            <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
          </span>
          <span class="description" style="font-size: 15px !important;"> 
            Se asoció nuevo Asistido a tu Comunidad
            <br><a href="{{url('/asistido/show/'.$m->content4)}}" target="?_blank"><i class="icon fa fa-user fa-fw"></i><b><?php echo $m->content1 ?> <?php echo $m->content2 ?></b></a>
            <br>
          </span>
        </div>  
      </div>

    <?php } else if ($m->type == 'consulta') { ?>

      <div class="post">
          <div class="user-block">
            <i class="fa-fw icon fa fa-comments user-block-icon text-orange"></i>
            <span class="username">
              <a href="#">Nueva Consulta</a>
              <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
            </span>
            <span class="description" style="font-size: 15px !important;"> 
              <b><?php echo $m->author1 ?> <?php echo $m->author2 ?></b> generó una nueva Consulta en la <a href="{{url('/asistido/show/'.$m->content5)}}" target="_blank"><em><?php echo $m->content4 ?></em></a> del Asistido <i class="icon fa fa-user"></i> <b><?php echo $m->content1 ?> <?php echo $m->content2 ?></b>
            </span>
          </div>  
        </div>

    <?php } else if ($m->type == 'ficha') { ?>

      <div class="post">
        <div class="user-block">
          <i class="fa-fw icon fa fa-file-text-o user-block-icon text-navy"></i>
          <span class="username">
            <a href="#">Nueva Ficha</a>
            <span href="#" class="pull-right btn-box-tool">{{ Carbon\Carbon::parse($m->created_at)->diffForHumans() }}</span>
          </span>
          <span class="description" style="font-size: 15px !important;"> 
            <b><?php echo $m->author1 ?> <?php echo $m->author2 ?></b> creó una nueva<a href="{{url('/asistido/show/'.$m->content5)}}" target="_blank"> <em><?php echo $m->content4 ?></em></a> para el Asistido <i class="icon fa fa-user"></i> <b><?php echo $m->content1 ?> <?php echo $m->content2 ?></b>
          </span>
        </div>  
      </div>

    <?php } ?>

  <?php endforeach ?>

  <a href="javascript:void(0)" class="divMore moreUpdates" data-offset="<?php echo $offset+count($actualizaciones) ?>">
    <div class="post">
      <div class="user-block" style="vertical-align: middle;">
        <span class="description text-center" style="font-size: 1.5em;"><i class="icon fa fa-plus-square iconMore"></i> CARGAR ANTERIORES</span>
      </div>  
    </div>
  </a>

<?php endif ?>



      

      



        
