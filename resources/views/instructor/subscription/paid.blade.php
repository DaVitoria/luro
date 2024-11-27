<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="#">Pago</a></li>
            </ul>
        </nav>
    </div>


    <div class="card">
        <!-- Card header -->
        <div class="card-header actions-toolbar border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="d-inline-block mb-0">Pago</h4>
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
                        <th scope="col">#</th>
                        <th scope="col">Name do Aluno</th>
                        <th scope="col">Name do Auno</th>
                        <th scope="col">Titulo do Curso</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Data do pagammento</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="list">
                    @forelse ($subscriptions as $subscription)
                        <tr>
                            <th>
                                {{ $subscription->id }}
                            </th>
                            <th scope="row">
                                {{ $subscription->user->name }}
                            </th>
                            <td>
                                {{ $subscription->user->number }}
                            </td>
                            <td>
                                {{ $subscription->course->title }}
                            </td>
                            <td>
                                {{ $subscription->payment->value }}
                            </td>
                            <td>
                                {{ $subscription->payment->created_at }}
                            </td>
                            <td class="text-right">
                                <!-- Actions -->
                                @if ($subscription->status->isActive())
                                    <form
                                        action="{{ route('instructor.subscriptions.cancel', ['subscription' => $subscription->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button href="#" class="btn btn-danger">
                                            Cancelar pagamento </button>
                                    </form>
                                @elseif ($subscription->status->isCanceled())
                                    <span>O aluno concluiu o curso</span>
                                @endif
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6">
                                Sem subscricoes pagas
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.dashboard>
