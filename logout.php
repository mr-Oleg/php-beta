<?php
    require_once "db.php";
    unset($_SESSION['lname']);
    unset($_SESSION['fname']);
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    unset($_SESSION['email']);
    header("Location: index.php");
?>