<?php
    ob_start();
    session_start();
    if(isset($_SESSION['logged_user'])){
        header('Location: clients.php');
    }
    include('includes/login.php');
    include('includes/header.php');

?>
<div class="container">
    <div class="row">


        <div class="col-xs-12">
            <?php echo $error; ?>
            <?php
            if(isset($_GET['msg'])){
               $msg = $_GET['msg'];
                if($msg == 'out'){
                    $alert = '<div class="alert alert-warning">You have logged out.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                } elseif($msg == 'conf'){
                    $alert = '<div class="alert alert-success">Your account has been confirmed. You can log in now.<a
                     class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-xs-12 col-md-8 col-sm8">
            <h2>Log in to you account.</h2>
            <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <label class="sr-only" for="login_username">Username</label>
                <input type="text" id="login_username" class="form-control" name="username" placeholder="Username">
                <label class="sr-only" for="login_password">Password</label>
                <input type="password" id="login_password" class="form-control" name="password" placeholder="Password">
                <input type="submit" name="login_cl" class="btn btn-primary" value="Log in">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<?php
    include('includes/footer.php');
?>
