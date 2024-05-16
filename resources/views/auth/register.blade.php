<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);">Registro</span>
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5">
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h2 class="mb-30">Registro</h2>
                                </div>

                                <form method="post" action="{{ route('register') }}">
                                    @csrf

                                    <div class="form-group">
                                        <input type="text" required="" name="name" placeholder="Nombre"
                                            :value="old('name')" required autofocus autocomplete="name">
                                    </div>

                                    <div class="form-group">
                                        <input type="text" required="" name="email" placeholder="Correo electrónico"
                                            :value="old('email')" required>
                                    </div>

                                    <div class="form-group">
                                        <input required="" type="password" name="password" placeholder="Contraseña"
                                            required autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <input required="" type="password" name="password_confirmation"
                                            placeholder="Confirmar Contraseña" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <input required="" type="password" name="admin_access_key" placeholder="Clave de acceso para administradores">
                                        @error('admin_access_key')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox"
                                                    id="exampleCheckbox12" value="">
                                                <label class="form-check-label" for="exampleCheckbox12">
                                                    <span>Acepto los términos y condiciones</span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                            name="login">Registrarse</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</x-app-layout>
