<?php
    ob_start();
    session_start();
    if(isset($_SESSION['logged_user'])){
        header('Location: clients.php');
    }
    include('includes/header.php');
    include('includes/functions.php');
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="assets/js/script.js"></script>
<div class="container">
    <div class="row">


        <div class="col-xs-12">
            <?php
            if(isset($_GET['msg'])){
                $msg = $_GET['msg'];
                if($msg == 'reg'){
                    $alert = '<div class="alert alert-warning">Activation email has been sent to your address. 
                    Please activate your account in order to use it.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
            if(isset($_GET['msg1'])){
                $msg = $_GET['msg1'];
                if($msg == 'erru'){
                    $alert = '<div class="alert alert-warning">Username you have entered is invalid. The username 
                    must begin with a letter and has to be 5-15 characters long. Characters that are not allowed are:
                     ! &quot; @ # $ & ( ) = * ? / and \'<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                } elseif ($msg == 'exiu'){
                    $alert = '<div class="alert alert-warning">User with that username already exists.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
            if(isset($_GET['msg2'])){
                $msg = $_GET['msg2'];
                if($msg == 'errp'){
                    $alert = '<div class="alert alert-warning">Passwords you have entered don\'t match.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
            if(isset($_GET['msg3'])){
                $msg = $_GET['msg3'];
                if($msg == 'erre'){
                    $alert = '<div class="alert alert-warning">>E-mail you have entered is invalid.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                } elseif ($msg == 'exie'){
                    $alert = '<div class="alert alert-warning">User with that email already exists.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-xs-12 col-md-8 col-sm8">
            <h2>Register a new account.</h2>
            <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <div class="form-group">
                    <label class="sr-only" for="reg_username">Username</label>
                    <input type="text" id="reg_username" class="form-control" name="username" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="reg_email">E-mail</label>
                    <input type="email" id="reg_email" class="form-control" name="email" placeholder="Enter your e-mail">
                </div>
                <div class="form-group">
                <div class="form-group">
                    <label class="sr-only" for="reg_password">Password</label>
                    <input type="password" id="reg_password" class="form-control" name="password" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <label class="sr-only" for="confirm_reg_password">Password</label>
                    <input type="password" id="confirm_reg_password" class="form-control" name="confirm_password" placeholder="Confirm password">
                </div>
                </div>
                <input type="submit" name="register_cl" class="btn btn-primary" id="reg_button" value="Register" style="visibility: hidden">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
if(isset($_POST['register_cl'])) {
    $msg1 = $msg2 = $msg3 = '';
    if (isset($_POST['username'])) {
        $reg_username = validateUsername(validateInput($_POST['username']));
        if ($reg_username == '') {
            $msg1 = "erru";
        } elseif($reg_username == 'exists'){
            $msg1 = "exiu";
        }
    }
    if (isset($_POST['password']) && $_POST['confirm_password']) {
        $reg_password = validatePassword(validateInput($_POST['password']), validateInput($_POST['confirm_password']));
        if ($reg_password == '') {
            $msg2 = "errp";
        }
    }
    if (isset($_POST['email'])) {
        $reg_email = validateEmail(validateInput($_POST['email']));
        if($reg_email == '') {
            $msg3 = "erre";
        } elseif($reg_email == 'exists'){
            $msg3 = "exie";
        }
    }
    if($msg1 != '' || $msg2 != '' || $msg3 != ''){
        header('location: registration.php?msg1='.$msg1.'&msg2='.$msg2.'&msg3='.$msg3);
    } else {
        include('includes/connection.php');
        $md5 = md5($reg_username . $reg_email . time());
        $query = "INSERT INTO users (username, password, email, confirm) VALUES ('" . $reg_username . "', '" .
        password_hash($reg_password, PASSWORD_DEFAULT) . "', '" . $reg_email . "', '" . $md5 . "')";
        mysqli_query($conn, $query);
        mysqli_close($conn);
        sendMail($md5, $reg_email);
        header('location: index.php?msg=reg');
    }
}
include('includes/footer.php');
?>

