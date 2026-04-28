@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Settings')}}
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
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    {{__('Update Settings')}}
                </h2>
            </div>
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">

                            <div class="mb-3">
                                <label class="form-label required">{{__('Application Name')}}</label>
                                <input type="text" value="{{ !empty(old('app_name')) ? old('app_name') : $settings::find('app_name')->value }}" class="form-control @error('app_name') is-invalid @enderror" name="app_name" placeholder="">

                                @error('app_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{__('Application Tagline')}}</label>
                                <input type="text" value="{{ !empty(old('app_tagline')) ? old('app_tagline') : $settings::find('app_tagline')->value }}" class="form-control @error('app_tagline') is-invalid @enderror" name="app_tagline" placeholder="">

                                @error('app_tagline')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{__('Application Description')}}</label>
                                <textarea name="app_description" class="form-control" data-bs-toggle="autosize" placeholder="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 56px;">{{ !empty(old('app_description')) ? old('app_description') : $settings::find('app_description')->value }}</textarea>
                            
                                @error('app_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                            </div>

                            <div class="mb-4">
                                <label class="form-label required">{{__('Theme Color')}}</label>
                                <input type="color" name="app_color" class="form-control form-control-color" value="{{ !empty(old('app_color')) ? old('app_color') : $settings::find('app_color')->value }}" title="Choose your color">
                                <small class="form-hint">{{__('NOTE: Assign a color for main components such as the navigation bar, some buttons and other details to customize the layout.')}}</small>

                                @error('app_color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label required">{{__('How many results to show per page?')}}</label>
                                <input type="number" value="{{ !empty(old('num_of_results')) ? old('num_of_results') : $settings::find('num_of_results')->value }}" class="form-control @error('num_of_results') is-invalid @enderror" name="num_of_results">
                                <small class="form-hint">{{__('NOTE: Indicates how many results to show per page. This is also the same for category results, search etc.')}}</small>

                                @error('num_of_results')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <label class="form-label required">{{__('How many comments to show at a time?')}}</label>
                                <input type="number" value="{{ !empty(old('num_comments_at_time')) ? old('num_comments_at_time') : $settings::find('num_comments_at_time')->value }}" class="form-control @error('num_comments_at_time') is-invalid @enderror" name="num_comments_at_time">
                                <small class="form-hint">{{__('NOTE: Indicate how many comments should be shown at a time in the "comments" section of a post and not how many to show overall.')}}</small>

                                @error('num_comments_at_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                            <div class="mb-3">
                                <div class="form-label">{{__('Select Text Direction')}}</div>
                                <select class="form-select form-control @error('dir') is-invalid @enderror" name="dir">
                                    <option value="rtl" @if (old('dir', $settings->find('dir')->value) == "rtl") {{ 'selected' }} @endif>RTL</option>
                                    <option value="ltr" @if (old('dir', $settings->find('dir')->value) == "ltr") {{ 'selected' }} @endif>LTR</option>
                                </select>
                            </div>

                        </div>

                        <div class="col-lg-7">
                        <fieldset class="form-fieldset">
                                <div class="mb-3">
                                    <div class="form-label required">{{__('New entries')}}</div>
                                    <small class="text-muted">{{__('By checking the box you accept that all new entries by users will be published immediately. In any case, you will be able to manage the contents later.')}}</small>
                                    <label class="form-check form-switch mt-2">
                                        <input type="hidden" name="new_entries" value="0">
                                        <input class="form-check-input @error('new_entries') is-invalid @enderror" type="checkbox" value="1" name="new_entries" {{ old('new_entries', $settings::find('new_entries')->value) == '1' ? 'checked="checked"' : '' }}>
                                    </label>

                                    @error('new_entries')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <div class="form-label required">{{__('New comments')}}</div>
                                    <small class="text-muted">{{__('By checking the box you accept that all new comments will be immediately public. In any case, you will be able to manage the contents later.')}}</small>
                                    <label class="form-check form-switch mt-2">
                                        <input type="hidden" name="new_comments" value="0">
                                        <input class="form-check-input @error('new_comments') is-invalid @enderror" type="checkbox" value="1" name="new_comments" {{ old('new_comments', $settings::find('new_comments')->value) == '1' ? 'checked="checked"' : '' }}>
                                    </label>

                                    @error('new_comments')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <div class="form-label required">{{__('Jumbotron')}}</div>
                                    <small class="text-muted">{{__('Choose whether to activate the jumbotron. The jumbotron is a section shown only on the home page to show introductory details of your web application.')}}</small>
                                    <label class="form-check form-switch mt-2">
                                        <input type="hidden" name="jumbotron" value="">
                                        <input class="form-check-input @error('jumbotron') is-invalid @enderror" type="checkbox" value="1" name="jumbotron" {{ old('jumbotron', $settings::find('jumbotron')->value) == '1' ? 'checked="checked"' : '' }}>
                                    </label>

                                    @error('jumbotron')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-lime">{{__('Save Changes')}}</button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection