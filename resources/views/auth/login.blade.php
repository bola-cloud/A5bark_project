@extends('layouts.app')

@section('content')

<div class="container-fluid d-flex flex-column" style="background: url('{{ asset('images/background.jpeg') }}') no-repeat center center fixed; background-size: cover;">
    <div class="text-center mb-4 row d-flex justify-content-center w-100">
        <img src="{{ asset('images/new images/Asset 2.svg') }}" alt="Logo" style="width: 160px;">
    </div>
    <div class="row w-100">
        <div class="col-md-5 d-flex align-items-center ">
            <div class="mr-5 ml-5 w-100 row">
                <h1 class="blue-color text-center">مرحبًا بك في مهرجان صيف بنغازي</h1>
            </div>
        </div>
        <div class="col-md-6 d-flex justify-content-center">
            <div class="row mt-5 justify-content-center align-items-center w-75">
                <div class="col-md-12">
                    <div class="card p-4 w-100">
                        <div class="text-right">
                            <a href="{{ url('/') }}" class="text-danger">{{ __('عودة') }}</a>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label text-md-end">{{ __('البريد الالكتروني') }}</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label text-md-end">{{ __('كلمة المرور') }}</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <label class="form-check-label" for="remember">{{ __('تذكرني') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">{{ __('تسجيل الدخول') }}</button>
                                    </div>
                                    <div class="col-md-12 text-center mt-3">
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('هل نسيت كلمة المرور؟') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                            {{-- <div class="text-center mt-3">
                                <span>أو</span>
                                <div class="social-login">
                                    <a href="{{ route('auth.facebook') }}" class="btn btn-outline-secondary"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('auth.google') }}" class="btn btn-outline-secondary"><i class="fab fa-google"></i></a>
                                    <a href="#" class="btn btn-outline-secondary"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="text-center mt-3">
                            <span>ليس لديك حساب؟</span>
                            <a href="{{ route('register') }}" class="btn btn-danger">{{ __('إنشاء حساب') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
