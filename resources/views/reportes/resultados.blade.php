
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">
                <i class="icon fa fa-list"></i> Resultados de Búsqueda 
                <span class="text-muted" id="cantidadResultados">(<?php echo count($resultados) ?>)</span>
              </h3>
              <div class="box-tools">
                <a href="#" class="btn btn-md btn-success btnExport"><i class="fa fa-file-excel-o"></i> <span class="hidden-sm hidden-xs">Exportar</span></a>
              </div>
            </div>
            <div class="box-body" style="overflow-x: auto;">
                
                <p><b>CONSULTA: </b><br><?php echo $sql ?></p>

                <table class="table table-hover" id="tableResultados">
                    
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Sexo</th>
                        <th>Estado Civil</th>
                        <th>Nacionalidad</th>
                        <th>Fecha Nacimiento</th>
                        <th>Fecha Alta</th>
                        <th>Celular</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Posadero</th>
                    </thead>
                    <tbody>
                        <?php foreach ($resultados as $resultado): ?>
                            <tr data-id="<?php echo $resultado->id ?>" class="rowAsistido">
                                <td><?php echo $resultado->nombre ?></td>
                                <td><?php echo $resultado->apellido ?></td>
                                <td><?php echo $resultado->dni ?></td>
                                <td><?php echo $resultado->descripcionSexo ?></td>
                                <td><?php echo $resultado->descripcionEstadoCivil ?></td>
                                <td><?php echo $resultado->nacionalidad ?></td>
                                <td><?php echo isset($resultado->fechaNacimiento) ? (new DateTime($resultado->fechaNacimiento))->format('d/m/Y') : '' ?> <?php echo isset($resultado->edad) ? '(' . $resultado->edad . ' años)' : '' ?></td>
                                <td><?php echo isset($resultado->created_at) ? (new DateTime($resultado->created_at))->format('d/m/Y') : '' ?> </td>
                                <td><?php echo $resultado->celular ?></td>
                                <td><?php echo $resultado->telefono ?></td>
                                <td><?php echo $resultado->email ?></td>
                                <td><?php echo isset($resultado->posadero) ? $resultado->posadero : 'N/D' ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>