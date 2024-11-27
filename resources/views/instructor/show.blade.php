<x-layouts.default>

    <div class="profile-container">
        <div class="page-content-inner uk-light pb-0">

            <div class="profile-layout">
                <div class="profile-layout-avature">

                    <div class="user-profile-photo">
                        <img src="{{ $user->image_url }}" alt="" style="aspect-ratio: 1; object-fit: cover;">
                    </div>

                </div>
                <div class="profile-layout-content">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->role->name() }}</p>
                </div>
                <div class="profile-layout-badge">
                    <div>
                        <div class="profile-layout-badge-num">{{ $user->courses_count }}</div>
                        <div class="profile-layout-badge-title"> Courses </div>
                    </div>
                </div>

            </div>


            <nav class="responsive-tab style-4">
                <ul>
                    <li class="uk-active"><a href="{{ route('instructor.show', ['user' => $user->id]) }}">Courses</a>
                    </li>
                    @canany(['administrator', 'instrutor'])
                        <li><a href="{{ route('instructor.edit', ['user' => $user->id]) }}">Settings</a></li>
                    @endcanany
                </ul>
            </nav>

        </div>

    </div>


    <div class="page-content-inner">



        <div class="section-small">
            <h4 class="mb-lg-5"> Courses </h4>

            @if ($user->courses_count > 0)
                <div class="uk-child-width-1-3@m uk-child-width-1-2@s" uk-grid="">
                    @foreach ($user->courses as $course)
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
                                            <h5> <i class="icon-feather-film"></i> 12 Lectures </h5>
                                            <h5> <i class="icon-feather-clock"></i> 64 Hours </h5>
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
                        No courses yet
                    </div>
                    @can('instrutor')
                        <div class="mt-2 d-flex justify-content-center">
                            <a href="{{ route('instructor.courses.create') }}" class="btn btn-default">Create</a>
                        </div>
                    @endcan
                </div>
            @endif

        </div>
    </div>
</x-layouts.default>
