<table class="table table-striped">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Fecha</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($pension as $data) {?>
        <tr class=" <?php echo ($data['status']==1)?>">
            <td><?= $data['idpension'];?></td>
            <td><?= $data['fecha_solicitud'];?></td>
            <td><?= $data['primer_nombre'];?></td>
            <td><?= $data['primer_apellido'];?></td>
            <td><?= $data['cedula'];?></td>
            <td><?= $data['telefono'];?></td>
            <td>
                <a href="#" class="btn btn-success btn-sm btn-edit" data-id="<?= $data['idpension'];?>">Aprobar</a>
                <a href="#" class="btn btn-danger btn-sm btn-delete" data-id="<?= $data['idpension'];?>">Desaprobado</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>