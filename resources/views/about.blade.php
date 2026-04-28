@extends('layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{__('app.about_title')}}
                </div>
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
        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        {!! $settings::find('about')->value !!}
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                @include('sidebar')
            </div>

        </div>
    </div>
</div>

@endsection