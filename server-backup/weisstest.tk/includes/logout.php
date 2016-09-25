<?php
  ob_start();
    // did the user's browser send a cookie for the session?
  session_start();
  //$msg = '';
      if ($_SESSION['logged_user']) {
          if (isset($_COOKIE[session_name()])) {
              // empty the cookie
              setcookie(session_name(), '', time() - 86400, '/');
          }
          // clear all session variables
          session_unset();
          // destroy the session
          session_destroy();
          $msg = 'out';
          header('Location: ../index.php?msg=' . $msg);
      }
?>
