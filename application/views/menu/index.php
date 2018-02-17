<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-list-ul"></i> Listado de Menúes
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <div class="content">
        <div class="box">
            <div class="box-header with-border">
                <span>
                    <form method="POST" action="/menu/">
                        <input class="form-control" type="text" placeholder="Buscar" name="titulo" autofocus>
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
                        <?php foreach ($menues as $menu) { ?>
                            <tr>
                                <td class="text-center">
                                    <strong><i class="<?=$menu['icono']?>"></i></strong><br>
                                    <strong><?=$menu['titulo']?></strong>
                                </td>
                                <td class="text-center">
                                    <strong>Locación</strong><br>
                                    <strong><?=$menu['menu']?></strong>
                                </td>
                                <td class="text-center">
                                    <strong>Link</strong><br>
                                    <strong><?=$menu['href']?></strong>
                                </td>
                                <td class="text-center">
                                    <strong>Visible</strong><br>
                                    <strong>
                                        <?php if($menu['visible'] == 1) { ?>
                                        <div class="label bg-green">SI</div>
                                        <?php } else { ?>
                                        <div class="label bg-red">NO</div>
                                        <?php } ?>
                                    </strong>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <?php
                    echo $links;
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>