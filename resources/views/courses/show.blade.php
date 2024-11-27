<x-layouts.default>


    <div class="course-details-wrapper topic-1 uk-light">
        <div class="page-content-inner pt-lg-7 pb-0">

            <div class="uk-grid-large" uk-grid="">

                <div class="uk-width-1-2@m">
                    <div class="course-thumbnail">
                        <img src="{{ $course->image_url }}" alt="">
                    </div>


                </div>
                <div class="uk-width-1-2@m course-details mt-0">
                    <h1>{{ $course->title }}</h1>

                    <div class="course-details-info">

                        <ul>
                            <li>Criado por<a href="{{ route('instructor.show', ['user' => $course->user->id]) }}">
                                    {{ $course->user->name }} </a>
                            </li>
                            <li>Ultima atualização {{ $course->updated_at->diffForHumans() }}</li>
                        </ul>

                    </div>

                    <div class="uk-flex uk-flex-between uk-flex-middle">
                        <div class="uk-visible@s">
                            <a hred="#" uk-tooltip="title: Add to your Bookmarks ; pos: top">
                                <i class="icon-feather-bookmark icon-small"></i> </a>
                            <a hred="#" uk-tooltip="title: Add to wishlist ; pos: top">
                                <i class="icon-feather-heart icon-small ml-3 text-danger"></i> </a>
                        </div>

                        @if ($subscriptionStatus)
                            <span @class(['mr-3 p-2 my-2', $subscriptionStatus->bg()])
                                style="color:#222;">{{ $subscriptionStatus->name() }}</span>
                        @endif
                    </div>

                    @can('student')
                        @if (!$subscriptionStatus)
                            <form action="{{ route('student.courses.subscription.store', ['course' => $course->id]) }}"
                                method="POST">
                                @csrf
                                <button style="cursor: pointer" href="takecouse.html" class="btn-course-start btn">Fazer
                                    o
                                    pré-registo
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="pt-4">
                            <p class="text-underline">Faca login como estudante parara poder se inscrever!</p>
                        </div>
                    @endcan


                </div>

            </div>

            <nav class="responsive-tab style-4 mt-lg-4">
                <ul
                    uk-switcher="connect: #course-intro-tab ;animation: uk-animation-slide-right-medium, uk-animation-slide-left-medium">
                    <li><a href="#">Descrição</a></li>
                    <li><a href="#">Currículo</a></li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="page-content-inner">

        <div class="uk-grid-large" uk-grid="">
            <div class="uk-width-2-3@m">

                <ul id="course-intro-tab" class="uk-switcher mt-4">

                    <!-- course description -->
                    <li class="course-description-content">
                        <h4>Descrição</h4>
                        <p>{{ $course->description }}</p>
                    </li>

                    <!-- course Curriculum-->
                    <li>

                        <ul class="course-curriculum" uk-accordion="multiple: true">

                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#"> Html Introduction </a>
                                <div class="uk-accordion-content">

                                    <!-- course-video-list -->
                                    <ul class="course-curriculum-list">
                                        <li> What is HTML <span> 23 min </span>
                                        <li> What is a Web page? <span> 23 min </span> </li>
                                        <li> Your First Web Page <a href="#trailer-modal" uk-toggle=""> Preview
                                            </a> <span> 23 min </span>
                                        </li>
                                        <li> Brain Streak <span> 23 min </span> </li>
                                    </ul>

                                </div>


                            <li>
                                <a class="uk-accordion-title" href="#"> Your First webpage</a>
                                <div class="uk-accordion-content">

                                    <!-- course-video-list -->
                                    <ul class="course-curriculum-list">
                                        <li> Headings <span> 23 min </span>
                                        <li> Paragraphs <span> 23 min </span> </li>
                                        <li> Emphasis and Strong Tag <a href="#trailer-modal" uk-toggle=""> Preview
                                            </a> <span> 23 min
                                            </span>
                                        </li>
                                        <li> Brain Streak <span> 23 min </span> </li>
                                        <li> Live Preview Feature <span> 23 min </span> </li>
                                    </ul>

                                </div>


                            <li>
                                <a class="uk-accordion-title" href="#"> Some Special Tags </a>
                                <div class="uk-accordion-content">

                                    <!-- course-video-list -->
                                    <ul class="course-curriculum-list">
                                        <li> The paragraph tag <span> 23 min </span> </li>
                                        <li> The break tag <a href="#trailer-modal" uk-toggle=""> Preview </a>
                                            <span> 23 min </span>
                                        </li>
                                        <li> Headings in HTML <span> 23 min </span> </li>
                                        <li> Bold, Italics Underline <span> 23 min </span>
                                        </li>
                                    </ul>

                                </div>
                            </li>

                            <li>
                                <a class="uk-accordion-title" href="#"> HTML Advanced level </a>
                                <div class="uk-accordion-content">

                                    <!-- course-video-list -->
                                    <ul class="course-curriculum-list">
                                        <li> Something to Ponder<span> 23 min </span> </li>
                                        <li> Tables <span> 23 min </span> </li>
                                        <li> HTML Entities <a href="#trailer-modal" uk-toggle=""> Preview
                                            </a><span> 23 min </span> </li>
                                        <li> HTML Iframes <span> 23 min </span> </li>
                                        <li> Some important things <span> 23 min </span> </li>
                                    </ul>

                                </div>
                            </li>

                        </ul>

                    </li>
                </ul>
            </div>

            <div class="uk-width-expand">

                <div class="course-info-list">
                    <div class="course-info-list-single">
                        <div class="course-info-list-single-label">
                            <span>N. Inscritos</span> : <strong> {{ $course->subscriptions_count }}</strong>
                        </div>
                        <div class="course-info-list-single-icon">
                            <i class="icon-feather-users"></i>
                        </div>
                    </div>

                    <div class="course-info-list-single">
                        <div class="course-info-list-single-label">
                            <span>N. Módulos </span> : <strong> {{ $course->modules_count }}</strong>
                        </div>
                        <div class="course-info-list-single-icon">
                            <i class="icon-line-awesome-list"></i>
                        </div>
                    </div>

                    <div class="course-info-list-single">
                        <div class="course-info-list-single-label">
                            <span>N. Aulas </span> : <strong> {{ $course->lessons_count }} </strong>
                        </div>
                        <div class="course-info-list-single-icon">
                            <i class="icon-feather-video"></i>
                        </div>
                    </div>

                    <div class="course-info-list-single">
                        <div class="course-info-list-single-label">
                            <span>Nível de acesso</span> : <strong> {{ $course->tier->name() }} </strong>
                        </div>
                        <div class="course-info-list-single-icon">
                            <i class="icon-material-outline-monetization-on"></i>
                        </div>
                    </div>

                    @if ($course->tier->isPaid())
                        <div class="course-info-list-single">
                            <div class="course-info-list-single-label">
                                <span>Preço</span> : <strong>
                                    {{ $course->price . ' MZN' }}</strong>
                            </div>
                            <div class="course-info-list-single-icon">
                                <i class="icon-line-awesome-money"></i>
                            </div>
                        </div>
                    @endif

                    <div class="course-info-list-single">
                        <div class="course-info-list-single-label">
                            <span>Validade</span> : <strong> {{ $course->validity->name() }} </strong>
                        </div>
                        <div class="course-info-list-single-icon">
                            <i class="icon-material-outline-access-time"></i>
                        </div>
                    </div>
                </div>

                <h4 class="mt-5 mb-4">Recomendações</h4>

                <div class="uk-child-width-1-1 mt-3" uk-grid="">
                    @foreach ($recommended as $item)
                        <x-course-card :course="$item" />
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</x-layouts.default>
