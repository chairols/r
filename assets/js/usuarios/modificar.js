function modificar() {
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
        ok: "Modificar",
        cancel: "Cancelar"
    };

    alertify.confirm(
            "<strong>¿Desea confirmar?</strong>",
            "Se modificará el usuario "+$("#usuario").val(),
            function () {
                datos = {
                    'idusuario' : $("#idusuario").val(),
                    'usuario' : $("#usuario").val(),
                    'password' : $("#password").val(),
                    'password2' : $("#password2").val(),
                    'email' : $("#email").val(),
                    'nombre' : $("#nombre").val(),
                    'apellido' : $("#apellido").val(),
                    'perfil': $("#perfil").val()
                };
                $.ajax({
                    type: 'POST',
                    url: '/usuarios/modificar_ajax/',
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
                            alertify.success("Se modificó correctamente el usuario");
                        }
                    }
                });
            },
            function () {
                alertify.error("Se canceló la operación");
            }
    );
}