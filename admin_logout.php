<?php
    session_start();
    session_unset();
    session_destroy();
    header('location:login_admin.php');
    exit();
?>