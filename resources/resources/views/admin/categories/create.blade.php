@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Create New Category')}}
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
                <form action="{{ route('admin.category.store') }}" method="POST">
                    @csrf
                    <!-- Form -->
                    <div class="card card-md rounded-3 shadow">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-6">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('Name')}}</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{__('Name')}}" value="{{ old('name') }}">
                                    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('Description')}}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="3">{{ old('description') }}</textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label required">{{__('Status')}}</div>
                                        
                                        <label class="form-check form-switch mt-2">
                                            <input type="hidden" name="status" value="0">
                                            <input class="form-check-input @error('status') is-invalid @enderror" type="checkbox" value="1" name="status" {{ old('status') == '1' ? 'checked="checked"' : '' }}>
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
                                <a href="#" class="btn btn-link">{{__('app.cancel')}}</a>
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