<!DOCTYPE html>
<html lang="en">

<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.html");
    exit();
}
$paperID = (int)$_GET['sno'];

include '../php-src/db/db_connect.php';
$uemail = $_SESSION['uemail'];
$sql = "SELECT * FROM `paper` WHERE `email` = '$uemail' AND `p_sno` = '$paperID';";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);

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
    <link rel="stylesheet" href="../css/style.css">

</head>

<body class="flex flex-col h-screen justify-between overflow-hidden">

    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap flex-col p-2 md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="main.php">
                <img class="bg-none h-20 w-48" src="../img/logo.png">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900 font-semibold" href="threads.php?section=<?php echo $row['paper_sec']; ?>">Go Back</a>
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

    <section class="text-gray-600 body-font font-mono relative overflow-auto">
        <form class="container px-5 py-2 mx-auto flex sm:flex-nowrap flex-wrap" method="post" action="../php-src/modifyPaper.php?sno=<?php echo $paperID; ?>&method=edit">
            <div class="lg:w-2/3 md:w-1/2 bg-gray-200 rounded-lg static sm:mr-10 p-10 flex flex-col justify-start relative">
                <div class="flex flex-wrap -m-2">
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="pname" class="leading-7 text-sm text-gray-600">Paper Name</label>
                            <input type="text" id="pname" name="pname" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_name']; ?>" required>
                        </div>
                    </div>
                    <div class="p-2 w-full">
                        <div class="relative">
                            <label for="aname" class="leading-7 text-sm text-gray-600">Author's Name</label>
                            <input type="text" id="aname" name="aname" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_author']; ?>" required>
                        </div>
                    </div>

                    <div class="p-2 lg:w-full w-full">
                        <div class="relative">
                            <label for="publisher" class="leading-7 text-sm text-gray-600">Publisher</label>
                            <input type="hidden" id="pubin" name="pubin" value="<?php echo $row['paper_published_in']; ?>">
                            <input type="text" id="publisher" name="publisher" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_publisher']; ?>" readonly>
                        </div>
                    </div>

                    <div class="p-2 lg:w-1/2 w-full">
                        <div class="relative">
                            <label for="pyear" class="leading-7 text-sm text-gray-600">Year of Publication</label>
                            <input type="text" id="pyear" name="pyear" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_yr']; ?>" required>
                        </div>
                    </div>

                    <div class="p-2 lg:w-1/2 w-full">
                        <div class="relative">
                            <label for="pdoi" class="leading-7 text-sm text-gray-600">DOI</label>
                            <input type="text" id="pdoi" name="pdoi" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_doi']; ?>" readonly>
                        </div>
                    </div>

                    <div class="p-2 lg:w-1/2 w-full">
                        <div class="relative">
                            <label for="upaper" class="leading-7 text-sm text-gray-600">Paper Link</label>
                            <label for="upaper" class="leading-7 text-xs text-gray-600">(** Only Drive Link of the paper)</label>
                            <input type="text" id="upaper" name="upaper" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_drive_url']; ?>">
                        </div>
                    </div>

                    <div class="p-2 lg:w-1/2 w-full">
                        <div class="relative">
                            <label for="psec" class="leading-7 text-sm text-gray-600">Section</label>
                            <label for="psec" class="leading-7 text-xs text-gray-600">(** To change section move paper)</label>
                            <input type="text" id="psec" name="psec" class="w-full bg-white bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-sm outline-none text-black py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" value="<?php echo $row['paper_sec']; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/3 md:w-1/2 bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">
                <h2 class="text-gray-900 text-lg mb-1 font-medium title-font">Summary</h2>
                <div class="relative mb-4">
                    <label for="rangeValue" class="leading-7 text-sm text-gray-600">User Paper Rating</label>
                    <span id="rangeValue" name="rangeValue" class="font-bold lg:text-lg text-sm"><?php echo (int)$row['paper_user_rating']; ?></span>
                    <input class="range" id="rating" name="rating" type="range" value="<?php echo (int)$row['paper_user_rating']; ?>" min="1" max="5" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)" required>
                </div>
                <div class="relative mb-4">
                    <label for="summary" class="leading-7 text-sm text-gray-600">Your Summary</label>
                    <textarea id="summary" name="summary" class="w-full bg-white rounded border border-gray-300 lg:h-52 h-40 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" rows="5" cols="55" maxlength="3000" required><?php echo $row['paper_user_summary']; ?></textarea>
                    <div id="counter" class="text-right text-xs"></div>
                </div>
                <button class="text-black font-bold bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-700 rounded text-lg">Summarize</button>
            </div>
        </form>
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
    function rangeSlide(value) {
        document.getElementById('rangeValue').innerHTML = value;
    }

    const messageEle = document.getElementById('summary');
    const counterEle = document.getElementById('counter');

    messageEle.addEventListener('input', function(e) {
        const target = e.target;

        // Get the `maxlength` attribute
        const maxLength = target.getAttribute('maxlength');

        // Count the current number of characters
        const currentLength = target.value.length;

        counterEle.innerHTML = `${currentLength}/${maxLength}`;
    });
</script>

</html>