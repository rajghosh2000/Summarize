<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

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
            $_SESSION['signedIn'] = true;
            $_SESSION['uemail'] = $usrEmail;
            $_SESSION['uname'] = $usrName;
            echo '
                <script type="text/javascript">
                    jQuery(function validation(){
                        swal({
                                title: "Success",
                                text: "Successfully Inserted",
                                icon: "success",
                                button: "Okay",
                            });
                    });
                </script>';
            header("refresh:2; ../pages/main.php");
            exit();
        } else {
            $err = "Details not added!!";
        }
    }
    header("Location: ../index.html");
    exit();
}
?>

<?php include('../js/js.php') ?>

</html>