<?php
    session_start();
    
    unset($_SESSION['signedIn']);  
    session_destroy();
    header("Location: ../index.html");
    exit();
?>