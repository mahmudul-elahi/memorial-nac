@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{ $page->title }}
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
    <div class="container-xl">        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{__('Edit')}}
                </h2>
            </div>
            <form action="{{ route('admin.page.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <!-- Title -->
                            <div class="mb-3">
                                <label class="form-label required">{{__('Title')}}</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="{{__('Title')}}" value="{{ !empty(old('title')) ? old('title') : $page->title }}">
                            
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label class="form-label required">{{__('Short Description')}}</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="2">{{ !empty(old('description')) ? old('description') : $page->description }}</textarea>
                                <small class="form-hint">{{__('')}}</small>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{__('Content')}}</label>
                                <textarea name="content" rows="20" id="editor" class="form-control @error('content') is-invalid @enderror">{!! !empty(old('content')) ? old('content') : $page->content !!}</textarea>
                                
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                
                                <small class="form-hint">
                                    {{__('HTML or plain text allowed.')}}
                                </small>

                                <ul class="mt-2 text-muted">
                                    <li>h1, h2, h3</li>
                                    <li>strong, b</li>
                                    <li>p</li>
                                </ul>
                            </div>

                            <div class="mb-3">
                                <div class="form-label required">{{__('Status')}}</div>
        
                                <label class="form-check form-switch mt-2">
                                    <input type="hidden" name="status" value="0">
                                    <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" value="1" name="status" {{ old('status', $page->status) == '1' ? 'checked="checked"' : '' }}>
                                </label>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>

                        <div class="col-lg-6">
                            <label class="form-label">
                                {{__('Preview')}}
                            </label>

                            <fieldset class="form-fieldset">
                                {!! $page->content !!}
                            </fieldset>

                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <input type="hidden" name="id" value="{{ $page->id }}">
                    <button type="submit" class="btn btn-lime">{{__('Update')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection