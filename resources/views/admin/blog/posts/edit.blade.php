@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Edit Post')}}
                </div>
                <span class="card-subtitle">
                    {{__('Take control of your web application.')}}
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
                <form action="{{ route('admin.blog.posts.update', $post->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Form -->
                    <div class="card card-md rounded-3 shadow">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6">
                                    <fieldset class="form-fieldset">
                                        <!-- Title -->
                                        <div class="mb-3">
                                            <label class="form-label required">{{__('app.title')}}</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                                name="title" placeholder="{{__('app.placeholder_title')}}"
                                                value="{{ $post->title }}">

                                            @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <!-- Categoria -->
                                        <div class="mb-3">
                                            <div class="form-label required">{{__('app.category')}}</div>
                                            <select
                                                class="form-select form-control @error('category') is-invalid @enderror"
                                                name="category_id">
                                                <option value="">{{__('app.select_category')}}</option>
                                                @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" @if ($post->category_id == $cat->id) {{
                                                    'selected'
                                                    }} @endif>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>

                                            @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                        <!-- Description -->
                                        <div class="mb-3">
                                            <label class="form-label">{{__('Seo Description')}}</label>
                                            <textarea class="form-control @error('description') is-invalid @enderror"
                                                name="description" rows="4">{{ $post->description }}</textarea>
                                            <small class="form-hint">{{__('app.form_hint_textarea_insert')}}</small>

                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>

                                    </fieldset>

                                </div>
                                <div class="col-lg-6">
                                    <fieldset class="form-fieldset">
                                        <!-- Upload images -->
                                        <div class="mb-3">
                                            <label class="form-label required">{{__('app.photo')}}</label>
                                            <div class="mb-3">
                                                <img srcset="{{ asset($post->getThumbnail()) }}" width="150px"
                                                    height="150px" class="rounded" alt="" title="">
                                            </div>

                                            <div class="input-group control-group img_div form-group">
                                                <input type="file" onchange="ValidateSize(this)" name="thumbnail"
                                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                                    accept="image/x-png,image/jpeg">
                                                @error('thumbnail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror

                                            </div>

                                        </div>
                                        {{-- Status --}}
                                        <div class="mb-3">
                                            <div class="form-label required">{{__('Status')}}</div>

                                            <label class="form-check form-switch mt-2">
                                                <input type="hidden" name="status" value="0">
                                                <input class="form-check-input @error('status') is-invalid @enderror"
                                                    type="checkbox" value="1" name="status" {{ $post->status
                                                ? 'checked="checked"' : '' }}>
                                            </label>

                                            @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror

                                        </div>
                                    </fieldset>

                                </div>
                            </div>
                            <!-- Body -->
                            <div class="mb-3">
                                <label class="form-label required">{{__('Body')}}</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" id="editor"
                                    name="body" rows="30">{{ $post->body }}</textarea>
                                <small class="form-hint">{{__('app.form_hint_textarea_insert')}}</small>

                                @error('body')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <a href="{{ route('admin.blog.posts') }}" class="btn btn-link">{{__('app.cancel')}}</a>
                                <button type="submit" class="btn btn-blue ms-auto">{{__('app.submit')}}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
