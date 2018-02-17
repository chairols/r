<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="icon fa fa-certificate"></i> Artículos Genéricos
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <span>
                    <form method="POST" action="/articulos_genericos/pendientes/">
                        <input class="form-control" type="text" placeholder="Artículo" name="code" autofocus>
                    </form>
                </span>
                <br>
                <div class="pull-left">
                    <strong>Total <?= $total_rows ?> registros.</strong>
                </div>
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?php
                    echo $links;
                    ?>
                </ul>
            </div>
            <div class="box-body">
                <table class="table table-hover table-striped">
                    <tbody>
                        <?php foreach ($productos as $producto) { ?>
                            <tr>
                                <td class="text-center">
                                    <strong><?= $producto['code'] ?></strong>
                                </td>
                                <td class="text-center">
                                    <span><strong>Línea</strong></span><br>
                                    <span class="label label-default"><strong><?= $producto['title'] ?></strong></span>
                                </td>
                                <td class="text-center">
                                    <span><strong>Artículos</strong></span><br>
                                    <span class="label label-info"><strong><?= count($producto['productos']) ?></strong></span>
                                </td>
                                <td class="text-center">
                                    <span><strong>Stock</strong></span><br>
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
                                <td class="text-center pull-right">
                                    <a href="#" class="btn bg-navy" data-placement="bottom" data-toggle="tooltip" data-original-title="Más información" class="tooltips">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar" class="tooltips">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a onclick="borrar(5, <?= $producto['abstract_id'] ?>);" class="btn btn-danger" data-placement="bottom" data-toggle="tooltip" data-original-title="Eliminar" class="tooltips">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?php
                    echo $links;
                    ?>
                </ul>
            </div>
            <!-- /.box-footer-->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>
<script type="text/javascript" src="/assets/js/articulos_genericos/pendientes.js"></script>