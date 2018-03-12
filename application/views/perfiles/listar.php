<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-list-ul"></i> Perfiles
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
                    <form method="POST" action="/perfiles/listar/">
                        <input class="form-control" type="text" placeholder="Perfil" name="perfil" autofocus>
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
                        <?php foreach ($perfiles as $perfil) { ?>
                            <tr>
                                <td class="text-center">
                                    <strong><?=$perfil['perfil']?></strong>
                                </td>
                                <td class="text-center pull-right">
                                    <a href="/perfiles/modificar/<?=$perfil['idperfil']?>/" class="btn btn-primary" data-placement="bottom" data-toggle="tooltip" data-original-title="Editar" class="tooltips">
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