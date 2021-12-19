<?php
    require("secure.php");
    unset($_SESSION['username']);
    session_destroy();
    header('Location: login.php');
?>