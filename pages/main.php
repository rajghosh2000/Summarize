<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.php");
    exit();
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
    <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
</head>
<style>
    <?php include "../css/style.css" ?>
</style>

<body class="flex flex-col h-screen justify-between overflow-hidden">


    <?php
    if (isset($_GET['user']) && $_GET['user'] == 'True') {
        if (isset($_GET['reg']) && $_GET['reg'] == 'success') {
            // Handle registration success case
            echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fas fa-solid fa-check check"></i>
            
                        <div class="message">
                            <span class="text text-1">Success</span>
                            <span class="text text-2">Registration Successful</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
        } elseif (isset($_GET['login']) && $_GET['login'] == 'success') {
            // Handle login success case
            echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fas fa-solid fa-check check"></i>
            
                        <div class="message">
                            <span class="text text-1">Success</span>
                            <span class="text text-2">Login Successful</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
        }
    }

    if (isset($_GET['info']) && $_GET['info'] == 'Added') {
        // Handle Successfull Login
        echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fas fa-solid fa-check check"></i>
            
                        <div class="message">
                            <span class="text text-1">Success</span>
                            <span class="text text-2">Paper Added Successfully</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'Exists') {
        // Handle Paper Exists
        echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                        <div class="message">
                            <span class="text text-1">Failure</span>
                            <span class="text text-2">Paper Exists in Section</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progresses active"></div>
                </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'AddedSec') {
        // Handle Add Dection Success
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>
                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Section Added Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'SecUpdated') {
        // Handle Add Dection Success
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>
                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Section Updated Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'SectionDel') {
        // Handle Add Dection Success
        echo '
            <div class="toast active">
                <div class="toast-content">
                    <i class="fas fa-solid fa-check check"></i>
                    <div class="message">
                        <span class="text text-1">Success</span>
                        <span class="text text-2">Section Deleted Successfully</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress active"></div>
            </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'ExistsSec') {
        // Handle Section Exists
        echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                        <div class="message">
                            <span class="text text-1">Failure</span>
                            <span class="text text-2">Section Name Already Exists</span>
                        </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progresses active"></div>
                </div>
            ';
    } elseif (isset($_GET['info']) && $_GET['info'] == 'ServerErr') {
        // Handle Server Error
        echo '
                <div class="toast active">
                    <div class="toast-content">
                        <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
            
                        <div class="message">
                            <span class="text text-1">Server Error</span>
                            <span class="text text-2">Sorry!!! Please Try Again</span>
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
            <a class="mr-5 text-green-600 hover:text-gray-900 font-semibold" href="account.php">
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

    <section class="text-gray-600 body-font">
        <div class="container px-5 mx-auto">
            <div class="flex flex-wrap w-full">
                <div class="lg:w-5/6 w-full lg:mb-0 text-center">
                    <h1 class="sm:text-3xl text-2xl font-bold title-font font-mono mb-2 text-gray-900">My Network</h1>
                </div>
                <a type="button" class="lg:w-1/10 flex mx-auto text-black bg-green-500 border-0 py-2 px-4 focus:outline-none hover:bg-green-700 rounded text-lg font-bold title-font font-mono shadow-2xl" href="section.php">
                    <i class="fa fa-fan text-md text-black px-2 py-1 animate-spin"></i>
                    New Section
                </a>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font overflow-auto font-mono">
        <div class="container px-5 py-5 mx-auto">
            <?php
            include '../php-src/db/db_connect.php';
            $uemail = $_SESSION['uemail'];
            $sql = "SELECT * FROM `section` WHERE `uemail` = '$uemail'";
            $res = mysqli_query($con, $sql);
            $numRows = mysqli_num_rows($res);


            if ($numRows > 0) {
                echo '<div class="flex flex-wrap -m-1">';
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '
                        
                            <div class="p-6 md:w-1/3">
                                <div class="flex rounded-lg shadow-xl h-full bg-gray-100 p-8 flex-col">
                                    <div class="flex items-center mb-3">
                                        <div class="w-8 h-8 mr-3 inline-flex items-center justify-center rounded-full bg-green-500 text-white flex-shrink-0">';

                    switch ($row['sec_icon']) {
                        case "Development":
                            echo '<i class="fa-brands fa-html5 text-black fa-flip"></i>';
                            break;
                        case "Coding":
                            echo '<i class="fa-solid fa-terminal text-black fa-flip"></i>';
                            break;
                        case "Research Writings":
                            echo '<i class="fa-solid fa-pen-nib text-black fa-flip"></i>';
                            break;
                        case "Social":
                            echo '<i class="fa-regular fa-comment text-black fa-bounce"></i>';
                            break;
                        case "Hardware":
                            echo 'fa-solid fa-laptop text-black fa-beat-fade';
                            break;
                        case "Technology":
                            echo '<i class="fa-solid fa-flask-vial text-black fa-beat-fade"></i>';
                            break;
                        default:
                            echo '<i class="fa-solid fa-snowflake fa-spin text-black"></i>';
                    }

                    echo '
                                    </div>
                                    <div class="flex flex-col">
                                        <h2 class="text-gray-900 text-lg title-font font-bold">' . $row['sec_name'] . '</h2>
                                        <h2 class="text-gray-900 text-xs">Section : ' . $row['sec_icon'] . '</h2>
                                    </div>
                                </div>
                                <div class="flex-grow">';
                    if (strlen($row['sec_info']) > 70) {
                        echo '<p class="leading-relaxed text-base">' . substr($row['sec_info'], 0, 70) . '....</p>';
                    } else {
                        echo '<p class="leading-relaxed text-base">' . substr($row['sec_info'], 0, 70) . '</p>';
                    }

                    $sec_name = $row['sec_name'];
                    $secNo = $row['sno'];
                    $sec_no = $row['sno'] . ' ' . $sec_name;
                    $sql_inner = "SELECT * FROM `paper` WHERE `email` = '$uemail' AND `paper_sec` = '$sec_name' ;";
                    $res_inner = mysqli_query($con, $sql_inner);
                    $numRows_inner = mysqli_num_rows($res_inner);

                    echo '
                                        <h2 class="text-gray-900 text-xs">Paper Count : ' . $numRows_inner . '</h2>
                                    </div>
                                    <div class="flex">
                                        <a class="mt-3 text-green-500 inline-flex items-center hover:text-green-900 font-semibold" href="threads.php?section=' . $sec_name . '">Explore
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                        <a class="flex ml-auto mt-3 text-blue-700 items-center hover:text-blue-900 font-bold" href="section.php?secID=' . $secNo . '&method=edit">
                                                <i class="fa-solid fa-pencil text-base m-2"></i>
                                        </a>
                                        <a class="cd-popup-triggerr inline-flex ml-2 mt-3 text-red-700 flex items-center hover:text-red-900 font-bold" href="#delete-' . $sec_no . '" data-sec-no="' . $sec_no . '">
                                            <i class="fa-regular fa-trash-can text-base m-2"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        ';
                }
                echo '</div>';
            } else {
                echo '
                        <div class="flex items-center justify-center flex-col">
                            <img class="lg:w-2/6 md:w-3/6 w-5/6 object-contain object-center rounded h-72" alt="hero" src="../img/no-data.png">
                            <div class="text-center lg:w-2/3 w-full">
                                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">NO DATA YET!!! ADD THE FIRST SECTION HERE</h1>
                            </div>
                            <div class="flex justify-center">
                                <a type="button" class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg" href="section.php">New Section</a>
                            </div>
                        </div>
                    ';
            }
            ?>

            <!-- DELETE ALERT STARTS HERE -->
            <div class="cd-popup" role="alert">
                <form class="cd-popup-container" method="post" action="../php-src/modifySection.php?method=del">
                    <i class="fa-solid fa-trash-can text-2xl m-2"></i>
                    <p>Are you sure you want to delete this section?</p>
                    <div class="w-full flex flex-row my-2 mx-auto">
                        <p class="text-sm w-1/3">Section : </p>
                        <input type="text" class="text-black font-bold text-sm w-2/3 outline-none border-none" id="del-sec" name="del-sec" readonly />
                    </div>
                    <input type="hidden" id="del-val" name="del-val">
                    <div class="w-full flex flex-row my-2">
                        <button class="text-black font-semibold bg-red-400 border py-2 px-8 focus:outline-none hover:bg-red-500 rounded text-lg w-1/2 my-2 mx-2">DELETE</button>
                        <button class="cd-popup-no text-black font-semibold bg-gray-400 border py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg w-1/2 my-2 mx-2">CANCEL</button>
                    </div>
                    <a href="#delete" class="cd-popup-close img-replace"></a>
                </form>
            </div>
            <!-- ENDS HERE -->

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

<script type="text/javascript">
    function preventBack() {
        window.history.forward()
    };
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null;
    }
</script>
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
<script>
    jQuery(document).ready(function($) {
        //open popup
        $('.cd-popup-triggerr').on('click', function(event) {
            event.preventDefault();
            var secNo = $(this).data('sec-no'); // Retrieve the sec_no value from the clicked trigger
            var indexOfSpace = secNo.indexOf(' ');

            if (indexOfSpace !== -1) {
                var sectionNumber = secNo.substring(0, indexOfSpace);
                var sectionName = secNo.substring(indexOfSpace + 1);
            }

            $('.cd-popup').addClass('is-visible');
            $('#del-val').val(sectionNumber);
            $('#del-sec').val(sectionName);
        });

        //close popup
        $('.cd-popup').on('click', function(event) {
            if ($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup')) {
                event.preventDefault();
                $(this).removeClass('is-visible');
            }
        });

        //close popup using NO button
        $('.cd-popup').on('click', function(event) {
            if ($(event.target).is('.cd-popup-no') || $(event.target).is('.cd-popup')) {
                event.preventDefault();
                $(this).removeClass('is-visible');
            }
        });

        //close popup when clicking the esc keyboard button
        $(document).keyup(function(event) {
            if (event.which == '27') {
                $('.cd-popup').removeClass('is-visible');
            }
        });
    });
</script>

</html>