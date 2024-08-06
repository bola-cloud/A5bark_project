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
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
        
                                <div class="form-group row">
                                    <label for="name" class="col-md-12 col-form-label text-md-end">{{ __('الاسم بالكامل') }}</label>
                                    <div class="col-md-12">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> 
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label text-md-end">{{ __('البريد الالكتروني') }}</label>
                                    <div class="col-md-12">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label for="phone" class="col-md-12 col-form-label text-md-end">{{ __('رقم الهاتف') }}</label>
                                    <div class="col-md-12">
                                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password" class="col-md-12 col-form-label text-md-end">{{ __('كلمة المرور') }}</label>
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-12 col-form-label text-md-end">{{ __('تأكيد كلمة المرور') }}</label>
                                    <div class="col-md-12">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
        
                                <div class="row mb-0 d-flex justify-content-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-danger">{{ __('إنشاء حساب') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="text-center mt-3">
                            <span>لديك حساب؟</span>
                            <a href="{{ route('login') }}" class="btn btn-primary">{{ __('تسجيل الدخول') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
