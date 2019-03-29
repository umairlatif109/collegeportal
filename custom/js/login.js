fileurl ="http://localhost/collegeportal/php_actions/";

$("#Login").submit(function(){

    username = $("#username").val();
    password = $("#password").val();
   $(".text-danger").remove();
    if(username == ""){
        $("#username").closest(".form-group").addClass("has-danger");
        $("#username").after("<p class='text-danger'>Enter <b>Username</b></p>");
    }
    else{
        $(".text-danger").remove();
        $("#username").closest(".form-group").removeClass("has-danger").addClass("has-success text-success");
    }
    if(password == ""){
        $("#password").closest(".form-group").addClass("has-danger");
        $("#password").after("<p class='text-danger'>Enter <b>Password</b></p>");
    }
    else{
        $(".text-danger").remove();
        $("#password").closest(".form-group").removeClass("has-danger").addClass("has-success text-success");
    }
    
    if(username && password){
       form = $(this);
       $.ajax({
           url: form.attr("action"),
           method:form.attr("method"),
           data:form.serialize(),
           dataType:"json",
           success:function(result){
               if(result.success == false){
                    $(".message").html("<div class='alert alert-danger text-center' role='alert'><i class='glyphicon glyphicon-exclamation-sign'></i> "+ result.message +"</div>");
                    $('.alert-danger').show(0).delay(2000).hide(0);
                    form[0].reset();
                    $(".form-group").removeClass("text-success");
                    $(".form-group").removeClass("text-success");
                    $("#username").focus();
               }
               if(result.success == true){
                    location.reload();
               }
           }
       });
    }

    return false;
});


