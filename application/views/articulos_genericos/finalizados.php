<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Listado de Artículos Genéricos Pendientes</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>

        <form class="col-sm-8 col-lg-8 col-xs-12" method="GET">
            <div class="input-group">
                <input class="form-control search-query" type="text" placeholder="Artículo" name="code" autofocus="">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <span class="ace-icon fa fa-search icon-on-right bigger-110"> Buscar</span>
                    </button>
                </span>
            </div>
        </form>

        <br><br>

        <ul class="pagination pagination-sm pull-right">
            <?= $links ?>
        </ul>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Artículo</th>
                    <th>Línea</th>
                    <th>Artículos Asociados</th>
                    <th>Stock</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td><strong><?= $producto['code'] ?></strong></td>
                        <td><span class="label label-primary"><strong><?= $producto['title'] ?></strong></span></td>
                        <td class="text-center">
                            <span class="label label-info"><strong><?= count($producto['productos']) ?></strong></span>
                        </td>
                        <td class="text-center">
                            <?php
                            $color = '';
                            switch ($producto['stock']) {
                                case null:
                                case 0:
                                    $color = 'label label-danger';
                                    $producto['stock'] = 0;
                                    break;
                                default:
                                    $color = 'label label-primary';
                                    break;
                            }
                            ?>
                            <span class="<?= $color ?>"><?= $producto['stock'] ?></span>
                        </td>
                        <td></td>
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


<script type="text/javascript" src="/assets/js/articulos_genericos/pendientes.js"></script>