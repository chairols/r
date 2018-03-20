<link rel="stylesheet" href="/assets/addons_extra/jstree-3.3.5/dist/themes/default/style.min.css">

<div id="html" class='sans'>
    <ul>
        <?php foreach ($padres as $padre) { ?>
            <div id="checkbox-<?=$padre['idmenu'] ?>"></div>
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
    </ul>
</div>

<div class='sans'>Con Sans Pro</div>
Sin Sans Pro
<div id="asd"></div>
<pre>
    <?php print_r($padres); ?>
</pre>

<script type="text/javascript" src="/assets/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script type="text/javascript" src="/assets/addons_extra/jstree-3.3.5/dist/jstree.min.js"></script>

<script type="text/javascript">

    $("#html").jstree({

        //"plugins" : [ "types" ]
    });

    $("#html").on('changed.jstree', function (e, data) {
        if (data.selected.length) {
            $(data.selected).each(function (idx) {
                var node = data.instance.get_node(data.selected[idx]);
                console.log("El nodo seleccionado es: " + node.text);
                console.log(node.id);
                console.log(node);
            });
        }
    });


    $(document).ready(function () {
        $("#html li").each(function (e, data) {
            console.log(data.id);
            actualizar_checkbox(1, data.id);
        });
    });

    function actualizar_checkbox(perfil, idmenu) {
        datos = {
            'perfil': perfil,
            'menu': idmenu
        };
        $.ajax({
            type: 'POST',
            url: '/prueba/actualizar_checkbox/',
            data: datos,
            beforeSend: function () {
                $("#checkbox-"+idmenu).val("fjlkajf");
            },
            success: function (data) {
                $("#checkbox-"+idmenu).val(data);
                $("#asd").html(idmenu);
            }
        });
    }

</script>

<style type="text/css" media="screen">

    /*LOS NAVEGADORES MODERNOS*/
    @font-face{
        font-family:'Sans Pro Regular';
        src: url(/assets/SourceSansPro-Regular.ttf) format('truetype');
    }

    .sans {
        font-family: 'Sans Pro Regular'
    }

</style>
