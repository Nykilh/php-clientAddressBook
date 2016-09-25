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
    $query = "SELECT * FROM clients WHERE username = '$activeUser'";
    $result = mysqli_query($conn, $query);

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

?>

<div class="container">
    <div class="row">
        <?php
            if(isset($_GET['info'])) {
                $info = $_GET['info'];
                if ($info == 'saved') {
                    $alert = '<div class="alert alert-success">Your changes have been saved.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                } elseif ($info == 'deleted') {
                    $alert = '<div class="alert alert-success">The client has been deleted.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                } elseif ($info == 'added') {
                    $alert = '<div class="alert alert-success">The client has been added.<a class="close" data-dismiss="alert">&times;</a></div>';
                    echo $alert;
                }
            }
        ?>
            <h2>Client list</h2>
            <table class="table table-bordered table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Company</th>
                    <th>Notes</th>
                    <th>Edit</th>
                </tr>
                <?php
                if(mysqli_num_rows($result)>0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" .  decryptData($row['name']) . "</td>";
                        echo "<td>" .  decryptData($row['email']) . "</td>";
                        echo "<td>" .  decryptData($row['phone']) . "</td>";
                        echo "<td>" .  decryptData($row['address']) . "</td>";
                        echo "<td>" .  decryptData($row['company']) . "</td>";
                        echo "<td>" .  decryptData($row['notes']) . "</td>";
                        echo '<td><a href = "edit.php?clientId=' . $row['id'] . '" type = "button" class="btn btn-default btn-primary btn-sm"><span class="glyphicon glyphicon-edit"></span></a></td>';
                        echo "<tr>";
                        }
                    }
                    mysqli_close($conn);
                ?>
            </table>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php');
?>