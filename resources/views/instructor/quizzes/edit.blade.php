<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="{{ route('instructor.courses.index') }}">Cursos</a></li>

                <li><a href="{{ route('instructor.courses.modules.index', ['course' => $course->id]) }}">Módulos</a></li>
                <li><a
                        href="{{ route('instructor.courses.lessons.index', ['module' => $module->id, 'course' => $course->id]) }}">Aulas</a>
                </li>
                <li><a href="#">Editar Quiz</a></li>
            </ul>
        </nav>
    </div>


    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0"
            action="{{ route('instructor.courses.quizzes.update', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id, 'quiz' => $quiz]) }}"
            method="POST">
            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                @method('PUT')
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Titulo (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="text" class="uk-input p-0" name="title" required
                                value="{{ $quiz->title }}">
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <label class="uk-form-label">Descrição (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <textarea class="uk-input" name="description" required>{{ $quiz->description }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="uk-flex uk-flex-right">
                <button type="submit" class="btn btn-default small">Salvar</button>
            </div>
        </form>
    </div>
</x-layouts.dashboard>
