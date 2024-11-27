<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="#">Cursos</a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Cursos</h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                        <i class="uil-refresh"></i>
                    </a>

                    <a href="{{ route('instructor.courses.create') }}" class="btn btn-icon btn-hover  btn-circle"
                        uk-tooltip="Criar">
                        <i class="uil-plus"></i>
                    </a>
                </div>
            </div>
        </div>
        @if ($courses->total() > 0)
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Status</th>
                            <th scope="col">Alunos Ativos</th>
                            <th scope="col">Alunos Pendentes</th>
                            <th scope="col">Criado em</th>
                            <th scope="col">Atualizado em</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($courses as $course)
                            <tr>
                                <th scope="row">
                                    <div class="media align-items-center">
                                        <div>
                                            <div class="avatar-parent-child" style="width: max-content">
                                                <img src="{{ $course->image_url }}"
                                                    style="object-fit: cover; aspect-ratio:5/4; width: 120px">
                                                <span class="avatar-child avatar-badge bg-success"></span>
                                            </div>
                                        </div>
                                        <div class="media-body ml-4">
                                            <a href="#" class="name h6 mb-0 text-sm">{{ $course->title }}</a>
                                            <small class="d-block font-weight-bold">#{{ $course->id }}</small>
                                        </div>
                                    </div>
                                </th>
                                <td><span @class(['mr-3 p-2 mt-1', $course->status->bg()])>{{ $course->status->name() }}</span></td>
                                <td>{{ $course->active_subs }}</td>
                                <td>{{ $course->pending_subs }}</td>
                                <td>{{ $course->created_at }}</td>
                                <td>{{ $course->updated_at }}</td>
                                <td class="text-right">
                                    <!-- Actions -->
                                    <div class="actions ml-3 d-flex">
                                        <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                            class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Visualizar"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="uil-external-link-alt "></i> </a>
                                        <a href="{{ route('instructor.courses.edit', ['course' => $course->id]) }}"
                                            class="btn btn-icon btn-hover btn-sm btn-circle" uk-tooltip="Editar">
                                            <i class="uil-pen "></i> </a>
                                        <form
                                            action="{{ route('instructor.courses.destroy', ['course' => $course->id]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button href="#" class="btn btn-icon btn-hover btn-sm btn-circle"
                                                uk-tooltip="Excluir">
                                                <i class="uil-trash-alt text-danger"></i> </button>
                                        </form>
                                        <a href="#" class="btn btn-icon btn-hover btn-sm btn-circle"
                                            uk-tooltip="Mais">
                                            <i class="uil-ellipsis-h"></i>
                                        </a>
                                        <div
                                            uk-dropdown="pos: bottom-right ; mode: click ;animation: uk-animation-scale-up">
                                            <ul class="uk-nav uk-dropdown-nav">
                                                <li><a
                                                        href="{{ route('instructor.courses.modules.index', ['course' => $course->id]) }}">
                                                        Gerir
                                                        módulos
                                                    </a></li>

                                                @if ($course->status->isApproved())
                                                    <li>
                                                        <button class="w-100 btn btn-link bg-transparent px-0"
                                                            style="text-align: right; border:0;cursor:pointer"
                                                            type="button" uk-toggle="target: #add-student">
                                                            Adicionar aluno
                                                        </button>
                                                    </li>


                                                    <div id="add-student" uk-modal>
                                                        <div class="uk-modal-dialog uk-modal-body">
                                                            <form
                                                                action="{{ route('instructor.courses.addstudent', [
                                                                    'course' => $course->id,
                                                                ]) }}"
                                                                method="POST">
                                                                <h2 class="uk-modal-title">Adicionar aluno no curso:
                                                                    {{ $course->title }}</h2>
                                                                @csrf

                                                                <div class="form-group row mb-3">
                                                                    <label class="form-label" for="number">Número do
                                                                        Aluno
                                                                        (obrigatório)
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        id="number" name="number"
                                                                        value="{{ old('number') }}">
                                                                </div>

                                                                <p class="uk-text-right"> <button
                                                                        class="uk-button uk-button-default uk-modal-close"
                                                                        type="button">Cancelar</button>

                                                                    <button type="submit"
                                                                        class="uk-button uk-button-primary"
                                                                        type="button">Save</button>
                                                                </p>



                                                            </form>
                                                        </div>

                                                    </div>
                                                @endif

                                                @if ($course->status->isDraft())
                                                    <hr class="m-0" />
                                                    <li>
                                                        <form
                                                            action="{{ route('instructor.courses.send', ['course' => $course->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button class="btn btn-link bg-transparent px-0 w-100"
                                                                style="cursor: pointer" type="submit"
                                                                href="#">Enviar
                                                                para
                                                                revisão do
                                                                administrador</button>
                                                        </form>
                                                    </li>
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {{ $courses->links() }}
            </div>
        @else
            <div class="p-4">
                <div class="my-4">
                    <div class="d-flex justify-content-center">
                        Ainda não há conteúdo para mostrar!
                    </div>

                    <div class="mt-2 d-flex justify-content-center">
                        <a href="{{ route('instructor.courses.create') }}" class="btn btn-default">Criar</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-layouts.dashboard>
