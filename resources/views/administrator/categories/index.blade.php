<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="#"> Categories </a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Categories</h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                        <i class="uil-refresh"></i>
                    </a>

                    <a href="{{ route('administrator.categories.create') }}" class="btn btn-icon btn-hover  btn-circle"
                        uk-tooltip="Criar">
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
                        <th scope="col">Name</th>
                        <th scope="col">N. courses</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Updated at</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse ($categories as $category)
                        <tr>
                            <th>
                                {{ $category->id }}
                            </th>
                            <th scope="row">
                                {{ $category->name }}
                            </th>
                            <td>{{ $category->courses_count }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>{{ $category->updated_at }}</td>
                            <td class="text-right">
                                <!-- Actions -->
                                <div class="actions ml-3 d-flex">
                                    <a href="{{ route('administrator.categories.show', ['category' => $category->id]) }}"
                                        class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Visualizar"
                                        target="_blank" rel="noopener noreferrer">
                                        <i class="uil-external-link-alt "></i> </a>
                                    <a href="{{ route('administrator.categories.edit', ['category' => $category->id]) }}"
                                        class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Editar">
                                        <i class="uil-pen "></i> </a>
                                    <form
                                        action="{{ route('administrator.categories.destroy', ['category' => $category->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button href="#" class="btn btn-icon btn-hover btn-sm btn-circle"
                                            uk-tooltip="Excluir">
                                            <i class="uil-trash-alt text-danger"></i> </button>
                                    </form>
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
