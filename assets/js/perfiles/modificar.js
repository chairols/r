$(document).ready(function () {
    $("#html").jstree({});
    actualizar_checkbox(document.getElementById('idperfil').value, 0);
});

//$("#html").on('changed.jstree', function (e, data) {
//    if (data.selected.length) {
//        $(data.selected).each(function (idx) {
//            var node = data.instance.get_node(data.selected[idx]);
//            console.log("El nodo seleccionado es: " + node.text);
//            console.log(node.id);
//            console.log(node);
//            console.log(document.getElementById('idperfil').value);
//            actualizar_checkbox(document.getElementById('idperfil').value, node.id);
//        });
//    }
//});

function actualizar_checkbox(perfil, idmenu) {
    datos = {
        'perfil': perfil,
        'menu': idmenu
    };
    $.ajax({
        type: 'POST',
        url: '/perfiles/actualizar_checkbox_ajax/',
        data: datos,
        beforeSend: function () {
        },
        success: function (data) {
            $("#html").html(data);
        }
    });
}