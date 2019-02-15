
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
                
                <!-- <p><b>CONSULTA: </b><br><?php echo $sql ?></p>

                <?php echo var_dump($tipo) ?> -->

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

                        <?php if ($tipo == 'necesidades'): ?>
                            <th>Necesidad</th>
                            <th>Necesidad Tipo</th>
                            <th>Necesidad Creada</th>
                            <th>Donacion</th>
                        <?php endif ?>

                        <?php if ($tipo == 'empleo'): ?>
                            <th>Tiene Empleo?</th>
                        <?php endif ?>

                        <?php if ($tipo == 'educacion'): ?>
                            <th>Tipo Educacion</th>
                            <th>Nivel Alcanzado</th>
                            <th>Titulo Obtenido</th>
                            <th>Orientacion</th>
                            <th>Institucion</th>
                        <?php endif ?>

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

                                <?php if ($tipo == 'necesidades'): ?>
                                    <td><?php echo $resultado->necesidadDescripcion ?></td>
                                    <td><?php echo $resultado->tipoNecesidad ?></td>
                                    <td><?php echo isset($resultado->necesidad_created_at) ? (new DateTime($resultado->necesidad_created_at))->format('d/m/Y') : '' ?></td>
                                    <td class="text-center">
                                        <?php if (isset($resultado->donacion_id)) { ?>
                                            <i class="icon fa fa-check-circle fa-fw text-success"></i>
                                        <?php } else { ?>
                                            <i class="icon fa fa-times-circle fa-fw text-danger"></i>
                                        <?php } ?>
                                    </td>
                                <?php endif ?>

                                <?php if ($tipo == 'empleo'): ?>
                                    <td class="text-center">
                                        <?php if (isset($resultado->tieneEmpleo) && $resultado->tieneEmpleo) { ?>
                                            <i class="icon fa fa-check-circle fa-fw text-success"></i>
                                        <?php } else { ?>
                                            <i class="icon fa fa-times-circle fa-fw text-danger"></i>
                                        <?php } ?>
                                    </td>
                                <?php endif ?>

                                <?php if ($tipo == 'educacion'): ?>
                                    <td><?php echo isset($resultado->tipoEduc) ? $resultado->tipoEduc : '' ?></td>
                                    <td><?php echo isset($resultado->nivelEduc) ? $resultado->nivelEduc : '' ?></td>
                                    <td><?php echo isset($resultado->tituloEduc) ? $resultado->tituloEduc : '' ?></td>
                                    <td><?php echo isset($resultado->orientacionEduc) ? $resultado->orientacionEduc : '' ?></td>
                                    <td><?php echo isset($resultado->institucionEduc) ? $resultado->institucionEduc : '' ?></td>
                                <?php endif ?>


                            </tr>
                        <?php endforeach ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>