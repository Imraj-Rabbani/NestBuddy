<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo.png') }}" />
    @vite('resources/css/app.css')

</head>

<body class="bg-gray-100">

    <nav class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('homepage') }}">
                            <img src="{{ asset('assets/Logo.png') }}" alt="" class="w-[60px]">
                        </a>
                    </div>
                </div>



                @if (Auth::check())
                    <div class="flex items-center">
                        <div class="hidden sm:block">
                            <ul class="flex space-x-8">
                                <li>
                                    <span class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                        <a href="{{route('showorders')}}">
                                        {{ Auth::user()->name }} 
                                    </a>
                                    </span>
                                </li>
                                <li><a href="{{ route('userprofile') }}"
                                        class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                                </li>
                                <li><a href="{{ route('logout') }}"
                                        class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium"
                                        onclick="event.preventDefault(); 
                                document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @else
                    <div class="flex items-center">
                        <div class="hidden sm:block">
                            <ul class="flex space-x-8">
                                <li><a href="{{ route('login') }}"
                                        class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">Log
                                        In</a></li>
                                <li><a href="{{ route('register') }}"
                                        class="text-gray-900 hover:bg-gray-50 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium">
                                        Register
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </nav>






    <main class="py-4">
        @yield('content')
    </main>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
