window.onload = function() { 
    init(); 
};

function init() {
    //MENSAJES
    $.get("usuarios", function(usuaris) {
        let noms = [];

        $("#users").append("<option selected='true' hidden='true' disabled='disabled'>Usuarios...</option>");
        usuaris.forEach(usuari => {
            $("#users").append($("<option>").val(usuari.id).text(usuari.name));
            noms.push(usuari.name);
        });

        var anterior;
        $("#users").on("focus", function() {
            anterior = parseInt(this.value);
        }).change(function() {
            let connectat = parseInt($("#user_id").attr("name"));
            let enviar = parseInt($("#users").val());

            $.get("mensajes")
            .done(function(mensajes) {
                $("#mensajes").text("");
                mensajes.forEach(mensaje => {
                    if ((mensaje.to == $("#user_id").attr("name") && mensaje.from == $("#users").val()) || mensaje.from == $("#user_id").attr("name") && mensaje.to == $("#users").val()) {
                        $("#mensajes").append($("<p>").text(noms[mensaje.from-1] + " a las " + mensaje.created_at.substring(0,19).replace("T", " ") + " - " + mensaje.message));
                    }
                });
            });

            if (anterior > connectat) {
                Echo.private("user." + anterior + "." + connectat).stopListening("NewMessageNotification");
            } else if (anterior < connectat) {
                Echo.private("user." + connectat + "." + anterior).stopListening("NewMessageNotification");
            } else {
                Echo.private("user." + connectat + "." + connectat).stopListening("NewMessageNotification");
            }

            if (connectat > enviar) {
                Echo.private("user." + connectat + "." + enviar)
                .listen("NewMessageNotification", function(e) {
                    $("#mensajes").prepend($("<p>").text(noms[e.message.from-1] + " a las " + e.message.created_at.substring(0,19).replace("T", " ") + " - " + e.message.message));
                });
            } else if (connectat < enviar) {
                Echo.private("user." + enviar + "." + connectat)
                .listen("NewMessageNotification", function(e) {
                    $("#mensajes").prepend($("<p>").text(noms[e.message.from-1] + " a las " + e.message.created_at.substring(0,19).replace("T", " ") + " - " + e.message.message));
                });
            } else {
                Echo.private("user." + enviar + "." + enviar)
                .listen("NewMessageNotification", function(e) {
                    $("#mensajes").prepend($("<p>").text(noms[e.message.from-1] + " a las " + e.message.created_at.substring(0,19).replace("T", " ") + " - " + e.message.message));
                });
            }

            anterior = parseInt(this.value);
        });
    });

    function NuevoMensaje($nuevomensaje) {
        $nuevomensaje.submit(function(event) {
            event.preventDefault();

            let datos = new FormData();
            datos.append("_token", $("#token").attr("content"));
            if ($("#users").val() != undefined) {
                datos.append("to", $("#users").val());
            }
            datos.append("cuerpo", $nuevomensaje.children("#cuerpo").val());
            
            $.ajax({
                type: "POST",
                url: $nuevomensaje.attr("action"),
                data: datos,
                processData: false,
                contentType: false,
            }).success(function() {
                $nuevomensaje.children("#cuerpo").val("");

            }).error(function(data) {
                let $errors = $("#errors");
                $errors.fadeIn().text("");
                $.each(data.responseJSON.errors, function(key, value) {
                    $errors.append(value + "<br>");
                });
                setTimeout(function() {
                    $errors.fadeOut();
                }, 3000);
            });
        });
    }

    NuevoMensaje($("#nuevomensaje"));
}