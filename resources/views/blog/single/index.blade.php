@extends('layouts.app')
@section('content')

<div class="theme-dark shadow">
    <div class="container">
        <div class="row align-items-center py-4">

            <div class="col-auto">
                <span class="avatar avatar-xl avatar-rounded"
                    style="background-image: url({{ asset($post->getThumbnail()) }});"></span>
            </div>

            <div class="col-lg-10">
                <h1 class="display-5 fw-bold">
                    {{ $post->title }}
                </h1>
                <div>
                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{__('Created At')}}">
                        {{ $post->created_at->diffForHumans() }}
                    </span>
                    @if ($post->category)
                    <a href="{{ route("blog.categories.show", $post->category->slug) }}" class="badge bg-green-lt">
                        {{ $post->category->name}}
                    </a>
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

                <div class="card border-0 mb-2">
                    <div class="card-header">
                        <h2 class="card-title">
                            {{__('Details')}}
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="text-muted">
                                    {!! $post->body !!}
                                </div>

                                <div class="mt-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.posts.show', $post->slug) }}"
                                        target="_blank" class="text-primary me-2"><svg
                                            xmlns="http://www.w3.org/2000/svg" class="icon icon-md" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" />
                                        </svg></a>
                                    <a href="https://twitter.com/share?url={{ route('blog.posts.show', $post->slug) }}&via={{ $site_name }}&text={{ Str::limit($post->description, 100, '...') }}"
                                        target="_blank" class="text-info me-2"><svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-md" width="24" height="24" viewBox="0 0 24 24"
                                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c-.002 -.249 1.51 -2.772 1.818 -4.013z" />
                                        </svg></a>
                                    <a href="https://wa.me/?text={{ route('blog.posts.show', $post->slug) }}"
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
                            {{__('app.write_a_comment')}}
                        </h2>
                    </div>
                    <div class="card-body">

                        <!-- Write a comment -->
                        @guest
                        <div class="mb-4">
                            <h2 class="card-title">
                                {{__('app.you_must_be_logged_in_to_post_a_comment')}}
                            </h2>

                            <div class="btn-list">
                                <a href="{{ route('login') }}" class="btn">
                                    {{__('app.login')}}
                                </a>
                                <a href="{{ route('register') }}" class="btn btn-link">
                                    {{__('app.register')}}
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="mb-4">
                            <form action="{{ route('blog.comments.store', $post->slug) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-auto">
                                        <span class="avatar avatar-rounded"
                                            style="background-image: url({{ asset(Auth::user()->getAvatar()) }})"></span>
                                    </div>
                                    <div class="col">
                                        <textarea class="form-control @error('comment') is-invalid @enderror"
                                            name="comment" rows="2"
                                            placeholder="{{__('app.write_a_comment_textarea')}}">{{ old('comment') }}</textarea>

                                        @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <div class="pt-2">
                                            <button type="submit"
                                                class="btn btn-primary ms-auto">{{__('app.send')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @endguest

                        <!-- List comments -->
                        <h2 class="card-title">
                            {{__('app.comments')}}
                        </h2>
                        <div class="infinite-scroll">
                            @forelse($comments as $comment)
                            <div class="row mb-4">
                                <div class="col-auto">
                                    <span class="avatar avatar-rounded"
                                        style="background-image: url({{ asset($comment->commentedBy->getAvatar()) }})"></span>
                                </div>
                                <div class="col">
                                    <div>
                                        <a
                                            href="{{ route('profile', [$comment->commentedBy->id, $comment->commentedBy->name]) }}">
                                            <strong>{{ $comment->commentedBy->name }}</strong>
                                        </a>
                                        {{ $comment->comment }}
                                    </div>
                                    <div class="text-muted mt-1">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                @if($comment->isMyComment())
                                <div class="col-auto">
                                    <form action="{{ route('blog.comments.destroy', $comment->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <line x1="4" y1="7" x2="20" y2="7" />
                                                <line x1="10" y1="11" x2="10" y2="17" />
                                                <line x1="14" y1="11" x2="14" y2="17" />
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
                                    {{__('app.there_are_no_comments_yet')}}
                                </p>
                                <p class="empty-subtitle text-muted">
                                    {{__('app.be_the_first_to_leave_a_comment_in_this_post')}}
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
                            {{__('app.categories')}} ({{ $totalCategories }})
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="divide-y">
                            @forelse($blogCategories as $category)
                            <div class="d-flex justify-content-between">
                                <a href="{{ route("blog.categories.show", $category->slug) }}">
                                    {{ $category->name }}
                                </a>
                                <span class="badge bg-cyan-lt"> {{ $category->posts_count }}</span>
                            </div>
                            @empty
                            {{__('app.no_categories_found')}}
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
