<?php
ob_start();
session_start();
if(isset($_SESSION['logged_user'])){
    header('Location: clients.php');
}
include('includes/header.php');
include('includes/functions.php');
?>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-xs-12 col-md-8 col-sm8">
            <h2>Reset your password.</h2>
            <p class="text-info">Please enter your e-mail address. Link for resetting will be sent to that address.</p>
            <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                <label class="sr-only" for="reset_username">E-mail</label>
                <input type="text" id="reset_username" class="form-control" name="username" placeholder="Enter e-mail">

                <input type="submit" name="reset_cl" class="btn btn-primary" value="Reset">
            </form>
        </div>
        <div class="col-md-2"></div>
    </div>
    </div>

<?php
include('includes/footer.php');
?>

