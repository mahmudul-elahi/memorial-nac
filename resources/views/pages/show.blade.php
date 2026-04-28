@extends('layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{ $page->title }}
                </div>
                <span class="page-subtitle">
                    {{ $page->description }}
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
        <div class="row row-cards">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        {!! $page->content !!}
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