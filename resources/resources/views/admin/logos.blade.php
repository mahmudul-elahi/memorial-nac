@extends('admin.layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('Logos')}}
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
                    {{__('Update Logos')}}
                </h2>
            </div>
            <form action="{{ route('admin.logos.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">

                            <!-- Upload images -->
                            <div class="mb-3">

                                <div class="mb-3">
                                    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                                        <img srcset="{{ asset($settings->getLogo()) }}" width="150px" height="150px" class="navbar-brand-image" alt="" title="">
                                    </h1>
                                </div>

                                <div class="input-group control-group img_div form-group" >
                                    <input type="file" name="logo" class="form-control @error('logo') is-invalid @enderror" accept="image/x-png,image/jpeg">
                                
                                    @error('logo')
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