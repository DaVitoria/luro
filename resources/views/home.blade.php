<x-layouts.default>
    <div class="home-hero" data-src="{{ asset('/assets/images/pexels-kampus-5940713.jpg') }}" uk-img="">
        <div class="uk-width-1-1">
            <div class="page-content-inner uk-position-z-index">
                <h1>Learn HTML , CSS, <br>& More</h1>
                <h4 class="my-lg-4">Aprenda a criar sites e aplicativos<br>escreva código e/ou comece um negócio
                </h4>
                <a href="{{ route('courses.index') }}" class="btn btn-default">Veja nossos cursos</a>
            </div>
        </div>
    </div>

    <!-- Content
    ================================================== -->

    <div class="section">
        <div class="page-content-inner">

            <div class="section-small text-md-left text-center">
                <div class="uk-child-width-1-2@m uk-gird-large uk-flex-middle" uk-grid="">
                    <div>
                        <img src="{{ asset('/assets/images/feature.png') }}" alt="">
                    </div>
                    <div>
                        <h2>Aprenda a codificar a qualquer momento <br>e em todos os lugares
                            <p>Comece apenas com seu nome e endereço de e-mail. É tão simples<br>assim - não são
                                necessários pagamentos ou informações de cartão de crédito.</p>
                            <a href="{{ route('courses.index') }}" class="btn btn-soft-light">Iniciar</a>
                        </h2>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="section-small delimiter-top">

        <div class="container-small">

            <div class="text-center mb-5">
                <h3>Confira nossos mais novos cursos</h3>
                <h5>Com nosso catálogo crescente de mais de 30 programas Nanodegree, do iniciante ao avançado</h5>
            </div>
            <div class="course-grid-slider mt-lg-5" uk-slider="finite: true">
                <div class="uk-slider-container pb-3">
                    <ul class="uk-slider-items uk-child-width-1-2@s uk-child-width-1-3@m uk-grid">
                        @foreach ($latest_courses as $course)
                            <x-course-card :course="$course" />
                        @endforeach
                    </ul>


                    <a class="uk-position-center-left uk-position-small uk-hidden-hover slidenav-prev" href="#"
                        uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover slidenav-next" href="#"
                        uk-slider-item="next"></a>

                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('courses.index') }}" class="btn btn-soft-light btn-small btn-circle">
                    Ver mais cursos</a>
            </div>
        </div>
    </div>

    <div class="section text-center">
        <div class="page-content-inner">

            <h2 class="mb-4">Nós cobrimos a parte técnica</h2>
            <img src="{{ asset('assets/images/feature-2.png') }}" alt="" class="my-lg-5">

        </div>
    </div>

    <div class="section bg-white">
        <div class="container-small">
            <h2 class="text-center my-lg-6">
                Experimente o Courseplus.
            </h2>

            <div class="d-flex justify-content-center">
                <a href="{{ route('register') }}" class="btn  btn-light btn-lg">Cadastre-se</a>
            </div>
        </div>
    </div>
</x-layouts.default>
