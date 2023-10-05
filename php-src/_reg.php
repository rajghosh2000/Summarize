<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db/db_connect.php';

    $usrName = $_POST['name'];
    $dob = $_POST['dob'];
    $usrEmail = $_POST['uemail'];
    $usrCountry = $_POST['country'];
    $usrPwd = $_POST['upwd'];
    $usrCpwd = $_POST['cpwd'];

    if ($usrPwd == $usrCpwd) {
        $chk_sql = "SELECT * FROM `user` WHERE email='$usrEmail';";
        $res_chk = mysqli_query($con, $chk_sql);
        $row = mysqli_fetch_assoc($res_chk);

        if ($res_chk) {
            $numRows = mysqli_num_rows($res_chk);
            if ($numRows == 0) {
                $usrPassword = password_hash($usrPwd, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `user` (`name`, `dob`, `email`, `password`, `timestamp`, `country`) VALUES ('$usrName', '$dob', '$usrEmail', '$usrPassword', current_timestamp(), '$usrCountry');";

                $res = mysqli_query($con, $sql);

                if ($res) {
                    session_start();
                    $_SESSION['signedIn'] = true;
                    $_SESSION['uemail'] = $usrEmail;
                    $_SESSION['uname'] = $usrName;
                    header("Location: ../pages/main.php?user=True&reg=success");
                    exit();
                }
            } else {
                header("Location: ../index.php?reg=false");
                exit();
            }
        }
    }
}
