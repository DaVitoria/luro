@props(['course' => []])

<div>
    <a href="{{ route('courses.show', ['course' => $course->id]) }}">
        <div class="course-card">
            <div class="course-card-thumbnail ">
                <img src="{{ $course->image_url }}">

            </div>
            <div class="course-card-body">
                <div class="course-card-info">
                    <div>
                        <span class="category">{{ $course->category->name }}</span>
                    </div>
                </div>

                <h4>{{ $course->title }}</h4>
                <p>{{ str($course->description)->limit() }}</p>
                <div class="course-card-footer">
                    <h5><i class="icon-feather-folder"></i>{{ $course->modules_count }} Módulos
                    </h5>
                    <h5><i class="icon-feather-film"></i>{{ $course->lessons_count }} Aulas</h5>
                </div>
            </div>

        </div>
    </a>
</div>
