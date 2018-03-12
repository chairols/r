<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="icon fa fa-list-ul"></i> Modificar Perfil
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Blank page</li>
        </ol>
    </section>

    <input type="hidden" id="idperfil" value="<?= $perfil['idperfil'] ?>">

    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">

            </div>
            <div class="box-body">
                <pre>
                    <?php print_r($session); ?>
                </pre>
                <div id="html">
<!--                    <ul>
                        <?php foreach ($padres as $padre) { ?>
                            <div id="checkbox-<?= $padre['idmenu'] ?>"></div>
                            <li data-jstree='{"opened":true}' id="<?= $padre['idmenu'] ?>"><?= $padre['titulo'] ?>
                                <ul>
                                    <?php foreach ($padre['hijos'] as $hijo) { ?>
                                        <div id="checkbox-<?= $hijo['idmenu'] ?>"></div>
                                        <li data-jstree='{"opened":true}' id="<?= $hijo['idmenu'] ?>"><?= $hijo['titulo'] ?>
                                            <ul>
                                                <?php foreach ($hijo['hijos'] as $h) { ?>
                                                    <div id="checkbox-<?= $h['idmenu'] ?>"></div>
                                                    <li id="<?= $h['idmenu'] ?>"><?= $h['titulo'] ?></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } ?>
                    </ul>-->
                </div>
<!--                <pre>
                    <?php print_r($padres); ?>
                </pre>-->
            </div>
        </div>
    </section>
</div>


