<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7cf9c715ad.js" crossorigin="anonymous"></script>
</head>
<body>
<div id="app">
    <nav class="sticky top-0 z-10 navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Events Finder') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a id="" class="nav-link " href="/events" role="button" v-pre>
                            Events <span class="caret"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a id="" class="nav-link " href="/venues" role="button" v-pre>
                            Venues <span class="caret"></span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a id="" class="nav-link " href="/artists" role="button" v-pre>
                            Artists <span class="caret"></span>
                        </a>
                    </li>

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item">
                            <a id="" class="nav-link " href="/dashboard" role="button" v-pre>
                                Dashboard <span class="caret"></span>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-0">
        @yield('content')
    </main>
    <footer class="text-gray-600 body-font">
        <div class="bg-gray-100">
            <div class="container px-5 py-6 mx-auto flex items-center sm:flex-row flex-col">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
                                            <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                                        </svg>
                    <span class="ml-3 text-l">AllEventsFinder © 2021 | </span>
                    <span>                    <p> <a href="/terms" class="text-blue-600">| Terms and conditions</a> </p>
</span>
                </a>
                <p class="text-sm text-gray-500 sm:ml-6 sm:mt-0 mt-4"><i class="fa fa-envelope-open" aria-hidden="true"></i> : Antonykatei11@gmail.com <i class="fa fa-phone" aria-hidden="true"></i>
                    : 0700024779
                </p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
{{--        <a class="text-gray-500">--}}
                    {{--          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">--}}
                    {{--            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>--}}
                    {{--          </svg>--}}
                    {{--        </a>--}}
                    {{--        <a class="ml-3 text-gray-500">--}}
                    {{--          <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">--}}
                    {{--            <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path>--}}
                    {{--          </svg>--}}
                    {{--        </a>--}}
                    {{--        <a class="ml-3 text-gray-500">--}}
                    {{--          <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">--}}
                    {{--            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>--}}
                    {{--            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>--}}
                    {{--          </svg>--}}
                    {{--        </a>--}}
                    {{--        <a class="ml-3 text-gray-500">--}}
                    {{--          <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">--}}
                    {{--            <path stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path>--}}
                    {{--            <circle cx="4" cy="4" r="2" stroke="none"></circle>--}}
                    {{--          </svg>--}}
                    {{--        </a>--}}
      </span>
            </div>
        </div>
    </footer>

</div>
<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
