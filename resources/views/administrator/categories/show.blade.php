<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="{{ route('administrator.categories.index') }}">Categories</a></li>
                <li> {{ $category->name }}</li>
            </ul>
        </nav>
    </div>



    <div uk-grid="">
        <div class="uk-width-1-3@m">

            <nav class="responsive-tab style-3 setting-menu card"
                uk-sticky="top:30 ; offset:100; media:@m ;bottom:true; animation: uk-animation-slide-top">
                <h5 class="mb-0 p-3 uk-visible@m"> Catagries </h5>
                <hr class="m-0 uk-visible@m">
                <ul>
                    @foreach ($categories as $item)
                        <li @class(['uk-active' => $item->id === $category->id])>
                            <a href="{{ route('administrator.categories.show', ['category' => $item->id]) }}">{{ $item->name }}
                                <span class="badge badge-light ml-2 badge-sm">{{ $item->courses_count }}</span> </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

        </div>

        <div class="uk-width-2-3@m">

            <div class="card rounded">
                <div class="p-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">{{ $category->name }}</h5> <span> {{ $courses->total() }} Courses </span>
                </div>

                @forelse ($courses as $course)
                    <hr class="m-0">
                    <div class="uk-grid-small p-4" uk-grid="">
                        <div class="uk-width-1-3@m">
                            <img src="{{ $course->image_url }}" class="  rounded" alt="">
                        </div>
                        <div class="uk-width-expand">
                            <h5 class="mb-2">{{ $course->title }}</h5>
                            <p class="uk-text-small mb-2"> Created by <a href="#">{{ $course->user->name }}</a>
                            </p>
                            <p class="mb-0 uk-text-small mt-3">
                                <span class="mr-3 bg-light p-2 mt-1"> 16 Enerolled</span>
                                <span> Last updated
                                    {{ $course->updated_at->diffForHumans() }} </span>
                            </p>
                        </div>
                    </div>
                @empty
                    <hr class="m-0">
                    <div class="p-3">Nenhum registo encontrado do display!</div>
                @endforelse
            </div>



            <div class="mt-2">
                {{ $courses->links() }}
            </div>



        </div>


    </div>

</x-layouts.dashboard>
