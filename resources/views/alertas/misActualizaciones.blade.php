
<?php if (isset($alertas) && count($alertas)) { ?>
	

	<?php $dia = 0; ?>
	<?php $meses = array('01' => 'Ene', '02' => 'Feb', '03' => 'Mar', '04' => 'Abr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Ago', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'); ?>

	<?php foreach ($alertas as $a): ?>

		<?php $fecha = new DateTime($a->orden) ?>

		<?php if ($fecha->format('Y-m-d') != $dia): ?>
	    	
	    	<li class="time-label">
	            <span class="bg-navy">
	              <?php echo $fecha->format('d') . ' ' . $meses[$fecha->format('m')] . ' ' . $fecha->format('Y') ?>
	            </span>
	      	</li>	
	    
	    <?php endif ?>

	    <?php $dia = $fecha->format('Y-m-d'); ?>

		
		<?php if ($a->tipo == 'alertas') { ?>

			<li>
	            <i class="fa fa-user-plus bg-blue"></i>

	            <div class="timeline-item">
	              <span class="time"><i class="fa fa-clock-o"></i> <?php echo $fecha->format('H:i') ?> </span>

	              <h3 class="timeline-header">		
	              		<a href="#">Generaste una alerta (#<?php echo $a->id ?>)</a>
	              </h3>

	              <div class="timeline-body">
	              	<strong><i class="icon fa fa-user"></i> DATOS DE LA PERSONA</strong>
	              	<p>
	              		Nombre: <?php echo $a->nombre ?> <?php echo $a->apellido ?>
	              		<br>DNI: <?php echo $a->dni ?>
	              		
	              		<?php if (isset($a->fechaNacimiento)): ?>
	              			<br>Fecha Nacimeinto: <?php echo (new DateTime($a->fechaNacimiento))->format('d/m/Y') ?>
	              		<?php endif ?>

	              		<?php if (isset($a->observaciones)): ?>
	              			<br><br><strong>Observaciones:</strong> 
	              			<br><?php echo $a->observaciones ?>
	              		<?php endif ?>
	              		
	              	</p>
	              	<?php if (isset($a->posadero)): ?>
	              		<img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> <strong>POSADERO al que fue derivado:</strong>
	              		<p><?php echo $a->posadero ?></p>
	              	<?php endif ?>
	              </div>
	          
	            </div>
	          </li>


		<?php } else if ($a->tipo == 'altas') { ?>

			<li>
	            <i class="fa fa-check bg-green"></i>

	            <div class="timeline-item">

	                <span class="time"><i class="fa fa-clock-o"></i> <?php echo $fecha->format('H:i') ?> </span>
		           	<h3 class="timeline-header no-border"><a href="#">Felicitaciones!</a> se dió de alta uno de tus Asistidos en un Posadero</h3>

					<div class="timeline-body">

						<i class="icon fa fa-user"></i> <?php echo $a->nombre ?> <?php echo $a->apellido ?> se dió de alta
							<?php if (isset($a->posadero)) { ?>
								en <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> <?php echo $a->posadero ?>
							<?php } else { ?>
								en un <img src="{{asset('/img/logoch.png')}}" class="img-circle" style="max-height: 17px;"> Posadero
							<?php } ?>
							
						<p class="help-block"> Si querés involucrarte y hacer un seguimiento del caso, podes acercarte a un Posadero. Hace <a href="#">click aca</a> para obtener mas información sobre como ayudar.</p>	

					</div>

					<?php if (Auth::user()->tipoUsuario->slug == 'administrador' || Auth::user()->tipoUsuario->slug == 'posadero' || Auth::user()->tipoUsuario->slug == 'coordinador' || Auth::user()->tipoUsuario->slug == 'profesional') : ?>
						<div class="timeline-footer">
		                	<a class="btn btn-default btn-xs" href="{{url('/asistido/show/' . $a->asistido)}}" target="_blank"><i class="fa icon fa-address-card fa-fw"></i> Ver Ficha</a>
		              	</div>
					<?php endif ?>
		              
	            </div>
	        </li>

		<?php } ?>

	<?php endforeach ?>

	<li class="liMore">
	    <i class="fa fa-clock-o bg-gray"></i>
	    <div class="timeline-item text-center" style="background-color: #fefefe !important; border: none;">
	    	<h3 class="timeline-header no-border" style="vertical-align: center;"><a href="javascript:void(0)" class="moreUpdates" data-offset="<?php echo $offset + count($alertas) ?>"><i class="icon fa fa-plus-square iconMore"></i> CARGAR ANTERIORES</a></h3>
	    </div>
	</li>

<?php } else { ?>

	<li>
	    <i class="fa fa-clock-o bg-gray"></i>
	</li>

<?php } ?>