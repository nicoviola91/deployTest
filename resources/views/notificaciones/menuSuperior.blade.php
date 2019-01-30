



<?php if (isset($resultados)): ?>

    <?php if ($unread > 0) { ?>
        
        <li class="header yesUnread">Tenés <span class="countUnread">{{$unread}}</span> notificaciones nuevas</li>

    <?php } else { ?>
        
        <li class="header noUnread">No tenés notificaciones sin leer</li>

    <?php } ?>


    <?php if (count($resultados)): ?>
    <li>
        <ul class="menu">
        
        <?php foreach ($resultados as $resultado): ?>

            @switch($resultado->type)
                
                @case('altasPropias')

                    <?php
                        if ((Auth::user()->tipoUsuario->slug != 'buenVecino' && Auth::user()->tipoUsuario->slug != 'samaritano'))
                            $url = url('/asistido/show') . "/" . $resultado->content5;
                        else
                            $url = '#';
                    ?>

                    <li><a href="<?php echo $url ?>"><i class="fa fa-user-plus text-aqua"></i> Nuevo Asistido de tus Alertas </a></li>
                    @break

                @case('solicitudAceptada')
                    <li><a href="{{url('/comunidad/muro')}}/{{$resultado->content5}}"><i class="fa fa-users text-primary"></i> Se aceptó tu Solicitud </a></li>
                    @break

                @case('asistidos')
                    <li><a href="{{url('/comunidad/muro')}}/{{$resultado->content5}}"><i class="fa fa-user-plus text-success"></i> Nuevo Asistido en tu Comunidad </a></li>
                    @break

                @case('alertas')
                    <li><a href="{{url('/comunidad/muro')}}/{{$resultado->content5}}"><i class="fa fa-exclamation-circle text-danger"></i> Nueva Alerta en tu Comunidad </a></li>
                    @break

                @case('mensajes')
                    <li><a href="{{url('/comunidad/muro')}}/{{$resultado->content5}}"><i class="fa fa-comments-o text-orange"></i> Nueva Mensaje en tu Comunidad </a></li>
                    @break

                @case('miembros')
                    <li><a href="{{url('/comunidad/muro')}}/{{$resultado->content5}}"><i class="fa fa-user-circle text-primary"></i> Nuevo Miembro en tu Comunidad </a></li>
                    @break

                @default

            @endswitch

        
        <?php endforeach ?>
        
        </ul>
    </li>
    <?php endif ?>

    <li class="footer"><a href="javascript:void(0)" data-toggle="control-sidebar" class="verTodas">Ver todas</a></li>

<?php endif ?>

        
    <!-- 
    OK <li><a href="#"><i class="fa fa-user-plus text-aqua"></i> Nuevo Asistido de tus Alertas</a></li> 
    OK <li><a href="#"><i class="fa fa-user-plus text-success"></i> Nuevo Asistido en tu Comunidad</a></li> 
    OK <li><a href="#"><i class="fa fa-exclamation-circle text-danger"></i> Nueva Alerta en tu Comunidad</a></li> 
    OK <li><a href="#"><i class="fa fa-comments-o text-orange"></i> Nueva Mensaje en tu Comunidad</a></li> 
    OK <li><a href="#"><i class="fa fa-user-circle text-primary"></i> Nueva Miembro en tu Comunidad</a></li> 

    <li><a href="#"><i class="fa fa-comments text-orange"></i> Nueva Consulta en tu Comunidad</a></li> 
    <li><a href="#"><i class="fa fa-user-circle text-maroon"></i> Nueva Solicitud en tu Comunidad</a></li>
    <li><a href="#"><i class="fa fa-file-text-o text-navy"></i> Nueva Ficha en tu Comunidad</a></li>
    <li><a href="#"><i class="fa fa-hotel text-purple"></i> Nueva Necesidad en tu Comunidad</a></li>
    <li><a href="#"><i class="fa fa-handshake-o text-primary"></i> Nueva Donación en tu Posadero</a></li> 
    -->