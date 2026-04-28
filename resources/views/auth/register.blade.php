@extends('layouts.guest')
@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-4">
        
        <div class="text-center">
            <a href="{{ route('index') }}" class="navbar-brand d-none-navbar-horizontal">
                <img srcset="{{ asset($settings->getLogo()) }}" class="navbar-brand-image">
            </a>
        </div>

        <div class="col-md-10 mx-auto col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        {{__('auth.registration')}}
                    </h2>
                </div>
                <div class="card-body">

                    <form action="{{ route('register') }}" method="post">
                        {{ csrf_field() }}
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label">{{__('auth.username')}}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                            <div class="mb-3">
                                <label class="form-label">{{__('auth.email_address')}}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{__('auth.password_input')}}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">{{__('auth.confirm_password')}}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="off">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" name="terms">
                                    <span class="form-check-label">{!!__('auth.agree_terms', ['url'=>url('terms')])!!}</span>
                                </label>

                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('auth.sign_me_up') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center text-muted mt-4">
                {{__('auth.alredy_have_an_account')}} <a href="{{ url('login') }}" tabindex="-1">{{__('auth.login')}}</a>
            </div>

        </div>
    </div>
</div>

@endsection