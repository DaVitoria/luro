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

                <li><a href="{{ route('instructor.courses.modules.index', ['course' => $course->id]) }}">Módulos</a>
                </li>
                <li><a
                        href="{{ route('instructor.courses.lessons.index', ['course' => $course->id, 'module' => $module->id]) }}">
                        Aulas</a>
                </li>
                <li><a
                        href="{{ route('instructor.courses.support_materials.index', ['course' => $course->id, 'module' => $module, 'lesson' => $lesson]) }}">Materias
                        de apoio</a></li>
                <li><a href="#">Editar</a></li>
            </ul>
        </nav>
    </div>



    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0"
            action="{{ route('instructor.courses.support_materials.update', ['course' => $course->id, 'module' => $module, 'lesson' => $lesson, 'support_material' => $sm->id]) }}"
            method="POST">
            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                @method('PUT')
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Nome(obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="text" class="uk-input p-0" name="name" required
                                value="{{ $sm->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="uk-form-label" for="material_type">Tipo (obrigatório)</label>

                        <div class="uk-position-relative w-100">
                            <select class="selectpicker" name="material_type">
                                @foreach ($material_types as $key => $material_type)
                                    <option value="{{ $material_type['id'] }}" @selected($sm->material_type->value === $material_type['id'])>
                                        {{ $material_type['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <label class="uk-form-label">Link (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="url" class="uk-input" name="link_material" required
                                value="{{ $sm->link_material }}">
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
