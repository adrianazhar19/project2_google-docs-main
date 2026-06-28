```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Google Docs') }}</title>

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-[Poppins] bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700">

    <div class="min-h-screen flex items-center justify-center px-4">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-6">

                <a href="/">
                    <div class="mx-auto w-20 h-20 rounded-full bg-white flex items-center justify-center shadow-xl">

                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-blue-600"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12h6m-6 4h6M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2z"/>

                        </svg>

                    </div>
                </a>

                <h1 class="text-3xl font-bold text-white mt-5">
                    Google Docs
                </h1>

                <p class="text-blue-100 mt-2">
                    Document Management System
                </p>

            </div>

            <!-- Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8">

                {{ $slot }}

            </div>

            <p class="text-center text-white text-sm mt-6">
                © {{ date('Y') }} Google Docs System.
                All Rights Reserved.
            </p>

        </div>

    </div>

</body>

</html>
```
