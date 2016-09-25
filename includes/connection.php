<?php
    $server = 'localhost';
    $user = 'root';
    $pass = 'root';
    $db = 'clientaddressbook_db';

    $conn = mysqli_connect($server, $user, $pass, $db);

if(!$conn){
    die('Error: ' . mysqli_connect_error());
}

?>