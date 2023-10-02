<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['signedIn'])) {
    header("Location: login.html");
    exit();
}
include '../php-src/db/db_connect.php';
$uemail = $_SESSION['uemail'];

$sectionsICON = array(
    'Research Writings' => '&#xf5ad; - Research Writings',
    'Social' => '&#xf075; - Social',
    'Technology' => '&#xe4f3; - Technology',
    'Hardware' => '&#xf109; - Hardware',
    'Coding' => '&#xf120; - Coding',
    'Development' => '&#xf13b; - Development',
    'Others' => '&#xf2dc; - Others'
);
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
                    echo $_SESSION['uname'];
                }
                ?>
            </a>
            <button class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 mx-2 md:mt-0 shadow-2xl" onclick="window.location.href='../php-src/logout.php'">Logout
            </button>
        </div>
    </header>

    <?php if (isset($_GET['method']) and $_GET['method'] == 'edit') {
        $secID = (int)$_GET['secID'];

        $chk_sql = "SELECT * FROM `section` WHERE uemail='$uemail' AND sno='$secID';";
        $res_chk = mysqli_query($con, $chk_sql);

        if ($res_chk) {
            $numRows = mysqli_num_rows($res_chk);
            if ($numRows > 0) {
                $sql = "SELECT * from `section` WHERE uemail='$uemail' AND sno='$secID';";
                $res = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($res);
    ?>
                <section class="text-gray-600 body-font">
                    <div class="container px-5 py-4 mx-auto">
                        <div class="lg:w-4/5 mx-auto flex flex-wrap">
                            <img alt="ecommerce" class="lg:w-1/3 w-full lg:h-auto h-44 object-contain object-center rounded mx-auto" src="../img/section.png">
                            <div class="lg:w-2/3 w-full font-mono bg-gray-100 rounded-2xl px-8 py-2 flex flex-col">
                                <h1 class="text-gray-900 lg:text-3xl text-xl title-font text-center font-medium font-bold mb-1">New Section</h1>
                                <form class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5 flex flex-col" action="../php-src/modifySection.php?secID=<?php echo $secID; ?>&method=edit" method="post">
                                    <div class="flex lg:flex-row flex-col w-full my-2">
                                        <div class="flex flex-col ml-3 w-full my-2">
                                            <span class="mr-3 font-bold">Section Name</span>
                                            <input type="text" id="sec-name" name="sec-name" class="w-full bg-white rounded-lg border-green-500 border-2 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out font-bold" required value="<?php echo $row['sec_name']; ?>">
                                        </div>
                                        <div class="flex flex-col ml-3 w-full my-2">
                                            <span class="mr-3 font-bold">Select Section Icon</span>
                                            <select id="sec-icon" name="sec-icon" class="bg-white border-green-500 border-2 text-green-700 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5" required>
                                                <?php
                                                $selectedIcon = isset($row['sec_icon']) ? $row['sec_icon'] : '';

                                                foreach ($sectionsICON as $value => $label) {
                                                    $selected = ($selectedIcon == $value) ? 'selected' : '';
                                                    echo "<option value='$value' $selected>$label</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="flex flex-col ml-6 w-full">
                                        <span class="mr-3 font-bold">Section Info</span>
                                        <textarea id="sec-info" name="sec-info" class="w-full bg-gray-50 bg-opacity-50 rounded-lg border-green-500 border-2 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" rows="3" cols="55" maxlength="200" required><?php echo $row['sec_info']; ?></textarea>
                                        <div id="counter" class="text-right text-xs"></div>
                                    </div>

                                    <div class="flex flex-col ml-6 my-2 w-full">
                                        <button class="flex mx-auto text-black font-bold bg-green-500 border-2 border-green-700 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                            <i class="fa fa-fan text-md text-black px-2 py-1 animate-spin"></i>
                                            Update Section
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
        <?php }
        }
    } else { ?>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-4 mx-auto">
                <div class="lg:w-4/5 mx-auto flex flex-wrap">
                    <img alt="ecommerce" class="lg:w-1/3 w-full lg:h-auto h-44 object-contain object-center rounded mx-auto" src="../img/section.png">
                    <div class="lg:w-2/3 w-full font-mono bg-gray-100 rounded-2xl px-8 py-2 flex flex-col">
                        <h1 class="text-gray-900 lg:text-3xl text-xl title-font text-center font-medium font-bold mb-1">New Section</h1>
                        <form class="flex mt-6 items-center pb-5 border-b-2 border-gray-100 mb-5 flex flex-col" action="../php-src/newSetion.php" method="post">
                            <div class="flex lg:flex-row flex-col w-full my-2">
                                <div class="flex flex-col ml-3 w-full my-2">
                                    <span class="mr-3 font-bold">Section Name</span>
                                    <input type="text" id="sec-name" name="sec-name" class="w-full bg-white rounded-lg border-green-500 border-2 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out font-bold">
                                </div>
                                <div class="flex flex-col ml-3 w-full my-2">
                                    <span class="mr-3 font-bold">Select Section Icon</span>
                                    <select id="sec-icon" name="sec-icon" class="bg-white border-green-500 border-2 text-green-700 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5">
                                        <option value="Research Writings">&#xf5ad; - Research Writings</option>
                                        <option value="Social">&#xf075; - Social</option>
                                        <option value="Technology">&#xe4f3; - Technology </option>
                                        <option value="Hardware">&#xf109; - Hardware</option>
                                        <option value="Coding">&#xf120; - Coding</option>
                                        <option value="Development">&#xf13b; - Development</option>
                                        <option value="Others">&#xf2dc; - Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="flex flex-col ml-6 w-full">
                                <span class="mr-3 font-bold">Section Info</span>
                                <textarea id="sec-info" name="sec-info" class="w-full bg-gray-50 bg-opacity-50 rounded-lg border-green-500 border-2 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" rows="3" cols="55" maxlength="200"></textarea>
                                <div id="counter" class="text-right text-xs"></div>
                            </div>

                            <div class="flex flex-col ml-6 my-2 w-full">
                                <button class="flex mx-auto text-black font-bold bg-green-500 border-2 border-green-700 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                    <i class="fa fa-fan text-md text-black px-2 py-1 animate-spin"></i>
                                    Create Section
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

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
    const messageEle = document.getElementById('sec-info');
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