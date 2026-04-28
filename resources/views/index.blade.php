@extends('layouts.app')
@section('content')
    <!-- jumbotron -->
    @includeWhen($jumboStatus, 'jumbotron', ['status' => '1'])
    <!-- end jumbotron -->

    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('app.latest_obituaries_title') }}
                    </div>
                    <div class="page-subtitle">
                        {{ __('app.latest_obituaries_subtitle') }}
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
        <div class="container">

            <div class="row row-cards">
                <div class="col-lg-12">
                    <div class="row row-cards">
                        @forelse($items as $item)
                            <div class="col-lg-3">
                                @include('card')
                            </div>
                        @empty
                            {{ __('app.no_results') }}
                        @endforelse

                        <div class="">
                            {{ $items->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 py-5">
                    <div class="card theme-dark shadow">
                        <div class="row align-items-center p-5">

                            <div class="col-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-lg" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <circle cx="10" cy="10" r="7"></circle>
                                    <line x1="21" y1="21" x2="15" y2="15"></line>
                                </svg>
                            </div>

                            <div class="col-lg-6">
                                <h1 class="text-reset">
                                    {{ __('app.search_section_title') }}
                                </h1>
                                <div class="text-muted">
                                    {{ __('app.search_section_subtitle') }}
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <form action="{{ route('search') }}" method="GET">
                                    @csrf
                                    <div class="input-icon text-center mb-3">
                                        <input type="text"
                                            class="form-control form-control-lg @error('keywords') is-invalid @enderror"
                                            name="keywords" placeholder="{{ __('app.search_placeholder') }}">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <circle cx="10" cy="10" r="7"></circle>
                                                <line x1="21" y1="21" x2="15" y2="15"></line>
                                            </svg>
                                        </span>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest comments -->
            <div class="row row-cards pt-5">

                <div class="d-flex justify-content-center">
                    <h1 class="d-flex align-items-center text-muted">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M12 20l-3 -3h-2a3 3 0 0 1 -3 -3v-6a3 3 0 0 1 3 -3h10a3 3 0 0 1 3 3v6a3 3 0 0 1 -3 3h-2l-3 3" />
                            <line x1="8" y1="9" x2="16" y2="9" />
                            <line x1="8" y1="13" x2="14" y2="13" />
                        </svg>
                        {{ __('app.latest_comments') }}
                    </h1>
                </div>

                @forelse($latestComments as $comment)
                    <div class="col-lg-4">
                        <div class="card card-stacked border-0 rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                            <div class="avatar avatar-rounded"
                                                style="background-image: url({{ asset($comment->user->getAvatar()) }})">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col">
                                        <div class="text-muted">
                                            <cite>{{ Str::limit($comment->content, 150, '...') }}</cite> -> <a
                                                href="{{ route('show.obituary', [$comment->item->id, $comment->item->slug]) }}"
                                                class="font-weight-bold">{{ $comment->item->title }}</a>
                                        </div>
                                        <div class="text-muted">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    {{ __('app.no_results') }}
                @endforelse
            </div>
            <!-- -->

        </div>
    </div>
@endsection
