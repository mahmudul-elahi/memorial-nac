@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Terms & Conditions - Settings')}}
                </div>
                <span class="card-subtitle">
                    {{__('Take control of your web application.')}}
                </span>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="{{ route('terms') }}" target="_blank" class="btn btn-primary">
                        {{__('View "Terms & Conditions" page')}}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{__('Terms & Conditions')}}
                </h2>
            </div>
            <form action="{{ route('admin.terms.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label class="form-label">{{__('Content')}}</label>
                                <textarea name="terms" rows="20" class="form-control @error('termd') is-invalid @enderror">{!! !empty(old('terms')) ? old('terms') : $settings::find('terms')->value !!}</textarea>
                                <small class="form-hint">
                                    {{__('HTML or plain text allowed.')}}
                                </small>

                                <ul class="mt-2 text-muted">
                                    <li>h1, h2, h3</li>
                                    <li>strong, b</li>
                                    <li>p</li>
                                </ul>


                                @error('about')
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
                                {!! $settings::find('terms')->value !!}
                            </fieldset>

                        </div>


                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-lime">{{__('Update')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection