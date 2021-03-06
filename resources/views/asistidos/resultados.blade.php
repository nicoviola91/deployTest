
<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            
            <div class="box-body">
                
                <h3> 
                    <div class="col-md-6 col-xs-12">
                        <i class="icon fa fa-search"></i> Resultados 
                        <small><br>RESULTADOS DE BUSQUEDA</small>
                    </div>
                </h3>
                
                <table class="table table-hover" id="tableResultados">
                    
                    <thead>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Documento</th>
                        <th>Fecha Alta</th>
                        <th>Posadero</th>
                        <th></th>
                    </thead>
                    <tbody>
                        <?php if (isset($resultados)): ?>
                        
                        <?php foreach ($resultados as $resultado): ?>
                            <tr data-id="<?php echo $resultado->id ?>" class="rowAsistido">
                                <td><?php echo $resultado->nombre ?></td>
                                <td><?php echo $resultado->apellido ?></td>
                                <td><?php echo $resultado->dni ?></td>
                                <td><?php echo isset($resultado->created_at) ? (new DateTime($resultado->created_at))->format('d/m/Y') : '' ?> </td>
                                <td><?php echo isset($resultado->institucion) ? $resultado->institucion : '' ?></td>
                                <td class="text-center" style="vertical-align: middle;"> 
                                    <a href="{{route('asistido.show',['id'=>$resultado->id])}}" target="_blank" class="" data-id="" title="Ver detalles del asistido." data-toggle="tooltip" data-title="Ver Perfil"><i class="icon fa fa-search fa-2x fa-fw text-blue"></i></a>
                                </td> 
                            </tr>
                        <?php endforeach ?>

                        <?php endif ?>
                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>