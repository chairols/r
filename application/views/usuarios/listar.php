<div class="row">
    <div class="col-xs-12">
        <h3 class="header smaller lighter blue">Listado de Usuarios</h3>

        <div class="clearfix">
            <div class="pull-right tableTools-container"></div>
        </div>
        
        <form class="col-sm-8 col-lg-8 col-xs-12" method="GET" action="/usuarios/listar/">
            <div class="input-group">
                <input class="form-control search-query" type="text" placeholder="Buscar..." name="usuario" autofocus="">
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
                    <th>Perfil</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) { ?>
                <tr>
                    <td><?= $usuario['first_name'] ?> <?= $usuario['last_name'] ?></td>
                    <td><span class="label label-primary"><strong><?=$usuario['perfil']?></strong></span></td>
                    <td>
                        <a class="green" href="#">
                            <i class="ace-icon fa fa-pencil bigger-150"></i>
                        </a>
                        <a class="red" href="#">
                            
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
            <?=$links?>
        </ul>
        
    </div>
</div>

