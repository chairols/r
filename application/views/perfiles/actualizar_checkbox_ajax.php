<ul>
    <?php foreach ($padres as $padre) { ?>
        <div id="checkbox-<?= $padre['idmenu'] ?>"></div>
        <li data-jstree='{"opened":true}' id="<?= $padre['idmenu'] ?>">
            <a onclick="actualizar_checkbox(<?= $perfil['idperfil'] ?>, <?= $padre['idmenu'] ?>);">
                <?php if ($padre['menu'] != null) { ?>
                    <div class="fa fa-check-square-o"> <?= $padre['titulo'] ?></div>
                <?php } else { ?>
                    <div class="fa fa-square-o"> <?= $padre['titulo'] ?></div>
                <?php } ?>
            </a>
            <ul>
                <?php foreach ($padre['hijos'] as $hijo) { ?>
                    <div id="checkbox-<?= $hijo['idmenu'] ?>"></div>
                    <li data-jstree='{"opened":true}' id="<?= $hijo['idmenu'] ?>">
                        <a onclick="actualizar_checkbox(<?= $perfil['idperfil'] ?>, <?= $hijo['idmenu'] ?>);">
                            <?php if ($hijo['menu'] != null) { ?>
                                <div class="fa fa-check-square-o"> <?= $hijo['titulo'] ?></div>
                            <?php } else { ?>
                                <div class="fa fa-square-o"> <?= $hijo['titulo'] ?></div>
                            <?php } ?>
                        </a>
                        <ul>
                            <?php foreach ($hijo['hijos'] as $h) { ?>
                                <div id="checkbox-<?= $h['idmenu'] ?>"></div>
                                <li id="<?= $h['idmenu'] ?>">
                                    <a onclick="actualizar_checkbox(<?= $perfil['idperfil'] ?>, <?= $h['idmenu'] ?>);">
                                        <?php if ($h['menu'] != null) { ?>
                                            <div class="fa fa-check-square-o"> <?= $h['titulo'] ?></div>
                                        <?php } else { ?>
                                            <div class="fa fa-square-o"> <?= $h['titulo'] ?></div>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
</ul>


<link rel="stylesheet" href="/assets/addons_extra/jstree-3.3.5/dist/themes/default/style.min.css">
<script src="/assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="/assets/addons_extra/jstree-3.3.5/dist/jstree.min.js"></script>

<script type="text/javascript">
                                    $("#html").jstree({});
</script>