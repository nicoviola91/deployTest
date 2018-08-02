	
	<style type="text/css">
		
		.link:hover {
			text-decoration: underline;
			cursor: pointer;
			color: #013c21;
		}

	</style>

	<div class="box box-widget widget-user-2" style="min-width: 300px; max-width: 310px;">
		<div class="widget-user-header bg-gray" style="padding: 20px 5px 20px 5px;">
			<div class="widget-user-image">
				

				<?php if (isset($institucion->imagen)) { ?>
					
					<img class="img-circle" src="<?php echo asset("storage") . '/' . $institucion->imagen ?>" alt="Imagen" >

				<?php } else { ?>				
					
					<img class="img-circle" src="{{asset('/img/institucion160x160.png')}}" alt="Imagen" >

				<?php } ?>
				
			</div>

			<h3 class="widget-user-username"><?php echo $institucion->nombre ?></h3>
			<h5 class="widget-user-desc"> <?php echo strtoupper($institucion->tipo) ?> </h5>
		</div><div class="box-footer no-padding">
			<ul class="nav nav-stacked">
				
				<li>
					<a href="#"><strong>Dirección:</strong><br>
				 		
				 		<?php if (isset($institucion->direccion)) { ?>


				 			<?php 
				 				$direccion = '';
								if ($institucion->direccion->calle != '')
									$direccion.= $institucion->direccion->calle;
								if ($institucion->direccion->numero != '' && $institucion->direccion->numero != '0')
									$direccion.=  ' ' . $institucion->direccion->numero;
								if ($institucion->direccion->piso != '' && $institucion->direccion->piso != '0')
									$direccion.= ', Piso ' . $institucion->direccion->piso;
								if ($institucion->direccion->departamento != '')
									$direccion.= ', Dpto ' . $institucion->direccion->departamento;
								

								if ($institucion->direccion->codigoPostal != '')
									$direccion.= ', CP '. $institucion->direccion->codigoPostal;
								if ($institucion->direccion->provincia != '')
									$direccion.= ' ' . $institucion->direccion->provincia;
				 			?>

				 			<?php echo($direccion) ?>
				 		<?php } else { ?>
				 			No Disponible
				 		<?php } ?>
				 	</a>
				 </li>


				<li>
					<a href="#"><strong>Contacto:</strong><br>

						<?php if (isset($institucion->responsable)): ?>
							<?php echo $institucion->responsable ?> <br>
						<?php endif ?>

						<?php if (isset($institucion->telefono)): ?>
							Tel. <?php echo $institucion->telefono ?>
						<?php endif ?>
					</a>
				</li>

				<?php if (isset($institucion->descripcion)): ?>
					<li><a href="#"><strong>Observaciones:</strong><br> <?php echo isset($institucion->descripcion) ? $institucion->descripcion : 'N/D' ?></a></li>
				<?php endif ?>

				<li><a href="#"> <i class="fa icon fa-fw fa-users"></i> Comunidades <span class="pull-right badge bg-purple"><?php echo isset($comunidades) ? $comunidades : ' - ' ?></span></a></li>
				<li><a href="#"> <i class="fa icon fa-fw fa-user"></i> Asistidos <span class="pull-right badge bg-teal"><?php echo isset($asistidos) ? $asistidos : ' - ' ?></span></a></li>

				<li>
					<a href="#" class="btn btn-default loadingLink" target="_blank"> <i class="icon fa fa-plus fa-fw"></i> VER PERFIL	</a>
				</li>

			</ul>
		</div>

	</div>
	