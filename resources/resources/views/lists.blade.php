@extends('layouts.app')
@section('content')

<div class="container-xl">
    <!-- Page title -->
    <div class="page-header d-print-none">
        <div class="row align-items-center">
            <div class="col">
                <div class="page-title text-muted">
                    {{ $cat->name }}
                </div>
                <div class="page-subtitle">
                    {{__('app.there_are_x_results', ['count'=>$items->total()])}}
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
            <div class="col">
                <div class="row row-cards">
                    @forelse($items as $item)
                    <div class="col-lg-4">
                        @include('card')
                    </div>
                    @empty 
                    <div class="empty">
                        <div class="empty-img">
	                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9" /><line x1="9" y1="10" x2="9.01" y2="10" /><line x1="15" y1="10" x2="15.01" y2="10" /><path d="M9.5 16a10 10 0 0 1 6 -1.5" /></svg>
                        </div>
                        <p class="empty-title">{{__('app.sorry_no_results')}}</p>
                        <p class="empty-subtitle text-muted">
                            {{__('app.try_other_keywords')}}
                        </p>
                        <div class="empty-action">
                            <a href="{{ route('insert.obituary') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                {{__('app.btn_propose_an_obituary')}}
                            </a>
                        </div>
                    </div>
                    @endforelse

                    <div class="p-2">
                        {{ $items->links() }}
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