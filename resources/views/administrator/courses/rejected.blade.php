<x-layouts.dashboard>
    <div class="d-flex pt-4">
        <nav id="breadcrumbs" class="mb-3">
            <ul>
                <li>
                    <a href="{{ route(auth()->user()->role->dashboard()) }}"> <i
                            class="icon-material-outline-dashboard"></i>
                    </a>
                </li>
                <li><a href="#">Rejected courses</a></li>
            </ul>
        </nav>
    </div>

    <!-- Table -->
    <div class="section-header pb-0">
        <div class="section-header-left">
            <h4> Rejected courses ({{ $courses->total() }})</h4>
        </div>
        <div class="section-header-right">
            <a href="#" class="btn-filter active" uk-tooltip="Atualizar">
                <i class="uil-refresh"></i>
            </a>
        </div>
    </div>

    <div class="section-small">

        <div class="uk-child-width-1-4@m uk-child-width-1-3@s course-card-grid uk-grid-match" uk-grid="">

            @forelse ($courses as $course)
                <div>
                    <a href="course-intro.html">
                        <div class="course-card">
                            <div class="course-card-thumbnail ">
                                <img src="{{ $course->image_url }}">

                            </div>
                            <div class="course-card-body">
                                <div class="course-card-info">
                                    <div>
                                        <span class="catagroy">{{ $course->category->name }}</span>
                                    </div>
                                    <div>
                                        <a href="/courses/{{ $course->id }}" target="_blank"
                                            rel="noopener noreferrer">
                                            <i class="uil-external-link-alt icon-small"></i>
                                        </a>
                                    </div>
                                </div>

                                <h4>{{ $course->title }}</h4>
                                <p>{{ str($course->description)->limit() }}</p>

                                <div class="course-card-footer">
                                    <h5> <i class="icon-feather-film"></i> 33 Lectures </h5>
                                    <h5> <i class="icon-feather-clock"></i> 26 Hours </h5>
                                </div>
                            </div>

                            <hr class="m-0" />

                            <div class="d-flex justify-content-between px-4 py-2">
                                <form action="{{ route('administrator.courses.approve', ['course' => $course->id]) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-icon btn-hover btn-success"
                                        uk-tooltip="Approve" title="" aria-expanded="false">
                                        <i class="icon-material-outline-check"></i>
                                    </button>
                                </form>

                                <a href="#" type="submit" class="btn btn-icon btn-hover btn-info"
                                    uk-tooltip="Perfil do instructor" title="" aria-expanded="false">
                                    <i class="uil-graduation-hat"></i>
                                </a>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div>
                    Nenhum registo encontrado
                </div>
            @endforelse
        </div>


        <!-- pagination menu -->
        <div class="my-5">
            {{ $courses->links() }}
        </div>


        <script>
            const a = document.querySelector('.refresh');
            a.onclick = event => {
                event.preventDefault();
                location.reload();
            }
        </script>
</x-layouts.dashboard>
