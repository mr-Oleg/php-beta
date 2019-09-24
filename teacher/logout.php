<?php
    require_once "../db.php";
    unset($_SESSION['teacher']);
    header("Location: index.php");
?>