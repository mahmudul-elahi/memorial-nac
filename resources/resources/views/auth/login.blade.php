@extends('layouts.guest')
@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-4">
 
        <div class="text-center">
            <a href="{{ route('index') }}" class="navbar-brand d-none-navbar-horizontal">
                <img srcset="{{ asset($settings->getLogo()) }}" class="navbar-brand-image">
            </a>
        </div>

        <div class="col-md-10 mx-auto col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">
                        {{__('auth.login')}}
                    </h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">{{ __('auth.email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="mb-2">
                                <label class="form-label">
                                    {{ __('auth.password_input') }}
                                    @if (Route::has('password.request'))
                                    <span class="form-label-description">
                                        <a href="{{ route('password.request') }}">
                                            {{ __('auth.forgot_password') }}
                                        </a>
                                    </span>
                                    @endif
                                </label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" autocomplete="current-password">
                                </div>
                            </div>
                            
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                            <div class="mb-2">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <span class="form-check-label">{{__('auth.remember_me')}}</span>
                                </label>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('auth.login') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center text-muted mt-4">
                {{__('auth.not_registered')}} <a href="{{ url('register') }}" tabindex="-1">{{__('auth.create_an_account')}}</a>
            </div>

        </div>
    </div>
</div>

@endsection