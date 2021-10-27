class Login{
    check_auth(user_id, user_key){
        return new Promise(function(resolve, reject) {
            $(".msg").html("Loading...")
            $.getJSON("check_login", {user_id: user_id, user_key: user_key}, function (jsn) {
                let code = parseInt(jsn["msg"]);
                if(code == '1'){
                    window.location.href = "redirector";
                }else if(code == '2'){
                    $(".msg").html("<strong class='text-danger'>Error: - Invalid Password</strong>");
                }else if(code == '3'){
                    $(".msg").html("<strong class='text-danger'>Error: - Invalid User ID</strong>");
                }else if(code == '4'){
                    $(".msg").html("<strong class='text-danger'>Error: - Prohibited Access</strong>");
                }else if(code == '5'){
                    $(".msg").html("<strong class='text-danger'>Error: - Unauthorized Access</strong>");
                }
            });
        });
    }
}