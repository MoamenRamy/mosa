<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Open Graph Meta Tags (for social media sharing) -->
    <meta property="og:title" content="Mosa">
    <meta property="og:description" content="At Mosa, we specialize in providing top-quality fish and seafood products to hotels, ensuring fresh, sustainably sourced ingredients that meet the highest industry standards. Our commitment to delivering exceptional service and premium fish products has made us a trusted partner for hotels seeking to enhance their dining experiences with the finest seafood.">

    <!-- image donot work -->
    <meta property="og:image" content="{{asset('images/logo/logo-color.png')}}">

    <link rel="icon" type="image/x-icon" href="{{asset('images/logo-no-background1.png')}}">
    <title>{{ config('app.name', 'موسي') }} - @yield('title', '')</title>
    <link href="https://fastly.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" integrity="sha512-GQGU0fMMi238uA+a/bdWJfpUGKUkBdgfFdgBm72SUQ6BeyWjoY/ton0tEjH+OSH9iP4Dfh+7HM0I9f5eR0L/4w==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="{{asset('theme/nomaliz.css')}}">
    <link rel="stylesheet" href="{{asset('theme/main.css')}}">

    @vite(['resources/css/app.css'])


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f0f0f0;
        }

        .bg-cart {
            background-color: #ffc107;
            color: #fff;
        }

        .score {
            display: block;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }

        .score-wrap {
            display: inline-block;
            position: relative;
            height: 19px;
        }

        .score .stars-active {
            color: #FFCA00;
            position: relative;
            z-index: 10;
            display: block;
            overflow: hidden;
            white-space: nowrap;
        }

        .score .stars-inactive {
            color: lightgray;
            position: absolute;
            top: 0;
            left: 0;
        }

        .rating {
            overflow: hidden;
            display: inline-block;
            position: relative;
            font-size: 20px;
        }
        .rating-star {
            padding: 0 5px;
            margin: 0;
            cursor: pointer;
            display: block;
            float: left;
        }
        .rating-star:after {
            position: relative;
            font-family: "Font Awesome 5 Free";
            content: '\f005';
            color: lightgrey;
        }
        .rating-star.checked ~ .rating-star:after,
        .rating-star.checked:after {
            content: '\f005';
            color: #FFCA00;
        }
        .rating:hover .rating-star:after {
            content: '\f005';
            color: lightgrey;
        }
        .rating-star:hover ~ .rating-star:after,
        .rating .rating-star:hover:after {
            content: '\f005';
            color: #FFCA00;
        }
        .collapse {
            visibility: visible;
        }

        .no-hover:hover {
            text-decoration: none;
            color: inherit;
            background-color: inherit;
        }
        /* @media(max-width: 993px)
        {
            .profile-arrow {
                display: none;
            }
        } */

    </style>
    @yield('head')
</head>
<body dir="rtl" style="text-align: right">


    <div>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand px-3" href="{{ url('/') }}">
                    <img src="{{asset('images/logo/png/logo-no-background.png')}}" alt="Mosa" width="120px">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{route('orders.index')}}">
                                    طلبيات الفنادق
                            </a>
                        </li>
                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{route('goods.index')}}">
                                    البضاعة
                            </a>
                        </li>
                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{ route('category.index') }}">
                                    التصنيفات
                            </a>
                        </li>
                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{ route('hotels.index') }}">
                                    الفنادق
                            </a>
                        </li>
                        @admin
                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{ route('suppliers.index') }}">
                                    الموردين
                            </a>
                        </li>

                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                    الموظفين
                            </a>
                        </li>

                        <li class="py-1 px-3 nav-item">
                            <a class="nav-link" href="{{route('financial.index')}}">
                                    الحسابات
                            </a>
                        </li>
                        @endadmin
                    </ul>

                    <ul class="navbar-nav mr-auto navbar-dark bg-dark">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('تسجيل الدخول') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('إنشاء حساب') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown justify-content-left">
                                <a id="navbarDropdown" class="nav-link" href="#" data-bs-toggle="dropdown">
                                    <button type="button" class="inline-flex items-center px-3 py-2 text-sm leading-4 font-medium rounded-md navbar-dark bg-dark hover:text-white-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        <i class="fa-solid fa-caret-down px-2 mt-1" style="color: #74C0FC;"></i>
                                        {{ Auth::user()->name }}

                                    </button>
                                </a>

                                <div class="dropdown-menu dropdown-menu-left px-2 text-right mt-2 navbar-dark bg-dark">


                                    <div class="pt-1 navbar-dark bg-dark">
                                        {{-- <div class="flex items-center px-4">
                                            <div>
                                                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                                            </div>
                                        </div> --}}

                                        <div dir="rtl" class="mt-3 space-y-1">
                                            <!-- Account Management -->
                                            <x-responsive-nav-link style="text-align: right !important" href="{{route('profile.show')}}" :active="request()->routeIs('profile.show')">
                                                {{ __('الملف الشخصي') }}
                                            </x-responsive-nav-link>

                                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                                <x-responsive-nav-link href="" :active="request()->routeIs('api-tokens.index')">
                                                    {{ __('API Tokens') }}
                                                </x-responsive-nav-link>
                                            @endif

                                            <!-- Authentication -->
                                            <form method="POST" action="{{ route('logout') }}" x-data>
                                                @csrf

                                                <x-responsive-nav-link style="text-align: right !important" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                                    {{ __('تسجيل خروج') }}
                                                </x-responsive-nav-link>
                                            </form>

                                            <!-- Team Management -->
                                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                                                <div class="border-t border-gray-200"></div>

                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Manage Team') }}
                                                </div>

                                                <!-- Team Settings -->
                                                <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                                                    {{ __('Team Settings') }}
                                                </x-responsive-nav-link>

                                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                                    <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                                                        {{ __('Create New Team') }}
                                                    </x-responsive-nav-link>
                                                @endcan

                                                <div class="border-t border-gray-200"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    {{ __('Switch Teams') }}
                                                </div>

                                                @foreach (Auth::user()->allTeams() as $team)
                                                    <x-switchable-team :team="$team" component="jet-responsive-nav-link" />
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @if(session('success'))
                <div class="container">
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            @if(session('fail'))
                <div class="container">
                    <div class="alert alert-danger" role="alert">
                        {{ session('fail') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </main>
    </div>


    <script src="https://fastly.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://fastly.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/160daa7df6.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')
</body>
</html>
