@extends('layouts.app')
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('app.update_your_account')}}
                </div>
                <div class="page-subtitle">
                    {{__('app.update_your_account_desc')}}
                </div>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row gx-lg-4">

            <div class="d-none d-lg-block col-lg-4">
                <ul class="nav nav-pills nav-vertical">

                    <li class="nav-item">
                        <a href="{{ route('account') }}" class="nav-link">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" /><circle cx="12" cy="12" r="3" /></svg>
                            {{__('Settings')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="nav-link font-weight-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 6a7.75 7.75 0 1 0 10 0" /><line x1="12" y1="4" x2="12" y2="12" /></svg>
                            {{__('Logout')}}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                            @csrf
                        </form>
                    </li>
                    
                </ul>
            </div>

            <div class="col-lg-8">

                <div class="card">
                    <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-8">


                                    <div class="row mb-3 align-items-end">
                                        <div class="col-auto">
                                            <span class="avatar avatar-md" style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                                        </div>
                                        <div class="col">
                                            <div class="form-label">{{__('Avatar')}}</div>
                                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar">

                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label required">{{__('Email')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ !empty(old('email')) ? old('email') : Auth::user()->email }}">
                                    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>

                                   
                                    <div class="hr-text hr-text-left">{{__('app.change_password')}}</div>
                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label">{{__('app.new_password')}}</label>
                                        <div class="col">
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" placeholder="{{ __('app.new_password') }}" value="{{ old('new_password') }}">
                                            
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="form-group mb-3 row">
                                        <label class="form-label">{{__('app.repeat_new_password')}}</label>
                                        <div class="col">
                                            <input type="password" class="form-control @error('new_confirm_password') is-invalid @enderror" name="new_confirm_password" placeholder="{{ __('app.repeat_new_password') }}" value="{{ old('new_confirm_password') }}">
                                            
                                            @error('new_confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            
                                        </div>
                                    </div>


                                </div>
                            </div>


                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn">{{__('app.update')}}</button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection