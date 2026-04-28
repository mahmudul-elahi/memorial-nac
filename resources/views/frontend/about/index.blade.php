@extends('frontend.master')

@section('content')
    {{-- Blog Section Start --}}


    <section id="blog_posts">
        <div class="bg">
            <div class="container">

                <div class="row">
                    <div class="col-md-9 gap-3 gap-md-0">


                        <div class="card" style="border-radius: 24px;">
                            <div class="card-header bg-white py-3">
                                {{ $page_name }}
                            </div>
                            <div class="card-body">
                                {!! $settings::find('about')->value !!}
                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="comment m-0">
                            <div class="user-comment">
                                <h4>Latest Comment</h4>

                                <div class="comments">
                                    @forelse($latestComments as $comment)
                                        <div class="comment-box">
                                            <div class="comment-user d-flex align-items-center ">
                                                <div class="author-image me-2">
                                                    <a class="text-dark"
                                                        href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                        <img src="{{ asset($comment->user->getAvatar()) }}"
                                                            alt="user"></a>

                                                </div>
                                                <div class="author">
                                                    <p class="m-0"> <a class="text-dark"
                                                            href="{{ route('profile', [$comment->user->id, $comment->user->name]) }}">
                                                            {{ $comment->user->name }}</a>
                                                        <span class="m-0">
                                                            {{ $comment->created_at->diffForHumans() }}</span>
                                                    </p>

                                                </div>
                                            </div>
                                            <div class="comment-message">
                                                <p> {{ $comment->content }}</p>
                                            </div>
                                        </div>

                                    @empty
                                        <p>No comments yet.</p>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Blog Section End --}}
@endsection
