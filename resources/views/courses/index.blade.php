<x-layouts.default>

    <div class="container">

        <div class="mt-lg-5" uk-grid="">
            <div class="uk-width-1-4@m">

                <div class="sidebar-filter" uk-sticky="top:20 ;offset: 90; bottom: true ; media : @m">

                    <button class="btn-sidebar-filter"
                        uk-toggle="target: .sidebar-filter; cls: sidebar-filter-visible">Filter </button>

                    <div class="sidebar-filter-contents">


                        <h4> Filter By </h4>

                        <ul class="sidebar-filter-list" uk-accordion="multiple: true">

                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#"> Skill Levels </a>
                                <div class="uk-accordion-content">
                                    <div class="uk-form-controls">
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio1">
                                            <span class="test"> Beginner <span> (25) </span> </span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio1">
                                            <span class="test"> Entermidate<span> (32) </span></span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio1">
                                            <span class="test"> Expert <span> (12) </span></span>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#"> Course type </a>
                                <div class="uk-accordion-content">
                                    <div class="uk-form-controls">
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio2">
                                            <span class="test"> Free (42) </span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio2">
                                            <span class="test"> Paid </span>
                                        </label>
                                    </div>
                                </div>
                            </li>

                            <li class="uk-open">
                                <a class="uk-accordion-title" href="#"> Duration time </a>
                                <div class="uk-accordion-content">
                                    <div class="uk-form-controls">
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio3">
                                            <span class="test"> +5 Hourse (23) </span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio3">
                                            <span class="test"> +10 Hourse (12)</span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio3">
                                            <span class="test"> +20 Hourse (5)</span>
                                        </label>
                                        <label>
                                            <input class="uk-radio" type="radio" name="radio3">
                                            <span class="test"> +30 Hourse (2)</span>
                                        </label>
                                    </div>
                                </div>
                            </li>


                        </ul>



                    </div>

                </div>


            </div>

            <div class="uk-width-expand@m">

                <div class="section-header mb-lg-3">
                    <div class="section-header-left">
                        <h4> Courses </h4>
                    </div>
                    <div class="section-header-right"> </div>
                </div>


                @if ($courses->total() > 0)
                    <div class="uk-child-width-1-3@m uk-child-width-1-2@s" uk-grid="">
                        @foreach ($courses as $course)
                            <div>
                                <a href="{{ route('courses.show', ['course' => $course->id]) }}">
                                    <div class="course-card">
                                        <div class="course-card-thumbnail ">
                                            <img src="{{ $course->image_url }}">
                                        </div>
                                        <div class="course-card-body">
                                            <div class="course-card-info">
                                                <div>
                                                    <span class="catagroy">{{ $course->category->name }}</span>
                                                </div>

                                            </div>
                                            <h4>{{ $course->title }}</h4>
                                            <p>{{ str($course->description)->limit() }}</p>
                                            <div class="course-card-footer">
                                                <h5><i class="icon-feather-folder"></i>2 Módulos</h5>
                                                <h5><i class="icon-feather-film"></i>12 Aulas</h5>
                                            </div>
                                        </div>

                                    </div>
                                </a>

                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="my-4">
                        <div class="d-flex justify-content-center">
                            Ainda não há cursos!
                        </div>
                        @can('instrutor')
                            <div class="mt-2 d-flex justify-content-center">
                                <a href="{{ route('instructor.courses.create') }}" class="btn btn-default">Criar</a>
                            </div>
                        @endcan
                    </div>
                @endif


                <div class="my-5">
                    {{ $courses->links() }}
                </div>

            </div>

        </div>

    </div>
</x-layouts.default>
