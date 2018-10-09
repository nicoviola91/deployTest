
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
                
                <p><b>CONSULTA: </b><br><?php echo $sql ?></p>

                <table class="table" id="tableResultados">
                    
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th>Nacionalidad</th>
                        <th>Fecha Nacimiento</th>
                        <th>Fecha Alta</th>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr>
                                <td><?php echo $resultado->nombre ?></td>
                                <td><?php echo $resultado->apellido ?></td>
                                <td><?php echo $resultado->dni ?></td>
                                <td><?php echo $resultado->descripcionSexo ?></td>
                                <td><?php echo $resultado->descripcionEstadoCivil ?></td>
                                <td><?php echo $resultado->nacionalidad ?></td>
                                <td><?php echo isset($resultado->fechaNacimiento) ? (new DateTime($resultado->fechaNacimiento))->format('d/m/Y') : '' ?> <?php echo isset($resultado->edad) ? '(' . $resultado->edad . ' años)' : '' ?></td>
                                <td><?php echo isset($resultado->created_at) ? (new DateTime($resultado->created_at))->format('d/m/Y') : '' ?> </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>