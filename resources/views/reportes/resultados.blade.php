
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="icon fa fa-list"></i> Resultados de Búsqueda 
                <span class="text-muted" id="cantidadResultados">(<?php echo count($resultados) ?>)</span>
              </h3>
            </div>
            <div class="box-body" style="overflow-x: auto;">
                <table class="table" id="tableResultados">
                    
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>
                                <td><?php echo $resultado->nombre ?></td>
                                <td><?php echo $resultado->apellido ?></td>
                                <td><?php echo $resultado->dni ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>