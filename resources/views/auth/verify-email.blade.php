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
                <h3 class="card-title">{{ __('auth.verify_email') }}</h3>
            </div>
            
            <div class="mb-4 text-sm text-gray-600">
                {{ __('auth.text_verify_email') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('auth.text_resend_verify_email') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                
                <div class="card-body">
                    <button class="btn btn-primary" type="submit">{{ __('auth.resend_verification_email') }}</button>
                </div>
            </form>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{ __('Logout') }}
                </button>

            </form>
            
        </div>
    </div>
</div>
@endsection