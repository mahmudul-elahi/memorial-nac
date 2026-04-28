@extends('admin.layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('Edit') }} - ({{ $pageImage->text }})
                    </div>
                    <span class="card-subtitle">
                        {{ __('Take control of your page images.') }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col">
                    <form action="{{ route('admin.page_images.update', $pageImage->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Form -->
                        <div class="card card-md rounded-3 shadow">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <!-- Text -->
                                        <div class="mb-3">
                                            <label class="form-label required">{{ __('Text') }}</label>
                                            <input type="text" class="form-control @error('text') is-invalid @enderror"
                                                name="text" placeholder="{{ __('Enter text') }}"
                                                value="{{ old('text', $pageImage->text) }}">

                                            @error('text')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Order -->
                                        <div class="mb-3">
                                            <label class="form-label required">{{ __('Order') }}</label>
                                            <input type="number" class="form-control @error('order') is-invalid @enderror"
                                                name="order" placeholder="{{ __('Enter order') }}"
                                                value="{{ old('order', $pageImage->order) }}" readonly>

                                            @error('order')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <!-- Upload Image -->
                                        <div class="mb-3">
                                            <label class="form-label required">{{ __('Image') }}</label>

                                            <div class="mb-4">
                                                <img src="{{ asset($pageImage->image_url) }}" width="150px" height="150px"
                                                    class="rounded" alt="" title="">
                                            </div>

                                            <div class="input-group">
                                                <input type="file" name="image_url"
                                                    class="form-control @error('image_url') is-invalid @enderror"
                                                    accept="image/x-png,image/jpeg">

                                                @error('image_url')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-end">
                                <div class="d-flex">
                                    <input type="hidden" name="id" value="{{ $pageImage->id }}">
                                    <a href="{{ route('admin.page_images') }}"
                                        class="btn btn-link">{{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-blue ms-auto">{{ __('Save Changes') }}</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
