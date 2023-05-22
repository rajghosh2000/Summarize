<?php
    session_start();
    echo 'Logging You Out Please Wait';
    
    unset($_SESSION['signedIn']);  
    session_destroy();
    header("Location: ../index.html");
    exit();
?>