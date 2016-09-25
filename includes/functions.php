<?php
// prevent injections by validating input
function validateInput($dataInput){
    $data = trim(stripcslashes(htmlspecialchars(strip_tags(str_replace(array('(', ')'), '', $dataInput)), ENT_QUOTES)));
    return $data;
}

function validateUsername($data){
    $regexUsername = '/^[a-zA-Z]{1}[^@"\'#$!&\/()=?* ]{4,15}$/';
    if(preg_match($regexUsername, $data)){
        require('connection.php');
        $query = "SELECT username FROM users WHERE username = '$data' ";
        $result = mysqli_query($conn, $query);
        mysqli_close();
        if(mysqli_fetch_row($result) > 0 ){
            return 'exists';
        } else {
            return $data;
        }
    } else {
        return '';
    }
}

function validateEmail($data){
    $regexEmail = '/^[a-zA-Z0-9]{1}[a-zA-Z0-9.-_]*@[a-zA-Z0-9]+?(.[a-zA-Z0-9]+)+$/';
    if(preg_match($regexEmail, $data)){
        require('connection.php');
        $query = "SELECT email FROM users WHERE email = '$data' ";
        $result = mysqli_query($conn, $query);
        mysqli_close();
        if(mysqli_fetch_row($result) > 0 ){
            return 'exists';
        } else {
            return $data;
        }
    } else {
        return '';
    }
}

function validatePassword($pass1, $pass2){
    if($pass1 == $pass2){
        return $pass1;
    } else {
        return '';
    }
}

function sendMail($md5, $email){
    $to = $email;
    $subject = "Client Address Book | Confirm your account";
    $txt = "Click on the following link to activate your account!" . "\r\n";
    $txt .= 'www.weisstest.tk/includes/activate.php?sc=' . $md5;
    $headers = "From: webmaster@weisstest.tk" . "\r\n";
    mail($to, $subject, $txt, $headers);
}
?>