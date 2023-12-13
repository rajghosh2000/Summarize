<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.php");
    exit();
}
include '../php-src/db/db_connect.php';
$uemail = $_SESSION['uemail'];
$chk_sql = "SELECT * FROM `user` WHERE email='$uemail';";
$res_chk = mysqli_query($con, $chk_sql);
$row = mysqli_fetch_assoc($res_chk);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summarize</title>
    <link rel="icon" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<style>
    <?php include "../css/style.css" ?>
</style>

<body class="flex flex-col h-screen justify-between overflow-hidden">
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap flex-col p-2 md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="main.php">
                <img class="bg-none h-20 w-48" src="../img/logo.png">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900 font-semibold" href="main.php">My Network</a>
                <a class="mr-5 hover:text-gray-900 font-semibold">About</a>
                <a class="mr-5 hover:text-gray-900 font-semibold">Contact Us</a>
            </nav>
            <a class="mr-5 text-green-600 hover:text-gray-900 font-semibold" href="#">
                <?php
                if (isset($_SESSION['signedIn']) && $_SESSION['signedIn'] == true) {
                    echo $_SESSION['uname'];
                }
                ?>
            </a>
            <button class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 mx-2 md:mt-0 shadow-2xl" onclick="window.location.href='../php-src/logout.php'">Logout
            </button>
        </div>
    </header>

    <section class="text-gray-600 body-font xl:overflow-hidden lg:overflow-hidden overflow-auto">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-col text-center w-full mb-2">
                <h1 class="sm:text-4xl text-3xl font-medium title-font mb-2 text-gray-900">Your Account</h1>
            </div>
            <div class="flex flex-wrap -m-4">
                <div class="p-4 xl:w-1/2 md:w-1/2 w-full">
                    <img class="object-cover h-96 object-center rounded mx-1" alt="hero" src="../img/account.png">
                </div>
                <div class="p-4 xl:w-1/2 md:w-1/2 w-full">
                    <div class="h-full p-6 rounded-lg border-2 border-green-500 flex flex-col relative overflow-hidden">
                        <span class="bg-green-500 text-black font-semibold px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">YOUR ACCOUNT</span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">Email: <?php echo $uemail; ?></h2>
                        <h1 class="text-5xl text-gray-900 leading-none flex items-center pb-4 mb-4 border-b border-gray-200">
                            <span><?php echo $_SESSION['uname']; ?></span>
                        </h1>
                        <p class="flex items-center text-gray-600 mb-2 font-bold">
                            <span class="w-8 h-8 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                <i class="fa-solid fa-cake-candles text-black"></i>
                            </span>
                            <?php echo $row['dob']; ?>
                        </p>
                        <p class="flex items-center text-gray-600 mb-2 font-bold">
                            <span class="w-8 h-8 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                <i class="fa-solid fa-globe text-black"></i>
                            </span>
                            <?php echo $row['country']; ?>
                        </p>
                        <p class="flex items-center text-gray-600 mb-2 font-bold">
                            <span class="w-8 h-8 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                <i class="fa-solid fa-fan text-black"></i>
                            </span> No of Sections :
                            <?php
                            $sql_inner = "SELECT * FROM `section` WHERE `uemail` = '$uemail';";
                            $res_inner = mysqli_query($con, $sql_inner);
                            $numRows_inner = mysqli_num_rows($res_inner);

                            echo $numRows_inner;

                            ?>
                        </p>
                        <p class="flex items-center text-gray-600 mb-2 font-bold">
                            <span class="w-8 h-8 mr-2 inline-flex items-center justify-center bg-gray-400 text-white rounded-full flex-shrink-0">
                                <i class="fa-solid fa-file-circle-check text-black"></i>
                            </span> No of Papers :
                            <?php
                            $sql_inner2 = "SELECT * FROM `paper` WHERE `email` = '$uemail';";
                            $res_inner2 = mysqli_query($con, $sql_inner2);
                            $numRows_inner2 = mysqli_num_rows($res_inner2);

                            echo $numRows_inner2;

                            ?>
                        </p>
                        <button class="flex items-center mt-auto text-black font-bold bg-green-500 border-0 py-2 px-4 w-full focus:outline-none hover:bg-green-600 rounded border-2 border-green-800">Edit Info
                            <i class="fa-solid fa-user-pen text-xl text-black ml-auto"></i>
                        </button>
                        <p class="text-xs text-gray-500 mt-3">Thank You for joining with us</p>
                        <span class="bg-green-500 text-black px-3 py-1 tracking-widest text-xs absolute right-0 bottom-0 rounded-tl font-semibold">USER FROM : <?php echo $row['timestamp']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0">
                <img class="bg-none h-6 w-20" src="../img/logo.png">
            </a>
            <p class="text-xs text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                2023 Summarize —
                <a href="https://www.linkedin.com/in/rajdeep-ghosh-301082175/" class="font-semibold text-green-300 ml-1 hover:text-green-900" rel="noopener noreferrer" target="_blank">@rajdeep</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </footer>

</body>

</html>