@extends('frontend.master')

@section('content')
    <section id="blog_posts">
        <div class="bg">
            <div class="container">

                @if (session('success'))
                    <div id="floating-alert" class="alert alert-success text-dark alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="row">

                    <div class="col-md-4 d-none d-lg-block">
                        <div class="account-links shadow-sm h-100">
                            <h3>Update your Account</h3>
                            <p>Edit your personal details</p>

                            <nav class="nav flex-column">
                                <a class="nav-link active" href="/account"><i class="fas fa-cog"></i>Setting</a>
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                        class="fas fa-sign-out-alt"></i>Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="display: none;">
                                    @csrf
                                </form>
                            </nav>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="row">
                            <div class="card shadow-sm pb-3" style="border-radius: 32px">
                                <form class="setting-form pb-3" action="{{ route('account.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">

                                        <div class="row">
                                            <div class="col-lg-12">

                                                <div class="row">
                                                    <div class="col-md-5 mb-4 mx-auto text-center">
                                                        <img src="{{ Auth::user()->avatar_url }}"
                                                            alt="{{ Auth::user()->name }}"
                                                            style="height: 70px; width: 70px; border-radius: 50%; object-fit: cover;">
                                                    </div>
                                                </div>

                                                <div class="input-group mb-2">
                                                    <label
                                                        class="form-control text-muted form-file-controll @error('avatar') is-invalid @enderror d-flex align-items-center"
                                                        for="customFile" style="cursor: pointer; border-radius: 12px"
                                                        id="fileLabel">
                                                        <i class="fas fa-upload me-3" style="color: #FBA8B2;"></i> Update
                                                        Avatar
                                                    </label>
                                                    <input type="file" id="customFile" class="d-none" name="avatar">

                                                    @error('avatar')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>


                                                <div class="mb-2">
                                                    <div class="input">
                                                        <div class="form-outline position-relative">
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror ps-5"
                                                                id="name" name="name"
                                                                value="{{ !empty(old('name')) ? old('name') : Auth::user()->name }}"
                                                                autocomplete="name" autofocus placeholder="Name">
                                                            <i class="far fa-user ms-3"></i>
                                                        </div>
                                                    </div>

                                                    @error('name')
                                                        <span class="text-danger ms-1">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <!-- Email input -->
                                                <div class="mb-2">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-10">
                                                            <div class="input">
                                                                <div class="form-outline position-relative">
                                                                    <input type="text"
                                                                        class="form-control @error('email') is-invalid @enderror ps-5"
                                                                        id="email" name="email"
                                                                        value="{{ !empty(old('email')) ? old('email') : Auth::user()->email }}"
                                                                        autocomplete="email" autofocus placeholder="E-mail">
                                                                    <i class="far fa-envelope ms-3"></i>
                                                                </div>
                                                            </div>

                                                            @error('email')
                                                                <span class="text-danger ms-1">
                                                                    <small>{{ $message }}</small>
                                                                </span>
                                                            @enderror
                                                        </div>

                                                        <div class="col-md-2">
                                                            @if (!auth()->user()->hasVerifiedEmail())
                                                                <button type="submit" name="resend_verification"
                                                                    class="btn btn-sm text-muted"><i
                                                                        class="fas fa-user-times"></i>
                                                                    <u class="d-block link-underline">Verify
                                                                        now</u></button>
                                                            @else
                                                                <p class="text-center text-warning m-0"><i
                                                                        class="fas fa-user-check"></i>
                                                                    <span class="d-block">Verified</span>
                                                                </p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="hr-text hr-text-left pt-4">Change Password</div>
                                                <hr>


                                                <!-- Password -->
                                                <div class="mb-2">
                                                    <div class="input">
                                                        <div class="form-outline position-relative">
                                                            <input type="new_password"
                                                                class="form-control @error('new_password') is-invalid @enderror ps-5"
                                                                id="new_password" name="new_password"
                                                                value="{{ old('new_password') }}" autocomplete="off"
                                                                autofocus placeholder="New Password">
                                                            <i class="fas fa-lock ms-3"></i>
                                                        </div>
                                                    </div>

                                                    @error('new_password')
                                                        <span class="text-danger ms-1">
                                                            <small>{{ $message }}</small>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-4">
                                                    <div class="input">
                                                        <div class="form-outline position-relative">
                                                            <input type="password"
                                                                class="form-control @error('new_confirm_password') is-invalid @enderror ps-5"
                                                                placeholder="Password New Repeat"
                                                                name="new_confirm_password" autocomplete="off" autofocus>
                                                            <i class="fas fa-lock ms-3"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="pt-2">
                                                <button type="submit" class="btn form-btn ms-5">Update</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
