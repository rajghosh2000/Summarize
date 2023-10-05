<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.php");
    exit();
}

$section_name = $_GET['section'];

include '../php-src/db/db_connect.php';
$uemail = $_SESSION['uemail'];
$sql = "SELECT * FROM `section` WHERE `uemail` = '$uemail' AND `sec_name` = '$section_name'";
$res = mysqli_query($con, $sql);
$numRows = mysqli_num_rows($res);
$row = mysqli_fetch_assoc($res);

$sec_icon = '';

switch ($row['sec_icon']) {
    case "Development":
        $sec_icon = '<i class="fa-brands fa-html5 text-black fa-flip"></i>';
        break;
    case "Coding":
        $sec_icon = '<i class="fa-solid fa-terminal text-black fa-flip"></i>';
        break;
    case "Research Writings":
        $sec_icon = '<i class="fa-solid fa-pen-nib text-black fa-flip"></i>';
        break;
    case "Social":
        $sec_icon = '<i class="fa-regular fa-comment text-black fa-bounce"></i>';
        break;
    case "Hardware":
        $sec_icon = 'fa-solid fa-laptop text-black fa-beat';
        break;
    case "Technology":
        $sec_icon = '<i class="fa-solid fa-flask-vial text-black fa-beat"></i>';
        break;
    default:
        $sec_icon = '<i class="fa-solid fa-snowflake fa-spin text-black"></i>';
}

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
    <script type="text/javascript">
        function preventBack() {
            window.history.forward()
        };
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null;
        }
    </script>
</head>
<style>
    <?php include "../css/style.css" ?>
</style>

<body class="flex flex-col h-screen justify-between overflow-hidden font-mono">

    <?php
    if (isset($_GET['info']) && $_GET['info'] == 'PaperDel') {
        // Handle Successfull Login
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>

                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Paper Deleted Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
    ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'PaperMoved') {
        // Handle Successfull Login
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>

                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Paper Moved Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
    ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'PaperModified') {
        // Handle Successfull Login
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>

                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Paper Modified Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
    ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'ModErr') {
        // Handle Paper Exists
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Failure</span>
                        <span class="text text-2">Action Failed</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progresses active"></div>
            </div>
    ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'PaperNotFound') {
        // Handle Paper Exists
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Not Found</span>
                        <span class="text text-2">Paper Not Available</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progresses active"></div>
            </div>
    ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'Err') {
        // Handle Paper Exists
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Failure</span>
                        <span class="text text-2">Server Error</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progresses active"></div>
            </div>
    ';
    }
    ?>

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

    <section class="text-gray-600 body-font text-center">
        <h2 class="text-xs text-green-500 tracking-widest font-semibold title-font">SECTION</h2>
        <div class="container mx-auto flex flex-wrap p-2 flex-col md:flex-row items-center">
            <div class="flex lg:w-1/5"></div>
            <div class="flex order-first lg:order-none lg:w-3/5 title-font font-medium items-center text-gray-900 lg:items-center lg:justify-center mb-4 md:mb-0">
                <h1 class="sm:text-3xl text-2xl font-bold title-font font-mono mb-2 mx-2 text-gray-900"><?php echo $section_name; ?></h1>
                <div class="w-12 h-12 mx-4 inline-flex items-center justify-center rounded-full bg-green-400 text-white flex-shrink-0 border-2 border-blue-900"><?php echo $sec_icon; ?></div>
            </div>
            <div class="lg:w-1/5 inline-flex lg:justify-end ml-5 lg:ml-0">
                <a type="button" class="inline-flex text-black items-center bg-green-400 border-2 border-green-900 py-2 px-3 focus:outline-none hover:bg-green-600 rounded text-lg mt-4 md:mt-0" href="paper.php">Add Paper
                    <i class="fa-solid fa-file-circle-plus text-md text-black ml-2 px-2 py-1 fa-beat"></i>
                </a>
            </div>
        </div>
    </section>


    <section class="text-gray-600 body-font overflow-auto">
        <div class="container px-5 py-12 mx-auto flex flex-wrap">

            <?php
            include '../php-src/db/db_connect.php';
            $uemail = $_SESSION['uemail'];
            $sql = "SELECT * FROM `paper` WHERE `email` = '$uemail' AND `paper_sec` = '$section_name';";
            $res = mysqli_query($con, $sql);
            $numRows = mysqli_num_rows($res);


            if ($numRows > 0) {
                echo '<div class="flex flex-wrap -m-4">';
                while ($row = mysqli_fetch_assoc($res)) {
                    $pub = '';
                    if (strlen($row['paper_publisher']) > 40) {
                        $pub = substr($row['paper_publisher'], 0, 40) . ' .....';
                    } else {
                        $pub = $row['paper_publisher'];
                    }

                    if ($numRows == 1) {
            ?>
                        <div class="p-4 w-full">
                            <div class="flex p-8 rounded-xl border-green-200 border-opacity-50 shadow-2xl sm:flex-row flex-col">
                                <div class="w-16 h-16 sm:mr-8 sm:mb-0 inline-flex items-center justify-center rounded-full bg-green-100 text-green-500 flex-shrink-0 border-4 border-green-500">
                                    <div class="w-12 h-12 mx-4 inline-flex items-center justify-center rounded-full bg-green-500 text-white flex-shrink-0 border-2 border-blue-900">
                                        <i class="fa-solid fa-book-open-reader fa-beat text-black text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h2 class="text-gray-900 text-base title-font font-bold"><?php echo $row['paper_name'] ?></h2>
                                    <p class="leading-relaxed text-sm">Publisher: <?php echo $pub; ?></p>
                                    <p class="leading-relaxed text-xs font-bold">Year: <?php echo $row['paper_yr']; ?></p>
                                    <a class="text-green-700 inline-flex items-center font-bold" href="chkPaper.php?sno=<?php echo $row['p_sno']; ?>">Check Paper
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php } else {

                    ?>
                        <div class="p-4 lg:w-1/2 md:w-full">
                            <div class="flex border-2 rounded-lg border-green-200 border-opacity-50 shadow-2xl p-8 sm:flex-row flex-col">
                                <div class="w-16 h-16 sm:mr-8 sm:mb-0 inline-flex items-center justify-center rounded-full bg-green-100 text-green-500 flex-shrink-0 border-4 border-green-500">
                                    <div class="w-12 h-12 mx-4 inline-flex items-center justify-center rounded-full bg-green-500 text-white flex-shrink-0 border-2 border-blue-900">
                                        <i class="fa-solid fa-book-open-reader fa-beat text-black text-xl"></i>
                                    </div>
                                </div>
                                <div class="flex-grow">
                                    <h2 class="text-gray-900 text-base title-font font-bold"><?php echo $row['paper_name'] ?></h2>
                                    <p class="leading-relaxed text-sm"><?php echo $pub; ?></p>
                                    <p class="leading-relaxed text-xs font-bold">Year: <?php echo $row['paper_yr']; ?></p>
                                    <a class="text-green-700 inline-flex items-center font-bold" href="chkPaper.php?sno=<?php echo $row['p_sno']; ?>">Check Paper
                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                            <path d="M5 12h14M12 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>
        </div>
    <?php } else {
                echo '
                                <div class="flex items-center justify-center flex-col mx-auto">
                                    <img class="w-full object-contain object-center rounded h-72" alt="hero" src="../img/no-data.png">
                                    <div class="text-center w-full">
                                        <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">NO PAPER YET!!! ADD THE FIRST PAPER HERE</h1>
                                        <a type="button" class="inline-flex text-black bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg" href="paper.php">New Paper</a>
                                    </div>
                                </div>
                            ';
            }
    ?>
    <!--Start-->
    <!--End-->
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
<script>
    const toast = document.querySelector(".toast");
    (closeIcon = document.querySelector(".close")), (progress = document.querySelector(".progress"));

    let timer1, timer2;

    timer1 = setTimeout(() => {
        toast.classList.remove("active");
    }, 5000); //1s = 1000 milliseconds

    timer2 = setTimeout(() => {
        progress.classList.remove("active");
    }, 5300);

    closeIcon.addEventListener("click", () => {
        toast.classList.remove("active");

        setTimeout(() => {
            progress.classList.remove("active");
        }, 300);

        clearTimeout(timer1);
        clearTimeout(timer2);
    });
</script>

</html>