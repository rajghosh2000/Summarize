<?php
session_start();
include 'db/db_connect.php';

$paperID = $_GET['sno'];
$uemail = $_SESSION['uemail'];

if ($_SESSION['signedIn'] == true) {
    $chk_sql = "SELECT * FROM `paper` WHERE email='$uemail' AND p_sno='$paperID';";
    $res_chk = mysqli_query($con, $chk_sql);
    $row = mysqli_fetch_assoc($res_chk);
    $currentSec = $row['paper_sec'];

    if ($res_chk) {
        $numRows = mysqli_num_rows($res_chk);
        if ($numRows > 0) {
            if (isset($_GET['method']) and $_GET['method'] == 'del') {
                $sql = "DELETE FROM `paper` WHERE email='$uemail' and p_sno='$paperID';";
                $res = mysqli_query($con, $sql);
                if ($res) {
                    header("Location: ../pages/threads.php?section=$currentSec&info=PaperDel");
                    exit();
                } else {
                    header("Location: ../pages/threads.php?section=$currentSec&info=ModErr");
                    exit();
                }
            } elseif (isset($_GET['method']) and $_GET['method'] == 'move') {
                $sectionID = (int)$_POST['psecID'];

                $getSection = "SELECT `sec_name` FROM `section` WHERE uemail = '$uemail' AND sno = '$sectionID';";
                $getSectionRes = mysqli_query($con, $getSection);
                $sec_row = mysqli_fetch_assoc($getSectionRes);
                $section_name = $sec_row['sec_name'];

                $sql = "UPDATE `paper` SET `paper_sec`='$section_name' WHERE email='$uemail' and p_sno='$paperID';";
                $res = mysqli_query($con, $sql);
                if ($res) {
                    header("Location: ../pages/threads.php?section=$section_name&info=PaperMoved");
                    exit();
                } else {
                    header("Location: ../pages/threads.php?section=$section_name&info=ModErr");
                    exit();
                }
            } elseif (isset($_GET['method']) and $_GET['method'] == 'edit' and $_SERVER["REQUEST_METHOD"] == "POST") {
                $pname = $_POST['pname'];
                $aname = $_POST['aname'];
                $pyear = $_POST['pyear'];
                $publisher = $_POST['publisher'];
                $publishedIn = $_POST['pubin'];
                $pdoi = $_POST['pdoi'];
                $pdriveurl = $_POST['upaper'];
                $psec = $_POST['psec'];
                $rangeValue = $_POST['rating'];
                $summary = $_POST['summary'];
                $paper_updated = 1;
                
                $sql = "UPDATE `paper` SET `paper_name`='$pname',`paper_author`='$aname',`paper_yr`='$pyear',`paper_doi`='$pdoi',`paper_publisher`='$publisher',`paper_published_in`='$publishedIn',`paper_drive_url`='$pdriveurl',`paper_sec`='$psec',`paper_user_rating`='$rangeValue',`paper_user_summary`='$summary', `paper_timestamp`= current_timestamp(), `p_updated` = '$paper_updated' WHERE email='$uemail' and p_sno='$paperID';";
                $res = mysqli_query($con, $sql);

                if ($res) {
                    header("Location: ../pages/threads.php?section=$currentSec&info=PaperModified");
                    exit();
                } else {
                    header("Location: ../pages/threads.php?section=$currentSec&info=ModErr");
                    exit();
                }
            }
        } else {
            header("Location: ../pages/threads.php?section=$currentSec&info=PaperNotFound");
            exit();
        }
    } else {
        header("Location: ../pages/threads.php?section=$currentSec&info=Err");
        exit();
    }
}
