<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-list-ul"></i> Usuarios
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <span>
                    <form method="POST" action="/usuarios/listar/">
                        <input class="form-control" type="text" placeholder="Buscar..." name="usuario" autofocus>
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
                        <?php foreach ($usuarios as $usuario) { ?>
                            <tr>
                                <td class="text-center">
                                    <strong><?= $usuario['first_name'] ?> <?= $usuario['last_name'] ?></strong>
                                </td>
                                <td class="text-center">
                                    Perfil <br>

                                </td>
                                <td class="text-center pull-right">
                                    <a href="#" class="btn bg-navy" data-placement="bottom" data-toggle="tooltip" data-original-title="Más información" class="tooltips">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                    <a href="#" class="btn btn-primary" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar" class="tooltips">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a class="btn btn-danger" data-placement="bottom" data-toggle="tooltip" data-original-title="Eliminar" class="tooltips">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>