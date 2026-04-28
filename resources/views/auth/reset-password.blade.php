@extends('layouts.guest')
@section('content')
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-4">

        <div class="text-center">
            <a href="{{ route('index') }}" class="navbar-brand d-none-navbar-horizontal">
                <img srcset="{{ asset($settings->getLogo()) }}" class="navbar-brand-image">
            </a>
        </div>

        <div class="card card-md shadow">

            <div class="card-header">
                <h3 class="card-title">{{ __('auth.reset_password') }}</h3>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">{{ __('auth.email') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $request->email) }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>

                    <div class="mb-2">
                        <label class="form-label">
                            {{ __('auth.password_input') }}
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
                        <label class="form-label">
                            {{ __('auth.confirm_password') }}
                        </label>
                        <div class="input-group input-group-flat">
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Password Confirm" name="password_confirmation" autocomplete="current-password">
                        </div>
                    </div>

                    @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{ __('auth.reset_password') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection