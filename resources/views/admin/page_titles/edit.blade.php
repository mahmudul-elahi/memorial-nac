@extends('admin.layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('Edit Page Title') }}
                    </div>
                    <span class="card-subtitle">
                        {{ __('Modify details of the page title and subtitle.') }}
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
                    <form action="{{ route('admin.page_titles.update', $pageTitle->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Form -->
                        <div class="card card-md rounded-3 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset class="form-fieldset">
                                            <!-- Page Identifier -->
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Page Identifier') }}</label>
                                                <input type="text"
                                                    class="form-control @error('page_identifier') is-invalid @enderror"
                                                    name="page_identifier"
                                                    placeholder="{{ __('Enter the page identifier, e.g., home, post') }}"
                                                    value="{{ old('page_identifier', $pageTitle->page_identifier) }}"
                                                    readonly>
                                                @error('page_identifier')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <!-- Title -->
                                            <div class="mb-3">
                                                <label class="form-label required">{{ __('Title') }}</label>
                                                <input type="text"
                                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                                    placeholder="{{ __('Enter page title') }}"
                                                    value="{{ old('title', $pageTitle->title) }}">
                                                @error('title')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </fieldset>
                                    </div>

                                    <div class="col-lg-6">
                                        <fieldset class="form-fieldset">
                                            <!-- Subtitle -->
                                            <div class="mb-3">
                                                <label class="form-label">{{ __('Subtitle') }}</label>
                                                <textarea class="form-control @error('subtitle') is-invalid @enderror" name="subtitle" rows="3"
                                                    placeholder="{{ __('Enter subtitle (optional)') }}">{{ old('subtitle', $pageTitle->subtitle) }}</textarea>
                                                @error('subtitle')
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
                                    <a href="{{ route('admin.page_titles') }}"
                                        class="btn btn-link">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-blue ms-auto">{{ __('Update') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
