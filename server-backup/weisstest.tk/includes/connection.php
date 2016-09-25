<?php
    $server = 'fdb12.freehostingeu.com';
    $user = '2027690_db';
    $pass = 'youm@ypasS93';
    $db = '2027690_db';

    $conn = mysqli_connect($server, $user, $pass, $db);

if(!$conn){
    die('Error: ' . mysqli_connect_error());
}
?>