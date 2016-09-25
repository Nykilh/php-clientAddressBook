<?php
    ob_start();
    session_start();

    //if user is not logged in, prevent page access
    if(!$_SESSION['logged_user']){
        //send him back to login page
        header('Location: index.php');
    }
    $activeUser = $_SESSION['logged_user'];
    include('includes/header.php');
    include('includes/connection.php');

    function encryptData($data){
        $password = $_SESSION['logged_password'];
        $salt = substr(md5(mt_rand(), true), 8);

        $key = md5($password . $salt, true);
        $iv  = md5($key . $password . $salt, true);

        $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

        return trim(base64_encode('Salted__' . $salt . $ct));
    }

?>
<div class="container">
    <div class="row">
        <?php
        if(isset($_GET['controln'])){
            if($_GET['controln'] == 1) {
                echo '<div class="alert alert-warning">You have to enter a name.</div>';
            }
        }

        if(isset($_GET['controle'])) {
            if ($_GET['controle'] == 1) {
                echo '<div class="alert alert-warning">You have to enter an email.</div>';
            }
        }
        ?>
        <div class="c-form-add">
            <h2>Add client</h2>
            <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label class="sr-only" for="add_name">Name</label>
                <input type="text" id="add_name" class="form-control" name="add_name" placeholder="Name">

                <label class="sr-only" for="add_email">Email</label>
                <input type="email" id="add_email" class="form-control" name="add_email" placeholder="Email">

                <label class="sr-only" for="add_phone">Phone</label>
                <input type="text" id="add_phone" class="form-control" name="add_phone" placeholder="Phone">

                <label class="sr-only" for="add_address">Address</label>
                <input type="text" id="add_address" class="form-control" name="add_address" placeholder="Address">

                <label class="sr-only" for="add_company">Company</label>
                <input type="text" id="add_company" class="form-control" name="add_company" placeholder="Company">

                <label class="sr-only" for="add_notes">Notes</label>
                <input type="text" id="add_notes" class="form-control" name="add_notes" placeholder="Notes">

                <input type="submit" name="add" class="btn btn-primary" value="Add">
            </form>
        </div>
    </div>
</div>
<?php
    if(isset($_POST['add'])){
        $control_name = 0;
        $control_email= 0;
        if ($_POST['add_name'] == "" ) {
            $control_name = 1;
        }
        if ($_POST['add_email'] == "" ) {
            $control_email = 1;
        }
        if ($control_name == 0 && $control_email == 0){
            $query = "INSERT INTO clients (id, name, email, phone, address, company, notes, date_added, username) 
            VALUES (NULL, '" . encryptData($_POST["add_name"]) . "', '" . encryptData($_POST['add_email']) . "', '" .
            encryptData($_POST['add_phone']) . "', '" . encryptData($_POST['add_address']) . "', '" . encryptData($_POST['add_company']) . "', '" . encryptData($_POST['add_notes']) . "', CURRENT_TIMESTAMP, '$activeUser')";
            mysqli_query($conn, $query);
            header('Location: clients.php?info=added');
        } else {
            header("location: addclient.php?controln=" . $control_name . "&controle=" . $control_email);
        }
    }
    mysqli_close($conn);
    include('includes/footer.php');

?>