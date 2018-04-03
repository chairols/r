<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Ver Comparaciones de Listas de Precios</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <br><br>

        <ul class="pagination pagination-sm pull-right">
            <?= $links ?>
        </ul>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Empresas</th>
                    <th>Marcas</th>
                    <th>Solo Stock Mínimo</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comparaciones as $comparacion) { ?>
                    <tr>
                        <td><?= $comparacion['creation_date'] ?></td>
                        <td>
                            <?php foreach ($comparacion['companias'] as $compania) { ?>
                                <span class="label label-primary"><?= $compania['name'] ?></span><br>
                            <?php } ?>
                        </td>
                        <td>
                            <?php foreach ($comparacion['marcas'] as $marca) { ?>
                                <span class="label label-purple"><?= $marca['name'] ?></span><br>
                            <?php } ?>
                        </td>
                        <td>
                            <?php if ($comparacion['stock_min'] == 'Y') { ?>
                                <strong>Si</strong>
                            <?php } else { ?>
                                <strong>No</strong>
                            <?php } ?>
                        </td>
                        <td>
                            <a href="/listas_de_precios/modificar/<?= $comparacion['comparation_id'] ?>/">
                                <span class="btn btn-info btn-sm tooltip-info" data-rel="tooltip" data-placement="bottom" title="Analizar">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="pull-left">
            <strong>Total <?= $total_rows ?> registros.</strong>
        </div>
        <ul class="pagination pagination-sm pull-right">
            <?= $links ?>
        </ul>
    </div>
</div>