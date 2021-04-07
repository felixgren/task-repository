<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Repo</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>

<body class="bg-gray-200 dark:bg-black-gh">
    <nav class="bg-blue-500 dark:bg-dark-gh-banner flex flex-wrap p-4 sm:flex-nowrap sm:justify-between">
        <ul class="flex items-center">
            <li>
                <a href="{{ route('dashboard') }}" class="navbar-link dark:text-white">Dashboard</a>
            </li>
            <li>
                <a href="" class="navbar-link dark:text-white">Settings</a>
            </li>
            <li>
                <a href="" class="navbar-link dark:text-white">Posts</a>
            </li>
        </ul>

        <h1 class="font-mono font-bold order-first w-full sm:order-none sm:w-auto sm:text-xl dark:text-white">Task Repo
        </h1>

        <ul class="flex items-center">
            @guest
                <li>
                    <a href="{{ route('login') }}" class="navbar-link dark:text-white">Login</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="navbar-link dark:text-white">Register</a>
                </li>
            @endguest

            @auth
                <li>
                    <a href="" class="navbar-link dark:text-white"></a>
                </li>
                <li>
                    <form action="" method="post" class="inline navbar-link dark:text-white">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>
    @yield('content')
    <script src="/js/app.js"></script>
</body>

</html>
