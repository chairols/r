<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Listado de CUIT</h3>
        
        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        
        <form class="col-sm-8 col-lg-8 col-xs-12" method="GET">
            <div class="input-group">
                <input class="form-control search-query" type="text" placeholder="Buscar..." name="codigo" autofocus="">
                <span class="input-group-btn">
                    <button class="btn btn-primary btn-sm" type="submit">
                        <span class="ace-icon fa fa-search icon-on-right bigger-110"> Buscar</span>
                    </button>
                </span>
            </div>
        </form>
        
        <br><br>
        
        <ul class="pagination pagination-sm pull-right">
            <?=$links?>
        </ul>
        
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>CUIT</th>
                    <th>Color</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($cuits as $cuit) { ?>
                <tr>
                    <td><?=$cuit['nombre']?></td>
                    <td><?=$cuit['cuit']?></td>
                    <td><span class="badge" style="background-color: <?=$cuit['color']?>"><?=$cuit['color']?></span></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <div class="pull-left">
            <strong>Total <?= $total_rows ?> registros.</strong>
        </div>
        <ul class="pagination pagination-sm pull-right">
            <?=$links?>
        </ul>
    </div>
</div>