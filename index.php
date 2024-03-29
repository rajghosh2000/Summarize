<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summarize</title>
    <link rel="icon" href="img/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />

    <style>
        <?php include "css/style.css" ?>
    </style>
</head>

<body class="flex flex-col h-screen justify-between overflow-hidden">
    <?php
    if (isset($_GET['reg']) && $_GET['reg'] == 'false') {
        // Handle registration success case
        echo '
                <div class="toast active">
                    <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Failure</span>
                        <span class="text text-2">User Email Exists !!! Try Logining In</span>
                    </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
    } elseif (isset($_GET['login']) && $_GET['login'] == 'noUsr') {
        // Handle registration success case
        echo '
                <div class="toast active">
                    <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Failure</span>
                        <span class="text text-2">User Email Doesnot Exists !!! Try Registering</span>
                    </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
    } elseif (isset($_GET['login']) && $_GET['login'] == 'false') {
        // Handle registration success case
        echo '
                <div class="toast active">
                    <div class="toast-content">
                    <i class="fa-solid fa-exclamation check" style="background-color: #b4030c"></i>
                    <div class="message">
                        <span class="text text-1">Failure</span>
                        <span class="text text-2">Wrong Password</span>
                    </div>
                    </div>
                    <i class="fa-solid fa-xmark close"></i>
                    <div class="progress active"></div>
                </div>
            ';
    }
    ?>
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap flex-col p-4 md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="index.php">
                <img class="bg-none h-20 w-48" src="img/logo.png">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900 font-semibold">About</a>
                <a class="mr-5 hover:text-gray-900 font-semibold">Contact Us</a>
            </nav>
            <button class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 md:mt-0" onclick="window.location.href='pages/reg.php'">Get
                Registered
            </button>
            <button class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 mx-2 md:mt-0" onclick="window.location.href='pages/login.php'">Login
            </button>
        </div>
    </header>


    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-12 md:flex-row flex-col items-center">
            <div class="lg:w-1/2 md:w-1/2 lg:pr-6 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Recapitulate your learning
                </h1>
                <p class="mb-8 leading-relaxed">Summarize Your Research Works with Us.</p>
                <div class="flex justify-center">
                    <button class="inline-flex text-white font-semibold bg-green-600 border-0 py-2 px-6 focus:outline-none hover:bg-green-900 rounded text-lg" onclick="window.location.href='pages/reg.php'">Get Started</button>
                    <button class="ml-4 inline-flex text-white font-semibold bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-600 rounded text-lg" onclick="window.location.href='pages/login.php'">Login</button>
                </div>
            </div>
            <div class="lg:max-w-lg lg:w-full md:w-1/2 flex flex-row ">
                <img class="object-cover object-center rounded mx-1" alt="hero" src="img/index-img.png">
            </div>
        </div>
    </section>

    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0">
                <img class="bg-none h-10 w-28" src="img/logo.png">
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
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