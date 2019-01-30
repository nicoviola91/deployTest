
<?php if (isset($resultados) && count($resultados)): ?>

  <?php foreach ($resultados as $r): ?>

    @switch($r->type)
                
        @case('altasPropias')

            <?php
                if ((Auth::user()->tipoUsuario->slug != 'buenVecino' && Auth::user()->tipoUsuario->slug != 'samaritano'))
                    $url = url('/asistido/show') . "/" . $r->content5;
                else
                    $url = '#';
            ?>

            <li>
              <a href="<?php echo $url ?>" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-user-plus bg-aqua"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nuevo Asistido de tus Alertas</h4>
                  <p>{{$r->content1}} {{$r->content2}} se presentó en {{$r->content4}}</p>
                </div>
              </a>
            </li>
            @break

        @case('solicitudAceptada')
            <li>
              <a href="{{url('/comunidad/muro')}}/{{$r->content5}}" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-user-circle bg-navy" style="background-color: #125eac !important;"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Tu Solicitud fue aceptada</h4>
                  <p>Bienvenido a {{$r->content1}}</p>
                </div>
              </a>
            </li>
            @break

        @case('asistidos')
            <li>
              <a href="{{url('/comunidad/muro')}}/{{$r->content5}}" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-user-plus bg-green"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nuevo Asistido en tu Comunidad</h4>
                  <p>Se asosió {{$r->content1}} {{$r->content2}} a {{$r->content3}}</p>
                </div>
              </a>
            </li>
            @break

        @case('alertas')
            <li>
              <a href="{{url('/comunidad/muro')}}/{{$r->content5}}" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-exclamation-circle bg-red"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nueva Alerta en tu Comunidad</h4>
                  <p>{{$r->author1}} {{$r->author2}} generó una Alerta en {{$r->content4}}</p>
                </div>
              </a>
            </li>
            @break

        @case('mensajes')
            <li>
              <a href="{{url('/comunidad/muro')}}/{{$r->content5}}" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-comments-o bg-orange"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nuevo Mensaje en tu Comunidad</h4>
                  <p>{{$r->author1}} {{$r->author2}} escribió en el Muro de {{$r->content4}}</p>
                </div>
              </a>
            </li>
            @break

        @case('miembros')
            <li>
              <a href="{{url('/comunidad/muro')}}/{{$r->content5}}" data-toggle="tooltip" title="<?php echo $r->orden ?>">
                <i class="menu-icon fa fa-user-circle bg-navy" style="background-color: #125eac !important;"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">Nuevo Miembro en tu Comunidad</h4>
                  <p>Dale la bienvenida a {{$r->content1}} {{$r->content2}}</p>
                </div>
              </a>
            </li>
            @break

        @default

    @endswitch

  <?php endforeach ?>

  <li class="divMore">
    <a href="javascript:void(0)" class="more" data-offset="<?php echo $offset+count($resultados) ?>">
      <i class="menu-icon iconMore fa fa-plus bg-gray"></i>
      <div class="menu-info" style="margin-top: 10px !important;">
        <h4 class="control-sidebar-subheading">CARGAR MAS</h4>
      </div>
    </a>
  </li>

<?php endif ?>


<!-- 
<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-user-plus bg-aqua"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nuevo Asistido de tus Alertas</h4>
      <p>Pepe gomez se presento en Posadero BLABLA</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-user-plus bg-green"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nuevo Asistido en tu Comunidad</h4>
      <p>Se asosio Pepe Gomez a Noche de la Caridad Blabla</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-exclamation-circle bg-red"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Alerta en tu Comunidad</h4>
      <p>Juan Gallo genero una Alerta en Noche de Caridad Blabla</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-comments-o bg-orange"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nuevo Mensaje en tu Comunidad</h4>
      <p>Juan Gallo escribio en el Muro de Noche de Caridad Blabla</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-comments bg-orange"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Consulta en tu Comunidad</h4>
      <p>Juan Gallo escribio una Consulta para Pepe Gomez</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-user-circle bg-navy" style="background-color: #125eac !important;"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nuevo Miembro en tu Comunidad</h4>
      <p>Dale la bienvenida a Juan Gallo</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-user-circle bg-maroon"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Solicitud en tu Comunidad</h4>
      <p>Juan Gallo solicito unirse a tu Comunidad</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-hotel bg-purple"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Necesidad en tu Comunidad</h4>
      <p>Juan Gallo creo una nueva necesidad para Pepe Gomez</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-file-text-o bg-black"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Ficha en tu Comunidad</h4>
      <p>Juan Gallo creo una Ficha para Pepe Gomez</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)">
    <i class="menu-icon fa fa-handshake-o bg-navy"></i>
    <div class="menu-info">
      <h4 class="control-sidebar-subheading">Nueva Donacion en tu Comunidad</h4>
      <p>Juan Gallo hizo una Donacion</p>
    </div>
  </a>
</li>

<li>
  <a href="javascript:void(0)" data-offset="">
    <i class="menu-icon fa fa-plus bg-gray"></i>
    <div class="menu-info" style="margin-top: 10px !important;">
      <h4 class="control-sidebar-subheading">CARGAR MAS</h4>
    </div>
  </a>
</li> 
-->

