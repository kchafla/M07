window.onload = function() { 
    init(); 
};

function init() {
    //FORMULARIO DE NUEVA PUBLICACIÓN
    function NuevoPost($nuevopost) {
        $nuevopost.submit(function(event) {
            event.preventDefault();
    
            let datos = new FormData();
            datos.append("_token", $("#token").attr("content"));
            datos.append("cuerpo", $nuevopost.children("#cuerpo").val());
            
            let imagen = $nuevopost.children("#imagen").prop('files')[0];
            if (imagen != undefined) {
                datos.append("imagen", $nuevopost.children("#imagen").prop('files')[0]);
            }
            
            $.ajax({
                type: "POST",
                url: $nuevopost.attr("action"),
                data: datos,
                processData: false,
                contentType: false,
                error: function(data) {
                    let $errors = $("#errors");
                    $errors.fadeIn().text("");
                    $.each(data.responseJSON.errors, function(key, value) {
                        if (key == "imagen") {
                            $.each(value, function(k, v) {
                                $errors.append(v + "<br>");
                            });
                        } else {
                            $errors.append(value + "<br>");
                        }
                    });
                    setTimeout(function() {
                        $errors.fadeOut();
                    }, 3000);
                },
                success: function() {
                    $nuevopost.children("#cuerpo").val("");
                    $nuevopost.children("#imagen").val(undefined);
                }
            });
        });
    }
    NuevoPost($("#nuevopost"));
    

    //FORMULARIO DE NUEVO LIKE
    function NuevoLike($nuevolike) {
        $nuevolike.each(function(i, element) {
            $(element).submit(function(event) {
                event.preventDefault();
    
                let datos = new FormData();
                datos.append("_token", $("#token").attr("content"));
                datos.append("id", $(element).children("#id").val());
    
                $.ajax({
                    type: "POST",
                    url: $(element).attr("action"),
                    data: datos,
                    processData: false,
                    contentType: false,
                    success: function() {
                        $darlike = $("#" + $(element).children("#id").val() + " #darlike");
                        if ($darlike.attr("class") == "btn btn-danger") {
                            $darlike.text("").append("<i class='far fa-thumbs-up'></i>").append(" Me gusta").attr("class", "btn btn-primary");
                        } else {
                            $darlike.text("").append("<i class='fas fa-thumbs-down'></i>").append(" No me gusta").attr("class", "btn btn-danger");
                        }
                    }
                });
            });
        });
    }
    NuevoLike($("#nuevolike"));
    
    //FORMULARIO DE NUEVO COMENTARIO
    function NuevoComment($nuevocomment) {
        $nuevocomment.each(function(i, element) {
            $(element).submit(function(event) {
                event.preventDefault();
        
                let datos = new FormData();
                datos.append("_token", $("#token").attr("content"));
                let id = $(element).children("#id").val();
                datos.append("id", id);
                datos.append("mensaje", $(element).children("#mensaje").val());
                
                $.ajax({
                    type: "POST",
                    url: $(element).attr("action"),
                    data: datos,
                    processData: false,
                    contentType: false,
                    error: function(data) {
                        let $errors = $("#" + id + " #errorscomment");
                        $errors.fadeIn().text("");
                        $.each(data.responseJSON.errors, function(key, value) {
                            $errors.append(value + "<br>");
                        });
                        setTimeout(function() {
                            $errors.fadeOut();
                        }, 3000);
                    },
                    success: function() {
                        $(element).children("#mensaje").val("");
                    }
                });
            });
        });
    }
    NuevoComment($("#nuevocomment"));

    //ENVIAR EVENTO DE WHISPER
    $("#cuerpo").keydown(function() {
        let $user = $("#user").attr("name");

        Echo.private('portada')
        .whisper('escribiendo', {
            texto: "El usuario " + $user + " está escribiendo..."
        });
    });

    Echo.private('portada')
    //RECIBIR EVENTO DE WHISPER
    .listenForWhisper('escribiendo', (e) => {
        $("#escribiendo").fadeIn().text(e.texto);

        setTimeout(function() {
            $("#escribiendo").fadeOut();
        }, 2000);
    })
    //RECIBIR EVENTO DE NUEVA PUBLICACIÓN
    .listen('NewPostNotification', (e) => {
        let $alerta = $("#alerta").text("Hay una nueva publicación!");
        $alerta.fadeIn();
        setTimeout(function() {
            $alerta.fadeOut();
        }, 5000);

        let tiempo = e.post.created_at;
        let $p1 = $("<p>").append($("<span>").text("Publicación de " + e.post.from + " ").attr("class", "h5")).append($("<span>").text(tiempo.substring(0,19).replace("T", " ")).attr("class", "text-muted"));
        let $p2 = $("<p>").text(e.post.body);
        let $div = $("<div>").append($p1).append($p2).attr("id", e.post.id).hide();
        if (e.post.image != "NULL") {
            $div.append($("<img>").attr("src", e.post.image).attr("class", "img-fluid"));
        }

        //FORMULARIO PARA DARLE A LIKE
        let $formlikes = $("<form>").attr("id", "nuevolike").attr("action", "like");
        $formlikes.append($("<input>").attr("type", "hidden").attr("name", "id").attr("id", "id").attr("value", e.post.id));
        let $p = $("<p>");
        $p.append($("<span>").attr("id", "likes").text(0)).append(" Likes ");
        $p.append($("<button>").attr("class", "btn btn-primary").attr("id", "darlike").append($("<i>").attr("class", "far fa-thumbs-up")).append(" Me gusta"));
        $formlikes.append($p);
        ////////////////////

        let $header = $("<p>").text("Comentarios").attr("class", "h5");
        let $comments = $("<div>").attr("id", "comentarios");

        //FORMULARIO PARA PUBLICAR UN COMENTARIO
        let $diverrors = $("<div>").attr("id", "errorscomment").attr("class", "alert alert-danger").attr("style", "display: none;")
        let $formcomment = $("<form>").attr("id", "nuevocomment").attr("action", "comment");
        $formcomment.append($("<input>").attr("type", "hidden").attr("name", "id").attr("id", "id").attr("value", e.post.id));
        $formcomment.append($("<input>").attr("type", "text").attr("name", "mensaje").attr("id", "mensaje"));
        $formcomment.append($("<button>").attr("class", "btn btn-dark").text("Enviar comentario"));
        ////////////////////

        $div.append("<br>").append($formlikes).append("<br>").append($header).append($comments).append($formcomment).append($("<br>")).append($diverrors);

        $("#publicaciones").prepend($div.append("<br><hr><br>"));
        $div.slideDown();

        $("#nuevolike").off("submit");
        NuevoLike($("#nuevolike"));
        $("#nuevocomment").off("submit");
        NuevoComment($("#nuevocomment"));
    })
    //RECIBIR EVENTO DE NUEVO LIKE
    .listen('NewLikeNotification', (e) => {
        let $alerta = $("#alerta").text("Alguien le ha dado me gusta a una publicación!");
        $alerta.fadeIn();
        setTimeout(function() {
            $alerta.fadeOut();
        }, 5000);

        $("#" + e.like.post_id + " #likes").hide(50, function() {
            let numero = parseInt($(this).text());
            $(this).text(numero + 1).slideDown(200);
        });
    })
    //RECIBIR EVENTO DE NUEVO DISLIKE
    .listen('NewDislikeNotification', (e) => {
        $("#" + e.like.post_id + " #likes").hide(50, function() {
            let numero = parseInt($(this).text());
            $(this).text(numero - 1).slideDown(200);
        });
    })
    //RECIBIR EVENTO DE NUEVO COMENTARIO
    .listen('NewCommentNotification', (e) => {
        let $alerta = $("#alerta").text("Hay un nuevo comentario!");
        $alerta.fadeIn();
        setTimeout(function() {
            $alerta.fadeOut();
        }, 5000);

        let tiempo = e.comment.created_at;
        let $p = $("<p>").text(e.comment.from + " a las " + tiempo.substring(0,19).replace("T", " ") + ": " + e.comment.body).hide();
        $("#" + e.comment.post_id + " #comentarios").append($p);
        $p.slideDown(200);
    });
}