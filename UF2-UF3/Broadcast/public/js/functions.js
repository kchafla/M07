window.onload = function() { 
    init(); 
};

function init() {
    var script_tag = document.getElementById('functions');
    var user_id = script_tag.getAttribute("user-id");

    Echo.private('user.' + user_id)

    .listen('NewMessageNotification', (e) => {
        alert(e.message.message);
    });
}