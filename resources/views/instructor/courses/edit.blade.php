<x-layouts.dashboard>
    <div class="d-flex">
        <nav id="breadcrumbs" class="mb-3 pt-4">
            <ul>
                <li><a href="#"> <i class="icon-material-outline-dashboard"></i> </a></li>
                <li><a href="{{ route('instructor.courses.index') }}">Cursos</a></li>

                <li>Editar</li>
            </ul>
        </nav>
    </div>



    <div class="card">
        <ul class="uk-child-width-expand uk-tab"
            uk-switcher="connect: #course-edit-tab ; animation: uk-animation-slide-left-medium, uk-animation-slide-right-medium">

            <li class="uk-active"><a href="#">Básico</a></li>
            <li><a href="#">Preço</a></li>
            <li><a href="#">Terminar</a></li>
        </ul>

        <div class="card-body">

            <form action="{{ route('instructor.courses.update', ['course' => $course->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <ul class="uk-switcher uk-margin" id="course-edit-tab">

                    <li>

                        <div class="row">
                            <div class="col-xl-9 m-auto">
                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_image">Imagem
                                        (opcional, max. 2MB)</label>

                                    <div class="col-md-9">
                                        <input type="file" class="form-control" id="course_image" name="image"
                                            accept="image/*" value="{{ old('image') }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_title">Título
                                        (obrigatório)</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="course_title" name="title"=""
                                            value="{{ $course->title }}">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_description">Descrição
                                        (obrigatório)</label>
                                    <div class="col-md-9">
                                        <textarea name="description" id="course_description" class="form-control">{{ $course->description }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_title">Category
                                        (obrigatório)</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" name="category_id">
                                            @foreach ($categories as $key => $category)
                                                <option data-icon="{{ $category->icon }}" value="{{ $category->id }}"
                                                    @selected($course->category_id === $category->id || $key === 0)>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>


                            </div>
                        </div>


                    </li>

                    <li>

                        <div class="row justify-content-center">

                            <div class="col-xl-9">

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label">Preço (obrigatório)</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="price" min="0"
                                            step="0.01" value="{{ $course->price }}">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-9">

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_title">Nível
                                        (obrigatório)</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" name="tier">
                                            <option value="free" @selected($course->tier->value === 'free')>Grátis</option>
                                            <option value="paid" @selected($course->tier->value === 'paid')>Pago</option>
                                        </select>

                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-9">

                                <div class="form-group row mb-3">
                                    <label class="col-md-3 col-form-label" for="course_title">Validade
                                        (obrigratório)</label>
                                    <div class="col-md-9">
                                        <select class="selectpicker" name="validity">
                                            <option value="lifetime" @selected($course->validity->value === 'lifetime')>Para toda a vida
                                            </option>
                                            <option value="one_year" @selected($course->validity->value === 'one_year')>Um ano</option>
                                        </select>

                                    </div>
                                </div>

                            </div>


                        </div>


                    </li>

                    <li>

                        <div class="row">
                            <div class="col-12 my-lg-5">
                                <div class="text-center">
                                    <h2 class="mt-0"><i class="icon-feather-check-circle text-success"></i></h2>

                                    <p class="w-75 mb-2 mx-auto">Prezado Instrutor, solicitamos a adição dos módulos,
                                        aulas, quizzes e materiais de apoio ao curso. Após concluído, submeta o curso
                                        para avaliação do administrador. </p>

                                    <p class="w-75 mb-2 mx-auto">Agradecemos pela colaboração e comprometimento
                                        com a qualidade do ensino na plataforma.</p>

                                    <div class="mb-3 mt-3">
                                        <button type="submit" class="btn btn-default">Salvar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </form>

        </div>

    </div>


</x-layouts.dashboard>
