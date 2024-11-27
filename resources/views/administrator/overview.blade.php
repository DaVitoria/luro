<x-layouts.dashboard>
    <div class="ro" uk-grid="">
        <div class="uk-width-expand@m">
            <div class="section-small">
                <h3>Ola!🖐 {{ auth()->user()->first_name }} !</h3>
            </div>

            <div class="uk-card-default uk-card-small rounded">
                <div class="uk-card-header py-3">
                    <span class="uk-h5">Latest Course Review Subitions</span>
                    <a href="{{ route('administrator.courses.pending') }}" class="uk-float-right"> See all </a>
                </div>

                <div class="" data-simplebar="">
                    @forelse ($pending_courses as $key => $item)
                        @if ($key !== 0)
                            <hr class="m-0" />
                        @endif

                        <div class="uk-grid-small p-4" uk-grid="">
                            <div class="uk-width-1-3@m">
                                <img src="{{ $item->image_url }}" class="rounded" alt="" />
                            </div>
                            <div class="uk-width-expand">
                                <h5 class="mb-2">{{ $item->title }}</h5>
                                <p class="uk-text-small mb-2">
                                    Created by <a href="#">{{ $item->user->name }}</a>
                                </p>
                                <p class="mb-0 uk-text-small mt-3">
                                    <span class="mr-3 bg-light p-2 mt-1">{{ $item->category->name }}</span>
                                    <span> Last updated
                                        {{ $item->updated_at->diffForHumans() }}
                                    </span>
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="p-3">Nenhum registo encontrado!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-layouts.dashboard>
