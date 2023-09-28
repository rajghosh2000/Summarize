<?php
$showErr = "false";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db/db_connect.php';

    $uemail = $_POST['email'];
    $upwd   = $_POST['pwd'];

    $sql = "SELECT * FROM `user` WHERE `email` = '$uemail';";
    $res = mysqli_query($con, $sql);
    $numRows = mysqli_num_rows($res);

    if ($numRows == 1) {
        $row = mysqli_fetch_assoc($res);
        if (password_verify($upwd, $row['password'])) {
            session_start();
            $_SESSION['signedIn'] = true;
            $_SESSION['uemail'] = $uemail;
            $_SESSION['uname'] = $row['name'];
            header("Location: ../pages/main.php?user=True&login=success");
            exit();
        } else {
            echo "Unable to log in ";
            $showErr = "UnableToLogIn";
        }
    } else {
        $showErr = "No field found";
    }
    header("Location: ../index.html");
    exit();
}
