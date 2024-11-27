<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">

    <!-- Favicon -->
    <link href="{{ asset('/assets/images/favicon.png') }}" rel="icon" type="image/png">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/night-mode.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/framework.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">

    <!-- icons
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('/assets/css/icons.css') }}">
</head>

<body>
    <!-- Content
    ================================================== -->
    <div uk-height-viewport="expand: true" class="uk-flex uk-flex-middle">
        <div class="uk-width-1-3@m uk-width-1-2@s m-auto">
            @if ($errors->any())
                <div class="my-4">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="uk-card-default p-5 rounded">
                <div class="mb-4 uk-text-center">
                    <h3 class="mb-0">Criar nova conta</h3>
                    <p class="my-2">Faça login para gerenciar sua conta.</p>
                </div>
                <form action="{{ route('register') }}" method="POST">

                    @csrf
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Nome</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" name="first_name" autocomplete="name"
                                    value="{{ old('first_name') }}">
                            </div>

                        </div>
                    </div>

                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Apelido</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-user"></i>
                                </span>
                                <input class="uk-input" type="text" name="last_name" autocomplete="name"
                                    value="{{ old('last_name') }}">
                            </div>

                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Email</label>

                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon">
                                    <i class="icon-feather-mail"></i>
                                </span>
                                <input class="uk-input" type="email" name="email" autocomplete="email"
                                    value="{{ old('email') }}">
                            </div>

                        </div>
                    </div>

                    <div class="uk-form-group">
                        <label class="uk-form-label">Palavra-passe</label>

                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon">
                                <i class="icon-feather-lock"></i>
                            </span>
                            <input class="uk-input" type="password" name="password" autocomplete="new-password">
                        </div>

                    </div>

                    <div class="uk-form-group">
                        <label class="uk-form-label">Confirmar palavra-passe</label>

                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon">
                                <i class="icon-feather-lock"></i>
                            </span>
                            <input class="uk-input" type="password" name="password_confirmation"
                                autocomplete="new-password">
                        </div>
                    </div>

                    <div class="uk-form-group">
                        <label class="uk-form-label">Tipo de conta</label>

                        <div class="uk-form-controls uk-form-controls-text">
                            <label>
                                <input class="uk-radio" type="radio" name="role" checked
                                    value="{{ \App\Enum\Role::STUDENT }}">
                                Aluno
                            </label>
                            <label>
                                <input class="uk-radio" type="radio" name="role"
                                    value="{{ \App\Enum\Role::INSTRUCTOR }}">
                                Instrutor
                            </label>
                        </div>
                    </div>



                    <div class="mt-4 uk-flex-middle uk-grid-small" uk-grid="">
                        <div class="uk-width-expand@s">
                            <p>Tem uma conta? <a href="{{ route('login') }}">Login</a></p>
                        </div>
                        <div class="uk-width-auto@s">
                            <input type="submit" class="btn btn-default w-100" value="Iniciar">
                        </div>
                    </div>
            </div>

            </form>
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
    <script src="{{ asset('/assets/js/framework.js') }}" ></script>
    <script src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('/assets/js/simplebar.js') }}"></script>
    <script src="{{ asset('/assets/js/main.js') }}"></script>
    <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>
</body>

</html>
