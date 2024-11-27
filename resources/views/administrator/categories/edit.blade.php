<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="{{ route('administrator.categories.index') }}">Categorias</a></li>
                <li>Editar</li>
            </ul>
        </nav>
    </div>



    <div class="uk-card uk-card-default uk-card-small uk-card-body">
        <form class="p-4 pt-0" action="{{ route('administrator.categories.update', ['category' => $category->id]) }}"
            method="POST">
            <h2> Editar categoria </h2>
            {{-- <h6></h6> --}}

            <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                @csrf
                @method('PUT')
                <div class="uk-width-1-1">
                    <div class="uk-form-group">
                        <label class="uk-form-label">Nome</label>
                        <div class="uk-position-relative w-100">
                            <span class="uk-form-icon"><i class="uil-tag-alt"></i></span>
                            <input type="text" class="uk-input" name="name" required
                                value="{{ $category->name }}">
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
