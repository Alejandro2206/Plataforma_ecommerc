<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);">Administrador</span>
                </div>
                
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-5">
                        <div class="login_wrap widget-taber-content p-30 background-white border-radius-10">
                            <div class="padding_eight_all bg-white">
                                <div class="heading_s1">
                                    <h2 class="mb-30 text-center">Login</h2>
                                </div>
                                <form method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" required="" name="email" placeholder="Correo electrónico" :value="old('email')" required autofocus>
                                    </div>
                                    <div class="form-group">
                                        <input required="" type="password" name="password" placeholder="Contraseña" required autocomplete="current-password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" value="">
                                                <label class="form-check-label" for="exampleCheckbox1"><span>Recordarme</span></label>
                                            </div>
                                        </div>
                                        <a class="text-muted" href="{{ route('password.request') }}">¿Has olvidado tu contraseña?</a>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-fill-out btn-block hover-up" name="login">Iniciar Sesión</button>
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