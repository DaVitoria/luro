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
                <li>Criar aula</li>
            </ul>
        </nav>
    </div>



    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0"
            action="{{ route('instructor.courses.lessons.store', ['course' => $course->id, 'module' => $module]) }}"
            method="POST">
            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Titulo (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="text" class="uk-input p-0" name="title" required
                                value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <label class="uk-form-label">Descrição (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <textarea class="uk-input" name="description" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <label class="uk-form-label">Numero (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="number" class="uk-input" name="lesson_number" required
                                value="{{ old('lesson_number') }}" min="1">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="uk-form-label" for="video_platform">Platarma (obrigatório)</label>

                        <div class="uk-position-relative w-100">
                            <select class="selectpicker" name="video_platform">
                                @foreach ($video_platforms as $key => $platform)
                                    <option value="{{ $platform['id'] }}" @selected(old('video_platform') === $platform['id'] || $key === 0)>
                                        {{ $platform['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="uk-form-group">
                        <label class="uk-form-label">Link do video (obrigatório)</label>
                        <div class="uk-position-relative w-100">

                            <input type="url" class="uk-input" name="video_url" required
                                value="{{ old('video_url') }}">
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
