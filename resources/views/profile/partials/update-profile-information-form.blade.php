<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Información del perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
        @csrf
        @method('patch')

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nombre') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-gray-800">
                    {{ __('Su dirección de correo electrónico no está verificada.') }}

                    <button form="send-verification" class="btn btn-link">
                        {{ __('Haga clic aquí para reenviar el correo de verificación.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-success">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex gap-4">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-success">
                    {{ __('Guardado.') }}
                </p>
            @endif
        </div>
    </form>
</section>
