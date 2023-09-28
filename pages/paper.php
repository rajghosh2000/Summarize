<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.html");
    exit();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summarize</title>
    <link rel="icon" href="../img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
</head>

<style>
    select {
        font-family: 'FontAwesome', 'Second Font name'
    }
</style>

<body class="flex flex-col h-screen justify-between">

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
                    echo $_SESSION['uemail'];
                }
                ?>
            </a>
            <button class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 mx-2 md:mt-0 shadow-2xl" onclick="window.location.href='../php-src/logout.php'">Logout
            </button>
        </div>
    </header>

    <section class="text-gray-600 body-font overflow-hidden pb-4">
        <div class="container px-5 mx-auto">
            <div class="flex flex-col text-center w-full">
                <h1 class="text-xl font-medium title-font text-gray-900">PAPER SEARCH</h1>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font">
        <div class="container px-5 py-2 mx-auto">
            <div class="flex flex-wrap -m-4">
                <div class="w-full p-4">
                    <div class="border border-green-500 p-2 rounded-lg h-auto">
                        <div class="w-3/4 mx-auto">
                            <form class="flex flex-wrap mx-auto my-1" method="post" action="">
                                <div class="p-2 w-full">
                                    <div class="relative">
                                        <label for="pname" class="leading-7 text-base text-gray-600 font-bold">Paper Name</label>
                                        <input type="text" id="pname" name="pname" class="w-full bg-white bg-opacity-50 rounded border-2 sm:flex-nowrap border-green-500 focus:border-green-700 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-gray-700 font-semibold py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" onkeyup='saveValue(this);'>
                                    </div>
                                </div>
                                <div class="p-2 w-full">
                                    <button class="flex mx-auto text-white bg-green-600 border-2 border-green-900 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-base font-semibold" name="submit" value="submit">
                                        Search
                                        <i class="fa-brands fa-searchengin text-base font-semibold text-white px-4 py-1"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php
    if (isset($_POST['submit'])) {
        include('../api/paperSearchApi.php');
        $search_paper_text = $_POST['pname'];
        // echo paperSearchByName($search_paper_text);
        $res = json_decode(paperSearchByName($search_paper_text));
        if ($res->Status) {
    ?>
            <section class="text-gray-600 body-font overflow-hidden pb-4">
                <div class="container px-5 py-2 mx-auto">
                    <div class="flex flex-col text-center w-full mb-5">
                        <h1 class="text-xl font-bold title-font mb-1 text-gray-900">Results Found</h1>
                    </div>
                </div>
            </section>

            <section class="text-gray-600 body-font overflow-auto">
                <div class="container px-2 py-4 mx-auto">
                    <?php
                    for ($i = 0; $i <= 4; $i++) {
                        if (isset($res->$i) and !is_null($res->$i->DOI)) {
                            $paper = $res->$i;
                            $authors = array();
                            if (isset($paper->Authors) and !is_null($paper->Authors)) {
                                foreach ($paper->Authors as $authorInfo) {
                                    // Loop through the properties of each authorInfo object
                                    foreach ($authorInfo as $authorNumber => $authorName) {
                                        // Add the author name to the $authors array
                                        $authors[] = $authorName;
                                    }
                                }
                            } else {
                                $authors[] = 'NOT AVAILABLE';
                            }
                    ?>

                            <div class="-my-8 divide-y-2 divide-gray-100">
                                <div class="py-8 flex flex-wrap md:flex-nowrap">
                                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                                        <span class="text-xs font-semibold text-gray-700 mt-2">
                                            <?php
                                            if (!is_null($paper->Publisher)) {
                                                if ($paper->Publisher == "Institute of Electrical and Electronics Engineers (IEEE)") {
                                                    echo 'IEEE';
                                                } elseif ($paper->Publisher == "Association for Computing Machinery (ACM)") {
                                                    echo 'ACM';
                                                } elseif ($paper->Publisher == "Springer International Publishing") {
                                                    echo 'Springer';
                                                } else {
                                                    echo $paper->Publisher;
                                                }
                                            } else {
                                                echo 'NOT AVAILABLE';
                                            }
                                            ?>
                                        </span>
                                        <span class="mt-1 text-gray-500 text-sm">
                                            <?php echo is_null($paper->Year) ? 'NOT AVAILABLE' : $paper->Year; ?>
                                        </span>
                                    </div>
                                    <div class="md:flex-grow mx-5">
                                        <h2 class="text-xl font-medium text-gray-900 title-font mb-2">
                                            <?php echo is_null($paper->Title) ? 'NOT AVAILABLE' : $paper->Title; ?>
                                        </h2>
                                        <h2 class="text-xs font-semibold text-gray-700 mt-2 w-full">
                                            <?php echo implode(", ", $authors); ?>
                                        </h2>
                                        <a class="text-green-500 font-bold inline-flex items-center mt-1" href="newPaper.php?DOI=<?php echo $paper->DOI; ?>">Explore
                                            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M5 12h14"></path>
                                                <path d="M12 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                    <?php
                        }
                    }
                    echo '           </div>
                    </section>';
                } else {
                    ?>
                    <section class="text-gray-600 body-font overflow-hidden">
                        <div class="container px-5 py-1 mx-auto">
                            <div class="flex flex-col text-center w-full mb-5">
                                <h1 class="text-4xl font-medium title-font mb-4 text-gray-900">Results Not Found</h1>
                            </div>
                        </div>
                    </section>
            <?php
                }
            }
            ?>



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
    document.getElementById("pname").value = getSavedValue("pname"); // set the value to this input
    /* Here you can add more inputs to set value. if it's saved */

    //Save the value function - save it to localStorage as (ID, VALUE)
    function saveValue(e) {
        var id = e.id; // get the sender's id to save it . 
        var val = e.value; // get the value. 
        localStorage.setItem(id, val); // Every time user writing something, the localStorage's value will override . 
    }

    //get the saved value function - return the value of "v" from localStorage. 
    function getSavedValue(v) {
        if (!localStorage.getItem(v)) {
            return ""; // You can change this to your defualt value. 
        }
        return localStorage.getItem(v);
    }
</script>

</html>