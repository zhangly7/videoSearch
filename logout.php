<?php
    session_start();
    $curUser= $_SESSION['loginUser'];
    $_SESSION = array();
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }
    session_destroy();
    include "index.html";


?>
