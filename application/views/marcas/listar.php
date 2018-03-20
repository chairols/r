<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Listado de Marcas</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        <div class="table-header">
            &nbsp;
        </div>

        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th>Marca</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marcas as $marca) { ?>
                    <tr>
                        <td><?= $marca['name'] ?></td>
                        <td>
                            <?php if($marca['status'] == 'A') { ?>
                            <span class="label label-sm label-success arrowed">Activo</span>
                            <?php } else { ?>
                            <span class="label label-sm label-danger arrowed">Inactivo</span>
                            <?php } ?>
                        </td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>