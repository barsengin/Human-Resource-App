@extends('layouts.auth')

@section('content')
    <div>
        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-sm-12 col-xs-12 col-form-label text-md-right">E-mail Adresi:</label>

                                <div class="col-md-8 col-sm-12 col-xs-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <button type="submit" class="btn btn-primary btn-block">
                                   Sıfırlama linkini gönder
                                </button>
                            </div>

                            <div class="clearfix"></div>
                            @error('email')
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
