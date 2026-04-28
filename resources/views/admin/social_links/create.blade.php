@extends('admin.layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('Create Social Link') }}
                    </div>
                    <span class="card-subtitle">
                        {{ __('Add social media links to display on your website.') }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- Optional button actions for admin panel -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col">
                    <form action="{{ route('admin.social_links.store') }}" method="POST">
                        @csrf
                        <!-- Form -->
                        <div class="card card-md rounded-3 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-fieldset">
                                            <!-- Platform -->
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Platform') }}</label>
                                                <input type="text"
                                                    class="form-control @error('platform') is-invalid @enderror"
                                                    name="platform"
                                                    placeholder="{{ __('Enter platform name, e.g., Facebook') }}"
                                                    value="{{ old('platform') }}">
                                                @error('platform')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- URL -->
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('URL') }}</label>
                                                <input type="url"
                                                    class="form-control @error('url') is-invalid @enderror" name="url"
                                                    placeholder="{{ __('Enter the social media link URL') }}"
                                                    value="{{ old('url') }}">
                                                @error('url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-6">
                                        <fieldset class="form-fieldset">
                                            <!-- Icon Class -->
                                            <div class="mb-3">
                                                <label
                                                    class="form-label required">{{ __('Font Awesome Icon Class') }}</label>
                                                <input type="text"
                                                    class="form-control @error('icon') is-invalid @enderror" name="icon"
                                                    placeholder="{{ __('Enter Font Awesome icon class, e.g., fab fa-facebook') }}"
                                                    value="{{ old('icon') }}">
                                                <small
                                                    class="form-hint">{{ __('Example: fab fa-facebook for Facebook') }}</small>
                                                @error('icon')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <a href="{{ route('admin.social_links') }}"
                                        class="btn btn-link">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-blue ms-auto">{{ __('Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
