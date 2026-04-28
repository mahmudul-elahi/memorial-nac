@extends('admin.layouts.app')
@section('content')
    <!-- Latest obituaries -->
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                    <div class="page-title text-muted">
                        {{ __('Dashboard') }}
                    </div>
                    <span class="card-subtitle">
                        {{ __('Take control of your web application.') }}
                    </span>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.obituary.create') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            {{ __('Insert New Obituary') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row row-deck row-cards mb-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">
                                    {{ __('Obituaries') }}
                                </div>
                                <div class="ms-auto lh-1">
                                    @if ($items->where('status', '0')->count() >= 1)
                                        <a href="{{ route('admin.obituaries') }}" class="badge bg-red-lt">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="12" cy="12" r="9" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                            {{ $items->where('status', '0')->count() }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="h1 mb-3">
                                {{ $items->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">
                                    {{ __('Categories') }}
                                </div>
                                <div class="ms-auto lh-1">
                                    <a href="{{ route('admin.category.create') }}" class="badge bg-secondary-lt">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        {{ __('Add category') }}
                                    </a>
                                </div>
                            </div>
                            <div class="h1 mb-3">
                                {{ $categories->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">
                                    {{ __('Comments') }}
                                </div>
                                <div class="ms-auto lh-1">
                                    @if ($comments->where('status', '0')->count() >= 1)
                                        <a href="{{ route('admin.comments') }}" class="badge bg-red-lt">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="12" cy="12" r="9" />
                                                <line x1="12" y1="8" x2="12" y2="12" />
                                                <line x1="12" y1="16" x2="12.01" y2="16" />
                                            </svg>
                                            {{ $comments->where('status', '0')->count() }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="h1 mb-3">
                                {{ $comments->count() }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">
                                    {{ __('Total Users') }}
                                </div>
                            </div>
                            <div class="h1 mb-3">
                                {{ $users->count() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-cards">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title">
                                {{ __('Moderate comments') }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="divide-y">
                                @forelse($comments->where('status', '0')->get() as $comment)
                                    <div class="row bg-red-lt">
                                        <div class="col-auto">
                                            <span class="avatar avatar-rounded"
                                                style="background-image: url({{ asset($comment->user->getAvatar()) }})"></span>
                                        </div>
                                        <div class="col">
                                            <div>
                                                <a
                                                    href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                    <strong>{{ $comment->user->name }}</strong>
                                                </a>
                                                <cite>{{ Str::limit($comment->content, 85, '...') }}</cite>
                                            </div>
                                            <div class="small text-muted mt-1">
                                                {{ $comment->created_at->diffForHumans() }} / <a class=""
                                                    href="{{ route('admin.comment.edit', $comment->id) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                        height="24" viewBox="0 0 24 24" stroke-width="2"
                                                        stroke="currentColor" fill="none" stroke-linecap="round"
                                                        stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path
                                                            d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                                                        <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                                                        <line x1="16" y1="5" x2="19"
                                                            y2="8" />
                                                    </svg>
                                                    {{ __('Edit') }}
                                                </a> /
                                                <a href="{{ route('admin.comment.destroy', $comment->id) }}"
                                                    onclick="return confirm('Are you sure?')" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-red"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        stroke-width="2" stroke="currentColor" fill="none"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <line x1="4" y1="7" x2="20"
                                                            y2="7" />
                                                        <line x1="10" y1="11" x2="10"
                                                            y2="17" />
                                                        <line x1="14" y1="11" x2="14"
                                                            y2="17" />
                                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                    </svg>
                                                    {{ __('Delete') }}
                                                </a>
                                            </div>

                                        </div>

                                        <div class="col-auto align-self-center">
                                            <a href="javascript:void(0);"
                                                onclick="updateStatusPost({{ $comment->id }}, 'comment')"
                                                class="btn btn-icon btn-link" id="status-post-{{ $comment->id }}">
                                                <span id="status-post-{{ $comment->id }}">
                                                    @if ($comment->getStatus())
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <circle cx="12" cy="12" r="2" />
                                                            <path
                                                                d="M12 19c-4 0 -7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7c-.42 .736 -.858 1.414 -1.311 2.033" />
                                                            <path d="M15 19l2 2l4 -4" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                            width="24" height="24" viewBox="0 0 24 24"
                                                            stroke-width="2" stroke="currentColor" fill="none"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <line x1="3" y1="3" x2="21"
                                                                y2="21" />
                                                            <path d="M10.584 10.587a2 2 0 0 0 2.828 2.83" />
                                                            <path
                                                                d="M9.363 5.365a9.466 9.466 0 0 1 2.637 -.365c4 0 7.333 2.333 10 7c-.778 1.361 -1.612 2.524 -2.503 3.488m-2.14 1.861c-1.631 1.1 -3.415 1.651 -5.357 1.651c-4 0 -7.333 -2.333 -10 -7c1.369 -2.395 2.913 -4.175 4.632 -5.341" />
                                                        </svg>
                                                    @endif
                                                </span>
                                            </a>
                                        </div>

                                    </div>
                                @empty
                                    {{ __('No comments.') }}
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
