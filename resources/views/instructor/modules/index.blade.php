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

                <li><a href="#">Módulos</a></li>
            </ul>
        </nav>
    </div>

    <div class="card-header actions-toolbar border-0 px-0 mb-2">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="d-inline-block mb-0">Módulos</h4>
            <div class="d-flex">
                <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                    <i class="uil-refresh"></i>
                </a>

                <a href="{{ route('instructor.courses.modules.create', ['course' => $course->id]) }}"
                    class="btn btn-icon btn-hover  btn-circle" uk-tooltip="Criar">
                    <i class="uil-plus"></i>
                </a>
            </div>
        </div>
    </div>

    <ul class="c-curriculum" uk-accordion="">
        @foreach ($modules as $module)
            <li {{-- class="uk-open" --}} style="background-color: #dbdbdb">
                <a class="uk-accordion-title " href="#"> <i class="uil-folder">
                    </i>{{ $module->name }}</a>
                <div class="action-btn">
                    <a href="{{ route('instructor.courses.lessons.create', ['course' => $course->id, 'module' => $module->id]) }}"
                        class="text-white"> <i class="uil-plus"> </i>Adicionar aula</a>
                    <a href="{{ route('instructor.courses.lessons.index', ['course' => $course->id, 'module' => $module->id]) }}"
                        class="text-white"> <i class="uil-file"> </i>Gerir aulas</a>

                    {{-- <a href="#" class="text-white disabled"> <i class="uil-plus"> </i>Adicionar material de
                        apoio</a>
                    <a href="#" class="text-white disabled"> <i class="uil-plus"> </i>Adicionar quiz</a> --}}

                    <a href="{{ route('instructor.courses.modules.edit', ['course' => $course->id, 'module' => $module->id]) }}"
                        class="btn btn-icon btn-hover btn-sm bg-transparent" uk-tooltip="Editar">
                        <i class="uil-pen text-info"></i>
                    </a>
                    <form
                        action="{{ route('instructor.courses.modules.destroy', ['course' => $course->id, 'module' => $module->id]) }}"
                        style="display: inline;" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-icon btn-hover btn-sm" uk-tooltip="Excluir">
                            <i class="uil-trash-alt text-danger"></i>
                        </button>
                    </form>

                </div>
                <div class="uk-accordion-content">
                    <ul class="sec-list">
                        @foreach ($module->lessons as $lesson)
                            <li>
                                <div class="sec-list-item">
                                    <div> <i class="uil-list-ul "></i>
                                        <label class="mb-0 mx-2">
                                            <p> {{ $lesson->lesson_number }} - </p>
                                        </label>
                                        <p> {{ $lesson->title }} </p>
                                    </div>
                                    <div>

                                        <div class="btn-act">
                                            <a
                                                href="{{ route('instructor.courses.lessons.edit', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id]) }}"><i
                                                    class="uil-pen text-info" uk-tooltip="Editar"></i></a>
                                            <form
                                                action="{{ route('instructor.courses.lessons.destroy', ['course' => $course->id, 'module' => $module->id, 'lesson' => $lesson->id]) }}"
                                                style="display: inline;" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-icon btn-hover btn-sm" uk-tooltip="Excluir">
                                                    <i class="uil-trash-alt text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach

    </ul>


</x-layouts.dashboard>
