$(document).ready(function() {
                // regular expression for validating email
                var regEmail = new RegExp("^[a-zA-Z0-9]{1}[a-zA-Z0-9\.\-_]*@[a-zA-Z0-9]+?(\.[a-zA-Z0-9]+)+$");
                var regUsername = new RegExp("^[a-zA-Z]{1}[^@\"\'#$!&/()=?* ]{4,15}$");
                 // setting email indicator to false
                var testEmail = false,
                    testPassword = false,
                    testUsername = false;
                // show button that was hidden if user disables javascript
                $("#reg_button").removeAttr("style");
                // disabling submit button
                // checking "on blur" if input fields contain value, if not, displaying error message


                /* =====================================================
                            "ON BLUR" VALIDATE FUNCTIONS
                 ===================================================== */
                $(".form-control").on("blur", function(){
                    // first, remove warning messages if they exist
                    $(this).parent().removeClass("has-success");
                    $(this).parent().removeClass("has-error");
                    $(this).prev(".text-danger").remove();
                    // if field has no value...
                    if($(this).val() == "") {
                        // display error message
                        $(this).prev(".text-warning").remove();
                        $("<small class='text-danger'>* This field is required.</small>").insertBefore(this);
                        $(this).parent().addClass("has-error");
                    } else {
                        $(this).parent().addClass("has-success");
                    }
                });

                // validating password "on blur"
                //==============================
                $("#confirm_reg_password, #reg_password").on("blur", function(){
                    // first, remove warning messages if they exist
                    $(this).parent().parent().removeClass("has-success");
                    $(this).parent().parent().removeClass("has-warning");
                    $("#reg_password").prev(".text-warning").remove();
                    // if fields are not empty..
                    if($("#reg_password").val() != "" && $("#confirm_reg_password").val() != "") {
                        // ... but don't have the same value...
                        if ($("#reg_password").val() != $("#confirm_reg_password").val()) {
                               // display warning message
                               $("<small class='text-warning'>* Entered passwords do not match.</small>").insertBefore("#reg_password");
                               $(this).parent().parent().addClass("has-warning");

                            } else {
                                $(this).parent().parent().addClass("has-success");
                             }
                        }
                });


                // validating email "on blur"
                //==============================
                $("#reg_email").on("blur", function(){
                    // first, remove warning messages if they exist
                    $(this).parent().removeClass("has-warning");
                    $(this).parent().removeClass("has-success");
                    $("#reg_email").prev(".text-warning").remove();
                    var email = $("#reg_email").val();
                    // if email is not empty..
                    if(email != "") {
                        // ... but it's not valid...
                        if (!(regEmail.test(email))) {
                            // display warning message
                            $("<small class='text-warning'>* Entered e-mail is not appropriate.</small>").insertBefore("#reg_email");
                            $(this).parent().addClass("has-warning");
                        } else {
                            $(this).parent().addClass("has-success");
                        }
                    }
                });

                 // validating username "on blur"
                //==============================
                $("#reg_username").on("blur", function(){
                    $(this).parent().removeClass("has-warning");
                    $(this).parent().removeClass("has-success");
                    // first, remove warning messages if they exist
                    $("#reg_username").prev(".text-warning").remove();
                    var username = $("#reg_username").val();
                    // if username is not empty..
                    if(username != "") {
                        // ... but it's not valid...
                        if (!(regUsername.test(username))) {
                            // display warning message
                            $("<small class='text-warning'>* The username must begin with a letter and has to be 5-15" +
                                " characters long. Characters that are not allowed are: ! &quot; @ # $ & ( ) = * ? / and" +
                                " ' " +
                                " </small>").insertBefore("#reg_username");
                            $(this).parent().addClass("has-warning");
                        } else {
                            $(this).parent().addClass("has-success");
                        }
                    }
                });

                /* =====================================================
                            SEPARATE VALIDATE FUNCTIONS
                ===================================================== */
                    function validateUsername(){
                        var username = $("#reg_username").val();
                        if(username.length>0){
                            if (regUsername.test(username)) {
                                return true;
                            } else{
                                return false;
                            }
                        } else {
                            return false;
                        }
                    }

                    function validateEmail(){
                        var email = $("#reg_email").val();
                        if(email.length > 0) {
                            if (regEmail.test(email)) {
                                return true;
                            } else {
                                return false;
                            }

                        }else {
                            return false;
                        }
                    }

                    function validatePassword(){
                        if($("#reg_password").val().length > 0 && $("#confirm_reg_password").val().length > 0) {
                            if ($("#reg_password").val() == $("#confirm_reg_password").val()) {
                                return true;
                            } else {
                                return false;
                            }
                        }else{
                            return false;
                        }
                    }
            //=====================================================
            $(".form-control").on("blur", function(){
                $("#reg_button").removeClass("btn-danger")
                $("#reg_button").removeClass("btn-success");
                testUsername = validateUsername();
                testEmail = validateEmail();
                testPassword = validatePassword();
                if (testUsername != true || testEmail != true || testPassword != true) {
                    $("#reg_button").addClass("btn-danger");
                }else{
                    $("#reg_button").addClass("btn-success");
                }
            });

            $("#reg_button").on("click", function(){
                testUsername = validateUsername();
                testEmail = validateEmail();
                testPassword = validatePassword();
                if (testUsername != true || testEmail != true || testPassword != true) {
                    return false;
                }
            });
});

