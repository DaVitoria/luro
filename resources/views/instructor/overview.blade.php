<x-layouts.dashboard>
    <div class="ro" uk-grid="">
        <div class="section-small">
            <h3>Ola!🖐 {{ auth()->user()->first_name }} !</h3>

        </div>

        <div class="uk-card-default uk-card-small rounded w-100">
            <div class="uk-card-header py-3">
                <span class="uk-h5">Seus cursos recentes</span>
                <a href="{{ route('instructor.courses.index') }}" class="uk-float-right">Ver tudo</a>
            </div>

            <div class="uk-height-large" data-simplebar="">
                @forelse ($recent_courses as $key => $course)
                    @if ($key !== 0)
                        <hr class="m-0" />
                    @endif

                    <div class="uk-grid-small p-4" uk-grid="">
                        <div class="uk-width-1-3@m">
                            <img src="{{ $course->image_url }}" class="rounded" alt=""
                                style="object-fit: cover; aspect-ratio:5/4;" />
                        </div>
                        <div class="uk-width-expand">
                            <h5 class="mb-2">{{ $course->title }}</h5>
                            <p class="mb-0 uk-text-small mt-3">
                                <span class="mr-3 bg-light p-2 mt-1">{{ $course->status->name() }}</span><span>Ultima
                                    atualização
                                    {{ $course->updated_at->diffForHumans() }}</span>
                            </p>
                        </div>
                    </div>
                @empty
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
                @endforelse



            </div>
        </div>

    </div>
</x-layouts.dashboard>
