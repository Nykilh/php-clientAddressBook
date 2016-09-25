<?php
    if(isset($_GET['sc'])){
        $md5 = $_GET['sc'];
        include('connection.php');
        $query = "SELECT * FROM users WHERE confirm = '$md5'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $user = $row['username'];
                $value = "yes";
                $query = "UPDATE users SET confirm = '" . $value . "' WHERE username = '$user'";
                mysqli_query($conn, $query);
                header('location: ../index.php?msg=conf');
            }
            
        }
    }

?>