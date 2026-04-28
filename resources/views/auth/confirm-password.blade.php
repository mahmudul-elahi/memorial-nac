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
                <h3 class="card-title">{{ __('auth.confirm_pass') }}</h3>
            </div>
            
            <div class="mb-4 text-sm text-gray-600">
                {{ __('auth.text_confirm_pass') }}
            </div>
            
            <form method="POST" action="{{ route('password.confirm') }}">
                {{ csrf_field() }}
                <div class="card-body">
                    
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

                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary w-100">{{ __('auth.send') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection