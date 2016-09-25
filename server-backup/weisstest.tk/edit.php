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
    $clientId = $_GET['clientId'];
    $query = "SELECT * FROM clients WHERE username = '$activeUser' AND id ='$clientId'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0) {
        while ($row = mysqli_fetch_assoc($result)) {
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
                        <h2>Edit client</h2>
                        <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <label class="sr-only" for="add_name">Name</label>
                            <input type="text" id="add_name" class="form-control" name="add_name" placeholder="Name"
                                   value="<?php echo decryptData($row['name']); ?>">

                            <label class="sr-only" for="add_email">Email</label>
                            <input type="email" id="add_email" class="form-control" name="add_email"
                                   placeholder="Email" value="<?php echo decryptData($row['email']); ?>">

                            <label class="sr-only" for="add_phone">Phone</label>
                            <input type="text" id="add_phone" class="form-control" name="add_phone"
                                   placeholder="Phone" value="<?php echo decryptData($row['phone']); ?>">

                            <label class="sr-only" for="add_address">Address</label>
                            <input type="text" id="add_address" class="form-control" name="add_address"
                                   placeholder="Address" value="<?php echo decryptData($row['address']); ?>">

                            <label class="sr-only" for="add_company">Company</label>
                            <input type="text" id="add_company" class="form-control" name="add_company" placeholder="Company" value="<?php echo decryptData($row['company']); ?>">

                            <label class="sr-only" for="add_notes">Notes</label>
                            <input type="text" id="add_notes" class="form-control" name="add_notes"
                                   placeholder="Notes" value="<?php echo decryptData($row['notes']); ?>">

                            <input type="submit" name="save" class="btn btn-primary" value="Save">
                            <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                            <input type="hidden" name="get_client_id" value="<?php echo $row['id']; ?>">
                        </form>
                    </div>
                </div>
            </div>
<?php
        }
    }

        if(isset($_GET['controln'])){
            if($_GET['controln'] == 1) {
                ?>
                <script>
                    document.getElementById("add_name").value = "";
                </script>
                <?php
            }
        }

        if(isset($_GET['controle'])) {
            if ($_GET['controle'] == 1) {
                ?>
                <script>
                    document.getElementById("add_email").value = "";
                </script>
                <?php
            }
        }



    if(isset($_POST['save'])) {
        $control_name = 0;
        $control_email= 0;
        if ($_POST['add_name'] == "" ) {
            $control_name = 1;
        }
        if ($_POST['add_email'] == "" ) {
            $control_email = 1;
        }
        if ($control_name == 0 && $control_email == 0){
            $query = "UPDATE clients SET name ='"  . encryptData($_POST["add_name"]) . "', email ='" . encryptData($_POST['add_email']) . "', phone ='" . encryptData($_POST['add_phone']) . "', address ='" . encryptData($_POST['add_address']) . "', company ='" . encryptData($_POST['add_company']) . "', notes ='" . encryptData($_POST['add_notes']) . "' WHERE username = '$activeUser' AND id=" .
                $_POST['get_client_id'];
            mysqli_query($conn, $query);
            header('Location: clients.php?info=saved');
        } else {
            header("location: edit.php?clientId=" . $_POST['get_client_id'] . "&controln=" . $control_name . "&controle=" . $control_email);
            }
    }



    if(isset($_POST['delete'])){
        $query = "DELETE FROM clients WHERE username = '$activeUser' AND id =" . $_POST['get_client_id'];
        mysqli_query($conn, $query);
        header('Location: clients.php?info=deleted');
    }
    mysqli_close($conn);
    include('includes/footer.php');

    function decryptData($data){
        $password = $_SESSION['logged_password'];
        $data = base64_decode($data);
        $salt = substr($data, 8, 8);
        $ct   = substr($data, 16);

        $key = md5($password . $salt, true);
        $iv  = md5($key . $password . $salt, true);

        $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

        return trim($pt);
    }

    function encryptData($data){
        $password = $_SESSION['logged_password'];
        $salt = substr(md5(mt_rand(), true), 8);

        $key = md5($password . $salt, true);
        $iv  = md5($key . $password . $salt, true);

        $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

        return trim(base64_encode('Salted__' . $salt . $ct));
    }
?>

