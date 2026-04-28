@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Edit Comment')}}
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
                <form action="{{ route('admin.comment.update') }}" method="POST">
                    @csrf
                    <!-- Form -->
                    <div class="card card-md rounded-3 shadow">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-6">

                                    <!-- Content -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('Content')}}</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" 
 name="content" rows="3">{{ !empty(old('content')) ? old('content') : $comment->content }}</textarea>

                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label required">{{__('Status')}}</div>
                
                                        <label class="form-check form-switch mt-2">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" value="1" name="status" {{ old('status', $comment->status) == '1' ? 'checked="checked"' : '' }}>
                                        </label>

                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>


                                
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <div class="d-flex">
                                <!-- hidden input -->
                                <input type="hidden" name="id" value="{{ $comment->id }}">

                                <a href="{{ route('admin.comments') }}" class="btn btn-link">{{__('app.cancel')}}</a>
                                <button type="submit" class="btn btn-blue ms-auto">{{__('app.update')}}</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection