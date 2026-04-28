@extends('layouts.app')
@section('content')
<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title">
                    {{__('Enter an obituary')}}
                </h2>
                <div class="text-muted">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col">
                
                <form action="{{ route('store.obituary') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Form -->
                    <div class="card card-md rounded-3 shadow">
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-lg-6">

                                    <!-- Upload images -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('app.photo')}}</label>
                                        <div class="input-group control-group img_div form-group" >
                                            <input type="file" onchange="ValidateSize(this)" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/x-png,image/jpeg">
                                        
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        
                                        </div>
                                    </div>

                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('app.title')}}</label>
                                        <input type="text" class="form-control form-control-lg @error('title') is-invalid @enderror" name="title" placeholder="{{__('app.placeholder_title')}}" value="{{ old('title') }}">
                                    
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label class="form-label required">{{__('app.description')}}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="editor" name="description" rows="15">{{ old('description') }}</textarea>
                                        <small class="form-hint">{{__('app.form_hint_textarea_insert')}}</small>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    
                                    </div>
                                    <!-- Categoria -->
                                    <div class="mb-3">
                                        <div class="form-label required">{{__('app.category')}}</div>
                                        <select class="form-select form-control @error('category') is-invalid @enderror" name="category">
                                            <option value="">{{__('app.select_category')}}</option>
                                            @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}" @if (old('category') == $cat->id) {{ 'selected' }} @endif>{{ $cat->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('category')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    
                                </div>


                                <div class="col-lg-6">

                                    <div class="row">

                                        <div class="mb-3">
                                            <label class="form-label required">{{__('app.sex')}}</label>

                                            <select class="form-select form-control @error('sex') is-invalid @enderror" name="sex">
                                                <option value="">{{__('app.select_sex')}}</option>
                                                <option value="male" @if(old('sex') == 'male') selected @endif>{{__('app.male') }}</option>
                                                <option value="female" @if(old('sex') == 'female') selected @endif>{{__('app.female') }}</option>
                                            </select>
                                            
                                            @error('sex')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{__('app.birth_date')}}</label>
                                                <input type="date" name="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                                                
                                                @error('birth_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label required">{{__('app.death_date')}}</label>
                                                <input type="date" name="death_date" class="form-control @error('death_date') is-invalid @enderror" value="{{ old('death_date') }}">

                                                @error('death_date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">{{__('app.funeral_place')}}</label>
                                                <input type="text" name="funeral_place" class="form-control @error('funeral_place') is-invalid @enderror" placeholder="{{__('app.placeholder_funeral_place')}}" value="{{ old('funeral_place') }}">

                                                @error('funeral_place')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                        </div>

                                    </div>

                                    <div class="mb-3">
                                        <div class="form-label required">{{__('Terms and Conditions')}}</div>
                                        <label class="form-check form-switch">
                                            <input class="form-check-input @error('terms_of_service') is-invalid @enderror" type="checkbox" value="1" name="terms_of_service" @if(old('terms_of_service') == 1) checked @endif>
                                            <span class="form-check-label">{!!__('app.accept_terms_conditions', ['url'=>url('terms')])!!}</span>
                                        </label>

                                        @error('terms_of_service')
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
                                <a href="{{ route('index') }}" class="btn btn-link">{{__('app.cancel')}}</a>
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