<?php
$err = "false";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION['signedIn'] == true) {
    include 'db/db_connect.php';

    $sec_name = $_POST['sec-name'];
    $sec_info = $_POST['sec-info'];
    $sec_icon = $_POST['sec-icon'];

    $uemail = $_SESSION['uemail'];

    $chk_sql = "SELECT * FROM `section` WHERE uemail='$uemail' AND sec_name='$sec_name';";
    $res_chk = mysqli_query($con, $chk_sql);

    if($res_chk){
        $numRows = mysqli_num_rows($res_chk);
        if($numRows > 0){
            header("Location: ../pages/main.php?info=ExistsSec");
            exit();
        }else{
            $sql = "INSERT INTO `section` (`uemail`, `sec_name`, `sec_info`, `sec_icon`) VALUES ('$uemail', '$sec_name', '$sec_info', '$sec_icon');";

            $res = mysqli_query($con, $sql);
            if ($res) {
                header("Location: ../pages/main.php?info=AddedSec");
                exit();
            } else {
                header("Location: ../pages/main.php?info=ServerErr");
                exit();
            }
        }
    }else {
        header("Location: ../pages/main.php?info=ServerErr");
        exit();
    }
}
