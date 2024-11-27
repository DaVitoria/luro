<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    {{--  --}}
    <link rel="icon" href="{{ asset('/assets/images/favicon.png') }}" type="image/png">


    {{--  --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/night-mode.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/framework.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">

    {{--  --}}
    <link rel="stylesheet" href="{{ asset('/assets/css/icons.css') }}">
</head>

<body>

    <div id="wrapper" class="admin-panel">

        <!-- menu -->
        <div class="page-menu">
            <!-- btn close on small devices -->
            <span class="btn-menu-close" uk-toggle="target: #wrapper ; cls: mobile-active"></span>
            <!-- traiger btn -->
            <span class="btn-menu-trigger" uk-toggle="target: .page-menu ; cls: menu-large"></span>

            <!-- logo -->
            <div class="logo uk-visible@s">
                <a href="{{ route('home') }}">
                    <i class="uil-graduation-hat"></i><span>Courseplus</span>
                </a>
            </div>
            <div class="page-menu-inner" data-simplebar="">
                <ul class="mt-0">
                    <li @class(['active' => request()->routeIs('home')])>
                        <a href="{{ route('home') }}"><i class="uil-home-alt"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li @class([
                        'active' => request()->routeIs(auth()->user()->role->dashboard()),
                    ])>
                        <a href="{{ route(auth()->user()->role->dashboard()) }}"><i
                                class="icon-material-outline-dashboard"></i><span>
                                Overview</span>
                        </a>
                    </li>
                    @can('student')
                        <li @class(['active' => request()->routeIs('student.courses.index')])>
                            <a href="#"><i class="uil-youtube-alt"></i><span>Cursos</span></a>
                        </li>
                    @elsecan('instrutor')
                        <li @class(['active' => request()->routeIs('instructor.courses.index')])>
                            <a href="{{ route('instructor.courses.index') }}"><i
                                    class="uil-youtube-alt"></i><span>Cursos</span></a>
                        </li>
                        <li @class(['active' => request()->routeIs('instructor.students.index')])>
                            <a href="{{ route('instructor.students.index') }}"><i
                                    class="icon-feather-users"></i><span>Alunos</span></a>
                        </li>
                        <li>
                            <a href="{{ route('instructor.subscriptions.paid') }}"><i
                                    class="icon-line-awesome-money"></i><span>Pago</span></a>
                        </li>
                        <li>
                            <a href="{{ route('instructor.subscriptions.pending') }}"><i
                                    class="icon-line-awesome-money"></i><span>Pagamentos pendentes/cancelados</span></a>
                        </li>
                    @elsecan('administrator')
                        <li @class([
                            'active' => request()->routeIs('administrator.instructors.index'),
                        ])>
                            <a href="{{ route('administrator.instructors.index') }}"><i
                                    class="uil-graduation-hat"></i><span>Instrutores</span></a>
                        </li>
                        <li @class([
                            'active' => request()->routeIs('administrator.categories.index'),
                        ])>
                            <a href="{{ route('administrator.categories.index') }}">
                                <i class="uil-tag-alt"></i><span>Categorias</span>
                            </a>
                        </li>
                        <li @class([
                            'active' =>
                                request()->routeIs('administrator.courses.pending') ||
                                request()->routeIs('administrator.courses.rejected'),
                        ])>
                            <a href="#"><i class="uil-layers"></i>
                                <span>Cursos</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('administrator.courses.pending') }}">Em revisão</a>
                                </li>

                                <li>
                                    <a href="{{ route('administrator.courses.rejected') }}">Rejeitados</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                </ul>

                <ul data-submenu-title="Configurações">
                    <li @class([
                        'active' => request()->routeIs('settings.account'),
                    ])>
                        <a href="{{ route('settings.account') }}"><i class="uil-cog"></i><span>Conta</span></a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="p-2">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-animated btn-danger btn-animated-x w-100">
                                <span class="btn-inner--visible">Sair</span>
                                <span class="btn-inner--hidden">
                                    <i class="icon-feather-log-out"></i>
                                </span>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Header Container
        ================================================== -->
        <header class="header uk-light">
            <div class="container">
                <nav uk-navbar="">
                    <!-- left Side Content -->
                    <div class="uk-navbar-left">
                        <!-- menu icon -->
                        <span class="mmenu-trigger" uk-toggle="target: #wrapper ; cls: mobile-active">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </span>

                        <!-- logo -->
                        <a href="{{ route('home') }}" class="logo">
                            <img src="/assets/images/logo-dark.svg" alt="" />
                            <span>Courseplus</span>
                        </a>

                        <div class="searchbox uk-visible@s">
                            <input class="uk-search-input" type="search" placeholder="Procurar..." />
                            <button class="btn-searchbox"></button>
                        </div>
                        <!-- Search box dropdown -->
                        <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small"
                            class="dropdown-search">
                            <div class="erh BR9 MIw"
                                style="
                    top: -26px;
                    position: absolute;
                    left: 24px;
                    fill: currentColor;
                    height: 24px;
                    pointer-events: none;
                    color: #f5f5f5;
                  ">
                                <svg width="22" height="22">
                                    <path d="M0 24 L12 12 L24 24"></path>
                                </svg>
                            </div>
                            <!-- User menu -->

                            <ul class="dropdown-search-list">
                                <li class="list-title">Recent Searches</li>
                                <li>
                                    <a href="course-intro.html">
                                        Ultimate Web Designer And Developer Course</a>
                                </li>
                                <li>
                                    <a href="course-intro.html">
                                        The Complete Ruby on Rails Developer Course
                                    </a>
                                </li>
                                <li>
                                    <a href="course-intro.html">
                                        Bootstrap 4 From Scratch With 5 Real Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="course-intro.html">
                                        The Complete 2020 Web Development Bootcamp
                                    </a>
                                </li>
                                <li class="menu-divider"></li>
                                <li>
                                    <a href="course-intro.html">
                                        Bootstrap 4 From Scratch With 5 Real Projects
                                    </a>
                                </li>
                                <li>
                                    <a href="course-intro.html">
                                        The Complete 2020 Web Development Bootcamp
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!--  Right Side Content   -->

                    <div class="uk-navbar-right">
                        <div class="header-widget">
                            <!-- notificiation icon  -->

                            <a href="#" class="header-widget-icon"
                                uk-tooltip="title: Notificiation ; pos: bottom ;offset:21">
                                <i class="uil-bell"></i>
                                <span>4</span>
                            </a>

                            <!-- notificiation dropdown -->
                            <div uk-dropdown="pos: top-right;mode:click ; animation: uk-animation-slide-bottom-small"
                                class="dropdown-notifications">
                                <!-- notivication header -->
                                <div class="dropdown-notifications-headline">
                                    <h4>Notifications</h4>
                                    <a href="#">
                                        <i class="icon-feather-settings"
                                            uk-tooltip="title: Notifications settings ; pos: left"></i>
                                    </a>
                                </div>

                                <!-- notification contents -->
                                <div class="dropdown-notifications-content" data-simplebar="">
                                    <!-- notiviation list -->
                                    <ul>
                                        <li class="notifications-not-read">
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-danger disabled">
                                                    <i class="icon-feather-thumbs-up"></i></span>
                                                <span class="notification-text">
                                                    <strong>Adrian Mohani</strong>Like Your Comment On
                                                    Course
                                                    <span class="text-primary">Javascript Introduction
                                                    </span>
                                                    <br />
                                                    <span class="time-ago">9 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-primary disabled">
                                                    <i class="icon-feather-message-circle"></i></span>
                                                <span class="notification-text">
                                                    <strong>Stella Johnson</strong>Replay Your Comments
                                                    in
                                                    <span class="text-primary">Programming for Games</span>
                                                    <br />
                                                    <span class="time-ago">12 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-success disabled">
                                                    <i class="icon-feather-star"></i></span>
                                                <span class="notification-text">
                                                    <strong>Alex Dolgove</strong>Added New Review In
                                                    Course
                                                    <span class="text-primary">Full Stack PHP Developer</span>
                                                    <br />
                                                    <span class="time-ago">19 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="notifications-not-read">
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-danger disabled">
                                                    <i class="icon-feather-share-2"></i></span>
                                                <span class="notification-text">
                                                    <strong>Jonathan Madano</strong>Shared Your
                                                    Discussion On Course
                                                    <span class="text-primary">Css Flex Box </span>
                                                    <br />
                                                    <span class="time-ago">Yesterday </span>
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Message  -->

                            <a href="#" class="header-widget-icon"
                                uk-tooltip="title: Message ; pos: bottom ;offset:21">
                                <i class="uil-envelope-alt"></i>
                                <span>1</span>
                            </a>

                            <!-- Message  notificiation dropdown -->
                            <div uk-dropdown=" pos: top-right;mode:click" class="dropdown-notifications">
                                <!-- notivication header -->
                                <div class="dropdown-notifications-headline">
                                    <h4>Messages</h4>
                                    <a href="#">
                                        <i class="icon-feather-settings"
                                            uk-tooltip="title: Message settings ; pos: left"></i>
                                    </a>
                                </div>

                                <!-- notification contents -->
                                <div class="dropdown-notifications-content" data-simplebar="">
                                    <!-- notiviation list -->
                                    <ul>
                                        <li class="notifications-not-read">
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-3.jpeg"
                                                        alt="" />
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Jonathan Madano</strong>
                                                    <p>
                                                        Okay.. Thanks for The Answer I will be waiting for
                                                        your...
                                                    </p>
                                                    <span class="time-ago">2 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-3.jpeg"
                                                        alt="" />
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Stella Johnson</strong>
                                                    <p>
                                                        Alex will explain you how to keep the HTML
                                                        structure and all that...
                                                    </p>
                                                    <span class="time-ago">7 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-1.jpeg"
                                                        alt="" />
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Alex Dolgove</strong>
                                                    <p>
                                                        Alia Joseph just joined Messenger! Be the first to
                                                        send a welcome message..
                                                    </p>
                                                    <span class="time-ago">19 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-4.jpeg"
                                                        alt="" />
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Adrian Mohani</strong>
                                                    <p>
                                                        Okay.. Thanks for The Answer I will be waiting for
                                                        your...
                                                    </p>
                                                    <span class="time-ago">Yesterday </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="dropdown-notifications-footer">
                                    <a href="#">
                                        sell all
                                        <i class="icon-line-awesome-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!-- profile-icon-->

                            <div class="dropdown-user-details">
                                <div class="dropdown-user-avatar">
                                    <img src="{{ auth()->user()->image_url }}" alt=""
                                        style="aspect-ratio: 1; object-fit: cover;" />
                                </div>
                                <div class="dropdown-user-name">
                                    {{ auth()->user()->name }} <span>{{ auth()->user()->role->name() }}</span>
                                </div>
                            </div>

                            <div uk-dropdown="pos: top-right ;mode:click" class="dropdown-notifications small">
                                <!-- User menu -->

                                <ul class="dropdown-user-menu">
                                    <li>
                                        <a href="{{ route(auth()->user()->role->dashboard()) }}">
                                            <i class="icon-material-outline-dashboard"></i>
                                            Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('settings.account') }}">
                                            <i class="icon-feather-settings"></i>Configurações</a>
                                    </li>
                                    <li>
                                        <a href="#" id="night-mode" class="btn-night-mode">
                                            <i class="icon-feather-moon"></i>Night mode
                                            <span class="btn-night-mode-switch">
                                                <span class="uk-switch-button"></span>
                                            </span>
                                        </a>
                                    </li>
                                    <ul class="menu-divider">

                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" class="p-2">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-animated btn-danger btn-animated-x w-100">
                                                    <span class="btn-inner--visible">Sign Out</span>
                                                    <span class="btn-inner--hidden">
                                                        <i class="icon-feather-log-out"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </ul>
                            </div>
                        </div>

                        <!-- icon search-->
                        <a class="uk-navbar-toggle uk-hidden@s"
                            uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#">
                            <i class="uil-search icon-small"></i>
                        </a>
                        <!-- User icons -->
                        <span class="uil-user icon-small uk-hidden@s"
                            uk-toggle="target: .header-widget ; cls: is-active">
                        </span>
                    </div>
                    <!-- End Right Side Content / End -->
                </nav>
            </div>
            <!-- container  / End -->
        </header>

        <div class="page-content">
            <div class="page-content-inner pt-lg-0 pr-lg-0">
                @if (session()->has('success'))
                    <div class="uk-alert-success mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
                        <p>{{ session()->get('success') }}</p>
                    </div>
                    @php
                        session()->remove('success');
                    @endphp
                @endif

                @if (session()->has('error'))
                    <div class="uk-alert-danger mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
                        <p>{{ session()->get('error') }}</p>
                    </div>
                    @php
                        session()->remove('error');
                    @endphp
                @endif

                @if ($errors->any())
                    <div class="uk-alert-danger mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                {{ $slot }}

                <div class="footer p-0">
                    <div class="uk-grid-collapse" uk-grid="">
                        <div class="uk-width-expand@s uk-first-column">
                            <p>© {{ now()->year }} <strong>{{ config('app.name') }}</strong>. Todos os direitos
                                reservados.</p>
                        </div>
                        <div class="uk-width-auto@s">
                            <nav class="footer-nav-icon">
                                <ul>
                                    <li>
                                        <a href="https://web.facebook.com/p/Universidade-Save-100063559124409"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="icon-line-awesome-facebook"></i>
                                        </a>
                                    </li>
                                    <li>

                                        <a href="http://unisave.ac.mz" target="_blank" rel="noopener noreferrer">
                                            <i class="icon-line-awesome-globe"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--  --}}
    <script>
        (function(window, document, undefined) {
            'use strict';
            if (!('localStorage' in window)) return;
            var nightMode = localStorage.getItem('gmtNightMode');
            if (nightMode) {
                document.documentElement.className += ' night-mode';
            }
        })(window, document);


        (function(window, document, undefined) {

            'use strict';

            // Feature test
            if (!('localStorage' in window)) return;

            // Get our newly insert toggle
            var nightMode = document.querySelector('#night-mode');
            if (!nightMode) return;

            // When clicked, toggle night mode on or off
            nightMode.addEventListener('click', function(event) {
                event.preventDefault();
                document.documentElement.classList.toggle('night-mode');
                if (document.documentElement.classList.contains('night-mode')) {
                    localStorage.setItem('gmtNightMode', true);
                    return;
                }
                localStorage.removeItem('gmtNightMode');
            }, false);

        })(window, document);
    </script>

    <script defer src="{{ asset('/assets/js/framework.js') }}"></script>
    <script defer src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script defer src="{{ asset('/assets/js/simplebar.js') }}"></script>
    <script defer src="{{ asset('/assets/js/main.js') }}"></script>
    <script defer src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
    <script defer src="{{ asset('/assets/js/chart.min.js') }}"></script>
    <script defer src="{{ asset('/assets/js/chart-custom.js') }}"></script>

    <script defer>
        const a = document.querySelectorAll('.refresh');
        a.forEach(element => {
            element.onclick = event => {
                event.preventDefault();
                location.reload();
            }
        });
    </script>
</body>

</html>
