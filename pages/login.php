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
    <script type="text/javascript">
        function preventBack(){
            window.history.forward()
        };
        setTimeout("preventBack()",0);
        window.onunload=function(){null;}
    </script>
</head>

<body class="flex flex-col h-screen justify-between">
    <nav class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap flex-col p-4 md:flex-row items-center">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0" href="../index.php">
                <img class="bg-none h-20 w-48" src="../img/logo.png">
            </a>
            <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
                <a class="mr-5 hover:text-gray-900 font-semibold">About</a>
                <a class="mr-5 hover:text-gray-900 font-semibold">Contact Us</a>
            </nav>
            <button
                class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 md:mt-0"
                onclick="window.location.href='reg.php'">Get
                Registered
            </button>
            <button
                class="inline-flex items-center bg-green-600 border-0 py-1 px-3 focus:outline-none hover:bg-green-900 rounded text-base text-white font-semibold mt-4 mx-2 md:mt-0"
                onclick="window.location.href='login.php'">Login
            </button>
        </div>
    </nav>

    <section class="text-gray-600 body-font relative">
        <div class="container px-5 mx-auto flex sm:flex-nowrap md:flex-nowrap flex-wrap">
            <div class="lg:max-w-lg lg:w-full md:w-1/2 m-auto px-4">
                <img class="object-cover object-center rounded mx-1" alt="hero" src="../img/logIn.png">
            </div>
            <form class="lg:w-1/2 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0"
                action="../php-src/_sign-in.php" method="post">
                <h2 class="text-gray-900 text-2xl mb-3 font-bold title-font text-center">Login</h2>
                <div class="relative mb-4">
                    <div class="relative">
                        <label for="email" class="leading-7 text-lg text-gray-600 font-bold">Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full bg-white bg-opacity-50 rounded border-2 sm:flex-nowrap border-green-500 focus:border-green-700 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 font-semibold py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <div class="relative mb-4">
                    <div class="relative">
                        <label for="name" class="leading-7 text-lg text-gray-600 font-bold">Password</label>
                        <input type="password" id="pwd" name="pwd"
                            class="w-full bg-white bg-opacity-50 rounded border-2 sm:flex-nowrap border-green-500 focus:border-green-700 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 font-semibold py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                </div>
                <button
                    class="flex mx-auto text-white bg-green-600 border-2 border-green-900 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-xl font-bold">
                    Sign In
                </button>
            </form>
        </div>
    </section>

    <footer class="text-gray-600 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center text-gray-900 md:mb-0">
                <img class="bg-none h-10 w-28" src="../img/logo.png">
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                2023 Summarize —
                <a href="https://www.linkedin.com/in/rajdeep-ghosh-301082175/"
                    class="font-semibold text-green-300 ml-1 hover:text-green-900" rel="noopener noreferrer"
                    target="_blank">@rajdeep</a>
            </p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
            </span>
        </div>
    </footer>
</body>

</html>