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
    $psec = $_POST['psec'];
    $rangeValue = $_POST['rangeValue'];
    $summary = $_POST['summary'];

    $upaper = $_POST['upaper']; //not yet taken

    $uemail = $_SESSION['uemail'];

    $sql = "INSERT INTO `paper` (`email`, `paper_name`, `paper_author`, `paper_yr`, `paper_doi`, `paper_publisher`, `paper_pdf`, `paper_sec`, `paper_user_rating`, `paper_user_summary`) VALUES ('$uemail', '$pname', '$aname', '$pyear', '$pdoi', '$publisher', 'NULL', '$psec', '$rangeValue', '$summary');";

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