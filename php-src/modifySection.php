<?php
session_start();
include 'db/db_connect.php';

if ($_SESSION['signedIn'] == true) {
    $uemail = $_SESSION['uemail'];
    if (isset($_GET['method']) and $_GET['method'] == 'del' and $_SERVER["REQUEST_METHOD"] == "POST") {
        $sectionID = (int)$_POST['del-val'];
        $chk_sql = "SELECT * FROM `section` WHERE uemail='$uemail' and sno='$sectionID';";
        $res_chk = mysqli_query($con, $chk_sql);

        if ($res_chk) {
            $numRows = mysqli_num_rows($res_chk);
            if ($numRows > 0) {
                $rowChk = mysqli_fetch_assoc($res_chk);
                $secName = $rowChk['sec_name'];

                $sql = "SELECT * FROM `paper` WHERE email='$uemail' and paper_sec='$secName';";
                $res = mysqli_query($con, $sql);
                $numberRows = mysqli_num_rows($res);
                if ($numberRows > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $del_val = $row['p_sno'];
                        $sqlDEL = "DELETE FROM `paper` WHERE email='$uemail' and p_sno='$del_val';";
                        $resDEL = mysqli_query($con, $sqlDEL);
                    }
                }

                $sql = "DELETE FROM `section` WHERE uemail='$uemail' and sno='$sectionID';";
                $res = mysqli_query($con, $sql);
                if ($res) {
                    header("Location: ../pages/main.php?info=SectionDel");
                    exit();
                } else {
                    header("Location: ../pages/main.php?info=ServerErr");
                    exit();
                }
            }
        }
    } elseif (isset($_GET['method']) and $_GET['method'] == 'edit' and $_SERVER["REQUEST_METHOD"] == "POST") {
        $sec_name = $_POST['sec-name'];
        $sec_info = $_POST['sec-info'];
        $sec_icon = $_POST['sec-icon'];

        $secID = (int)$_GET['secID'];

        $chk_sql = "SELECT * FROM `section` WHERE uemail='$uemail' AND sno='$secID';";
        $res_chk = mysqli_query($con, $chk_sql);

        if ($res_chk) {
            $numRows = mysqli_num_rows($res_chk);
            if ($numRows > 0) {
                $sql = "UPDATE `section` SET `uemail`='$uemail',`sec_name`='$sec_name',`sec_info`='$sec_info',`sec_icon`='$sec_icon',`sec_timestamp`= current_timestamp() WHERE uemail='$uemail' AND sno='$secID';";

                $res = mysqli_query($con, $sql);
                if ($res) {
                    header("Location: ../pages/main.php?info=SecUpdated");
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
}
