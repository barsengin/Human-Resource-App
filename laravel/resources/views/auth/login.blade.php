@extends("layouts.auth")

@section("content")
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <h1>Kullanıcı Girişi</h1>
                    <div>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required="" autocomplete="email" autofocus />
                    </div>
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    </div>
                       <div>
                           <div style="text-align:left">
                               <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                               <label class="form-check-label" for="remember">
                                   Beni Hatırla
                               </label>
                           </div>
                       </div>
                    <div>
                        <button type="submit" class="btn btn-primary btn-block"> Giriş Yap </button>

                        <a class="reset_pass" href="{{ route('password.request') }}">Şifremi unuttum</a>
                    </div>

                    <div class="clearfix"></div>

                    @error('email')
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{ $message }}
                        </div>
                    @enderror
                    @error('password')
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            {{ $message }}
                        </div>
                    @enderror

                </form>
            </section>
        </div>

    </div>
</div>
@endsection

@section("customCss")
@endsection
@section("customJs")
@endsection
