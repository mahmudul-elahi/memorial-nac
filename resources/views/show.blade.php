@extends('layouts.app')
@section('content')

    <div class="theme-dark shadow">
        <div class="container">
            <div class="row align-items-center py-4">

                <div class="col-auto">
                    <span class="avatar avatar-xl avatar-rounded"
                        style="background-image: url({{ asset($item->getThumb()) }});"></span>
                </div>

                <div class="col-lg-10">
                    <h1 class="display-5 fw-bold">
                        {{ $item->title }}
                        ({{ __('app.years_old', ['yo' => Carbon\Carbon::create($item->details->birth_date)->diffInYears()]) }})
                    </h1>
                    <div>
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('app.birth_date') }}">
                            {{ Carbon\Carbon::create($item->details->birth_date)->format('d M, Y') }}
                        </span> -
                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('app.death_date') }}">
                            {{ Carbon\Carbon::create($item->details->death_date)->format('d M, Y') }}
                        </span>
                        @if (!empty($item->details->funeral_place))
                            - <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('app.funeral_place') }}">
                                {{ $item->details->funeral_place }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">

            <div class="row row-cards">
                <div class="col-lg-8">

                    <div class="card border-0 mb-3">
                        <div class="card-header">
                            <h2 class="card-title">
                                {{ __('app.biography_card') }}
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col">

                                    <div class="text-muted mb-2">
                                        {{ $item->created_at->diffForHumans() }} &middot; <a
                                            href="{{ route('category', [$item->category->id, $item->category->slug]) }}">{{ $item->category->name }}</a>
                                        &middot; {{ __('app.' . $item->details->sex) }} &middot; <span
                                            class="text-reset"><svg xmlns="http://www.w3.org/2000/svg" class="icon"
                                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="12" cy="12" r="2" />
                                                <path
                                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                            </svg> {{ $item->views->count() }}</span>
                                    </div>

                                    <div class="text-muted">
                                        {!! $item->description !!}
                                    </div>

                                    <div class="mt-2">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('show.obituary', [$item->id, $item->slug]) }}"
                                            target="_blank" class="text-primary me-2"><svg
                                                xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                            </svg></a>
                                        <a href="https://twitter.com/share?url={{ route('show.obituary', [$item->id, $item->slug]) }}&via={{ $site_name }}&text={{ Str::limit(strip_tags($item->description), 100, '...') }}"
                                            target="_blank" class="text-info me-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path
                                                    d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
                                            </svg></a>
                                        <a href="https://wa.me/?text={{ route('show.obituary', [$item->id, $item->slug]) }}"
                                            target="_blank" class="text-success"><svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" />
                                                <path
                                                    d="M9 10a0.5 .5 0 0 0 1 0v-1a0.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a0.5 .5 0 0 0 0 -1h-1a0.5 .5 0 0 0 0 1" />
                                            </svg></a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h2 class="card-title" id="comments">
                                {{ __('app.write_a_comment') }}
                            </h2>
                        </div>
                        <div class="card-body">

                            <!-- Write a comment -->
                            @guest
                                <div class="mb-4">
                                    <h2 class="card-title">
                                        {{ __('app.you_must_be_logged_in_to_post_a_comment') }}
                                    </h2>

                                    <div class="btn-list">
                                        <a href="{{ route('login') }}" class="btn">
                                            {{ __('app.login') }}
                                        </a>
                                        <a href="{{ route('register') }}" class="btn btn-link">
                                            {{ __('app.register') }}
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="mb-4">
                                    <form action="{{ route('comments.store') }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="avatar avatar-rounded"
                                                    style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                                            </div>
                                            <div class="col">
                                                <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="2"
                                                    placeholder="{{ __('app.write_a_comment_textarea') }}">{{ old('content') }}</textarea>

                                                @error('content')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                                <div class="pt-2">
                                                    <input type="hidden" value="{{ $item->id }}" name="item_id">
                                                    <button type="submit"
                                                        class="btn btn-primary ms-auto">{{ __('app.send') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endguest

                            <!-- List comments -->
                            <h2 class="card-title">
                                {{ __('app.comments') }}
                            </h2>
                            <div class="infinite-scroll">
                                @forelse($comments as $comment)
                                    <div class="row mb-4">
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
                                                {{ $comment->content }}
                                            </div>
                                            <div class="text-muted mt-1">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                        </div>

                                        @if ($comment->isMyComment())
                                            <div class="col-auto">
                                                <form action="{{ route('comments.destroy') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                                    <button type="submit" class="btn btn-link btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon"
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
                                                    </button>
                                                </form>
                                            </div>
                                        @endif

                                    </div>
                                @empty
                                    <div class="empty">
                                        <p class="empty-title">
                                            {{ __('app.there_are_no_comments_yet') }}
                                        </p>
                                        <p class="empty-subtitle text-muted">
                                            {{ __('app.be_the_first_to_leave_a_comment_in_this_post') }}
                                        </p>
                                    </div>
                                @endforelse
                                {{ $comments->links() }}
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">

                    <!-- Condolences Card -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <h2 class="card-title">
                                {{ __('app.who_sent_a_flower') }} ({{ $item->condolences->count() }})
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="divide-y">
                                @forelse($item->condolences->take(2) as $condolence)
                                    <div>
                                        <div class="row">
                                            <div class="col-auto">
                                                <span class="avatar avatar-rounded"
                                                    style="background-image: url({{ asset($condolence->user->getAvatar()) }})"></span>
                                            </div>

                                            <div class="col">
                                                <div class="text-truncate">
                                                    <strong>{{ $condolence->user->name }}</strong>
                                                </div>

                                                <div class="text-muted">{{ $condolence->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <span class="avatar bg-pink-lt">
                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="icon icon-filled text-green" width="24" height="24"
                                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z"></path>
                                                        <path d="M12 9a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3"></path>
                                                        <path d="M12 11a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3"></path>
                                                        <line x1="12" y1="15" x2="12"
                                                            y2="9"></line>
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    {{ __('app.nobody_left_a_heart_be_the_first') }}
                                @endforelse
                            </div>

                            @if ($item->condolences->count() > 2)
                                <div class="mt-2 d-flex justify-content-end">
                                    <a href="#" class="btn btn-link" data-bs-toggle="modal"
                                        data-bs-target="#modal-allCondolences">
                                        {{ __('app.see_all') }}
                                    </a>
                                </div>
                            @endif

                        </div>
                    </div>

                    <a href="javascript:void(0);" onclick="storeCondolence({{ $item->id }})"
                        class="btn btn-dark btn-lg mb-3 w-100">
                        <svg xmlns="http://www.w3.org/2000/svg" id="like-icon-{{ $item->id }}"
                            class="icon icon-md @if (Auth::check()) @if (Auth::user()->hasLiked($item)) icon-filled text-success @else text-muted @endif
@else
text-muted @endif"
                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 15h10v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2v-4z" />
                            <path d="M12 9a6 6 0 0 0 -6 -6h-3v2a6 6 0 0 0 6 6h3" />
                            <path d="M12 11a6 6 0 0 1 6 -6h3v1a6 6 0 0 1 -6 6h-3" />
                            <line x1="12" y1="15" x2="12" y2="9" />
                        </svg>
                        {{ __('app.send_flower') }}
                    </a>

                </div>

            </div>
        </div>
    </div>

    <!-- Modal Condolences -->
    @if ($item->condolences->count() > 2)
        <div class="modal modal-blur fade" id="modal-allCondolences" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('app.who_sent_a_flower') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="divide-y">
                            @foreach ($item->condolences as $condolence)
                                <div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <span class="avatar avatar-rounded"
                                                style="background-image: url({{ asset($condolence->user->getAvatar()) }})"></span>
                                        </div>

                                        <div class="col">
                                            <div class="text-truncate">
                                                <strong>{{ $condolence->user->name }}</strong>
                                            </div>

                                            <div class="text-muted">{{ $condolence->created_at->diffForHumans() }}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
