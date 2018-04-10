<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Modificar Comparación</h3>


        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        
        <pre>
            <?php print_r($benchmark) ?>
        </pre>

        <form class="col-sm-12 col-lg-12 col-xs-12 form-inline" method="GET">
            <div class="input-group col-sm-2 col-lg-2">
                <input class="form-control search-query" type="text" placeholder="Artículo" name="generico" value="<?=$generico?>" autofocus="">
            </div>
            <div class="input-group col-sm-2 col-lg-2">
                <input class="form-control search-query" type="text" placeholder="Proveedor" name="proveedor" value="<?=$proveedor?>">
            </div>
            <div class="input-group col-sm-2 col-lg-2">
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

        <table class="table table-bordered table-hover table-striped">
            <tbody>
                <?php foreach ($items as $item) { ?>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 text-center">
                                    <span class="text-muted">Código Genérico</span><br>
                                    <span class="label label-purple"><?= $item['generico'] ?></span>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                    <span class="text-muted">Stock</span><br>
                                    <span class="label label-default"><?= $item['abstract_stock'] ?></span>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                    <span class="text-muted">Stock Mínimo</span><br>
                                    <span class="label label-inverse"><?= ($item['abstract_stock'] + $item['abstract_stock_diff']) ?></span>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 text-center">
                                    <span class="text-muted">Balance Stock</span><br>
                                    <?php if ($item['abstract_stock_diff'] <= 0) { ?>
                                        <span class="label label-success"><?= ($item['abstract_stock_diff'] * -1) ?></span>
                                    <?php } else { ?>
                                        <span class="label label-danger"><?= $item['abstract_stock_diff'] ?></span>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-1 text-center">Posición</div>
                                <div class="col-xs-2 text-center">Proveedor</div>
                                <div class="col-xs-3 text-center">
                                    Cód. Prov -> Roller<br>
                                    Marca
                                </div>
                                <div class="col-xs-1 text-center">Precio</div>
                                <div class="col-xs-3 text-center">Stock</div>
                                <div class="col-xs-1 text-center">Ordenar</div>
                            </div>
                            <?php foreach ($item['articulos'] as $key => $articulo) { ?>
                                <div class="row">
                                    <?php
                                    $color = '';
                                    if ($key < 2) {
                                        $color = 'label-success';
                                    } elseif ($key == 2) {
                                        $color = 'label-warning';
                                    } else {
                                        $color = 'label-danger';
                                    }
                                    ?>
                                    <div class="col-xs-1 text-center">
                                        <label class="label <?= $color ?>"><?= ($key + 1) ?></label>
                                    </div>
                                    <div class="col-xs-2 text-center">
                                        <label class="label label-primary"><?= $articulo['compania'] ?></label>
                                    </div>
                                    <div class="col-xs-3 text-center">
                                        <label class="label label-inverse"><?= $articulo['codigo_proveedor'] ?></label> -> 
                                        <label class="label label-inverse"><?= $articulo['codigo_roller'] ?></label><br>
                                        <label class="label label-info"><?= $articulo['marca'] ?></label>
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        <label class="label label-success"><?= $articulo['precio'] ?></label>
                                    </div>
                                    <div class="col-xs-3 text-center">
                                        <label class="label label-info tooltip-info" data-rel="tooltip" data-placement="bottom" title="Stock del Proveedor"><?= $articulo['stock_proveedor'] ?></label> /
                                        <label class="label label-inverse tooltips" data-rel="tooltip" data-placement="bottom" title="Stock Mínimo"><?= ($item['abstract_stock'] + $item['abstract_stock_diff']) ?></label> /
                                        <label class="label label-warning tooltip-warning" data-rel="tooltip" data-placement="bottom" title="Stock Actual (Depósito + Importaciones)"><?= $articulo['abstract_stock'] ?></label> /
                                        <?php if ($item['abstract_stock_diff'] <= 0) { ?>
                                            <span class="label label-success tooltip-success" data-rel="tooltip" data-placement="bottom" title="Stock Sobrante"><?= ($item['abstract_stock_diff'] * -1) ?></span>
                                        <?php } else { ?>
                                            <span class="label label-danger tooltip-error" data-rel="tooltip" data-placement="bottom" title="Stock Faltante"><?= $item['abstract_stock_diff'] ?></span>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
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