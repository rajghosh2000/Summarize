<?php
$err = "false";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" and $_SESSION['signedIn'] == true) {
    include 'db/db_connect.php';

    $pname = $_POST['pname'];
    $aname = $_POST['aname'];
    $pyear = $_POST['pyear'];
    $publisher = $_POST['publisher'];
    $pdoi = $_POST['pdoi'];
    $pexternalurl = $_POST['purl'];
    $pdriveurl = $_POST['upaper'];
    $psec = $_POST['psec'];
    $rangeValue = $_POST['rating'];
    $summary = $_POST['summary'];

    $uemail = $_SESSION['uemail'];

    $chk_sql = "SELECT * FROM `paper` WHERE email='$uemail' AND paper_sec='$psec' AND paper_doi='$pdoi';";
    $res_chk = mysqli_query($con, $chk_sql);

    if($res_chk){
        $numRows = mysqli_num_rows($res_chk);
        if($numRows > 0){
            header("Location: ../pages/main.php?info=Exists");
            exit();
        }else{
            $sql = "INSERT INTO `paper` (`email`, `paper_name`, `paper_author`, `paper_yr`, `paper_doi`, `paper_publisher`, `paper_external_url`, `paper_drive_url`, `paper_sec`, `paper_user_rating`, `paper_user_summary`) VALUES ('$uemail', '$pname', '$aname', '$pyear', '$pdoi', '$publisher', '$pexternalurl', '$pdriveurl', '$psec', '$rangeValue', '$summary');";

            $res = mysqli_query($con, $sql);
            if ($res) {
                header("Location: ../pages/main.php?info=Added");
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