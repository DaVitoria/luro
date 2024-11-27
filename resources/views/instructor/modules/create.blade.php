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

                <li><a href="#">{{ str($course->title)->limit(12) }}</a></li>
                <li><a href="{{ route('instructor.courses.modules.index', ['course' => $course->id]) }}">Módulos</a></li>
                <li>Criar</li>
            </ul>
        </nav>
    </div>



    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0" action="{{ route('instructor.courses.modules.store', ['course' => $course->id]) }}"
            method="POST">
            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Nome</label>
                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon"><i class="uil-folder"></i></span>
                            <input type="text" class="uk-input" name="name" required value="{{ old('name') }}">
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
