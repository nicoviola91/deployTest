
<div class="modal" id="modal-mensaje">
	<div class="modal-dialog modal-lg">
	  	<div class="modal-content">
	    
		    <div class="modal-header">
		      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        <span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title"><i class="icon fa fa-fw fa-bug"></i> Issues </h4>
		    </div>
		    

		    <form role="form" id="issueForm" enctype="multipart/form-data" class="form-horizontal">
	    
		    	<div class="modal-body">

		    		<p>Herramienta para reportar errores o sugerencias de cambios y nuevas funcionalidades.</p>
		    		<p>Formulario para ingresar nuevo Issue <a href="<?php echo site_url() ?>/issues/listar" data-toggle="tooltip" data-title='Mas Información'><i class="icon fa fa-info-circle"></i></a> </p>
		    		<hr>

		    		<div class="form-group">
		  				<label class="col-sm-2 control-label" for="titulo">Título*</label>
		  				<div class="col-sm-10">
		  					<input type="text" class="form-control" id="titulo" placeholder="Título" required name="titulo" maxlength="150">
		  				</div>
		  			</div>

		  			<div class="form-group">
                        <label class="col-sm-2 control-label" for="tipo">Tipo *</label>
                        <div class="col-sm-4">
                          <select id="tipo" name="tipo" class="form-control" style="width: 100%;" required>       
                          	<option value="" selected disabled hidden>Seleccione ...</option>        		
                            <option value="Bug">BUG</option>
                            <option value="Changes">CHANGES</option>
                            <option value="To Do">TO-DO</option>
                          </select>
                        </div>
                        <div class="col-sm-6"><p class="help-block" id="info"></p></div>
                    	
                    </div>
                    

		  			<div class="form-group">
                       <label class="col-sm-2 control-label" for="descripcion">Descripción *</label>
                       <div class="col-sm-10">
                        <textarea class="form-control" rows="5" placeholder="Descripción del problema." id="descripcion" name="descripcion" required></textarea>
                      </div>
                    </div>

		    	</div>

		    	<div class="modal-footer">
		        	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary" id="confirmIssueBtn">Enviar Solicitud</button>
		        </div>

			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
	
	$('#tipo').change(function () {

		var opt = $(this).val();
		var txt = '';

		switch(opt) {

			case 'Bug':
				txt = '<span class="label label-danger">BUG</span> Reportar Errores';
				break;

			case 'To Do':
				txt = '<span class="label label-success">TO-DO</span> Solicitud/Sugerencia de nueva funcionalidad';
				break;

			case 'Changes':
				txt = '<span class="label label-warning">CHANGES</span> Solicitud/Sugerencia de cambios';
				break;

			default:
				txt = '';
				break;
		}

		$('#info').html(txt);	
	})

	$('#confirmIssueBtn').click(function (e) {

		e.preventDefault();

		bootbox.dialog({
	        message: '<p class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i> Por favor, espere mientras se envía su solicitud.</p>',
	        closeButton: false
	    });

		formData = new FormData($('#issueForm')[0]);

		$.ajax({
            url: '<?php echo site_url() ?>/issues/guardar',
            type: "POST",
            enctype: 'multipart/form-data',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data)
            {	
            	var datos = $.parseJSON(data);

            	if (datos.status) {
            		lanzarAlerta('exito', datos.msg);
            	}
            	else {
            		lanzarAlerta('peligro', datos.msg);
            	}

            	$('.modal').modal('hide');
            },
            error: function(data) {					
				lanzarAlerta('peligro', 'Ocurrió un error al publicar el formulario. Vuelva a intentarlo.');
			}

    	});

	})

</script>