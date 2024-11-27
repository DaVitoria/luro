<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="#">Instructors</a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Instructors</h4>
                <div class="d-flex">
                    <a href="#" class="btn btn-icon btn-hover  btn-circle refresh" uk-tooltip="Atualizar">
                        <i class="uil-refresh"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Table -->
        <div class="table-responsive">
            <table class="table align-items-center">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Número</th>
                        <th scope="col">N. courses</th>
                        <th scope="col">N. active students</th>
                        <th scope="col">Data de registo</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse ($instructors as $instructor)
                        <tr>
                            <th scope="row">
                                <div class="media align-items-center">
                                    <div>
                                        <div class="avatar-parent-child" style="width: max-content">
                                            <img alt="Image placeholder" src="{{ $instructor->image_url }}"
                                                class="avatar  rounded-circle">
                                            <span class="avatar-child avatar-badge bg-success"></span>
                                        </div>
                                    </div>
                                    <div class="media-body ml-4">
                                        <a href="#" class="name h6 mb-0 text-sm">{{ $instructor->name }}</a>
                                        <small class="d-block font-weight-bold">#{{ $instructor->id }}</small>
                                    </div>
                                </div>
                            </th>
                            <td>{{ $instructor->number }}</td>
                            <td>{{ $instructor->courses_count }}</td>
                            <td>{{ $instructor->subscriptions_count }}</td>
                            <td>{{ $instructor->created_at }}</td>
                            <td class="text-right">
                                <!-- Actions -->
                                <div class="actions ml-3 d-flex">
                                    <a href="#" class="btn btn-icon btn-hover btn-sm btn-circle"
                                        uk-tooltip="Visualizar" target="_blank" rel="noopener noreferrer">
                                        <i class="uil-external-link-alt "></i> </a>
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
