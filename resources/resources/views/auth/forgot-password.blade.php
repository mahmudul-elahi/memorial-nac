@extends('layouts.guest')
@section('content')
<div class="container col-xl-4 col-xxl-4 px-4 py-5">
    <div class="row align-items-center g-lg-4">
    
        <div class="text-center">
            <a href="{{ route('index') }}" class="navbar-brand d-none-navbar-horizontal">
                <img srcset="{{ asset($settings->getLogo()) }}" class="navbar-brand-image">
            </a>
        </div>

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">{{ __('auth.forgot_password') }}</h3>
            </div>
            
            <div class="card-body">
                {{ __('auth.text_forgot_pass') }}
            </div>
            
            <!-- Session Status -->
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
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
                    
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{ __('auth.email_pass_reset_link') }}</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection