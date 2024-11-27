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
                <li><a href="#">Quizzes</a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Quizzes</h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                        <i class="uil-refresh"></i>
                    </a>

                    <a href="{{ route('instructor.courses.quizzes.create', [
                        'course' => $course->id,
                        'module' => $module->id,
                        'lesson' => $lesson->id,
                    ]) }}"
                        class="btn btn-icon btn-hover  btn-circle" uk-tooltip="Criar">
                        <i class="uil-plus"></i>
                    </a>


                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titiulo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">N. Questões</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse ($quizzes as $quiz)
                        <tr>
                            <th> {{ $quiz->id }} </th>
                            <th> {{ $quiz->title }}</th>
                            <td>{{ $quiz->description }}</td>
                            <th> {{ $quiz->questions_count }}</th>

                            <td class="text-right">
                                <!-- Actions -->
                                <div class="actions ml-3 d-flex align-items-center" style="gap:4px">
                                    <a href="{{ route('instructor.courses.quizzes.edit', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id, 'quiz' => $quiz->id]) }}"
                                        class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Editar">
                                        <i class="uil-pen "></i></a>

                                    <form
                                        action="{{ route('instructor.courses.quizzes.destroy', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id, 'quiz' => $quiz->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Excluir">
                                            <i class="uil-trash-alt text-danger"></i> </button>
                                    </form>

                                    <a href="{{ route('instructor.courses.questions.index', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id, 'quiz' => $quiz->id]) }}"
                                        class="btn btn-sn btn-secondary">Questões</a>
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6">
                                Nenhum registo encontrado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.dashboard>
