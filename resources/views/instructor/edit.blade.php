<x-layouts.default>

    <div class="profile-container">
        <div class="page-content-inner uk-light pb-0">

            <div class="profile-layout">
                <div class="profile-layout-avature">

                    <div class="user-profile-photo">
                        <img src="{{ $user->image_url }}" alt="" style="aspect-ratio: 1; object-fit: cover;">
                    </div>

                </div>
                <div class="profile-layout-content">
                    <h2>{{ $user->name }}</h2>
                    <p>{{ $user->role->name() }}</p>
                </div>
                <div class="profile-layout-badge">
                    <div>
                        <div class="profile-layout-badge-num">{{ $user->courses_count }}</div>
                        <div class="profile-layout-badge-title"> Courses </div>
                    </div>
                </div>

            </div>


            <nav class="responsive-tab style-4">
                <ul>
                    <li><a href="{{ route('instructor.show', ['user' => $user->id]) }}">Courses</a>
                    </li>
                    @canany(['administrator', 'instrutor'])
                        <li class="uk-active">
                            <a href="{{ route('instructor.edit', ['user' => $user->id]) }}">Settings</a>
                        </li>
                    @endcanany
                </ul>
            </nav>

        </div>

    </div>


    <div class="page-content-inner ">
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



        <div class="">
            <h4 class="mb-lg-5"> Edit </h4>

            <form class="mt-2 p-4" style="background-color: #EDEFF0;"
                action="{{ route('instructor.update', ['user' => $user->id]) }}" method="POST"
                enctype="multipart/form-data">
                <h4 class="mb-lg-5"> Details </h4>

                @csrf
                <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Image (opcional)</label>
                            <div class="uk-position-relative w-100">
                                <input type="file" class="uk-input" name="image" autocomplete="name"
                                    accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> First name </label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-user"> </i></span>
                                <input type="text" class="uk-input" name="first_name" autocomplete="name">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Second name </label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-user"> </i></span>
                                <input type="text" class="uk-input" name="last_name" autocomplete="name">

                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label"> Your Email </label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-mail"> </i></span>
                                <input type="email" class="uk-input" name="email" autocomplete="email">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right">
                    <button type="submit" class="btn btn-default small"> Salvar</button>
                </div>
            </form>

            <form class="mt-4 p-4" style="background-color: #EDEFF0;"
                action="{{ route('instructor.password', ['user' => $user->id]) }}" method="POST">
                <h4 class="mb-lg-5"> Password </h4>

                @csrf
                <div class="uk-child-width-1-2@s uk-grid-small my-5" uk-grid="">
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Current Password</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="current_password" class="uk-input">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-form-group">
                            <label class="uk-form-label">Password</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="password" class="uk-input">

                            </div>
                        </div>
                    </div>
                    <div class="w-100">
                        <div class="uk-form-group">
                            <label class="uk-form-label">Password Confirmation</label>
                            <div class="uk-position-relative w-100">
                                <span class="uk-form-icon"> <i class="icon-feather-lock"> </i></span>
                                <input type="password" name="password_confirmation" class="uk-input">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uk-flex uk-flex-right">
                    <button type="submit" class="btn btn-default small"> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.default>
