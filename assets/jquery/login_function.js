class MyFunctions extends Login{}
let lg = new MyFunctions();
$(document).ready(function() {
    $(".login").on("click", function () {
        $("#msg").html("Working...");
        lg.check_auth($("#user_id").val(), $("#user_key").val());
    });
});
