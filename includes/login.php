<?php
    ob_start();
    include('includes/functions.php');
    $error = '';
    // check if log-in button is clicked
    if(isset($_POST['login_cl'])){
        $username = validateInput($_POST['username']);
        $password = validateInput($_POST['password']);
        // connect to database
        include('includes/connection.php');
        // get user info from database
        $query = "SELECT * FROM users WHERE username = '" . $username ."'";
        $result = mysqli_query($conn, $query);
        if( mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $confirm = $row['confirm'];
                $hashed_pass = $row['password'];
                $email = $row['email'];
            }
            // verify users password
            if (password_verify($password, $hashed_pass)){
                // if account has been activated (confirm is empty)
                if($confirm == "yes"){
                    //if correct, start the session
                    session_start();
                    //store data in variables
                    $_SESSION['logged_user'] = $username;
                    $_SESSION['logged_email'] = $email;
                    $_SESSION['logged_password'] = $password;
                    //redirect to clients.php
                    header('Location: clients.php');
                } else {
                    $error = '<div class="alert alert-warning">Your account has not been activated yet. Please 
                    activate your account using link that was sent to your e-mail address.</div>';
                }
            } else {
                // if password is not appropriate...
                $error = '<div class="alert alert-danger">Wrong username / password combination. <a href="resetpassword.php" class="alert-link">Forgot your password?</a></div>';
            }
        // if no such user, display an error.
        } else {
            $error = '<div class="alert alert-danger">No such user in database.<a class="close" data-dismiss = "alert">&times;</a></div>';
        }
        mysqli_close($conn);
    }


?>