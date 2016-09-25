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
        <h2>Set new password.</h2>
        <p class="text-info">Please enter new password.</p>
        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
            <label class="sr-only" for="enter_new_password">New password</label>
            <input type="text" id="enter_new_password" class="form-control" name="password" placeholder="Enter password">
            <label class="sr-only" for="enter_new_password_again">New password again</label>
            <input type="text" id="enter_new_password_again" class="form-control" name="new_password" placeholder="Enter password">

            <input type="submit" name="set_cl" class="btn btn-primary" value="Confirm">
        </form>
    </div>
    <div class="col-md-2"></div>
</div>
</div>

<?php
include('includes/footer.php');
?>

