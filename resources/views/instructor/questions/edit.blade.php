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
                <li><a
                        href="{{ route('instructor.courses.quizzes.index', ['module' => $module->id, 'course' => $course->id, 'lesson' => $lesson->id]) }}">Quizzes</a>
                </li>
                <li><a href="#">Editar Questão</a></li>
            </ul>
        </nav>
    </div>


    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0"
            action="{{ route('instructor.courses.questions.update', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id, 'quiz' => $quiz, 'question' => $question]) }}"
            method="POST">
            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                @method('PUT')
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Conteúdo (obrigatório)</label>
                        <div class="uk-position-relative w-100">
                            <textarea name="content" required>{{ $question->content }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="uk-form-label" for="material_type">Tipo (obrigatório)</label>

                        <div class="uk-position-relative w-100">
                            <select class="selectpicker" name="type">
                                @foreach ($question_types as $key => $question_type)
                                    <option value="{{ $question_type['id'] }}" @selected($question->type->value === $question_type['id'])>
                                        {{ $question_type['name'] }}</option>
                                @endforeach
                            </select>
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
