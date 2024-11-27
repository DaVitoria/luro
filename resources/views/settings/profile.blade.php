<x-layouts.default>
    @if (session()->has('success'))
        <div class="uk-alert-success mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
            <p>{{ session()->get('success') }}</p>
        </div>
        @php
            session()->remove('success');
        @endphp
    @endif

    @if (session()->has('error'))
        <div class="uk-alert-danger mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
            <p>{{ session()->get('error') }}</p>
        </div>
        @php
            session()->remove('error');
        @endphp
    @endif

    @if ($errors->any())
        <div class="uk-alert-danger mt-2" uk-alert> <a class="uk-alert-close" uk-close></a>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="p-2">
        <h4 class="mb-lg-5"> Editar</h4>
    </div>


    <div class="uk-child-width-1-2@m uk-flex-middle p-2" uk-grid="">

        <div>


            <form class="mt-2 p-4" style="background-color: #EDEFF0;"
                action="{{ route('settings.account', ['user' => $user->id]) }}" method="POST"
                enctype="multipart/form-data">
                <h4 class="mb-lg-5"> Detalhes </h4>

                @csrf
                <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Imagem (opcional)</label>
                            <div class="uk-position-relative w-100">
                                <input type="file" class="uk-input" name="image" autocomplete="name"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Nome</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-user"> </i></span>
                                <input type="text" class="uk-input" name="first_name" autocomplete="name"
                                    value="{{ $user->first_name }}">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Apelido </label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-user"> </i></span>
                                <input type="text" class="uk-input" name="last_name" autocomplete="name"
                                    value="{{ $user->last_name }}">

                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Email </label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-mail"> </i></span>
                                <input type="email" class="uk-input" name="email" autocomplete="email"
                                    value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right">
                    <button type="submit" class="btn btn-default small"> Salvar</button>
                </div>
            </form>

        </div>
        <div></div>
    </div>
    <div class="uk-child-width-1-2@m uk-flex-middle p-2" uk-grid="">

        <div>


            <form class="mt-4 p-4" style="background-color: #EDEFF0;"
                action="{{ route('settings.password', ['user' => $user->id]) }}" method="POST">
                <h4 class="mb-lg-5"> Palavra-passe</h4>

                @csrf
                <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Palavra-passe corrente</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="current_password" class="uk-input">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Palavra-passe</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="password" class="uk-input">

                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label">Confirmar Password</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="password_confirmation" class="uk-input">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right">
                    <button type="submit" class="btn btn-default small">Salvar</button>
                </div>
            </form>

        </div>
        <div></div>
    </div>
</x-layouts.default>
