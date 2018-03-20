$('#color').ace_colorpicker();

$('#cuit').mask('99-99999999-9');

function guardar() {
    alertify.defaults.transition = "slide";
    alertify.defaults.theme.ok = "btn btn-success";
    alertify.defaults.theme.cancel = "btn btn-danger";
    alertify.defaults.theme.input = "form-control";
    alertify.defaults.notifier = {
        delay: 3,
        position: 'bottom-right',
        closeButton: false
    };
    alertify.defaults.glossary = {
        ok: "Agregar",
        cancel: "Cancelar"
    };

    alertify.confirm(
            "<strong>¿Desea agregar?</strong>",
            "Se agregará "+$("#nombre").val(),
            function () {
                datos = {
                    'nombre' : $("#nombre").val(),
                    'cuit' : $("#cuit").val(),
                    'color' : $("#color").val()
                };
                $.ajax({
                    type: 'POST',
                    url: '/cuit/agregar_ajax/',
                    data: datos,
                    beforeSend: function () {

                    },
                    success: function (data) {
                        alertify.defaults.glossary = {
                            ok: "Aceptar",
                        };
                        resultado = $.parseJSON(data);
                        if (resultado['status'] == 'error') {
                            alertify.alert('<strong>ERROR</strong>', resultado['data']);
                        } else if (resultado['status'] == 'ok') {
                            alertify.success("Se agregó correctamente");
                        }
                    }
                });
            },
            function () {
                alertify.error("Se canceló la operación");
            }
    );
}