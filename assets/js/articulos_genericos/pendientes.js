function borrar(idot, numero_ot) {
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
        ok: "Confirmar",
        cancel: "Cancelar"
    };

    alertify.confirm(
            "<strong>¿Está seguro?</strong>",
            "Se eliminará la Orden de Trabajo " + numero_ot,
            function () {
                $.ajax({
                    type: 'GET',
                    url: '/ots/borrar/' + idot,
                    //data: datos,
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
                            alertify.success("Se eliminó correctamente");
                        }
                    }
                });
            },
            function () {
                alertify.error("Se canceló la operación");
            }
    );
}
