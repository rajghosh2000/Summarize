<?php
$err = "false";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'db/db_connect.php';

    $usrName = $_POST['name'];
    $dob = $_POST['dob'];
    $usrEmail = $_POST['uemail'];
    $usrCountry = $_POST['country'];
    $usrPwd = $_POST['upwd'];
    $usrCpwd = $_POST['cpwd'];

    if ($usrPwd == $usrCpwd) {
        $usrPassword = password_hash($usrPwd, PASSWORD_DEFAULT);


        $sql = "INSERT INTO `user` (`name`, `dob`, `email`, `password`, `timestamp`, `country`) VALUES ('$usrName', '$dob', '$usrEmail', '$usrPassword', current_timestamp(), '$usrCountry');";

        $res = mysqli_query($con, $sql);

        if ($res) {
            session_start();
            isset($_SESSION['signedIn']);
            $_SESSION['uemail'] = $usrEmail;
            $_SESSION['uname'] = $usrName;
            header("Location: ../pages/main.php");
            exit();
        } else {
            $err = "Details not added!!";
        }
    }
    header("Location: ../index.html");
    exit();
}
