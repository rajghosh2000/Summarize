<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.php");
    exit();
}

$paperID = (int)$_GET['sno'];

include '../php-src/db/db_connect.php';
$uemail = $_SESSION['uemail'];
$sql = "SELECT * FROM `paper` WHERE `email` = '$uemail' AND `p_sno` = '$paperID';";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

$timestamp = $row['paper_timestamp'];
$formattedDate = date("d-m-Y", strtotime($timestamp));
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
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap flex-col p-2 md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="main.php">
                <img class="bg-none h-20 w-48" src="../img/logo.png">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900 font-semibold" href="threads.php?section=<?php echo $row['paper_sec']; ?>">Go Back</a>
                <a class="mr-5 hover:text-gray-900 font-semibold" href="main.php">My Network</a>
                <!-- <a class="mr-5 hover:text-gray-900 font-semibold">About</a>
                <a class="mr-5 hover:text-gray-900 font-semibold">Contact Us</a> -->
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

    <section class="text-gray-600 body-font overflow-auto">
        <div class="container px-5 py-4 mx-auto">
            <div class="flex flex-col text-center w-full mb-4">
                <h2 class="text-xs text-green-500 tracking-widest font-semibold title-font">SECTION : <?php echo $row['paper_sec']; ?></h2>
                <h1 class="sm:text-3xl text-2xl font-bold title-font text-gray-900"><?php echo $row['paper_name']; ?></h1>
            </div>
            <div class="flex flex-col lg:flex-row -m-4 h-auto lg:h-96">
                <div class="p-4 lg:w-1/2">
                    <div class="h-full p-2 rounded-lg border-2 border-green-300 flex flex-col relative overflow-hidden">
                        <?php if ((int)$row['p_updated'] == 1) { ?>
                            <span class="bg-green-500 px-3 py-1 tracking-widest text-xs absolute right-0 bottom-0 rounded-tl text-black">LAST EDITED ON : <?php echo $timestamp; ?></span>
                        <?php } ?>
                        <h2 class="text-base tracking-widest title-font mb-1 font-medium">DOI</h2>
                        <h1 class="text-base font-bold pb-4 mb-2 border-b border-gray-200 leading-none"><?php echo $row['paper_doi']; ?></h1>
                        <h2 class="text-base tracking-widest title-font mb-1 font-medium">Publisher Details</h2>
                        <h2 class="text-base tracking-widest title-font mb-1 font-bold"><?php echo $row['paper_publisher']; ?></h2>
                        <h1 class="text-base font-bold pb-4 mb-2 border-b border-gray-200 leading-none"><?php echo $row['paper_published_in']; ?></h1>
                        <h2 class="text-base tracking-widest title-font mb-1 font-medium">Author Details</h2>
                        <h1 class="text-base font-bold pb-4 mb-2 border-b border-gray-200 leading-none"><?php echo $row['paper_author']; ?></h1>

                        <a type="button" class="flex items-center mt-2 text-black bg-green-500 border-2 border-green-700 py-2 px-4 w-full focus:outline-none hover:bg-green-600 rounded" href="<?php echo $row['paper_external_url']; ?>" target="_blank">Paper External Link
                            <i class="fa-solid fa-square-up-right w-4 h-4 ml-auto"></i>
                        </a>
                    </div>
                </div>
                <div class="p-4 lg:w-1/2">
                    <div class="h-full p-6 rounded-lg border-2 border-green-500 flex flex-col relative overflow-hidden">
                        <span class="bg-green-500 text-white px-3 py-1 tracking-widest text-xs absolute right-0 top-0 rounded-bl">YOUR SUMMARY</span>
                        <h2 class="text-sm tracking-widest title-font mb-1 font-medium">DATED : <?php echo $formattedDate; ?></h2>
                        <p class="text-base text-green-800 mt-1 px-2 overflow-auto"> <?php echo $row['paper_user_summary']; ?> </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container px-5 py-2 mx-auto flex items-center md:flex-row flex-col">
            <div class="flex flex-col md:pr-10 md:mb-0 mb-6 pr-0 w-full md:w-auto md:text-left text-center">
                <h2 class="text-xs text-green-800 tracking-widest font-medium title-font mb-2">Your Rating</h2>

                <span class="star-rating text-2xl">
                    <?php
                    $paper_user_rating = (int)$row['paper_user_rating'];
                    for ($i = 1; $i <= 5; $i++) {
                        $checked = ($i === $paper_user_rating) ? 'checked' : '';
                        echo '<label for="rate-' . $i . '" style="--i:' . $i . '"><i class="fa-solid fa-star"></i></label>';
                        echo '<input type="radio" name="rating" class="px-2" id="rate-' . $i . '" value="' . $i . '" disabled ' . $checked . '>';
                    }
                    ?>
                </span>
            </div>
            <div class="flex flex-col lg:flex-row -m-4 h-auto lg:h-12 md:ml-auto md:mr-0 mx-auto items-center flex-shrink-0 space-x-4">

                <?php if ($row['paper_drive_url'] == '') { ?>
                    <a type="button" title="No Paper Drive Link Available" class="bg-gray-400 text-black inline-flex py-3 px-5 rounded-lg items-center focus:outline-none my-2 border-2 border-green-700" href="#" disabled>
                        <i class="fa-solid fa-link text-2xl"></i>
                        <span class="ml-4 flex items-start flex-col leading-none">
                            <span class="title-font font-medium">NO PAPER DRIVE LINK</span>
                        </span>
                    </a>
                <?php } else { ?>
                    <a type="button" title="Paper Drive Link Uploaded By User" class="bg-green-400 text-black inline-flex py-3 px-5 rounded-lg items-center hover:bg-green-500 focus:outline-none my-2 border-2 border-green-700" href="<?php echo $row['paper_drive_url']; ?>" target="_blank">
                        <i class="fa-solid fa-link text-2xl fa-beat"></i>
                        <span class="ml-4 flex items-start flex-col leading-none">
                            <span class="title-font font-medium">PAPER DRIVE LINK</span>
                        </span>
                    </a>
                <?php } ?>

                <a type="button" title="Edit your Paper" class="bg-green-400 text-black inline-flex py-3 px-5 rounded-lg items-center hover:bg-green-500 focus:outline-none my-2 border-2 border-green-700" href="editPaper.php?sno=<?php echo $paperID; ?>">
                    <i class="fa-solid fa-pen-fancy text-2xl fa-beat"></i>
                    <span class="ml-4 flex items-start flex-col leading-none">
                        <span class="title-font font-medium">EDIT PAPER</span>
                    </span>
                </a>
                <a type="button" title="Move Paper to Different Section" class="cd-popup-triggeer bg-green-400 text-black inline-flex py-3 px-5 rounded-lg items-center hover:bg-green-500 focus:outline-none my-2 border-2 border-green-700" href="#move">
                    <i class="fa-solid fa-angles-right text-2xl fa-beat"></i>
                    <span class="ml-4 flex items-start flex-col leading-none">
                        <span class="title-font font-medium">MOVE PAPER</span>
                    </span>
                </a>

                <div class="cd-popup-1" role="alert">
                    <form class="cd-popup-container" method="post" action="../php-src/modifyPaper.php?sno=<?php echo $paperID; ?>&method=move">
                        <i class="fa-solid fa-arrow-right-arrow-left text-2xl m-2"></i>
                        <p>Move Paper</p>
                        <p class="font-bold text-black">PRESENT SECTION : <?php echo $row['paper_sec']; ?></p>
                        <div class="flex ml-6 items-center">
                            <span class="mr-3">Section</span>
                            <div class="relative">
                                <?php
                                include '../php-src/db/db_connect.php';
                                $uemail = $_SESSION['uemail'];
                                $sqlSEC = "SELECT * FROM `section` WHERE `uemail` = '$uemail'";
                                $resSEC = mysqli_query($con, $sqlSEC);
                                $numRowsSEC = mysqli_num_rows($resSEC);


                                if ($numRowsSEC > 0) {
                                    if ($numRowsSEC == 1) {
                                        echo '<p class="font-bold text-black">No Other Section Available</p>';
                                        echo '
                                            </div>
                                        </div>
                                        <button class="text-black font-semibold bg-gray-400 border py-2 px-8 focus:outline-none hover:bg-gray-500 rounded text-lg w-full mt-2" disabled>MOVE NOT POSSIBLE</button>
                                        <a href="#move" class="cd-popup-close img-replace"></a>                                        
                                        ';
                                    } else {
                                ?>
                                        <select id="psecID" name="psecID" class="rounded border appearance-none border-gray-300 py-2 focus:outline-none focus:ring-2 focus:ring-green-200 focus:border-green-500 text-base pl-3 my-2 pr-10 w-full font-bold text-black shadow-2xl">
                                    <?php
                                        while ($rowSEC = mysqli_fetch_assoc($resSEC)) {
                                            if ($rowSEC['sec_name'] == $row['paper_sec']) {
                                                continue;
                                            } else {
                                                echo '<option value="' . $rowSEC['sno'] . '">' . $rowSEC['sec_name'] . '</option>';
                                            }
                                        }
                                        echo '</select>';
                                        echo '
                                                    <span class="absolute right-0 top-0 h-full w-10 text-center text-gray-600 pointer-events-none flex items-center justify-center">
                                                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 font-bold text-black" viewBox="0 0 24 24">
                                                            <path d="M6 9l6 6 6-6"></path>
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                            <button class="text-black font-semibold bg-green-400 border py-2 px-8 focus:outline-none hover:bg-green-500 rounded text-lg w-full mt-2" disabled>MOVE PAPER</button>
                                            <a href="#move" class="cd-popup-close img-replace"></a>  
                                        ';
                                    }
                                }

                                    ?>
                    </form>
                </div>


                <a type="button" title="Delete Paper" class="cd-popup-triggerr bg-green-400 text-black inline-flex py-3 px-5 rounded-lg items-center hover:bg-green-500 focus:outline-none my-2 border-2 border-green-700" href="#delete">
                    <i class="fa-solid fa-trash-can text-2xl"></i>
                    <span class="ml-4 flex items-start flex-col leading-none">
                        <span class="title-font font-medium">DELETE PAPER</span>
                    </span>
                </a>

                <div class="cd-popup" role="alert">
                    <div class="cd-popup-container">
                        <i class="fa-solid fa-trash-can text-2xl m-2"></i>
                        <p>Are you sure you want to delete this paper?</p>
                        <ul class="cd-buttons">
                            <li><a href="../php-src/modifyPaper.php?sno=<?php echo $paperID; ?>&method=del">Yes</a></li>
                            <li><a href="#delete" class="cd-popup-no">No</a></li>
                        </ul>
                        <a href="#delete" class="cd-popup-close img-replace"></a>
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
<script>
    jQuery(document).ready(function($) {
        //open popup
        $('.cd-popup-triggerr').on('click', function(event) {
            event.preventDefault();
            $('.cd-popup').addClass('is-visible');
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

    jQuery(document).ready(function($) {
        //open popup
        $('.cd-popup-triggeer').on('click', function(event) {
            event.preventDefault();
            $('.cd-popup-1').addClass('is-visible');
        });

        //close popup
        $('.cd-popup-1').on('click', function(event) {
            if ($(event.target).is('.cd-popup-close') || $(event.target).is('.cd-popup-1')) {
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
                $('.cd-popup-1').removeClass('is-visible');
            }
        });
    });

    document.getElementById('delete-no').addEventListener('click', function() {
        // Close the modal when the "No" button is clicked
        var modal = document.querySelector('.cd-popup-1');
        modal.classList.add('hidden'); // Add a class to hide the modal
    });
</script>

</html>