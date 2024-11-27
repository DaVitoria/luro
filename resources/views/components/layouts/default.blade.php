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

    <!-- Wrapper -->
    <div id="wrapper" class="bg-white">

        <!-- Header Container
        ================================================== -->
        <header class="header header-horizontal header bg-grey uk-light">

            <div class="container">
                <nav uk-navbar="">

                    <!-- left Side Content -->
                    <div class="uk-navbar-left">

                        <!-- menu icon -->
                        <span class="mmenu-trigger">
                            <button class="hamburger hamburger--collapse" type="button">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </span>

                        <!-- logo -->
                        <a href="{{ route('home') }}" class="logo">
                            <img src="{{ asset('/assets/images/logo-dark.svg') }}" alt="">
                            <span>Courseplus</span>
                        </a>

                        <!-- Main Navigation -->

                        <nav id="navigation">
                            <ul id="responsive">
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="{{ route('courses.index') }}">Cursos</a></li>
                            </ul>
                        </nav>
                        <!-- Main Navigation / End -->

                    </div>


                    <!--  Right Side Content   -->

                    <div class="uk-navbar-right">

                        <div class="header-widget">

                            <div class="searchbox uk-visible@s">

                                <input class="uk-search-input" type="search" placeholder="Procurar..">
                                <button class="btn-searchbox"></button>

                            </div>
                            <!-- Search box dropdown -->
                            <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small"
                                class="dropdown-search">
                                <div class="erh BR9 MIw"
                                    style="top: -27px;position: absolute ; left: 24px;fill: currentColor;height: 24px;pointer-events: none;color: #f5f5f5;">
                                    <svg width="22" height="22">
                                        <path d="M0 24 L12 12 L24 24"></path>
                                    </svg>
                                </div>
                                <!-- User menu -->

                                <ul class="dropdown-search-list">
                                    <li class="list-title">
                                        Recent Searches
                                    </li>
                                    <li>
                                        <a href="#">Ultimate Web Designer And Developer Course</a>
                                    </li>
                                    <li><a href="#">The Complete Ruby on Rails Developer Course</a>
                                    </li>
                                    <li><a href="#">Bootstrap 4 From Scratch With 5 Real Projects</a>
                                    </li>
                                    <li>
                                        <a href="#">The Complete 2020 Web Development Bootcamp</a>
                                    </li>
                                </ul>

                            </div>



                            <!-- User icons close mobile-->
                            <span class="icon-feather-x icon-small uk-hidden@s"
                                uk-toggle="target: .header-widget ; cls: is-active"></span>


                            <a href="#" class="header-widget-icon"
                                uk-tooltip="title: My Courses ; pos: bottom ;offset:21">
                                <i class="uil-youtube-alt"></i>
                            </a>

                            <!-- courses dropdown List -->
                            <div uk-dropdown="pos: top;mode:click;animation: uk-animation-slide-bottom-small"
                                class="dropdown-notifications my-courses-dropdown">

                                <!-- notivication header -->
                                <div class="dropdown-notifications-headline">
                                    <h4>Your Courses</h4>
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
                                                <span class="notification-image">
                                                    <img src="..\assets\images\course\1.png" alt=""></span>
                                                <span class="notification-text">
                                                    <span class="course-title">Ultimate Web Designer & Web Developer
                                                    </span>
                                                    <span class="course-number">6/35 </span>
                                                    <span class="course-progressbar">
                                                        <span class="course-progressbar-filler"
                                                            style="width:95%"></span>
                                                    </span>
                                                </span>

                                                <!-- option menu -->
                                                <span class="btn-option">
                                                    <i class="icon-feather-more-vertical"></i>
                                                </span>
                                                <div class="dropdown-option-nav"
                                                    uk-dropdown="pos: bottom-right ;mode : hover">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="icon-material-outline-dashboard"></i>
                                                                Course Dashboard</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-video"></i>
                                                                Resume Course</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-x"></i>
                                                                Remove Course</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a>

                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-image">
                                                    <img src="..\assets\images\course\3.png" alt=""></span>
                                                <span class="notification-text">
                                                    <span class="course-title">The Complete JavaScript Course Build
                                                        Real
                                                        Projects !</span>
                                                    <span class="course-number">6/35 </span>
                                                    <span class="course-progressbar">
                                                        <span class="course-progressbar-filler"
                                                            style="width:95%"></span>
                                                    </span>
                                                </span>

                                                <!-- option menu -->
                                                <span class="btn-option">
                                                    <i class="icon-feather-more-vertical"></i>
                                                </span>
                                                <div class="dropdown-option-nav"
                                                    uk-dropdown="pos: bottom-right ;mode : hover">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="icon-material-outline-dashboard"></i>
                                                                Course Dashboard</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-video"></i>
                                                                Resume Course</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-x"></i>
                                                                Remove Course</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-image">
                                                    <img src="..\assets\images\course\2.png" alt=""></span>
                                                <span class="notification-text">
                                                    <span class="course-title">Learn Angular Fundamentals From The
                                                        Beginning</span>
                                                    <span class="course-number">6/35 </span>
                                                    <span class="course-progressbar">
                                                        <span class="course-progressbar-filler"
                                                            style="width:95%"></span>
                                                    </span>
                                                </span>

                                                <!-- option menu -->
                                                <span class="btn-option">
                                                    <i class="icon-feather-more-vertical"></i>
                                                </span>
                                                <div class="dropdown-option-nav"
                                                    uk-dropdown="pos: bottom-right ;mode : hover">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="icon-material-outline-dashboard"></i>
                                                                Course Dashboard</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-video"></i>
                                                                Resume Course</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-x"></i>
                                                                Remove Course</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-image">
                                                    <img src="..\assets\images\course\1.png" alt=""></span>
                                                <span class="notification-text">
                                                    <span class="course-title">Ultimate Web Designer & Web Developer
                                                    </span>
                                                    <span class="course-number">6/35 </span>
                                                    <span class="course-progressbar">
                                                        <span class="course-progressbar-filler"
                                                            style="width:95%"></span>
                                                    </span>
                                                </span>

                                                <!-- option menu -->
                                                <span class="btn-option">
                                                    <i class="icon-feather-more-vertical"></i>
                                                </span>
                                                <div class="dropdown-option-nav"
                                                    uk-dropdown="pos: top-right ;mode : hover">
                                                    <ul>
                                                        <li>
                                                            <span>
                                                                <i class="icon-material-outline-dashboard"></i>
                                                                Course Dashboard</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-video"></i>
                                                                Resume Course</span>
                                                        </li>
                                                        <li>
                                                            <span>
                                                                <i class="icon-feather-x"></i>
                                                                Remove Course</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                                <div class="dropdown-notifications-footer">
                                    <a href="#">sell all</a>
                                </div>
                            </div>

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
                                    <h4>Notifications </h4>
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
                                                    <strong>Adrian Mohani</strong>Like Your Comment On Course
                                                    <span class="text-primary">Javascript Introduction </span>
                                                    <br><span class="time-ago">9 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-primary disabled">
                                                    <i class="icon-feather-message-circle"></i></span>
                                                <span class="notification-text">
                                                    <strong>Stella Johnson</strong>Replay Your Comments in
                                                    <span class="text-primary">Programming for Games</span>
                                                    <br><span class="time-ago">12 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-success disabled">
                                                    <i class="icon-feather-star"></i></span>
                                                <span class="notification-text">
                                                    <strong>Alex Dolgove</strong>Added New Review In Course
                                                    <span class="text-primary">Full Stack PHP Developer</span>
                                                    <br><span class="time-ago">19 hours ago </span>
                                                </span>
                                            </a>
                                        </li>
                                        <li class="notifications-not-read">
                                            <a href="#">
                                                <span class="notification-icon btn btn-soft-danger disabled">
                                                    <i class="icon-feather-share-2"></i></span>
                                                <span class="notification-text">
                                                    <strong>Jonathan Madano</strong>Shared Your Discussion On Course
                                                    <span class="text-primary">Css Flex Box </span>
                                                    <br><span class="time-ago">Yesterday </span>
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
                                                    <img src="..\assets\images\avatars\avatar-2.jpeg" alt="">
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Jonathan Madano</strong>
                                                    <p>Okay.. Thanks for The Answer I will be waiting for your...
                                                    </p>
                                                    <span class="time-ago">2 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-3.jpeg" alt="">
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Stella Johnson</strong>
                                                    <p>Alex will explain you how to keep the HTML structure and all
                                                        that...</p>
                                                    <span class="time-ago">7 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-1.jpeg" alt="">
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Alex Dolgove</strong>
                                                    <p>Alia Joseph just joined Messenger! Be the first to send a
                                                        welcome message..</p>
                                                    <span class="time-ago">19 hours ago </span>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="notification-avatar">
                                                    <img src="..\assets\images\avatars\avatar-4.jpeg" alt="">
                                                </span>
                                                <div class="notification-text notification-msg-text">
                                                    <strong>Adrian Mohani</strong>
                                                    <p>Okay.. Thanks for The Answer I will be waiting for your...
                                                    </p>
                                                    <span class="time-ago">Yesterday </span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                                <div class="dropdown-notifications-footer">
                                    <a href="#">Ver tudo <i class="icon-line-awesome-long-arrow-right"></i>
                                    </a>
                                </div>
                            </div>


                            <!-- profile-icon-->

                            <a href="#" class="header-widget-icon profile-icon">
                                <img src="{{ auth()->check() ? auth()->user()->image_url : asset('/assets/images/incognito.jpg') }}"
                                    alt="" class="header-profile-icon"
                                    style="aspect-ratio: 1; object-fit: cover;">
                            </a>

                            <div uk-dropdown="pos: top-right ;mode:click" class="dropdown-notifications small">
                                @auth
                                    {{--  --}}
                                    <a href="#">
                                        <div class="dropdown-user-details">
                                            <div class="dropdown-user-avatar">
                                                <img src="{{ auth()->user()->image_url }}" alt=""
                                                    style="aspect-ratio: 1; object-fit: cover;">
                                            </div>
                                            <div class="dropdown-user-name">
                                                {{ auth()->user()->name }}
                                                <span>{{ auth()->user()->role->name() }}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endauth

                                {{--  --}}
                                <ul class="dropdown-user-menu">
                                    @auth
                                        <li>
                                            <a href="{{ route(auth()->user()->role->dashboard()) }}">
                                                <i class="icon-material-outline-dashboard"></i>Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('settings.account') }}">
                                                <i class="icon-feather-settings"></i>Configurações da conta
                                            </a>
                                        </li>
                                    @endauth

                                    <li>
                                        <a href="#" id="night-mode" class="btn-night-mode">
                                            <i class="icon-feather-moon"></i>Modo noturno
                                            <span class="btn-night-mode-switch">
                                                <span class="uk-switch-button"></span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="menu-divider">

                                    <li>
                                        @auth
                                            <form action="{{ route('logout') }}" method="POST" class="p-2">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-animated btn-danger btn-animated-x w-100">
                                                    <span class="btn-inner--visible">Sair</span>
                                                    <span class="btn-inner--hidden">
                                                        <i class="icon-feather-log-out"></i>
                                                    </span>
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('login') }}">
                                                <i class="icon-feather-log-in"></i>Login
                                            </a>
                                            <a href="{{ route('register') }}">
                                                <i class="icon-feather-upload"></i>Registo
                                            </a>
                                        @endauth
                                    </li>
                                </ul>


                            </div>


                        </div>



                        <!-- icon search-->
                        <a class="uk-navbar-toggle uk-hidden@s"
                            uk-toggle="target: .nav-overlay; animation: uk-animation-fade" href="#">
                            <i class="uil-search icon-small"></i>
                        </a>

                        <!-- User icons -->
                        <a href="#" class="uil-user icon-small uk-hidden@s"
                            uk-toggle="target: .header-widget ; cls: is-active">
                        </a>

                    </div>
                    <!-- End Right Side Content / End -->


                </nav>

            </div>
            <!-- container  / End -->

        </header>

        <!-- overlay seach on mobile-->
        <div class="nav-overlay uk-navbar-left uk-position-relative uk-flex-1 bg-grey uk-light p-2" hidden=""
            style="z-index: 10000;">
            <div class="uk-navbar-item uk-width-expand" style="min-height: 60px;">
                <form class="uk-search uk-search-navbar uk-width-1-1">
                    <input class="uk-search-input" type="search" placeholder="Procurar..." autofocus="">
                </form>
            </div>
            <a class="uk-navbar-toggle" uk-close="" uk-toggle="target: .nav-overlay; animation: uk-animation-fade"
                href="#"></a>
        </div>



        <div class="page-content">


            {{ $slot }}

        </div>

        {{--  --}}
        <div class="footer">
            <div class="container">
                <div uk-grid="">
                    <div class="uk-width-1-3@m">
                        <a href="#" class="uk-logo">
                            <!-- logo icon -->
                            <i class="uil-graduation-hat"></i>
                            Courseplus
                        </a>
                        <p class="footer-description">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Itaque
                            corporis ipsam inventore.</p>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-2">
                        <div class="footer-links pl-lg-8">
                            <h5>Explorar </h5>
                            <ul>
                                <li><a href="{{ route('courses.index') }}">Coursos</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-2">
                        <div class="footer-links pl-lg-8">
                            <h5>Conta</h5>
                            <ul>
                                <li><a href="#">Perfil</a></li>
                                <li><a href="{{ route('settings.account') }}">Configurações </a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="uk-width-expand@s uk-width-1-2">
                        <div class="footer-links pl-lg-8">
                            <h5>Resources</h5>
                            <ul>
                                <li><a href="#">Contacto</a></li>
                                <li><a href="#">Política de Privacidade</a></li>
                                <li><a href="#">Termos de Uso</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
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
    <script defer src="{{ asset('/assets/js/mmenu.min.js') }}"></script>
    <script defer src="{{ asset('/assets/js/simplebar.js') }}"></script>
    <script defer src="{{ asset('/assets/js/main.js') }}"></script>

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
