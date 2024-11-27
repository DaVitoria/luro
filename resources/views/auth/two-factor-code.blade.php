<!DOCTYPE html>

<head>
  <!-- Basic Page Needs
    ================================================== -->
  <title>{{ config('app.name') }}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Courseplus - Professional Learning Management HTML Template">

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
          <h3 class="mb-0">Autenticação de 2FA</h3>
          <p>Ao ativar a autenticação de dois fatores, você adicionará uma camada extra de segurança à sua conta.</p>
        </div>

        <p>Use o seguinte código para completar seu login:</p>
        <h2>{{ $code }}</h2>
        <p>O código expira em 10 minutos.</p>
      </div>
    </div>
  </div>



  <!-- For Night mode -->
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


  <!-- javaScripts
    ================================================== -->
  <script src="{{ asset('/assets/js/framework.js') }}"></script>
  <script src="{{ asset('/assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('/assets/js/simplebar.js') }}"></script>
  <script src="{{ asset('/assets/js/main.js') }}"></script>
  <script src="{{ asset('/assets/js/bootstrap-select.min.js') }}"></script>

</body>

</html>
