<?php
$err = "false";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION['signedIn'] == true) {
    include 'db/db_connect.php';

    $sec_name = $_POST['sec-name'];
    $sec_info = $_POST['sec-info'];
    $sec_icon = $_POST['sec-icon'];
    $uemail = $_SESSION['uemail'];

    $sql = "INSERT INTO `section` (`uemail`, `sec_name`, `sec_info`, `sec_icon`) VALUES ('$uemail', '$sec_name', '$sec_info', '$sec_icon');";

    $res = mysqli_query($con, $sql);

    if ($res) {
        header("Location: ../pages/main.php");
        exit();
    } else {
        $err = "Details not added!!";
    }
    header("Location: ../pages/main.php");
    exit();
}
