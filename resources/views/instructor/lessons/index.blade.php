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
                <li><a href="#">Aulas</a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Aulas</h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                        <i class="uil-refresh"></i>
                    </a>

                    <a href="{{ route('instructor.courses.lessons.create', ['course' => $course->id, 'module' => $module->id]) }}"
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
                        <th scope="col">Número</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Plataforma do video</th>
                        <th scope="col">Link do video</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse ($module->lessons as $lesson)
                        <tr>
                            <th> {{ $lesson->id }} </th>
                            <td>{{ $lesson->lesson_number }}</td>
                            <th> {{ $lesson->title }}</th>
                            <td>{{ $lesson->description }}</td>
                            <td>{{ $lesson->video_platform->name() }}</td>
                            <td>
                                <a href="{{ $lesson->video_url }}" target="_blank" rel="noopener noreferrer"
                                    class="btn btn-link">
                                    {{ $lesson->video_url }}
                                </a>
                            </td>
                            <td class="text-right">
                                <!-- Actions -->
                                <div class="actions ml-3 d-flex align-items-center" style="gap:4px">
                                    <a href="{{ route('instructor.courses.lessons.edit', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id]) }}"
                                        class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Editar">
                                        <i class="uil-pen "></i> </a>

                                    <form
                                        action="{{ route('instructor.courses.lessons.destroy', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button href="#" class="btn btn-icon btn-hover btn-sm btn-circle"
                                            uk-tooltip="Excluir">
                                            <i class="uil-trash-alt text-danger"></i> </button>
                                    </form>

                                    <a href="{{ route('instructor.courses.support_materials.index', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id]) }}"
                                        class="btn btn-primary" style="word-wrap: no-wrap">
                                        Materias de apoio
                                    </a>
                                    <a href="{{ route('instructor.courses.quizzes.index', ['course' => $course->id, 'lesson' => $lesson->id, 'module' => $module->id]) }}"
                                        class="btn btn-primary" style="word-wrap: no-wrap">
                                        Quizzes
                                    </a>
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
